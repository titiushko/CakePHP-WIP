<?php
App::uses('Helper', 'View');

class FuncionesHelper extends Helper {
	public $roles = array(
		'admin' => 'Administrador',
		'user' => 'Usuario'
	);
	
	public function roles() {
		return $this->roles;
	}
	public function rol($rol) {
		return $this->roles[$rol];
	}
}
