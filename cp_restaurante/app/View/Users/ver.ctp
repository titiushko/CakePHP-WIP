<?= $this->element(
	'ver', array(
		'id' => $usuario['User']['id'],
		'elemento_eliminar' => $usuario['User']['username'],
		'alias_singular' => 'usuario',
		'alias_plural' => 'usuarios',
		'controlador' => 'users',
		'modelo' => 'User',
		'campos' => array(
			'dui' => array('value' => $usuario['Persona']['dui'], 'label' => array('text' => 'DUI', 'class' => 'col-lg-3 control-label')),
			'nombres' => array('value' => $usuario['Persona']['nombres']),
			'apellidos' => array('value' => $usuario['Persona']['apellidos']),
			'telefono' => array('value' => $usuario['Persona']['telefono'], 'label' => array('text' => 'Teléfono', 'class' => 'col-lg-3 control-label')),
			//'cargo' => array('value' => $usuario['Persona']['cargo'], 'options' => $this->Funciones->cargos()),
			'username' => array('value' => $usuario['User']['username'], 'label' => array('text' => 'Usuario', 'class' => 'col-lg-3 control-label')),
			'password' => array('value' => $usuario['User']['password'], 'type' => 'password', 'label' => array('text' => 'Contraseña', 'class' => 'col-lg-3 control-label')),
			'rol' => array('value' => $usuario['User']['rol'], 'options' => $this->Funciones->roles())
		)
	)
); ?>
