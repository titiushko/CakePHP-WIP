<?php
App::uses('AppModel', 'Model');

class CocinerosPlatillo extends AppModel {
	public $useTable = 'cocineros_platillos';
	
	public $belongsTo = array(
		'Persona' => array(
			'className' => 'Persona',
			'foreignKey' => 'cocinero_id'
		),
		'Platillo' => array(
			'className' => 'Platillo',
			'foreignKey' => 'platillo_id'
		)
	);
}
