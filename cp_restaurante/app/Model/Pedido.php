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
}
