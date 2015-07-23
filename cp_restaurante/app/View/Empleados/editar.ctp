<?php
$lista_asociacion = array(); $contador = 0;
foreach ($empleado['Mesa'] as $mesa) {
	$lista_asociacion[$contador]['id'] = $mesa['id'];
	$lista_asociacion[$contador]['mesa'] = h($mesa['serie']);
	$lista_asociacion[$contador]['puestos'] = h($mesa['puestos']);
	$lista_asociacion[$contador]['posicion'] = h($mesa['posicion']);
	$lista_asociacion[$contador]['creado'] = $this->Time->format('d/m/Y h:i A', $mesa['created']);
	$lista_asociacion[$contador]['modificado'] = $this->Time->format('d/m/Y h:i A', $mesa['modified']);
	$lista_asociacion[$contador]['elemento_eliminar'] = h($mesa['serie']);
	$contador++;
}
$lista = array(); $contador = 0;
foreach ($ordenes as $orden) {
	$lista[$contador]['id'] = $orden['Orden']['id'];
	$lista[$contador]['mesa'] = h($orden['Mesa']['serie']);
	$lista[$contador]['cliente'] = h($orden['Cliente']['nombres'].' '.$orden['Cliente']['apellidos']);
	$lista[$contador]['dui'] = h($orden['Cliente']['dui']);
	$lista[$contador]['total'] = '$'.number_format($orden['Orden']['total'], 2, '.', ',');
	$contador++;
}
echo $this->element(
	'editar', array(
		'id' => $empleado['Persona']['id'],
		'alias_singular' => 'empleado',
		'alias_plural' => 'empleados',
		'modelo' => 'Persona',
		'campos' => array(
			'dui' => array('label' => array('text' => 'DUI', 'class' => 'col-lg-3 control-label')),
			'nombres' => array(),
			'apellidos' => array(),
			'telefono' => array('label' => array('text' => 'Teléfono', 'class' => 'col-lg-3 control-label')),
			'cargo' => array('options' => $this->Funciones->cargos())
		),
		'lista_asociacion' => $lista_asociacion,
		'asociacion_singular' => 'mesa',
		'asociacion_plural' => 'mesas',
		'campos_asociacion' => array('mesa', 'puestos', 'posicion', 'creado', 'modificado'),
		'lista' => $lista,
		'singular' => 'orden',
		'plural' => 'ordenes',
		'titulos' => array('mesa', 'cliente', 'dui', 'total')
	)
);
?>
