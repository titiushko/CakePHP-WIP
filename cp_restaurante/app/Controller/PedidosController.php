<?php
App::uses('AppController', 'Controller');

class PedidosController extends AppController {
	public function isAuthorized($usuario) {
		if ($usuario['rol'] == 'user') {
			if (in_array($this->action, array('agregar', 'index', 'actualizar_pedido', 'eliminar_pedido', 'eliminar_pedidos'))) return TRUE;
			elseif ($this->Auth->user('id')) {
				$this->Session->setFlash(__('%s NO TIENE ACCESO PARA REALIZAR ESTA ACCIÓN', '<span style="color: #d9534f;"><i class="fa fa-times-circle"></i></span>'), 'default', array('class' => 'alert alert-danger'));
				return $this->redirect(array('action' => 'index'));
			}
		}
		else return parent::isAuthorized($usuario);
	}
	
	public function agregar() {
		if ($this->request->is('ajax')) {
			$platillo_id = $this->request->data['id'];
			$cantidad = $this->request->data['cantidad'];
			$subtotal = $cantidad * $this->Pedido->Platillo->precio_platillo($platillo_id);
			
			$pedido = $this->Pedido->find('all', array('fields' => array('Pedido.platillo_id'), 'conditions' => array('Pedido.platillo_id' => $platillo_id)));
			if (count($pedido) == 0) $this->Pedido->save(array('platillo_id' => $platillo_id, 'cantidad' => $cantidad, 'subtotal' => $subtotal));
		}
		
		$this->autoRender = FALSE;
	}
	
	public function index() {
		$pedidos = $this->Pedido->find('all');
		if (count($pedidos) == 0) {
			$this->Session->setFlash(__('%s No se han agregado pedidos a la orden.', '<span style="color: #d9534f;"><i class="fa fa-times-circle"></i></span>'), 'default', array('class' => 'alert alert-danger'));
			return $this->redirect(array('controller' => 'platillos', 'action' => 'index'));
		}
		else {
			$this->set(array('pedidos' => $pedidos, 'total_orden' => $this->Pedido->total_orden()));
		}
	}
	
	public function actualizar_pedido() {
		if ($this->request->is('ajax')) {
			$pedido_id = $this->request->data['id'];
			$cantidad = isset($this->request->data['cantidad']) ? preg_replace('/[^1-9]/', '', $this->request->data['cantidad']) : NULL;
			if ($cantidad == 0 || $cantidad == '') $cantidad = 1;
			$subtotal = $cantidad * $this->Pedido->precio_platillo($pedido_id);
			
			$this->Pedido->saveAll(array('id' => $pedido_id, 'cantidad' => $cantidad, 'subtotal' => $subtotal));
			
			$pedido = array(
				'id' => $pedido_id,
				'cantidad' => ''.$cantidad.'',
				'subtotal' => number_format($subtotal, 2, '.', ','),
				'total_orden' => number_format($this->Pedido->total_orden(), 2, '.', ',')
			);
			echo json_encode(compact('pedido'));
			$this->autoRender = FALSE;
		}
	}
	
	public function eliminar_pedido() {
		if ($this->request->is('ajax')) {
			$pedido_id = $this->request->data['id'];
			
			$this->Pedido->delete($pedido_id);
			
			$total_orden = $this->Pedido->total_orden();
			if (count($total_orden) == 0) $total_orden = '0';
			
			$pedidos = $this->Pedido->find('all');
			
			echo json_encode(compact('pedidos', 'total_orden'));
			$this->autoRender = FALSE;
		}
	}
	
	public function eliminar_pedidos() {
		if ($this->Pedido->deleteAll(TRUE, FALSE)) $this->Session->setFlash(__('%s Se eliminaron todos los pedidos de la orden.', '<span style="color: #5cb85c;"><i class="fa fa-check"></i></span>'), 'default', array('class' => 'alert alert-success'));
		else $this->Session->setFlash(__('%s No se pudieron eliminar todos los pedidos de la orden.', '<span style="color: #d9534f;"><i class="fa fa-times-circle"></i></span>'), 'default', array('class' => 'alert alert-danger'));
		return $this->redirect(array('controller' => 'platillos', 'action' => 'index'));
	}
}
