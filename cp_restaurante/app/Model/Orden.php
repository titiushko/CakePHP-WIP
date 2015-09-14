<?php
App::uses('AppModel', 'Model');

class Orden extends AppModel {
	public $displayField = 'cliente';
	public $useTable = 'ordenes';
	
	public $validate = array(
		'dui' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'DUI requerido.'
			),
			'numeric' => array(
				'rule' => 'numeric',
				'message' => 'Sólo números.'
			),
			'unique' => array(
				'rule' => 'isUnique',
				'message' => 'DUI ya existe.'
			),
			'formatDui' => array(
				'rule' => '/^\d{9}$/',
				'message' => 'DUI inválido. Formato: 9 dígitos sin guión.'
			)
		),
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
		),
		'mesero_id' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Seleccionar un mesero.'
			)
		),
		'mesa_id' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Seleccionar una mesa.'
			)
		)
	);
	
	public $belongsTo = array(
		'Mesa' => array(
			'className' => 'Mesa',
			'foreignKey' => 'mesa_id'
		),
		'Persona' => array(
			'className' => 'Persona',
			'foreignKey' => 'mesero_id'
		),
		'Cliente' => array(
			'className' => 'Persona',
			'foreignKey' => 'cliente_id'
		)
	);
	
	public $hasMany = array(
		'PlatillosOrden' => array(
			'className' => 'PlatillosOrden',
			'foreignKey' => 'orden_id',
			'dependent' => TRUE
		)
	);
}
