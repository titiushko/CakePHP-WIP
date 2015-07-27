<?php
App::uses('AppController', 'Controller');

class CategoriaPlatillosController extends AppController {
	public $paginate = array(
		'CategoriaPlatillo' => array(
			'limit' => 4,
			'order' => array(
				'CategoriaPlatillo.categoria' => 'asc'
			)
		),
		'Platillo' => array(
			'limit' => 3,
			'order' => array(
				'Platillo.nombre' => 'asc'
			)
		)
	);
	
	public function beforeFilter() {
		$this->Auth->allow('index', 'ver');
		parent::beforeFilter();
	}
	
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
		$this->CategoriaPlatillo->recursive = 0;
		$this->paginate['CategoriaPlatillo']['order'] = array('CategoriaPlatillo.categoria' => 'asc');
		$this->set(array('categoria_platillos' => $this->paginate(), 'opcion_menu' => array('platillos' => 'active')));
	}
	
	public function ver($id = null) {
		if (!$id) {
			throw new NotFoundException(__('Datos incorrectos.'));
		}
		elseif (!$this->CategoriaPlatillo->exists($id)) {
			throw new NotFoundException(__('Categoría no existe.'));
		}
		else {
			$categoria_platillo = $this->CategoriaPlatillo->find('first', array('conditions' => array('CategoriaPlatillo.'.$this->CategoriaPlatillo->primaryKey => $id)));
			$this->set(array('categoria_platillo' => $categoria_platillo, 'opcion_menu' => array('platillos' => 'active')));
		}
	}
	
	public function nuevo() {
		if ($this->request->is('post')) {
			
			$this->CategoriaPlatillo->create();
			$categoria_platillo = $this->request->data;
			if ($this->CategoriaPlatillo->save($categoria_platillo)) {
				$this->Session->setFlash(__('%s Se creó categoría %s.', '<span style="color: #5cb85c;"><i class="fa fa-check"></i></span>', $categoria_platillo['CategoriaPlatillo']['categoria']), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			}
			
			$this->Session->setFlash(__('%s No se pudo crear categoría.', '<span style="color: #d9534f;"><i class="fa fa-times-circle"></i></span>'), 'default', array('class' => 'alert alert-danger'));
		}
		
		$this->set(array('opcion_menu' => array('platillos' => 'active')));
	}
	
	public function editar($id = null) {
		if (!$id) {
			throw new NotFoundException(__('Datos incorrectos.'));
		}
		
		$categoria_platillo = $this->CategoriaPlatillo->findById($id);
		if (!$categoria_platillo) {
			throw new NotFoundException(__('Categoría no existe.'));
		}
		
		if ($this->request->is(array('post', 'put'))) {
			$this->CategoriaPlatillo->id = $id;
			if ($this->CategoriaPlatillo->save($this->request->data)) {
				$categoria_platillo = $this->CategoriaPlatillo->findById($id);
				$this->Session->setFlash(__('%s Se actualizó categoría %s.', '<span style="color: #5cb85c;"><i class="fa fa-check"></i></span>', $categoria_platillo['CategoriaPlatillo']['categoria']), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			}
			
			$this->Session->setFlash(__('%s No se pudo actualizar categoría.', '<span style="color: #d9534f;"><i class="fa fa-times-circle"></i></span>'), 'default', array('class' => 'alert alert-danger'));
		}
		
		if (!$this->request->data) {
			$this->request->data = $categoria_platillo;
		}
		$this->set(array('categoria_platillo' => $categoria_platillo, 'opcion_menu' => array('platillos' => 'active')));
	}
	
	public function eliminar($id) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException(__('Incorrecto.'));
		}
		
		$categoria_platillo = $this->CategoriaPlatillo->findById($id);
		if (!$categoria_platillo) {
			throw new NotFoundException(__('Categoría no existe.'));
		}
		
		if ($this->CategoriaPlatillo->delete($id)) {
			$this->Session->setFlash(__('%s Se eliminó categoría %s.', '<span style="color: #5cb85c;"><i class="fa fa-check"></i></span>', $categoria_platillo['CategoriaPlatillo']['categoria']), 'default', array('class' => 'alert alert-success'));
			return $this->redirect(array('action' => 'index'));
		}
	}
}
