<?php
App::uses('AppController', 'Controller');

class OrdenesController extends AppController {
	public $helpers = array('Html', 'Form', 'Time');
	public $components = array('Session', 'RequestHandler');
	
	public function agregar() {
		$this->loadModel('Pedido');
		$pedidos = $this->Pedido->find('all', array('order' => 'Pedido.id ASC'));
		if (count($pedidos) > 0) {
			$total_orden = $this->Pedido->total_orden();
			$this->loadModel('Orden');
			$mesas = $this->Orden->Mesa->find('list', array('order' => 'Mesa.serie ASC'));
			$this->set(compact('pedidos', 'total_orden', 'mesas'));
		}
		else {
			$this->Session->setFlash(__('No se ha procesado ninguna orden.'), 'default', array('class' => 'alert alert-danger'));
			return $this->redirect(array('controller' => 'platillos', 'action' => 'index'));
		}
		
		if ($this->request->is('post')) {
			$this->loadModel('Orden');
			$this->Orden->create();
			if ($this->Orden->save($this->request->data)) {
				$orden_id = $this->Orden->id;
				for($i = 0; $i < count($pedidos); $i++) {
					$platillo_id = $pedidos[$i]['Pedido']['platillo_id'];
					$cantidad = $pedidos[$i]['Pedido']['cantidad'];
					$subtotal = $pedidos[$i]['Pedido']['subtotal'];
					$this->Orden->PlatillosOrden->saveAll(array('platillo_id' => $platillo_id, 'orden_id' => $orden_id, 'cantidad' => $cantidad, 'subtotal' => $subtotal));
				}
				$this->loadModel('Pedido');
				$this->Pedido->deleteAll(TRUE, FALSE);
				$this->Session->setFlash(__('Se procesó la orden.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('controller' => 'platillos', 'action' => 'index'));
			}
			else {
				$this->Session->setFlash(__('No se pudo procesar la orden.'), 'default', array('class' => 'alert alert-danger'));
			} 
		}
	}
}
