<?php
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');
App::uses('AppModel', 'Model');

class User extends AppModel {
	public $displayField = 'username';
	
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
		'username' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Usuario requerido.'
			),
			'unique' => array(
				'rule' => 'isUnique',
				'message' => 'Usuario ya existe.',
				'on' => 'create'
			),
			'between' => array(
				'rule' => array('between', 5, 15),
				'required' => TRUE,
				'message' => 'Usuario debe tener entre 5 y 15 caracteres.'
			),
			'alphaNumericDashUnderscore' => array(
				'rule' => '/^[a-zA-Z0-9_ \-]*$/',
				'message' => 'Usuario sólo puede ser letras, números y guiones bajos.'
			)
		),
		'password' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Contraseña requerida.',
				//'on' => 'create'
			),
			'min_length' => array(
				'rule' => array('minLength', '6'),
				'message' => 'Contraseña debe tener un mínimo de 6 caracteres.'
			)
		),
		/*'confirmar_password' => array(
			'required' => array(
				'rule' => 'notEmpty',
				'message' => 'Por favor, confirmar password.'
			),
			'equalToField' => array(
				'rule' => array('equaltofield', 'password'),
				'message' => 'Ambas passwords deben coincidir.'
			)
		),*/
		'rol' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Rol requerido.'
			),
			'valid' => array(
				'rule' => array('inList', array('admin', 'user')),
				'message' => 'Por favor ingrese un rol válido.',
				'allowEmpty' => FALSE
			)
		)
	);
	
	public function equalToField($campo, $otro_campo) {
		$nombre_campo = '';
		foreach ($campo as $indice => $valor) {
			$nombre_campo = $indice;
			break;
		}
		return $this->data[$this->name][$otro_campo] === $this->data[$this->name][$nombre_campo]; 
	}
	
	public $belongsTo = array(
		'Persona' => array(
			'className' => 'Persona',
			'foreignKey' => 'persona_id'
		)
	);
	
	public function beforeSave($opciones = array()) {
		if (isset($this->data[$this->alias]['password'])) {
			$password = new BlowfishPasswordHasher();
			$this->data[$this->alias]['password'] = $password->hash($this->data[$this->alias]['password']);
		}
		else return TRUE;
	}
}
