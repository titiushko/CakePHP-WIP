<?= $this->element(
	'nuevo', array(
		'alias_singular' => 'usuario',
		'alias_plural' => 'usuarios',
		'campos' => array(
			'nombre_completo' => array(),
			'usuario' => array(),
			'contrasena' => array('type' => 'password'),
			'rol' => array('options' => $this->Funciones->roles(), 'empty' => '')
		)
	)
); ?>
