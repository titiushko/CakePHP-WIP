<?php
App::uses('AppModel', 'Model');

class Cocinero extends AppModel {
	public $displayField = 'nombres';
	public $virtualFields = array('nombre_completo' => 'CONCAT(Cocinero.nombres, " ", Cocinero.apellidos)');
	
	public $validate = array(
		'nombres' => array(
			'rule' => 'notEmpty'
		),
		'apellidos' => array(
			'rule' => 'notEmpty'
		)
	);
	
	public $hasAndBelongsToMany = array(
		'Platillo' => array(
			'className' => 'Platillo',
			'joinTable' => 'cocineros_platillos',
			'foreignKey' => 'cocinero_id',
			'associationForeignKey' => 'platillo_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
		)
	);
}
