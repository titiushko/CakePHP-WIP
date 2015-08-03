<?php
$lista = array(); $contador = 0;
foreach ($ordenes as $orden) {
	$lista[$contador]['id'] = $orden['Orden']['id'];
	$lista[$contador]['mesero'] = h($orden['Persona']['nombre_completo']);
	$lista[$contador]['cliente'] = h($orden['Cliente']['nombres'].' '.$orden['Cliente']['apellidos']);
	$lista[$contador]['dui'] = h($orden['Cliente']['dui']);
	$lista[$contador]['total'] = '$'.number_format($orden['Orden']['total'], 2, '.', ',');
	$contador++;
}

echo $this->element(
	'ver', array(
		'id' => $mesa['Mesa']['id'],
		'elemento_eliminar' => $mesa['Mesa']['serie'],
		'alias_singular' => 'mesa',
		'alias_plural' => 'mesas',
		'campos' => array(
			'serie' => array('value' => $mesa['Mesa']['serie']),
			'puestos' => array('value' => $mesa['Mesa']['puestos']),
			'posicion' => array('value' => $mesa['Mesa']['posicion'], 'rows' => 3),
			'mesa_id' => $this->Funciones->campo_enlace('mesero', $this->Html->link($mesa['Persona']['nombre_completo'], array('controller' => 'empleados', 'action' => 'ver', $mesa['Persona']['id'])))
		),
		'lista' => $lista,
		'singular' => 'orden',
		'plural' => 'ordenes',
		'titulos' => array('mesero', 'cliente', 'dui', 'total')
	)
);
?>
