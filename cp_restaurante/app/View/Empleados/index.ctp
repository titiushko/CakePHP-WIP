<?php
$lista_valores = array(); $contador = 0;
foreach ($empleados as $empleado) {
	$lista_valores[$contador]['id'] = $empleado['Persona']['id'];
	$lista_valores[$contador]['nombres'] = h($empleado['Persona']['nombres']);
	$lista_valores[$contador]['apellidos'] = h($empleado['Persona']['apellidos']);
	$lista_valores[$contador]['cargo'] = $this->Funciones->cargo($empleado['Persona']['cargo']);
	$lista_valores[$contador]['creado'] = $this->Time->format('d/m/Y h:i A', $empleado['Persona']['created']);
	$lista_valores[$contador]['modificado'] = $this->Time->format('d/m/Y h:i A', $empleado['Persona']['modified']);
	$lista_valores[$contador]['elemento_eliminar'] = h($empleado['Persona']['nombre_completo']);
	$contador++;
}

echo $this->element('index', array(
		'alias_singular' => 'empleado',
		'alias_plural' => 'empleados',
		'lista_valores' => $lista_valores,
		'campos' => array('nombres', 'apellidos', 'cargo', 'creado', 'modificado')
	));
?>
