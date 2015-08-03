<?php
App::uses('AppController', 'Controller');

class PlatillosOrdenesController extends AppController {
	public $uses = array('PlatillosOrden');
	public $paginate = array(
		'limit' => 4,
		'order' => array(
			'PlatillosOrden.id' => 'ASC'
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
			$this->paginate['PlatillosOrden']['order'] = array('PlatillosOrden.id' => 'ASC');
			$this->paginate['PlatillosOrden']['conditions'] = array('PlatillosOrden.orden_id' => $id);
			$this->set(array('platillos_ordenes' => $this->paginate(), 'opcion_menu' => array('ordenes' => 'active')));
		}
	}
}
