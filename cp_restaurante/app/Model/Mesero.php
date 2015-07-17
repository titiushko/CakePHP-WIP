<?php
App::uses('AppModel', 'Model');

class Mesero extends AppModel {
	public $displayField = 'nombres';
	public $virtualFields = array('nombre_completo' => 'CONCAT(Mesero.nombres, " ", Mesero.apellidos)');
	
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
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Teléfono requerida.'
			),
			'numeric' => array(
				'rule' => 'numeric',
				'message' => 'Sólo números.'
			),
			'formatTelefono' => array(
				'rule' => '/^\d{8}$/',
				'message' => 'Teléfono inválido. Formato: 8 dígitos sin guiones.'
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
		)
	);
}
