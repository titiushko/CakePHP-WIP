<?php
App::uses('AppController', 'Controller');

class UsersController extends AppController {
	public $uses = array('User', 'Persona');
	public $paginate = array(
		'limit' => 3,
		'order' => array(
			'User.username' => 'ASC'
		),
	);
	public function beforeFilter() {
		parent::beforeFilter();
	}
	
	public function login() {
		if ($this->request->is('post')) {
			if ($this->Auth->login()) return $this->redirect($this->Auth->redirectUrl());
			else $this->Session->setFlash(__('%s Usuario o contraseña no válidos, por favor vuelva a intentarlo.', '<span style="color: #d9534f;"><i class="fa fa-times-circle"></i></span>'), 'default', array('class' => 'alert alert-danger'));
		}
	}
	
	public function logout() {
		return $this->redirect($this->Auth->logout());
	}
	
	public function index() {
		$this->User->recursive = 0;
		$this->paginate['User']['limit'] = 5;
		$this->paginate['User']['order'] = array('User.username' => 'ASC');
		$this->set(array('usuarios' => $this->paginate(), 'opcion_menu' => array('usuarios' => 'active')));
	}
	
	public function ver($id = null) {
		if (!$id) {
			throw new NotFoundException(__('Datos incorrectos.'));
		}
		elseif (!$this->User->exists($id)) {
			throw new NotFoundException(__('Usuario no existe.'));
		}
		else {
			$opciones = array('conditions' => array('User.'.$this->User->primaryKey => $id));
			$this->set(array('usuario' => $this->User->find('first', $opciones), 'opcion_menu' => array('usuarios' => 'active')));
		}
	}
	
	public function nuevo() {
		if ($this->request->is('post')) {
			$datos_persona = array(
				'Persona' => array(
					'dui' => $this->request->data['User']['dui'],
					'nombres' => $this->request->data['User']['nombres'],
					'apellidos' => $this->request->data['User']['apellidos'],
					'telefono' => $this->request->data['User']['telefono'],
					//'cargo' => $this->request->data['User']['cargo']
					'cargo' => 'usuario'
				)
			);
			$this->Persona->create();
			$nueva_persona = $this->Persona->save($datos_persona);
			
			$datos_usuario = array(
				'User' => array(
					'persona_id' => $this->Persona->getLastInsertID(),
					'username' => $this->request->data['User']['username'],
					'password' => $this->request->data['User']['password'],
					'rol' => $this->request->data['User']['rol']
				)
			);
			$this->User->create();
			$nuevo_usuario = $this->User->save($datos_usuario);
			
			if ($nueva_persona && $nuevo_usuario) {
				$this->Session->setFlash(__('%s Se creó usuario %s.', '<span style="color: #5cb85c;"><i class="fa fa-check"></i></span>', $datos_usuario['User']['username']), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			}
			elseif (!$nueva_persona) {
				$this->User->delete($this->User->getLastInsertID());
				$this->Session->setFlash(__('%s Error al crear datos de persona para usuario %s.', '<span style="color: #d9534f;"><i class="fa fa-times-circle"></i></span>', $datos_usuario['User']['username']), 'default', array('class' => 'alert alert-danger'));
				//return $this->redirect(array('action' => 'index'));
			}
			elseif (!$nuevo_usuario) {
				$this->Persona->delete($this->Persona->getLastInsertID());
				$this->Session->setFlash(__('%s Error al crear datos de usuario.', '<span style="color: #d9534f;"><i class="fa fa-times-circle"></i></span>'), 'default', array('class' => 'alert alert-danger'));
			}
			else $this->Session->setFlash(__('%s No se pudo crear usuario.', '<span style="color: #d9534f;"><i class="fa fa-times-circle"></i></span>'), 'default', array('class' => 'alert alert-danger'));
		}
		
		$this->set(array('opcion_menu' => array('usuarios' => 'active')));
	}
	
	public function editar($id = null) {
		if (!$id) {
			throw new NotFoundException(__('Datos incorrectos.'));
		}
		
		$usuario = $this->User->findById($id);
		if (!$usuario) {
			throw new NotFoundException(__('Usuario no existe.'));
		}
		
		if ($this->request->is(array('post', 'put'))) {
			$formulario = $this->request->data;
			$evaluar_password = $this->User->find('all', array('conditions' => array('User.id' => $id, 'User.password' => $formulario['User']['password'])));
			if($formulario['User']['password'] && !empty($evaluar_password)) unset($formulario['User']['password']);
			
			$datos_persona = array(
				'Persona' => array(
					'dui' => $this->request->data['User']['dui'],
					'nombres' => $this->request->data['User']['nombres'],
					'apellidos' => $this->request->data['User']['apellidos'],
					'telefono' => $this->request->data['User']['telefono'],
					'cargo' => 'usuario'
				)
			);
			$this->Persona->id = $usuario['Persona']['id'];
			$editar_persona = $this->Persona->save($datos_persona);
			
			if (empty($formulario['User']['password'])) {
				$datos_usuario = array(
					'User' => array(
						'persona_id' => $this->Persona->getID(),
						'username' => $this->request->data['User']['username'],
						'rol' => $this->request->data['User']['rol']
					)
				);
			}
			else {
				$datos_usuario = array(
					'User' => array(
						'persona_id' => $this->Persona->getID(),
						'username' => $this->request->data['User']['username'],
						'password' => $this->request->data['User']['password'],
						'rol' => $this->request->data['User']['rol']
					)
				);
			}
			$this->User->id = $id;
			$editar_usuario = $this->User->save($datos_usuario);
			
			if ($editar_persona && $editar_usuario) {
				$this->Session->setFlash(__('%s Se actualizó usuario %s.', '<span style="color: #5cb85c;"><i class="fa fa-check"></i></span>', $usuario['User']['username']), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			}
			elseif (!$editar_persona) {
				$this->Session->setFlash(__('%s Error al actualizar datos de persona para usuario %s.', '<span style="color: #d9534f;"><i class="fa fa-times-circle"></i></span>', $datos_usuario['User']['username']), 'default', array('class' => 'alert alert-danger'));
				//return $this->redirect(array('action' => 'index'));
			}
			elseif (!$editar_usuario) $this->Session->setFlash(__('%s Error al actualizar datos de usuario.', '<span style="color: #d9534f;"><i class="fa fa-times-circle"></i></span>'), 'default', array('class' => 'alert alert-danger'));
			else $this->Session->setFlash(__('%s No se pudo actualizar usuario.', '<span style="color: #d9534f;"><i class="fa fa-times-circle"></i></span>'), 'default', array('class' => 'alert alert-danger'));
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
		
		$usuario = $this->User->findById($id);
		if (!$usuario) {
			throw new NotFoundException(__('Usuario no existe.'));
		}
		
		$eliminar_usuario = $this->User->delete($id);
		$eliminar_persona = $this->Persona->delete($usuario['Persona']['id']);
		
		if ($eliminar_persona && $eliminar_usuario) {
			$this->Session->setFlash(__('%s Se eliminó usuario %s.', '<span style="color: #5cb85c;"><i class="fa fa-check"></i></span>', $usuario['User']['username']), 'default', array('class' => 'alert alert-success'));
			return $this->redirect(array('action' => 'index'));
		}
		elseif (!$eliminar_persona) {
			$this->Session->setFlash(__('%s Error al eliminar datos de persona para usuario %s.', '<span style="color: #d9534f;"><i class="fa fa-times-circle"></i></span>', $usuario['User']['username']), 'default', array('class' => 'alert alert-danger'));
			return $this->redirect(array('action' => 'index'));
		}
		elseif (!$eliminar_usuario) {
			$this->Session->setFlash(__('%s Error al eliminar datos de usuario.', '<span style="color: #d9534f;"><i class="fa fa-times-circle"></i></span>'), 'default', array('class' => 'alert alert-danger'));
			return $this->redirect(array('action' => 'index'));
		}
		else {
			$this->Session->setFlash(__('%s No se pudo eliminar usuario.', '<span style="color: #d9534f;"><i class="fa fa-times-circle"></i></span>'), 'default', array('class' => 'alert alert-danger'));
			return $this->redirect(array('action' => 'index'));
		}
	}
}
