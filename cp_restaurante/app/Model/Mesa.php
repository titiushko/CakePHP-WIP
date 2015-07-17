<?php
App::uses('AppModel', 'Model');

class Mesa extends AppModel {
	public $displayField = 'serie';
	
	public $validate = array(
		'serie' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Serie requerida.'
			),
			'numeric' => array(
				'rule' => 'numeric',
				'message' => 'Sólo números.'
			),
			'unique' => array(
				'rule' => 'isUnique',
				'message' => 'Serie ya existe.'
			)
		),
		'puestos' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Puestos requeridos.'
			),
			'numeric' => array(
				'rule' => 'numeric',
				'message' => 'Sólo números.'
			)
		),
		'posicion' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Posición requerida.'
			)
		),
		'mesero_id' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Seleccionar un mesero.'
			)
		)
	);
	
	public $belongsTo = array(
		'Mesero' => array(
			'className' => 'Mesero',
			'foreignKey' => 'mesero_id'
		)
	);
	
	public $hasMany = array(
		'Orden' => array(
			'className' => 'Orden',
			'foreignKey' => 'mesa_id',
			'dependent' => FALSE
		)
	);
}
