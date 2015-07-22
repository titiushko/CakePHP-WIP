<?php
App::uses('AppController', 'Controller');

class CocinerosController extends AppController {
	public $paginate = array(
		'limit' => 3,
		'order' => array(
			'Cocinero.nombres' => 'asc'
		),
	);
	
	public function index() {
		$this->Cocinero->recursive = 0;
		$this->set(array('cocineros' => $this->paginate(), 'opcion_menu' => array('empleados' => 'active')));
	}
	
	public function ver($id = null) {
		if (!$id) {
			throw new NotFoundException(__('Datos incorrectos.'));
		}
		elseif (!$this->Cocinero->exists($id)) {
			throw new NotFoundException(__('Cocinero no existe.'));
		}
		else {
			$opciones = array('conditions' => array('Cocinero.'.$this->Cocinero->primaryKey => $id));
			$this->set(array('cocinero' => $this->Cocinero->find('first', $opciones), 'categoriaPlatillos' => $this->Cocinero->Platillo->CategoriaPlatillo->find('list'), 'opcion_menu' => array('empleados' => 'active')));
		}
	}
	
	public function nuevo() {
		if ($this->request->is('post')) {
			
			$this->Cocinero->create();
			$cocinero = $this->request->data;
			if ($this->Cocinero->save($cocinero)) {
				$this->Session->setFlash(__('Se creó cocinero %s %s.', $cocinero['Cocinero']['nombres'], $cocinero['Cocinero']['apellidos']), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			}
			
			$this->Session->setFlash(__('No se pudo crear cocinero.'), 'default', array('class' => 'alert alert-danger'));
		}
		
		$this->set(array('opcion_menu' => array('empleados' => 'active')));
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
				$this->Session->setFlash(__('Se actualizó cocinero %s %s.', $cocinero['Cocinero']['nombres'], $cocinero['Cocinero']['apellidos']), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			}
			
			$this->Session->setFlash(__('No se pudo actualizar cocinero.'), 'default', array('class' => 'alert alert-danger'));
		}
		
		if (!$this->request->data) {
			$this->request->data = $cocinero;
		}
		
		$this->set(array(
			'cocinero' => $cocinero,
			'categoriaPlatillos' => $this->Cocinero->Platillo->CategoriaPlatillo->find('list'),
			'opcion_menu' => array('empleados' => 'active')
		));
	}
	
	public function eliminar($id) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException(__('Incorrecto.'));
		}
		
		$cocinero = $this->Cocinero->findById($id);
		if (!$cocinero) {
			throw new NotFoundException(__('Cocinero no existe.'));
		}
		
		if ($this->Cocinero->delete($id)) {
		$this->Session->setFlash(__('Se eliminó cocinero %s.', $cocinero['Cocinero']['nombre_completo']), 'default', array('class' => 'alert alert-success'));
			return $this->redirect(array('action' => 'index'));
		}
	}
}
