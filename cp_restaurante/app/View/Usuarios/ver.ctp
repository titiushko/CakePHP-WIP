<?php
echo $this->element(
	'ver', array(
		'id' => $usuario['Usuario']['id'],
		'elemento_eliminar' => $usuario['Usuario']['usuario'],
		'alias_singular' => 'usuario',
		'alias_plural' => 'usuarios',
		'campos' => array(
			'dui' => array('value' => $usuario['Persona']['dui'], 'disabled' => TRUE, 'label' => array('text' => 'DUI', 'class' => 'col-lg-3 control-label')),
			'nombres' => array('value' => $usuario['Persona']['nombres'], 'disabled' => TRUE),
			'apellidos' => array('value' => $usuario['Persona']['apellidos'], 'disabled' => TRUE),
			'telefono' => array('value' => $usuario['Persona']['telefono'], 'disabled' => TRUE, 'label' => array('text' => 'Teléfono', 'class' => 'col-lg-3 control-label')),
			//'cargo' => array('value' => $usuario['Persona']['cargo'], 'disabled' => TRUE, 'options' => $this->Funciones->cargos()),
			'usuario' => array('value' => $usuario['Usuario']['usuario'], 'disabled' => TRUE),
			'contrasena' => array('value' => $usuario['Usuario']['contrasena'], 'disabled' => TRUE, 'type' => 'password', 'label' => array('text' => 'Contraseña', 'class' => 'col-lg-3 control-label')),
			'rol' => array('value' => $usuario['Usuario']['rol'], 'disabled' => TRUE, 'options' => $this->Funciones->roles())
		)
	)
);
?>
