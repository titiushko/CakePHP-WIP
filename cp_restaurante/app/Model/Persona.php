<?php
App::uses('AppModel', 'Model');

class Persona extends AppModel {
	public $displayField = 'nombres';
	public $virtualFields = array('nombre_completo' => 'CONCAT(Persona.nombres, " ", Persona.apellidos)');
	
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
		'telefono' => array(
			'numeric' => array(
				'rule' => 'numeric',
				'message' => 'Sólo números.'
			),
			'formatTelefono' => array(
				'rule' => '/^\d{8}$/',
				'message' => 'Teléfono inválido. Formato: 8 dígitos sin guiones.'
			)
		),
		'cargo' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Cargo requerido.'
			)
		)
	);
	
	public $hasMany = array(
		'Mesa' => array(
			'className' => 'Mesa',
			'foreignKey' => 'mesero_id',
			'conditions' => '',
			'order' => 'Mesa.serie DESC',
			'dependent' => FALSE
		),
		'Orden' => array(
			'className' => 'Orden',
			'foreignKey' => 'mesero_id',
			'dependent' => FALSE
		),
		'Cliente' => array(
			'className' => 'Orden',
			'foreignKey' => 'cliente_id',
			'dependent' => FALSE
		),
		'Usuario' => array(
			'className' => 'Usuario',
			'foreignKey' => 'persona_id',
			'dependent' => FALSE
		)
	);
	
	public $hasAndBelongsToMany = array(
		'Platillo' => array(
			'className' => 'Platillo',
			'joinTable' => 'cocineros_platillos',
			'foreignKey' => 'cocinero_id',
			'associationForeignKey' => 'platillo_id',
			'unique' => 'keepExisting'
		)
	);
}
