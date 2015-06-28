<?php
App::uses('AppController', 'Controller');

class CategoriaPlatillosController extends AppController {
	public $helpers = array('Html', 'Form', 'Time', 'Paginator', 'Js');
	public $components = array('Session', 'RequestHandler');
	public $paginate = array(
		'limit' => 3,
		'order' => array(
			'CategoriaPlatillo.id' => 'asc'
		),
	);
	
	public function index() {
		$this->CategoriaPlatillo->recursive = 0;
		$this->paginate['CategoriaPlatillo']['limit'] = 5;
		$this->paginate['CategoriaPlatillo']['order'] = array('CategoriaPlatillo.categoria' => 'asc');
		$this->set(array('categoria_platillos' => $this->paginate(), 'opcion_menu' => array('platillos' => 'active')));
	}
	
	public function ver($id = null) {
		if (!$id) {
			throw new NotFoundException(__('Datos incorrectos.'));
		}
		elseif (!$this->CategoriaPlatillo->exists($id)) {
			throw new NotFoundException(__('CategoriaPlatillo no existe.'));
		}
		else {
			$opciones = array('conditions' => array('CategoriaPlatillo.'.$this->CategoriaPlatillo->primaryKey => $id));
			$this->set(array('categoria_platillo' => $this->CategoriaPlatillo->find('first', $opciones), 'opcion_menu' => array('platillos' => 'active')));
		}
	}
	
	public function nuevo() {
		if ($this->request->is('post')) {
			
			$this->CategoriaPlatillo->create();
			$categoria_platillo = $this->request->data;
			if ($this->CategoriaPlatillo->save($categoria_platillo)) {
				$this->Session->setFlash(__('Se creó categoria_platillo %s.', $categoria_platillo['CategoriaPlatillo']['categoria']), 'default', array('class' => 'success'));
				return $this->redirect(array('action' => 'index'));
			}
			
			$this->Session->setFlash(__('No se pudo crear el categoria_platillo.'));
		}
		
		$this->set(array('opcion_menu' => array('platillos' => 'active')));
	}
	
	public function editar($id = null) {
		if (!$id) {
			throw new NotFoundException(__('Datos incorrectos.'));
		}
		
		$categoria_platillo = $this->CategoriaPlatillo->findById($id);
		if (!$categoria_platillo) {
			throw new NotFoundException(__('CategoriaPlatillo no existe.'));
		}
		
		if ($this->request->is(array('post', 'put'))) {
			$this->CategoriaPlatillo->id = $id;
			if ($this->CategoriaPlatillo->save($this->request->data)) {
				$categoria_platillo = $this->CategoriaPlatillo->findById($id);
				$this->Session->setFlash(__('CategoriaPlatillo %s.', $categoria_platillo['CategoriaPlatillo']['categoria']), 'default', array('class' => 'success'));
				return $this->redirect(array('action' => 'index'));
			}
			
			$this->Session->setFlash(__('No se puede modificar categoria_platillo.'));
		}
		
		if (!$this->request->data) {
			$this->request->data = $categoria_platillo;
			$this->set(array('categoria_platillo' => $categoria_platillo, 'opcion_menu' => array('platillos' => 'active')));
		}
	}
	
	function eliminar($id) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException(__('Incorrecto.'));
		}
		
		$categoria_platillo = $this->CategoriaPlatillo->findById($id);
		if (!$categoria_platillo) {
			throw new NotFoundException(__('CategoriaPlatillo no existe.'));
		}
		
		if ($this->CategoriaPlatillo->delete($id)) {
			$this->Session->setFlash(__('CategoriaPlatillo %s eliminado.', $categoria_platillo['CategoriaPlatillo']['categoria']), 'default', array('class' => 'success'));
			return $this->redirect(array('action' => 'index'));
		}
	}
}
