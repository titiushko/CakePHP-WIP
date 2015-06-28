<?php
App::uses('AppController', 'Controller');

class MeserosController extends AppController {
	public $helpers = array('Html', 'Form', 'Time', 'Paginator', 'Js');
	public $components = array('Session', 'RequestHandler');
	public $paginate = array(
		'limit' => 3,
		'order' => array(
			'Mesero.id' => 'asc'
		),
	);
	
	public function index() {
		$this->Mesero->recursive = 0;
		$this->paginate['Mesero']['limit'] = 5;
		$this->paginate['Mesero']['order'] = array('Mesero.nombres' => 'asc');
		$this->set(array('meseros' => $this->paginate(), 'opcion_menu' => array('meseros' => 'active')));
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
			$this->set(array('mesero' => $this->Mesero->find('first', $opciones), 'opcion_menu' => array('meseros' => 'active')));
		}
	}
	
	public function nuevo() {
		if ($this->request->is('post')) {
			
			$this->Mesero->create();
			$mesero = $this->request->data;
			if ($this->Mesero->save($mesero)) {
				$this->Session->setFlash(__('Se creó mesero %s.', $mesero['Mesero']['nombre_completo']), 'default', array('class' => 'success'));
				return $this->redirect(array('action' => 'index'));
			}
			
			$this->Session->setFlash(__('No se pudo crear el mesero.'));
		}
		
		$this->set(array('opcion_menu' => array('meseros' => 'active')));
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
				$this->Session->setFlash(__('Mesero %s.', $mesero['Mesero']['nombre_completo']), 'default', array('class' => 'success'));
				return $this->redirect(array('action' => 'index'));
			}
			
			$this->Session->setFlash(__('No se puede modificar mesero.'));
		}
		
		if (!$this->request->data) {
			$this->request->data = $mesero;
			$this->set(array('mesero' => $mesero, 'opcion_menu' => array('meseros' => 'active')));
		}
	}
	
	function eliminar($id) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException(__('Incorrecto.'));
		}
		
		$mesero = $this->Mesero->findById($id);
		if (!$mesero) {
			throw new NotFoundException(__('Mesero no existe.'));
		}
		
		if ($this->Mesero->delete($id)) {
			$this->Session->setFlash(__('Mesero %s eliminado.', $mesero['Mesero']['nombre_completo']), 'default', array('class' => 'success'));
			return $this->redirect(array('action' => 'index'));
		}
	}
}
