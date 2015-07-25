<?php
App::uses('AppController', 'Controller');

class CategoriaPlatillosController extends AppController {
	public $paginate = array(
		'CategoriaPlatillo' => array(
			'limit' => 4,
			'order' => array(
				'CategoriaPlatillo.categoria' => 'asc'
			)
		),
		'Platillo' => array(
			'limit' => 3,
			'order' => array(
				'Platillo.nombre' => 'asc'
			)
		)
	);
	
	public function beforeFilter() {
		$this->Auth->allow('index', 'ver');
	}
	
	public function isAuthorized($usuario) {
		if ($usuario['rol'] == 'usuario') {
			if (in_array($this->action, array('index', 'ver', 'nuevo', 'editar'))) return TRUE;
			else if($this->Auth->user('id')) {
				$this->Session->setFlash('NO TIENE ACCESO PARA REALIZAR ESTA ACCIÓN', 'default', array('class' => 'alert alert-danger'));
				$this->redirect($this->Auth->redirect());
			}
		}
		else return parent::isAuthorized($usuario);
	}
	
	public function index() {
		$this->CategoriaPlatillo->recursive = 0;
		$this->paginate['CategoriaPlatillo']['order'] = array('CategoriaPlatillo.categoria' => 'asc');
		$this->set(array('categoria_platillos' => $this->paginate(), 'opcion_menu' => array('platillos' => 'active')));
	}
	
	public function ver($id = null) {
		if (!$id) {
			throw new NotFoundException(__('Datos incorrectos.'));
		}
		elseif (!$this->CategoriaPlatillo->exists($id)) {
			throw new NotFoundException(__('Categoría no existe.'));
		}
		else {
			$categoria_platillo = $this->CategoriaPlatillo->find('first', array('conditions' => array('CategoriaPlatillo.'.$this->CategoriaPlatillo->primaryKey => $id)));
			$this->set(array('categoria_platillo' => $categoria_platillo, 'opcion_menu' => array('platillos' => 'active')));
		}
	}
	
	public function nuevo() {
		if ($this->request->is('post')) {
			
			$this->CategoriaPlatillo->create();
			$categoria_platillo = $this->request->data;
			if ($this->CategoriaPlatillo->save($categoria_platillo)) {
				$this->Session->setFlash(__('Se creó categoría %s.', $categoria_platillo['CategoriaPlatillo']['categoria']), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			}
			
			$this->Session->setFlash(__('No se pudo crear categoría.'), 'default', array('class' => 'alert alert-danger'));
		}
		
		$this->set(array('opcion_menu' => array('platillos' => 'active')));
	}
	
	public function editar($id = null) {
		if (!$id) {
			throw new NotFoundException(__('Datos incorrectos.'));
		}
		
		$categoria_platillo = $this->CategoriaPlatillo->findById($id);
		if (!$categoria_platillo) {
			throw new NotFoundException(__('Categoría no existe.'));
		}
		
		if ($this->request->is(array('post', 'put'))) {
			$this->CategoriaPlatillo->id = $id;
			if ($this->CategoriaPlatillo->save($this->request->data)) {
				$categoria_platillo = $this->CategoriaPlatillo->findById($id);
				$this->Session->setFlash(__('Se actualizó categoría %s.', $categoria_platillo['CategoriaPlatillo']['categoria']), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			}
			
			$this->Session->setFlash(__('No se pudo actualizar categoría.'), 'default', array('class' => 'alert alert-danger'));
		}
		
		if (!$this->request->data) {
			$this->request->data = $categoria_platillo;
		}
		$this->set(array('categoria_platillo' => $categoria_platillo, 'opcion_menu' => array('platillos' => 'active')));
	}
	
	public function eliminar($id) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException(__('Incorrecto.'));
		}
		
		$categoria_platillo = $this->CategoriaPlatillo->findById($id);
		if (!$categoria_platillo) {
			throw new NotFoundException(__('Categoría no existe.'));
		}
		
		if ($this->CategoriaPlatillo->delete($id)) {
			$this->Session->setFlash(__('Se eliminó categoría %s.', $categoria_platillo['CategoriaPlatillo']['categoria']), 'default', array('class' => 'alert alert-success'));
			return $this->redirect(array('action' => 'index'));
		}
	}
}
