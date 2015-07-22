<?= $this->element(
	'nuevo', array(
		'icono' => 'user',
		'alias_singular' => 'mesero',
		'alias_plural' => 'meseros',
		'campos' => array(
			'dui' => array('label' => array('text' => 'DUI', 'class' => 'col-lg-3 control-label')),
			'nombres' => array(),
			'apellidos' => array(),
			'telefono' => array('label' => array('text' => 'Teléfono', 'class' => 'col-lg-3 control-label'))
		)
	)
); ?>
