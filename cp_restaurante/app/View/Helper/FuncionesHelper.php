<?php
App::uses('AppHelper', 'View/Helper');

class FuncionesHelper extends AppHelper {
	public $helpers = array('Form');
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
	
	/* Devuelve un enlace con estilo de bootstrap para ser utilizado en un formulario. */
	public function campo_enlace($alias_singular, $enlace) {
		$alias = str_replace('_', ' ', $alias_singular);
		return '<div class="form-group">'.
					$this->Form->label($alias, ucwords($alias), array('class' => 'col-lg-3 control-label')).
					'<div class="col-lg-9" style="margin-top: 6px;">'.$enlace.'</div>
				</div>';
	}
}
