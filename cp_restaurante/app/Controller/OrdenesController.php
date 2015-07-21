<?php
App::uses('AppController', 'Controller');

class OrdenesController extends AppController {
	public $uses = array('Orden', 'Pedido');
	public $paginate = array(
		'limit' => 4,
		'order' => array(
			'Orden.id' => 'asc'
		)
	);
	
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
			$meseros = $this->Orden->Mesero->find('list', array('fields' => array('id', 'nombre_completo'), 'order' => 'Mesero.nombre_completo ASC'));
			$this->set(compact('pedidos', 'total_orden', 'mesas', 'meseros'));
		}
		else {
			$this->Session->setFlash(__('No se ha procesado ninguna orden.'), 'default', array('class' => 'alert alert-danger'));
			return $this->redirect(array('controller' => 'platillos', 'action' => 'index'));
		}
		
		if ($this->request->is('post')) {
			$this->Orden->create();
			if ($this->Orden->save($this->request->data)) {
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
