<?php
App::uses('AppController', 'Controller');

class CocinerosController extends AppController {
	public $helpers = array('Html', 'Form', 'Time', 'Paginator', 'Js');
	public $components = array('Session', 'RequestHandler');
	public $paginate = array(
		'limit' => 3,
		'order' => array(
			'Cocinero.id' => 'asc'
		),
	);
	
	public function index() {
		$this->Cocinero->recursive = 0;
		$this->set(array('cocineros' => $this->paginate(), 'opcion_menu' => array('cocineros' => 'active')));
	}
	
	public function nuevo() {
		if ($this->request->is('post')) {
			
			$this->Cocinero->create();
			$cocinero = $this->request->data;
			if ($this->Cocinero->save($cocinero)) {
				$this->Session->setFlash(__('Se creó cocinero %s %s.', $cocinero['Cocinero']['nombres'], $cocinero['Cocinero']['apellidos']), 'default', array('class' => 'success'));
				return $this->redirect(array('action' => 'index'));
			}
			
			$this->Session->setFlash(__('No se pudo crear el cocinero.'));
		}
	}
	
	public function editar($id = null) {
		if (!$id) {
			throw new NotFoundException(__('Datos incorrectos.'));
		}
		
		$cocinero = $this->Cocinero->findById($id);
		if (!$cocinero) {
			throw new NotFoundException(__('Cocinero no existe.'));
		}
		
		if ($this->request->is(array('post', 'put'))) {
			$this->Cocinero->id = $id;
			if ($this->Cocinero->save($this->request->data)) {
				$cocinero = $this->Cocinero->findById($id);
				$this->Session->setFlash(__('Cocinero %s %s.', $cocinero['Cocinero']['nombres'], $cocinero['Cocinero']['apellidos']), 'default', array('class' => 'success'));
				return $this->redirect(array('action' => 'index'));
			}
			
			$this->Session->setFlash(__('No se puede modificar cocinero.'));
		}
		
		if (!$this->request->data) {
			$this->request->data = $cocinero;
			$this->set(array('cocinero' => $cocinero, 'opcion_menu' => array('cocineros' => 'active')));
		}
	}
	
	function eliminar($id) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException(__('Incorrecto.'));
		}
		
		$cocinero = $this->Cocinero->findById($id);
		if (!$cocinero) {
			throw new NotFoundException(__('Cocinero no existe.'));
		}
		
		if ($this->Cocinero->delete($id)) {
			$this->Session->setFlash(__('Cocinero %s %s eliminado.', $cocinero['Cocinero']['nombres'], $cocinero['Cocinero']['apellidos']), 'default', array('class' => 'success'));
			return $this->redirect(array('action' => 'index'));
		}
	}
}
