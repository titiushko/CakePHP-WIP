<?php
App::uses('AppController', 'Controller');

class PedidosController extends AppController {
	public $helpers = array('Html', 'Form', 'Time');
	public $components = array('Session', 'RequestHandler');
	
	public function agregar() {
		if ($this->request->is('ajax')) {
			$id = $this->request->data['id'];
			$cantidad = $this->request->data['cantidad'];			
			$platillo = $this->Pedido->Platillo->find('all', array('fields' => array('Platillo.precio'), 'conditions' => array('Platillo.id' => $id)));			
			$precio = $platillo[0]['Platillo']['precio'];			
			$subtotal = $cantidad * $precio;
			$pedido = $this->Pedido->find('all', array('fields' => array('Pedido.platillo_id'), 'conditions' => array('Pedido.platillo_id' => $id)));
			if (count($pedido) == 0) {
				$this->Pedido->save(array('platillo_id' => $id, 'cantidad' => $cantidad, 'subtotal' => $subtotal));
			}
		}
		
		$this->autoRender = FALSE;
	}
	
	public function index() {
		$this->set('pedidos', $this->Pedido->find('all'));
	}
}
