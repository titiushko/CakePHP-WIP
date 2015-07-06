<?php
App::uses('AppModel', 'Model');

class Cocinero extends AppModel {
	public $displayField = 'nombres';
	public $virtualFields = array('nombre_completo' => 'CONCAT(Cocinero.nombres, " ", Cocinero.apellidos)');
	
	public $validate = array(
		'nombres' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Nombres requeridos.'
			),
			'alphabetic' => array(
				'rule' => '/^[a-zA-Z[:space:]ñáéíóúÑÁÉÍÓÚ]*$/',
				'message' => 'Sólo letras.'
			)
		),
		'apellidos' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Apellidos requeridos.'
			),
			'alphabetic' => array(
				'rule' => '/^[a-zA-Z[:space:]ñáéíóúÑÁÉÍÓÚ]*$/',
				'message' => 'Sólo letras.'
			)
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
