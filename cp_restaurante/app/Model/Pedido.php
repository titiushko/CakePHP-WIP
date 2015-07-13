<?php
App::uses('AppModel', 'Model');

class Pedido extends AppModel {
	public $displayField = 'platillo_id';
	
	public $belongsTo = array(
		'Platillo' => array(
			'className' => 'Platillo',
			'foreignKey' => 'platillo_id'
		)
	);
	
	public function total_orden() {
		return $this->find('all', array('fields' => array('SUM(Pedido.subtotal) total_orden')))[0][0]['total_orden'];
	}
	
	public function precio_platillo($pedido_id) {
		return $this->find('all', array('fields' => array('Platillo.precio'), 'conditions' => array('Pedido.id' => $pedido_id)))[0]['Platillo']['precio'];
	}
}
