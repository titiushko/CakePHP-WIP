<?= $this->element(
	'nuevo', array(
		'icono' => 'users',
		'alias_singular' => 'usuario',
		'alias_plural' => 'usuarios',
		'campos' => array(
			'nombre_completo' => array(),
			'usuario' => array(),
			'contrasena' => array('type' => 'password', 'label' => array('text' => 'Contraseña', 'class' => 'col-lg-3 control-label')),
			'rol' => array('options' => $this->Funciones->roles(), 'empty' => '')
		)
	)
); ?>
