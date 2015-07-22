<?php
echo $this->element(
	'editar', array(
		'icono' => 'users',
		'id' => $usuario['Usuario']['id'],
		'alias_singular' => 'usuario',
		'alias_plural' => 'usuarios',
		'campos' => array(
			'nombre_completo' => array(),
			'usuario' => array(),
			'contrasena' => array('type' => 'password', 'label' => array('text' => 'Contraseña', 'class' => 'col-lg-3 control-label')),
			'rol' => array('options' => $this->Funciones->roles())
		)
	)
);
?>
