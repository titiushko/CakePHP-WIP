<?php
App::uses('AppController', 'Controller');

class MesasController extends AppController {
	public $uses = array('Mesa', 'Persona', 'Orden');
	public $paginate = array(
		'limit' => 5,
		'order' => array(
			'Mesa.serie' => 'asc'
		),
	);
	
	public function isAuthorized($usuario) {
		if ($usuario['rol'] == 'user') {
			if (in_array($this->action, array('index', 'ver', 'nuevo', 'editar'))) return TRUE;
			elseif ($this->Auth->user('id')) {
				$this->Session->setFlash(__('%s NO TIENE ACCESO PARA REALIZAR ESTA ACCIÓN', '<span style="color: #d9534f;"><i class="fa fa-times-circle"></i></span>'), 'default', array('class' => 'alert alert-danger'));
				return $this->redirect(array('action' => 'index'));
			}
		}
		else return parent::isAuthorized($usuario);
	}
	
	public function index() {
		$this->Mesa->recursive = 0;
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
			$this->set(array(
				'mesa' => $this->Mesa->find('first', array('conditions' => array('Mesa.'.$this->Mesa->primaryKey => $id))),
				'ordenes' => $this->Mesa->Orden->find('all', array('conditions' => array('Orden.mesa_id' => $id))),
				'opcion_menu' => array('mesas' => 'active')
			));
		}
	}
	
	public function nuevo() {
		if ($this->request->is('post')) {
			
			$this->Mesa->create();
			$mesa = $this->request->data;
			if ($this->Mesa->save($mesa)) {
				$this->Session->setFlash(__('%s Se creó mesa %s.', '<span style="color: #5cb85c;"><i class="fa fa-check"></i></span>', $mesa['Mesa']['serie']), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			}
			
			$this->Session->setFlash(__('%s No se pudo crear mesa.', '<span style="color: #d9534f;"><i class="fa fa-times-circle"></i></span>'), 'default', array('class' => 'alert alert-danger'));
		}
		
		$this->set(array(
			'meseros' => $this->Mesa->Persona->find('list', array('fields' => array('id', 'nombre_completo'), 'conditions' => array('Persona.cargo' => 'mesero'), 'order' => array('Persona.nombre_completo' => 'ASC'))),
			'opcion_menu' => array('mesas' => 'active')
		));
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
				$this->Session->setFlash(__('%s Se actualizó mesa %s.', '<span style="color: #5cb85c;"><i class="fa fa-check"></i></span>', $mesa['Mesa']['serie']), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			}
			
			$this->Session->setFlash(__('%s No se pudo actualizar mesa.', '<span style="color: #d9534f;"><i class="fa fa-times-circle"></i></span>'), 'default', array('class' => 'alert alert-danger'));
		}
		
		if (!$this->request->data) {
			$this->request->data = $mesa;
		}
		
		$this->set(array(
			'mesa' => $mesa,
			'meseros' => $this->Mesa->Persona->find('list', array('fields' => array('id', 'nombre_completo'), 'conditions' => array('Persona.cargo' => 'mesero'), 'order' => array('Persona.nombre_completo' => 'ASC'))),
			'ordenes' => $this->Mesa->Orden->find('all', array('conditions' => array('Orden.mesa_id' => $id))),
			'opcion_menu' => array('mesas' => 'active')
		));
	}
	
	public function eliminar($id) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException(__('Incorrecto.'));
		}
		
		$mesa = $this->Mesa->findById($id);
		if (!$mesa) {
			throw new NotFoundException(__('Mesa no existe.'));
		}
		
		if ($this->Mesa->delete($id)) {
			$this->Session->setFlash(__('%s Se eliminaó mesa %s.', '<span style="color: #5cb85c;"><i class="fa fa-check"></i></span>', $mesa['Mesa']['serie']), 'default', array('class' => 'alert alert-success'));
			return $this->redirect(array('action' => 'index'));
		}
	}
}
