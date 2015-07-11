<?php
App::uses('AppController', 'Controller');

class PedidosController extends AppController {
	public $helpers = array('Html', 'Form', 'Time');
	public $components = array('Session', 'RequestHandler');
	
	public function agregar() {
		if ($this->request->is('ajax')) {
			$platillo_id = $this->request->data['id'];
			$cantidad = $this->request->data['cantidad'];
			
			$precio = $this->Pedido->Platillo->find('all', array('fields' => array('Platillo.precio'), 'conditions' => array('Platillo.id' => $platillo_id)))[0]['Platillo']['precio'];
			$subtotal = $cantidad * $precio;
			
			$pedido = $this->Pedido->find('all', array('fields' => array('Pedido.platillo_id'), 'conditions' => array('Pedido.platillo_id' => $platillo_id)));
			if (count($pedido) == 0) $this->Pedido->save(array('platillo_id' => $platillo_id, 'cantidad' => $cantidad, 'subtotal' => $subtotal));
		}
		
		$this->autoRender = FALSE;
	}
	
	public function index() {
		$pedidos = $this->Pedido->find('all');
		if (count($pedidos) == 0) {
			$this->Session->setFlash(__('No se han agregado platillos a la orden.'), 'default', array('class' => 'alert alert-success'));
			return $this->redirect(array('controller' => 'platillos', 'action' => 'index'));
		}
		else {
			$this->set(array('pedidos' => $pedidos, 'total_orden' => $this->Pedido->find('all', array('fields' => array('SUM(Pedido.subtotal) subtotal')))[0][0]['subtotal']));
		}
	}
	
	public function actualizar_orden() {
		if ($this->request->is('ajax')) {
			$pedido_id = $this->request->data['id'];
			$cantidad = isset($this->request->data['cantidad']) ? $this->request->data['cantidad'] : NULL;
			if ($cantidad == 0) $cantidad = 1;
			
			$precio = $this->Pedido->find('all', array('fields' => array('Platillo.precio'), 'conditions' => array('Pedido.id' => $pedido_id)))[0]['Platillo']['precio'];
			$subtotal = $cantidad * $precio;
			
			$this->Pedido->saveAll(array('id' => $pedido_id, 'cantidad' => $cantidad, 'subtotal' => $subtotal));
			
			$total_orden = $this->Pedido->find('all', array('fields' => array('SUM(Pedido.subtotal) subtotal')))[0][0]['subtotal'];
			$pedido = $this->Pedido->find('all', array('fields' => array('Pedido.id', 'Pedido.subtotal'), 'conditions' => array('Pedido.id' => $pedido_id)));
			
			$orden = array(
				'id' => $pedido[0]['Pedido']['id'],
				'subtotal' => $pedido[0]['Pedido']['subtotal'],
				'total_orden' => $total_orden
			);
			echo json_encode(compact('orden'));
			$this->autoRender = FALSE;
		}
	}
}
