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
	'editar', array(
		'id' => $mesa['Mesa']['id'],
		'alias_singular' => 'mesa',
		'alias_plural' => 'mesas',
		'campos' => array(
			'serie' => array(),
			'puestos' => array(),
			'posicion' => array('rows' => 3),
			'mesero_id' => array()
		),
		'lista' => $lista,
		'singular' => 'orden',
		'plural' => 'ordenes',
		'titulos' => array('mesero', 'cliente', 'dui', 'total')
	)
);
?>
