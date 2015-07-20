<?php
App::uses('AppController', 'Controller');

class PlatillosController extends AppController {
	public $helpers = array('Html', 'Form', 'Time', 'Paginator', 'Js');
	public $components = array('Session', 'RequestHandler');
	public $paginate = array(
		'limit' => 12,
		'order' => array(
			'Platillo.nombre' => 'asc'
		),
	);
	
	public function index() {
		$this->Platillo->recursive = 0;
		$this->set(array('platillos' => $this->paginate(), 'opcion_menu' => array('platillos' => 'active')));
	}
	
	public function ver($id = null) {
		if (!$id) {
			throw new NotFoundException(__('Datos incorrectos.'));
		}
		elseif (!$this->Platillo->exists($id)) {
			throw new NotFoundException(__('Platillo no existe.'));
		}
		else {
			$opciones = array('conditions' => array('Platillo.'.$this->Platillo->primaryKey => $id));
			$this->set(array('platillo' => $this->Platillo->find('first', $opciones), 'opcion_menu' => array('platillos' => 'active')));
		}
	}
	
	public function nuevo() {
		if ($this->request->is('post')) {
			
			$this->Platillo->create();
			$platillo = $this->request->data;
			if ($this->Platillo->save($platillo)) {
				$this->Session->setFlash(__('Se creó platillo %s.', $platillo['Platillo']['nombre']), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			}
			
			$this->Session->setFlash(__('No se pudo crear platillo.'), 'default', array('class' => 'alert alert-danger'));
		}
		
		$this->set(array('categoriaPlatillos' => $this->Platillo->CategoriaPlatillo->find('list'), 'cocineros' => $this->Platillo->Cocinero->find('list', array('fields' => array('id', 'nombre_completo'))), 'opcion_menu' => array('platillos' => 'active')));
	}
	
	public function editar($id = null) {
		if (!$id) {
			throw new NotFoundException(__('Datos incorrectos.'));
		}
		
		$platillo = $this->Platillo->findById($id);
		if (!$platillo) {
			throw new NotFoundException(__('Platillo no existe.'));
		}
		
		if ($this->request->is(array('post', 'put'))) {
			$this->Platillo->id = $id;
			if ($this->Platillo->save($this->request->data)) {
				$platillo = $this->Platillo->findById($id);
				$this->loadModel('Pedido');
				$this->Pedido->updateAll(array('Pedido.subtotal' =>'Pedido.cantidad * '.$platillo['Platillo']['precio']), array('Pedido.platillo_id' => $id));
				$this->Session->setFlash(__('Se actualizó platillo %s.', $platillo['Platillo']['nombre']), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			}
			
			$this->Session->setFlash(__('No se pudo actualizar platillo.'), 'default', array('class' => 'alert alert-danger'));
			$this->set('platillo', $platillo);
		}
		
		if (!$this->request->data) {
			$this->request->data = $platillo;
			$this->set('platillo', $platillo);
		}
		
		$this->set(array('categoriaPlatillos' => $this->Platillo->CategoriaPlatillo->find('list'), 'cocineros' => $this->Platillo->Cocinero->find('list', array('fields' => array('id', 'nombre_completo'))), 'opcion_menu' => array('platillos' => 'active')));
	}
	
	public function eliminar($id) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException(__('Incorrecto.'));
		}
		
		$platillo = $this->Platillo->findById($id);
		if (!$platillo) {
			throw new NotFoundException(__('Platillo no existe.'));
		}
		
		if ($this->Platillo->delete($id)) {
			$this->loadModel('Pedido');
			$this->Pedido->deleteAll(array('Pedido.platillo_id' => $id));
			$this->Session->setFlash(__('Se eliminadó platillo %s.', $platillo['Platillo']['nombre']), 'default', array('class' => 'alert alert-success'));
			return $this->redirect(array('action' => 'index'));
		}
	}
	
	public function busqueda() {
		$busqueda = NULL;
		if (!empty($this->request->query['busqueda'])) {
			$busqueda = $this->request->query['busqueda'];
			$terminos_busqueda = explode(' ', trim($busqueda));
			$terminos_busqueda = array_diff($terminos_busqueda, array(''));
			foreach($terminos_busqueda as $termino) $filtro[] = array('Platillo.nombre LIKE' => '%'.$termino.'%');
			$platillos = $this->Platillo->find('all', array('recursive' => -1, 'fields' => array('Platillo.id, Platillo.nombre, Platillo.foto, Platillo.foto_dir'), 'conditions' => $filtro, 'limit' => 10));
		}
		echo json_encode($platillos);
		$this->autoRender = FALSE;
	}
	
	public function buscar() {
		$busqueda = NULL;
		if ($this->request->is(array('post', 'put'))) {
			$busqueda = $this->request->data['Platillo']['busqueda'];
			$busqueda = preg_replace('/[^a-zA-ZñÑáéíóúÁÉÍÓÚ0-9 ]/', '', $busqueda);
			$terminos_busqueda = explode(' ', trim($busqueda));
			$terminos_busqueda = array_diff($terminos_busqueda, array(''));
			$filtro = NULL;
			foreach($terminos_busqueda as $termino) $filtro[] = array('Platillo.nombre LIKE' => '%'.$termino.'%');
			$platillos = $this->Platillo->find('all', array('recursive' => 0, 'conditions' => $filtro, 'order' => array('Platillo.nombre' => 'asc'), 'limit' => 100));
			if (count($platillos) == 1) return $this->redirect(array('action' => 'ver', $platillos[0]['Platillo']['id']));
			$this->set(compact('platillos'));
		}
		$this->set(array('busqueda' => $busqueda, 'opcion_menu' => array('platillos' => 'active')));
		if ($this->request->is('ajax')) {
			$this->layout = FALSE;
			$this->set('ajax', TRUE);
		}
		else {
			$this->set('ajax', FALSE);
		}
	}
}
