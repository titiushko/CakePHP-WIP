<?php
$lista_valores = array(); $contador = 0;
foreach ($ordenes as $orden) {
	$lista_valores[$contador]['id'] = $orden['Orden']['id'];
	$lista_valores[$contador]['mesero_id'] = h($orden['Mesero']['nombre_completo']);
	$lista_valores[$contador]['mesa_id'] = h($orden['Mesa']['serie']);
	$lista_valores[$contador]['cliente'] = h($orden['Orden']['cliente']);
	$lista_valores[$contador]['dui'] = h($orden['Orden']['dui']);
	$lista_valores[$contador]['total'] = '$ '.number_format($orden['Orden']['total'], 2, '.', ',');
	$lista_valores[$contador]['creado'] = $this->Time->format('d/m/Y h:i A', $orden['Orden']['created']);
	$lista_valores[$contador]['modificado'] = $this->Time->format('d/m/Y h:i A', $orden['Orden']['modified']);
	$lista_valores[$contador]['elemento_eliminar'] = h($orden['Mesero']['nombre_completo']);
	$contador++;
}
echo $this->element('index', array(
		'alias_singular' => 'orden',
		'alias_plural' => 'ordenes',
		'lista_valores' => $lista_valores,
		'campos' => array('mesero_id', 'mesa_id', 'cliente', 'dui', 'total', 'creado', 'modificado')
	));
?>
