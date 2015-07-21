<?php
$lista_asociacion = array(); $contador = 0;
foreach ($mesero['Mesa'] as $mesa) {
	$lista_asociacion[$contador]['id'] = $mesa['id'];
	$lista_asociacion[$contador]['serie'] = h($mesa['serie']);
	$lista_asociacion[$contador]['puestos'] = h($mesa['puestos']);
	$lista_asociacion[$contador]['posicion'] = h($mesa['posicion']);
	$lista_asociacion[$contador]['creado'] = $this->Time->format('d/m/Y h:i A', $mesa['created']);
	$lista_asociacion[$contador]['modificado'] = $this->Time->format('d/m/Y h:i A', $mesa['modified']);
	$lista_asociacion[$contador]['elemento_eliminar'] = h($mesa['serie']);
	$contador++;
}
echo $this->element(
	'ver', array(
		'id' => $mesero['Mesero']['id'],
		'elemento_eliminar' => $mesero['Mesero']['nombre_completo'],
		'alias_singular' => 'mesero',
		'alias_plural' => 'meseros',
		'campos' => array(
			'dui' => array('value' => $mesero['Mesero']['dui'], 'disabled' => TRUE),
			'nombres' => array('value' => $mesero['Mesero']['nombres'], 'disabled' => TRUE),
			'apellidos' => array('value' => $mesero['Mesero']['apellidos'], 'disabled' => TRUE),
			'telefono' => array('value' => $mesero['Mesero']['telefono'], 'disabled' => TRUE)
		),
		'lista_asociacion' => $lista_asociacion,
		'asociacion_singular' => 'mesa',
		'asociacion_plural' => 'mesas',
		'campos_asociacion' => array('serie', 'puestos', 'posicion', 'creado', 'modificado')
	)
);
?>
