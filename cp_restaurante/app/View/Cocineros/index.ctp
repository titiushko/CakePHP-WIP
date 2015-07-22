<?php
$lista_valores = array(); $contador = 0;
foreach ($cocineros as $cocinero) {
	$lista_valores[$contador]['id'] = $cocinero['Cocinero']['id'];
	$lista_valores[$contador]['nombres'] = h($cocinero['Cocinero']['nombres']);
	$lista_valores[$contador]['apellidos'] = h($cocinero['Cocinero']['apellidos']);
	$lista_valores[$contador]['creado'] = $this->Time->format('d/m/Y h:i A', $cocinero['Cocinero']['created']);
	$lista_valores[$contador]['modificado'] = $this->Time->format('d/m/Y h:i A', $cocinero['Cocinero']['modified']);
	$lista_valores[$contador]['elemento_eliminar'] = h($cocinero['Cocinero']['nombre_completo']);
	$contador++;
}
echo $this->element('index', array(
	'icono' => 'male',
	'alias_singular' => 'cocinero',
	'alias_plural' => 'cocineros',
	'lista_valores' => $lista_valores,
	'campos' => array('nombres', 'apellidos', 'creado', 'modificado')
));
?>
