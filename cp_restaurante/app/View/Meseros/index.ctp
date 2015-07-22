<?php
$lista_valores = array(); $contador = 0;
foreach ($meseros as $mesero) {
	$lista_valores[$contador]['id'] = $mesero['Mesero']['id'];
	$lista_valores[$contador]['nombres'] = h($mesero['Mesero']['nombres']);
	$lista_valores[$contador]['apellidos'] = h($mesero['Mesero']['apellidos']);
	$lista_valores[$contador]['creado'] = $this->Time->format('d/m/Y h:i A', $mesero['Mesero']['created']);
	$lista_valores[$contador]['modificado'] = $this->Time->format('d/m/Y h:i A', $mesero['Mesero']['modified']);
	$lista_valores[$contador]['elemento_eliminar'] = h($mesero['Mesero']['nombre_completo']);
	$contador++;
}
echo $this->element('index', array(
		'icono' => 'user',
		'alias_singular' => 'mesero',
		'alias_plural' => 'meseros',
		'lista_valores' => $lista_valores,
		'campos' => array('nombres', 'apellidos', 'creado', 'modificado')
	));
?>
