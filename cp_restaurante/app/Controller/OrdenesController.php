<?php
App::uses('AppController', 'Controller');

class OrdenesController extends AppController {
	public $uses = array('Orden', 'Pedido', 'Persona');
	public $paginate = array(
		'limit' => 4,
		'order' => array(
			'Orden.id' => 'asc'
		)
	);
	
	public function isAuthorized($usuario) {
		if ($usuario['rol'] == 'usuario') {
			if (in_array($this->action, array('agregar'))) return TRUE;
			else if($this->Auth->user('id')) {
				$this->Session->setFlash('NO TIENE ACCESO PARA REALIZAR ESTA ACCIÓN', 'default', array('class' => 'alert alert-danger'));
				$this->redirect($this->Auth->redirect());
			}
		}
		else return parent::isAuthorized($usuario);
	}
	
	public function index() {
		$this->Orden->recursive = 0;
		$ordenes = $this->paginate();
		if (count($ordenes) == 0) {
			$this->Session->setFlash(__('No se ha procesado ninguna orden.'), 'default', array('class' => 'alert alert-danger'));
			return $this->redirect(array('controller' => 'platillos', 'action' => 'index'));
		}
		else {
			$this->set(array('ordenes' => $ordenes, 'opcion_menu' => array('ordenes' => 'active')));
		}
	}
	
	public function agregar() {
		$pedidos = $this->Pedido->find('all', array('order' => 'Pedido.id ASC'));
		if (count($pedidos) > 0) {
			$total_orden = $this->Pedido->total_orden();
			$mesas = $this->Orden->Mesa->find('list', array('order' => 'Mesa.serie ASC'));
			$meseros = $this->Orden->Persona->find('list', array('fields' => array('id', 'nombre_completo'), 'conditions' => array('Persona.cargo' => 'mesero'), 'order' => 'Persona.nombre_completo ASC'));
			$this->set(compact('pedidos', 'total_orden', 'mesas', 'meseros'));
		}
		else {
			$this->Session->setFlash(__('No se ha procesado ninguna orden.'), 'default', array('class' => 'alert alert-danger'));
			return $this->redirect(array('controller' => 'platillos', 'action' => 'index'));
		}
		
		if ($this->request->is('post')) {
			//$this->Orden->create();
			$datos_persona = array(
				'Persona' => array(
					'dui' => $this->request->data['Orden']['dui'],
					'nombres' => $this->request->data['Orden']['nombres'],
					'apellidos' => $this->request->data['Orden']['apellidos'],
					//'cargo' => $this->request->data['Orden']['cargo']
					'cargo' => 'cliente'
				)
			);
			$this->Persona->create();
			$nueva_persona = $this->Persona->save($datos_persona);
			
			$datos_orden = array(
				'Orden' => array(
					'cliente_id' => $this->Persona->getLastInsertID(),
					'mesa_id' => $this->request->data['Orden']['mesa_id'],
					'mesero_id' => $this->request->data['Orden']['mesero_id'],
					'total' => $this->request->data['Orden']['total']
				)
			);
			$this->Orden->create();
			$nueva_orden = $this->Orden->save($datos_orden);
			
			if ($nueva_persona && $nueva_orden) {
				$orden_id = $this->Orden->id;
				for($i = 0; $i < count($pedidos); $i++) {
					$platillo_id = $pedidos[$i]['Pedido']['platillo_id'];
					$cantidad = $pedidos[$i]['Pedido']['cantidad'];
					$subtotal = $pedidos[$i]['Pedido']['subtotal'];
					$this->Orden->PlatillosOrden->saveAll(array('platillo_id' => $platillo_id, 'orden_id' => $orden_id, 'cantidad' => $cantidad, 'subtotal' => $subtotal));
				}
				$this->Pedido->deleteAll(TRUE, FALSE);
				$this->Session->setFlash(__('Se procesó la orden.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			}
			else {
				$this->Session->setFlash(__('No se pudo procesar la orden.'), 'default', array('class' => 'alert alert-danger'));
			} 
		}
	}
}
