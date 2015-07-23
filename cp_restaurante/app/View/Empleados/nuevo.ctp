<?= $this->element(
	'nuevo', array(
		'alias_singular' => 'empleado',
		'alias_plural' => 'empleados',
		'modelo' => 'Persona',
		'campos' => array(
			'dui' => array('label' => array('text' => 'DUI', 'class' => 'col-lg-3 control-label')),
			'nombres' => array(),
			'apellidos' => array(),
			'telefono' => array('label' => array('text' => 'Teléfono', 'class' => 'col-lg-3 control-label')),
			'cargo' => array('options' => $this->Funciones->cargos(), 'empty' => '')
		)
	)
); ?>
