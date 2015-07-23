<?php
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');
App::uses('AppModel', 'Model');

class Usuario extends AppModel {
	public $displayField = 'usuario';
	
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
		/*'cargo' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Cargo requerido.'
			)
		),*/
		'usuario' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Usuario requerido.'
			),
			'unique' => array(
				'rule' => 'isUnique',
				'message' => 'Usuario ya existe.',
				'on' => 'create'
			)
		),
		'contrasena' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Contraseña requerida.',
				//'on' => 'create'
			)
		),
		'rol' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Rol requerido.'
			)
		)
	);
	
	public $belongsTo = array(
		'Persona' => array(
			'className' => 'Persona',
			'foreignKey' => 'persona_id'
		)
	);
	
	public function beforeSave($opciones = array()) {
		if (isset($this->data[$this->alias]['contrasena'])) {
			$contrasena = new BlowfishPasswordHasher();
			$this->data[$this->alias]['contrasena'] = $contrasena->hash($this->data[$this->alias]['contrasena']);
		}
		else return TRUE;
	}
}
