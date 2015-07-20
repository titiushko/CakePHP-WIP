<?php
App::uses('AppModel', 'Model');

class Orden extends AppModel {
	public $displayField = 'cliente';
	public $useTable = 'ordenes';
	
	public $validate = array(
		'cliente' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Cliente requerido.'
			),
			'alphabetic' => array(
				'rule' => '/^[a-zA-Z[:space:]ñáéíóúÑÁÉÍÓÚ]*$/',
				'message' => 'Sólo letras.'
			)
		),
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
		)
	);
	
	public $belongsTo = array(
		'Mesa' => array(
			'className' => 'Mesa',
			'foreignKey' => 'mesa_id'
		),
		'Mesero' => array(
			'className' => 'Mesero',
			'foreignKey' => 'mesero_id'
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
