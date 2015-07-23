<?php
echo $this->element(
	'editar', array(
		'id' => $usuario['Usuario']['id'],
		'alias_singular' => 'usuario',
		'alias_plural' => 'usuarios',
		'campos' => array(
			'dui' => array('value' => $usuario['Persona']['dui'], 'label' => array('text' => 'DUI', 'class' => 'col-lg-3 control-label')),
			'nombres' => array('value' => $usuario['Persona']['nombres']),
			'apellidos' => array('value' => $usuario['Persona']['apellidos']),
			'telefono' => array('value' => $usuario['Persona']['telefono'], 'label' => array('text' => 'Teléfono', 'class' => 'col-lg-3 control-label')),
			//'cargo' => array('value' => $usuario['Persona']['cargo'], 'options' => $this->Funciones->cargos()),
			'usuario' => array(),
			'contrasena' => array('type' => 'password', 'label' => array('text' => 'Contraseña', 'class' => 'col-lg-3 control-label')),
			'rol' => array('options' => $this->Funciones->roles())
		)
	)
);
?>
