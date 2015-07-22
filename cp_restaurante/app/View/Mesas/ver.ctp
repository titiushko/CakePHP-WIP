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
	'ver', array(
		'icono' => 'coffee',
		'id' => $mesa['Mesa']['id'],
		'elemento_eliminar' => $mesa['Mesa']['serie'],
		'alias_singular' => 'mesa',
		'alias_plural' => 'mesas',
		'campos' => array(
			'serie' => array('value' => $mesa['Mesa']['serie'], 'disabled' => TRUE),
			'puestos' => array('value' => $mesa['Mesa']['puestos'], 'disabled' => TRUE),
			'posicion' => array('value' => $mesa['Mesa']['posicion'], 'disabled' => TRUE, 'rows' => 3),
			'mesa_id' => $this->Funciones->campo_enlace('mesero', $this->Html->link($mesa['Mesero']['nombre_completo'], array('controller' => 'meseros', 'action' => 'ver', $mesa['Mesero']['id'])))
		),
		'lista' => $lista,
		'singular' => 'orden',
		'plural' => 'ordenes',
		'titulos' => array('mesero', 'cliente', 'dui', 'total')
	)
);
?>
