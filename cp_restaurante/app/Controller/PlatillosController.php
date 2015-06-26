<?php
App::uses('AppController', 'Controller');

class PlatillosController extends AppController {
	public $helpers = array('Html', 'Form', 'Time', 'Paginator', 'Js');
	public $components = array('Session', 'RequestHandler');
	public $paginate = array(
		'limit' => 5,
		'order' => array(
			'Platillo.id' => 'asc'
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
				$this->Session->setFlash(__('Se creó platillo %s.', $platillo['Platillo']['nombre']), 'default', array('class' => 'success'));
				return $this->redirect(array('action' => 'index'));
			}
			
			$this->Session->setFlash(__('No se pudo crear el platillo.'));
		}
		
		$this->set(array('categorias_platillos' => $this->Platillo->CategoriaPlatillo->find('list'), 'opcion_menu' => array('platillos' => 'active')));
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
				$this->Session->setFlash(__('Platillo %s actualizada.', $platillo['Platillo']['nombre']), 'default', array('class' => 'success'));
				return $this->redirect(array('action' => 'index'));
			}
			
			$this->Session->setFlash(__('No se puede modificar platillo.'));
		}
		
		if (!$this->request->data) {
			$this->request->data = $platillo;
			$this->set(array('platillo' => $platillo, 'opcion_menu' => array('platillos' => 'active')));
		}
		
		$this->set(array('categorias_platillos' => $this->Platillo->CategoriaPlatillo->find('list'), 'cocineros' => $this->Platillo->Cocinero->find('list')));
	}
	
	function eliminar($id) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException(__('Incorrecto.'));
		}
		
		$platillo = $this->Platillo->findById($id);
		if (!$platillo) {
			throw new NotFoundException(__('Platillo no existe.'));
		}
		
		if ($this->Platillo->delete($id)) {
			$this->Session->setFlash(__('Platillo %s eliminada.', $platillo['Platillo']['nombre']), 'default', array('class' => 'success'));
			return $this->redirect(array('action' => 'index'));
		}
	}
}
