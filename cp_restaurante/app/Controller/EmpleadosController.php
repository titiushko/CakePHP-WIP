<?php
App::uses('AppController', 'Controller');

class EmpleadosController extends AppController {
	public $uses = array('Persona');
	public $paginate = array(
		'limit' => 3,
		'order' => array(
			'Persona.nombres' => 'ASC'
		),
	);
	
	public function isAuthorized($usuario) {
		if ($usuario['rol'] == 'usuario') {
			if (in_array($this->action, array('index', 'ver', 'nuevo', 'editar', 'mesas'))) return TRUE;
			else if($this->Auth->user('id')) {
				$this->Session->setFlash('NO TIENE ACCESO PARA REALIZAR ESTA ACCIÓN', 'default', array('class' => 'alert alert-danger'));
				$this->redirect($this->Auth->redirect());
			}
		}
		else return parent::isAuthorized($usuario);
	}
	
	public function index() {
		$this->Persona->recursive = 0;
		$this->paginate['Persona']['limit'] = 5;
		$this->paginate['Persona']['conditions'] = array('Persona.cargo IN' => array('mesero', 'cocinero'));
		$this->paginate['Persona']['order'] = array('Persona.nombres' => 'ASC');
		$this->set(array('empleados' => $this->paginate(), 'opcion_menu' => array('empleados' => 'active')));
	}
	
	public function ver($id = null) {
		if (!$id) {
			throw new NotFoundException(__('Datos incorrectos.'));
		}
		elseif (!$this->Persona->exists($id)) {
			throw new NotFoundException(__('Persona no existe.'));
		}
		else {
			$empleado = $this->Persona->find('first', array('conditions' => array('Persona.'.$this->Persona->primaryKey => $id)));
			$asociacion = array(
				'mesero' => array('ordenes', $this->Persona->Orden->find('all', array('conditions' => array('Orden.mesero_id' => $id)))),
				'cocinero' => array('categoriaPlatillos', $this->Persona->Platillo->CategoriaPlatillo->find('list'))
			);
			$this->set(array(
				'empleado' => $empleado,
				$asociacion[$empleado['Persona']['cargo']][0] => $asociacion[$empleado['Persona']['cargo']][1],
				'opcion_menu' => array('empleados' => 'active')
			));
		}
	}
	
	public function nuevo() {
		if ($this->request->is('post')) {
			
			$this->Persona->create();
			$empleado = $this->request->data;
			if ($this->Persona->save($empleado)) {
				$this->Session->setFlash(__('Se creó empleado %s %s.', $empleado['Persona']['nombres'], $empleado['Persona']['apellidos']), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			}
			
			$this->Session->setFlash(__('No se pudo crear empleado.'), 'default', array('class' => 'alert alert-danger'));
		}
		
		$this->set(array('opcion_menu' => array('empleados' => 'active')));
	}
	
	public function editar($id = null) {
		if (!$id) {
			throw new NotFoundException(__('Datos incorrectos.'));
		}
		
		$empleado = $this->Persona->findById($id);
		if (!$empleado) {
			throw new NotFoundException(__('Persona no existe.'));
		}
		
		if ($this->request->is(array('post', 'put'))) {
			$this->Persona->id = $id;
			if ($this->Persona->save($this->request->data)) {
				$empleado = $this->Persona->findById($id);
				$this->Session->setFlash(__('Se actualizó empleado %s %s.', $empleado['Persona']['nombres'], $empleado['Persona']['apellidos']), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			}
			
			$this->Session->setFlash(__('No se pudo actualizar empleado.'), 'default', array('class' => 'alert alert-danger'));
		}
		
		if (!$this->request->data) {
			$this->request->data = $empleado;
		}
		
		$this->set(array(
			'opcion_menu' => array('empleados' => 'active'),
			'ordenes' => $this->Persona->Orden->find('all', array('conditions' => array('Orden.mesero_id' => $id))),
			'empleado' => $empleado
		));
	}
	
	public function eliminar($id) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException(__('Incorrecto.'));
		}
		
		$empleado = $this->Persona->findById($id);
		if (!$empleado) {
			throw new NotFoundException(__('Persona no existe.'));
		}
		
		if ($this->Persona->delete($id)) {
			$this->Session->setFlash(__('Se eliminó empleado %s.', $empleado['Persona']['nombre_completo']), 'default', array('class' => 'alert alert-success'));
			return $this->redirect(array('action' => 'index'));
		}
	}
	
	public function mesas() {
		if ($this->request->is('ajax')) {
			$mesero_id = $this->request->data['mesero_id'];
			$mesas = $this->Persona->Mesa->find('all', array('fields' => array('Mesa.id', 'Mesa.serie'), 'conditions' => array('Mesa.mesero_id' => $mesero_id), 'order' => 'Mesa.serie ASC'));
			echo json_encode(compact('mesas'));
			$this->autoRender = FALSE;
		}
	}
}
