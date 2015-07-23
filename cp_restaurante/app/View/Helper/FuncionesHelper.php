<?php
App::uses('AppHelper', 'View/Helper');

class FuncionesHelper extends AppHelper {
	public $helpers = array('Form');
	public $roles = array(
		'admin' => 'Administrador',
		'user' => 'Usuario'
	);
	public $cargos = array(
		'mesero' => 'Mesero',
		'cocinero' => 'Cocinero'
	);
	
	/* Devuelve el listado de roles */
	public function roles() {
		return $this->roles;
	}
	
	/* Devuelve el nombre completo de un rol */
	public function rol($rol) {
		return $this->roles[$rol];
	}
	
	/* Devuelve el listado de cargos */
	public function cargos() {
		return $this->cargos;
	}
	
	/* Devuelve el nombre completo de un cargo */
	public function cargo($cargo) {
		$cargo = empty($cargo) ? '' : $cargo;
		if ($cargo == 'cliente' || $cargo == '') return '';
		else return $this->cargos[$cargo];
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
		$etiqueta = str_replace('_', ' ', $alias_singular);
		return '<div class="form-group">'.
					$this->Form->label($etiqueta, ucwords($etiqueta), array('class' => 'col-lg-3 control-label')).
					'<div class="col-lg-9" style="margin-top: 6px;">'.$enlace.'</div>
				</div>';
	}
	
	/* Devuelve ícono del módluo. */
	public function icono_modulo($alias_plural) {
		$icono = array(
			'usuarios' => 'users',
			'empleados' => 'male',
			'mesas' => 'coffee',
			'platillos' => 'cutlery',
			'categoria_platillos' => 'random',
			'ordenes' => 'archive',
			'pedidos' => 'shopping-cart'
		);
		return '<i class="fa fa-'.$icono[$alias_plural].'"></i>';
	}
}
