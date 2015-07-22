<?php
echo $this->element(
	'ver', array(
		'icono' => 'users',
		'id' => $usuario['Usuario']['id'],
		'elemento_eliminar' => $usuario['Usuario']['usuario'],
		'alias_singular' => 'usuario',
		'alias_plural' => 'usuarios',
		'campos' => array(
			'nombre_completo' => array('value' => $usuario['Usuario']['nombre_completo'], 'disabled' => TRUE),
			'usuario' => array('value' => $usuario['Usuario']['usuario'], 'disabled' => TRUE),
			'contrasena' => array('value' => $usuario['Usuario']['contrasena'], 'disabled' => TRUE, 'type' => 'password', 'label' => array('text' => 'Contraseña', 'class' => 'col-lg-3 control-label')),
			'rol' => array('value' => $usuario['Usuario']['rol'], 'disabled' => TRUE, 'options' => $this->Funciones->roles())
		)
	)
);
?>
