<?= $this->element(
	'nuevo', array(
		'alias_singular' => 'mesa',
		'alias_plural' => 'mesas',
		'campos' => array(
			'serie' => array(),
			'puestos' => array('type' => 'number'),
			'posicion' => array('rows' => 3),
			'mesero_id' => array()
		)
	)
); ?>
