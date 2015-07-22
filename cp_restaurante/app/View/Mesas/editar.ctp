<?php
$lista = array(); $contador = 0;
foreach ($mesa['Orden'] as $orden) {
	$lista[$contador]['id'] = $orden['id'];
	$lista[$contador]['mesero'] = h($mesa['Mesero']['nombre_completo']);
	$lista[$contador]['cliente'] = h($orden['cliente']);
	$lista[$contador]['dui'] = $orden['dui'];
	$lista[$contador]['total'] = '$'.number_format($orden['total'], 2, '.', ',');
	$contador++;
}
echo $this->element(
	'editar', array(
		'icono' => 'coffee',
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
