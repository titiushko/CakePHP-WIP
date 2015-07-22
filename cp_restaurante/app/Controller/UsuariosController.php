<?php
App::uses('AppController', 'Controller');

class UsuariosController extends AppController {
	public $paginate = array(
		'limit' => 3,
		'order' => array(
			'Usuario.usuario' => 'ASC'
		),
	);
	
	public function index() {
		$this->Usuario->recursive = 0;
		$this->paginate['Usuario']['limit'] = 5;
		$this->paginate['Usuario']['order'] = array('Usuario.usuario' => 'ASC');
		$this->set(array('usuarios' => $this->paginate(), 'opcion_menu' => array('usuarios' => 'active')));
	}
	
	public function ver($id = null) {
		if (!$id) {
			throw new NotFoundException(__('Datos incorrectos.'));
		}
		elseif (!$this->Usuario->exists($id)) {
			throw new NotFoundException(__('Usuario no existe.'));
		}
		else {
			$opciones = array('conditions' => array('Usuario.'.$this->Usuario->primaryKey => $id));
			$this->set(array('usuario' => $this->Usuario->find('first', $opciones), 'opcion_menu' => array('usuarios' => 'active')));
		}
	}
	
	public function nuevo() {
		if ($this->request->is('post')) {
			
			$this->Usuario->create();
			$usuario = $this->request->data;
			if ($this->Usuario->save($usuario)) {
				$this->Session->setFlash(__('Se creó usuario %s.', $usuario['Usuario']['usuario']), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			}
			
			$this->Session->setFlash(__('No se pudo crear usuario.'), 'default', array('class' => 'alert alert-danger'));
		}
		
		$this->set(array('opcion_menu' => array('usuarios' => 'active')));
	}
	
	public function editar($id = null) {
		if (!$id) {
			throw new NotFoundException(__('Datos incorrectos.'));
		}
		
		$usuario = $this->Usuario->findById($id);
		if (!$usuario) {
			throw new NotFoundException(__('Usuario no existe.'));
		}
		
		if ($this->request->is(array('post', 'put'))) {
			$this->Usuario->id = $id;
			
			$formulario = $this->request->data;
			$evaluar_contrasena = $this->Usuario->find('all', array('conditions' => array('Usuario.id' => $id, 'Usuario.contrasena' => $formulario['Usuario']['contrasena'])));
			if($formulario['Usuario']['contrasena'] && !empty($evaluar_contrasena)) unset($formulario['Usuario']['contrasena']);
			
			if ($this->Usuario->save($formulario)) {
				$usuario = $this->Usuario->findById($id);
				$this->Session->setFlash(__('Se actualizó usuario %s.', $usuario['Usuario']['usuario']), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			}
			
			$this->Session->setFlash(__('No se pudo actualizar usuario.'), 'default', array('class' => 'alert alert-danger'));
		}
		
		if (!$this->request->data) {
			$this->request->data = $usuario;
		}
		
		$this->set(array('usuario' => $usuario, 'opcion_menu' => array('usuarios' => 'active')));
	}
	
	public function eliminar($id) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException(__('Incorrecto.'));
		}
		
		$usuario = $this->Usuario->findById($id);
		if (!$usuario) {
			throw new NotFoundException(__('Usuario no existe.'));
		}
		
		if ($this->Usuario->delete($id)) {
			$this->Session->setFlash(__('Se eliminó usuario %s.', $usuario['Usuario']['usuario']), 'default', array('class' => 'alert alert-success'));
			return $this->redirect(array('action' => 'index'));
		}
	}
}
