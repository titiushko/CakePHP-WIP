<?php
App::uses('Helper', 'View');

class FuncionesHelper extends Helper {
	public $roles = array(
		'admin' => 'Administrador',
		'user' => 'Usuario'
	);
	
	/* Devuelve el listado de roles */
	public function roles() {
		return $this->roles;
	}
	
	/* Devuelve el nombre completo de un rol */
	public function rol($rol) {
		return $this->roles[$rol];
	}
	
	/*
	Devuelve una cadena de $cadena hasta que encuentre $busqueda.
	Ejemplo:
		echo extraer('tabla.campo', '.'); // resultado: "tabla"
	*/
	public function extraer($cadena, $busqueda) {
		$posicion = stripos($cadena, $busqueda);
		if (empty($posicion)) {
			return $cadena;
		}
		else {
			return substr($cadena, 0, $posicion);
		}
	}
}
