<?php
App::uses('AppController', 'Controller');

class MeserosController extends AppController {
	public $helpers = array('Html', 'Form', 'Time', 'Paginator', 'Js');
	public $components = array('Session', 'RequestHandler');
	public $paginate = array(
		'limit' => 3,
		'order' => array(
			'Mesero.nombres' => 'asc'
		),
	);
	
	public function index() {
		$this->Mesero->recursive = 0;
		$this->paginate['Mesero']['limit'] = 5;
		$this->paginate['Mesero']['order'] = array('Mesero.nombres' => 'asc');
		$this->set(array('meseros' => $this->paginate(), 'opcion_menu' => array('empleados' => 'active')));
	}
	
	public function ver($id = null) {
		if (!$id) {
			throw new NotFoundException(__('Datos incorrectos.'));
		}
		elseif (!$this->Mesero->exists($id)) {
			throw new NotFoundException(__('Mesero no existe.'));
		}
		else {
			$opciones = array('conditions' => array('Mesero.'.$this->Mesero->primaryKey => $id));
			$this->set(array('mesero' => $this->Mesero->find('first', $opciones), 'opcion_menu' => array('empleados' => 'active')));
		}
	}
	
	public function nuevo() {
		if ($this->request->is('post')) {
			
			$this->Mesero->create();
			$mesero = $this->request->data;
			if ($this->Mesero->save($mesero)) {
				$this->Session->setFlash(__('Se creó mesero %s %s.', $mesero['Mesero']['nombres'], $mesero['Mesero']['apellidos']), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			}
			
			$this->Session->setFlash(__('No se pudo crear mesero.'), 'default', array('class' => 'alert alert-danger'));
		}
		
		$this->set(array('opcion_menu' => array('empleados' => 'active')));
	}
	
	public function editar($id = null) {
		if (!$id) {
			throw new NotFoundException(__('Datos incorrectos.'));
		}
		
		$mesero = $this->Mesero->findById($id);
		if (!$mesero) {
			throw new NotFoundException(__('Mesero no existe.'));
		}
		
		if ($this->request->is(array('post', 'put'))) {
			$this->Mesero->id = $id;
			if ($this->Mesero->save($this->request->data)) {
				$mesero = $this->Mesero->findById($id);
				$this->Session->setFlash(__('Se actualizó mesero %s %s.', $mesero['Mesero']['nombres'], $mesero['Mesero']['apellidos']), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			}
			
			$this->Session->setFlash(__('No se pudo actualizar mesero.'), 'default', array('class' => 'alert alert-danger'));
			$this->set('mesero', $mesero);
		}
		
		if (!$this->request->data) {
			$this->request->data = $mesero;
			$this->set('mesero', $mesero);
		}
		
		$this->set('opcion_menu', array('empleados' => 'active'));
	}
	
	public function eliminar($id) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException(__('Incorrecto.'));
		}
		
		$mesero = $this->Mesero->findById($id);
		if (!$mesero) {
			throw new NotFoundException(__('Mesero no existe.'));
		}
		
		if ($this->Mesero->delete($id)) {
			$this->Session->setFlash(__('Se eliminó mesero %s.', $mesero['Mesero']['nombre_completo']), 'default', array('class' => 'alert alert-success'));
			return $this->redirect(array('action' => 'index'));
		}
	}
	
	public function mesas() {
		if ($this->request->is('ajax')) {
			$mesero_id = $this->request->data['mesero_id'];
			$mesas = $this->Mesero->Mesa->find('all', array('fields' => array('Mesa.id', 'Mesa.serie'), 'conditions' => array('Mesa.mesero_id' => $mesero_id), 'order' => 'Mesa.serie ASC'));
			echo json_encode(compact('mesas'));
			$this->autoRender = FALSE;
		}
	}
}
