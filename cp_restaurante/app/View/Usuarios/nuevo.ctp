<?= $this->element(
	'nuevo', array(
		'alias_singular' => 'usuario',
		'alias_plural' => 'usuarios',
		'campos' => array(
			'dui' => array('label' => array('text' => 'DUI', 'class' => 'col-lg-3 control-label')),
			'nombres' => array('required' => TRUE),
			'apellidos' => array('required' => TRUE),
			'telefono' => array('label' => array('text' => 'Teléfono', 'class' => 'col-lg-3 control-label')),
			//'cargo' => array('options' => $this->Funciones->cargos(), 'empty' => ''),
			'usuario' => array(),
			'contrasena' => array('type' => 'password', 'label' => array('text' => 'Contraseña', 'class' => 'col-lg-3 control-label')),
			'rol' => array('options' => $this->Funciones->roles(), 'empty' => '')
		)
	)
); ?>
