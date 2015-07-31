<?= $this->element(
	'ver', array(
		'id' => $usuario['User']['id'],
		'elemento_eliminar' => $usuario['User']['username'],
		'alias_singular' => 'usuario',
		'alias_plural' => 'usuarios',
		'controlador' => 'users',
		'modelo' => 'User',
		'campos' => array(
			'dui' => array('value' => $usuario['Persona']['dui'], 'disabled' => TRUE, 'label' => array('text' => 'DUI', 'class' => 'col-lg-3 control-label')),
			'nombres' => array('value' => $usuario['Persona']['nombres'], 'disabled' => TRUE),
			'apellidos' => array('value' => $usuario['Persona']['apellidos'], 'disabled' => TRUE),
			'telefono' => array('value' => $usuario['Persona']['telefono'], 'disabled' => TRUE, 'label' => array('text' => 'Teléfono', 'class' => 'col-lg-3 control-label')),
			//'cargo' => array('value' => $usuario['Persona']['cargo'], 'disabled' => TRUE, 'options' => $this->Funciones->cargos()),
			'username' => array('value' => $usuario['User']['username'], 'disabled' => TRUE, 'label' => array('text' => 'Usuario', 'class' => 'col-lg-3 control-label')),
			'password' => array('value' => $usuario['User']['password'], 'disabled' => TRUE, 'type' => 'password', 'label' => array('text' => 'Contraseña', 'class' => 'col-lg-3 control-label')),
			'rol' => array('value' => $usuario['User']['rol'], 'disabled' => TRUE, 'options' => $this->Funciones->roles())
		)
	)
); ?>
