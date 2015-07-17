<?php
App::uses('AppController', 'Controller');

class PlatillosOrdenesController extends AppController {
	public $uses = array('PlatillosOrden');
	public $helpers = array('Html', 'Form', 'Time', 'Paginator', 'Js');
	public $components = array('Session', 'RequestHandler');
	public $paginate = array(
		'limit' => 4,
		'order' => array(
			'PlatillosOrden.id' => 'asc'
		)
	);
	
	public function ver($id = NULL) {
		if (!$id) {
			throw new NotFoundException(__('Datos incorrectos.'));
		}
		elseif (!$this->PlatillosOrden->exists($id)) {
			throw new NotFoundException(__('Pedido no existe.'));
		}
		else {
			$this->paginate['PlatillosOrden']['limit'] = 4;
			$this->paginate['PlatillosOrden']['order'] = array('PlatillosOrden.id' => 'asc');
			$this->paginate['PlatillosOrden']['conditions'] = array('PlatillosOrden.orden_id' => $id);
			$this->set(array('platillos_ordenes' => $this->paginate(), 'opcion_menu' => array('ordenes' => 'active')));
		}
	}
}
