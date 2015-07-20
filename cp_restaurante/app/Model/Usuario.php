<?php
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');
App::uses('AppModel', 'Model');

class Usuario extends AppModel {
	public $displayField = 'usuario';
	
	public $validate = array(
		'nombre_completo' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Nombre Completo requerido.'
			),
			'alphabetic' => array(
				'rule' => '/^[a-zA-Z[:space:]ñáéíóúÑÁÉÍÓÚ]*$/',
				'message' => 'Sólo letras.'
			)
		),
		'usuario' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Usuario requerido.'
			),
			'unique' => array(
				'rule' => 'isUnique',
				'message' => 'Usuario ya existe.'
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
	
	public function beforeSave($opciones = array()) {
		if(isset($this->data[$this->alias]['contrasena'])) {
			$contrasena = new BlowfishPasswordHasher();
			$this->data[$this->alias]['contrasena'] = $contrasena->hash($this->data[$this->alias]['contrasena']);
		}
		return TRUE;
	}
}
