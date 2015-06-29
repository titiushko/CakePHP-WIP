<?php
App::uses('AppController', 'Controller');

class MesasController extends AppController {
	public $helpers = array('Html', 'Form', 'Time', 'Paginator', 'Js');
	public $components = array('Session', 'RequestHandler');
	public $paginate = array(
		'limit' => 5,
		'order' => array(
			'Mesa.serie' => 'asc'
		),
	);
	
	public function index() {
		$this->Mesa->recursive = 0;
		//$this->paginate['Mesa']['conditions'] = array('Mesa.mesero_id' => 2);
		$this->set(array('mesas' => $this->paginate(), 'opcion_menu' => array('mesas' => 'active')));
	}
	
	public function ver($id = null) {
		if (!$id) {
			throw new NotFoundException(__('Datos incorrectos.'));
		}
		elseif (!$this->Mesa->exists($id)) {
			throw new NotFoundException(__('Mesa no existe.'));
		}
		else {
			$opciones = array('conditions' => array('Mesa.'.$this->Mesa->primaryKey => $id));
			$this->set(array('mesa' => $this->Mesa->find('first', $opciones), 'opcion_menu' => array('mesas' => 'active')));
		}
	}
	
	public function nuevo() {
		if ($this->request->is('post')) {
			
			$this->Mesa->create();
			$mesa = $this->request->data;
			if ($this->Mesa->save($mesa)) {
				$this->Session->setFlash(__('Se creó mesa %s.', $mesa['Mesa']['serie']), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			}
			
			$this->Session->setFlash(__('No se pudo crear mesa.'), 'default', array('class' => 'alert alert-danger'));
		}
		
		$this->set(array('meseros' => $this->Mesa->Mesero->find('list', array('fields' => array('id', 'nombre_completo'))), 'opcion_menu' => array('mesas' => 'active')));
	}
	
	public function editar($id = null) {
		if (!$id) {
			throw new NotFoundException(__('Datos incorrectos.'));
		}
		
		$mesa = $this->Mesa->findById($id);
		if (!$mesa) {
			throw new NotFoundException(__('Mesa no existe.'));
		}
		
		if ($this->request->is(array('post', 'put'))) {
			$this->Mesa->id = $id;
			if ($this->Mesa->save($this->request->data)) {
				$mesa = $this->Mesa->findById($id);
				$this->Session->setFlash(__('Se actualizó mesa %s.', $mesa['Mesa']['serie']), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			}
			
			$this->Session->setFlash(__('No se pudo actualizar mesa.'), 'default', array('class' => 'alert alert-danger'));
			$this->set('mesa', $mesa);
		}
		
		if (!$this->request->data) {
			$this->request->data = $mesa;
			$this->set('mesa', $mesa);
		}
		
		$this->set(array('meseros' => $this->Mesa->Mesero->find('list', array('fields' => array('id', 'nombre_completo'))), 'opcion_menu' => array('mesas' => 'active')));
	}
	
	function eliminar($id) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException(__('Incorrecto.'));
		}
		
		$mesa = $this->Mesa->findById($id);
		if (!$mesa) {
			throw new NotFoundException(__('Mesa no existe.'));
		}
		
		if ($this->Mesa->delete($id)) {
			$this->Session->setFlash(__('Se eliminaó mesa %s.', $mesa['Mesa']['serie']), 'default', array('class' => 'alert alert-success'));
			return $this->redirect(array('action' => 'index'));
		}
	}
}
