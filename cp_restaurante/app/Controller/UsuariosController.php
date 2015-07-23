<?php
App::uses('AppController', 'Controller');

class UsuariosController extends AppController {
	public $uses = array('Usuario', 'Persona');
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
			$datos_persona = array(
				'Persona' => array(
					'dui' => $this->request->data['Usuario']['dui'],
					'nombres' => $this->request->data['Usuario']['nombres'],
					'apellidos' => $this->request->data['Usuario']['apellidos'],
					'telefono' => $this->request->data['Usuario']['telefono'],
					//'cargo' => $this->request->data['Usuario']['cargo']
					'cargo' => 'usuario'
				)
			);
			$this->Persona->create();
			$nueva_persona = $this->Persona->save($datos_persona);
			
			$datos_usuario = array(
				'Usuario' => array(
					'persona_id' => $this->Persona->getLastInsertID(),
					'usuario' => $this->request->data['Usuario']['usuario'],
					'contrasena' => $this->request->data['Usuario']['contrasena'],
					'rol' => $this->request->data['Usuario']['rol']
				)
			);
			$this->Usuario->create();
			$nuevo_usuario = $this->Usuario->save($datos_usuario);
			
			if ($nueva_persona && $nuevo_usuario) {
				$this->Session->setFlash(__('Se creó usuario %s.', $datos_usuario['Usuario']['usuario']), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			}
			elseif (!$nueva_persona) {
				$this->Session->setFlash(__('Error al crear datos de persona para usuario %s.', $datos_usuario['Usuario']['usuario']), 'default', array('class' => 'alert alert-danger'));
				return $this->redirect(array('action' => 'index'));
			}
			elseif (!$nuevo_usuario) $this->Session->setFlash(__('Error al crear datos de usuario.'), 'default', array('class' => 'alert alert-danger'));
			else $this->Session->setFlash(__('No se pudo crear usuario.'), 'default', array('class' => 'alert alert-danger'));
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
			$formulario = $this->request->data;
			$evaluar_contrasena = $this->Usuario->find('all', array('conditions' => array('Usuario.id' => $id, 'Usuario.contrasena' => $formulario['Usuario']['contrasena'])));
			if($formulario['Usuario']['contrasena'] && !empty($evaluar_contrasena)) unset($formulario['Usuario']['contrasena']);
			
			$datos_persona = array(
				'Persona' => array(
					'dui' => $this->request->data['Usuario']['dui'],
					'nombres' => $this->request->data['Usuario']['nombres'],
					'apellidos' => $this->request->data['Usuario']['apellidos'],
					'telefono' => $this->request->data['Usuario']['telefono']
				)
			);
			$this->Persona->id = $usuario['Persona']['id'];
			$editar_persona = $this->Persona->save($datos_persona);
			
			if (empty($formulario['Usuario']['contrasena'])) {
				$datos_usuario = array(
					'Usuario' => array(
						'persona_id' => $this->Persona->getID(),
						'usuario' => $this->request->data['Usuario']['usuario'],
						'rol' => $this->request->data['Usuario']['rol']
					)
				);
			}
			else {
				$datos_usuario = array(
					'Usuario' => array(
						'persona_id' => $this->Persona->getID(),
						'usuario' => $this->request->data['Usuario']['usuario'],
						'contrasena' => $this->request->data['Usuario']['contrasena'],
						'rol' => $this->request->data['Usuario']['rol']
					)
				);
			}
			$this->Usuario->id = $id;
			$editar_usuario = $this->Usuario->save($datos_usuario);
			
			if ($editar_persona && $editar_usuario) {
				$this->Session->setFlash(__('Se actualizó usuario %s.', $usuario['Usuario']['usuario']), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			}
			elseif (!$editar_persona) {
				$this->Session->setFlash(__('Error al actualizar datos de persona para usuario %s.', $datos_usuario['Usuario']['usuario']), 'default', array('class' => 'alert alert-danger'));
				return $this->redirect(array('action' => 'index'));
			}
			elseif (!$editar_usuario) $this->Session->setFlash(__('Error al actualizar datos de usuario.'), 'default', array('class' => 'alert alert-danger'));
			else $this->Session->setFlash(__('No se pudo actualizar usuario.'), 'default', array('class' => 'alert alert-danger'));
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
		
		$eliminar_usuario = $this->Usuario->delete($id);
		$eliminar_persona = $this->Persona->delete($usuario['Persona']['id']);
		
		if ($eliminar_persona && $eliminar_usuario) {
			$this->Session->setFlash(__('Se eliminó usuario %s.', $usuario['Usuario']['usuario']), 'default', array('class' => 'alert alert-success'));
			return $this->redirect(array('action' => 'index'));
		}
		elseif (!$eliminar_persona) {
			$this->Session->setFlash(__('Error al eliminar datos de persona para usuario %s.', $usuario['Usuario']['usuario']), 'default', array('class' => 'alert alert-danger'));
			return $this->redirect(array('action' => 'index'));
		}
		elseif (!$eliminar_usuario) {
			$this->Session->setFlash(__('Error al eliminar datos de usuario.'), 'default', array('class' => 'alert alert-danger'));
			return $this->redirect(array('action' => 'index'));
		}
		else {
			$this->Session->setFlash(__('No se pudo eliminar usuario.'), 'default', array('class' => 'alert alert-danger'));
			return $this->redirect(array('action' => 'index'));
		}
	}
}
