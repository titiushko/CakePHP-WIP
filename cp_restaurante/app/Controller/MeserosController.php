<?php
class MeserosController extends AppController {
	public $helpers = array('Html', 'Form', 'Time');
	public $components = array('Session');
	
	public function index() {
		$this->set(array('meseros' => $this->Mesero->find('all'), 'opcion_menu' => array('meseros' => 'active')));
	}
	
	public function ver($id = null) {
		if (!$id) {
			throw new NotFoundException(__('Datos incorrectos.'));
		}
		
		$mesero = $this->Mesero->findById($id);
		if (!$mesero) {
			throw new NotFoundException(__('Mesero no existe.'));
		}
		
		$this->set(array('mesero' => $mesero, 'opcion_menu' => array('meseros' => 'active')));
	}
	
	public function nuevo() {
		if ($this->request->is('post')) {
			
			$this->Mesero->create();
			$mesero = $this->request->data;
		if ($this->Mesero->save($mesero)) {
				$this->Session->setFlash(__('Se creó mesero %s %s.', $mesero['Mesero']['nombres'], $mesero['Mesero']['apellidos']), 'default', array('class' => 'success'));
				return $this->redirect(array('action' => 'index'));
			}
			
			$this->Session->setFlash(__('No se pudo crear el mesero.'));
		}
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
				$this->Session->setFlash(__('Mesero %s %s.', $mesero['Mesero']['nombres'], $mesero['Mesero']['apellidos']), 'default', array('class' => 'success'));
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
			$this->Session->setFlash(__('Mesero %s %s eliminado.', $mesero['Mesero']['nombres'], $mesero['Mesero']['apellidos']), 'default', array('class' => 'success'));
			return $this->redirect(array('action' => 'index'));
		}
	}
}
