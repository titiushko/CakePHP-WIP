<?php
$lista_valores = array(); $contador = 0;
foreach ($mesas as $mesa) {
	$lista_valores[$contador]['id'] = $mesa['Mesa']['id'];
	$lista_valores[$contador]['serie'] = h($mesa['Mesa']['serie']);
	$lista_valores[$contador]['puestos'] = h($mesa['Mesa']['puestos']);
	$lista_valores[$contador]['posicion'] = h($mesa['Mesa']['posicion']);
	$lista_valores[$contador]['creado'] = $this->Time->format('d/m/Y h:i A', $mesa['Mesa']['created']);
	$lista_valores[$contador]['modificado'] = $this->Time->format('d/m/Y h:i A', $mesa['Mesa']['modified']);
	$nombre_completo = empty($mesa['Persona']['nombre_completo']) ? '' : $mesa['Persona']['nombre_completo'];
	$lista_valores[$contador]['Persona.nombre_completo'] = $this->Html->link(__('%s', $nombre_completo), array('controller' => 'empleados', 'action' => 'ver', $mesa['Persona']['id']));
	$lista_valores[$contador]['elemento_eliminar'] = h($mesa['Mesa']['serie']);
	$contador++;
}
echo $this->element('index', array(
	'alias_singular' => 'mesa',
	'alias_plural' => 'mesas',
	'lista_valores' => $lista_valores,
	'campos' => array('serie', 'puestos', 'posicion', 'creado', 'modificado', 'Persona.nombre_completo')
));
?>
