<?php
App::uses('AppModel', 'Model');

class PlatillosOrden extends AppModel {
	public $displayField = 'orden_id';
	public $useTable = 'platillos_ordenes';
	
	public $belongsTo = array(
		'Orden' => array(
			'className' => 'Orden',
			'foreignKey' => 'orden_id'
		),
		'Platillo' => array(
			'className' => 'Platillo',
			'foreignKey' => 'platillo_id'
		)
	);
}
