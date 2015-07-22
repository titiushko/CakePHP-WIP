<?php
$lista_asociacion = array(); $contador = 0;
foreach ($cocinero['Platillo'] as $platillo) {
	$lista_asociacion[$contador]['id'] = $platillo['id'];
	$lista_asociacion[$contador]['foto'] = empty($platillo['foto']) ? '<figure>'.$this->Html->image('../img/plato_vacio/thumb_plato_vacio.jpg').'</figure>' : '<figure>'.$this->Html->image('../files/platillo/foto/'.$platillo['foto_dir'].'/'.'thumb_'.$platillo['foto']).'</figure>';
	$lista_asociacion[$contador]['nombre'] = h($platillo['nombre']);
	$lista_asociacion[$contador]['precio'] = '$ '.number_format($platillo['precio'], 2, '.', ',');
	$lista_asociacion[$contador]['elemento_eliminar'] = h($platillo['nombre']);
	$contador++;
}
echo $this->element(
	'ver', array(
		'icono' => 'male',
		'id' => $cocinero['Cocinero']['id'],
		'elemento_eliminar' => $cocinero['Cocinero']['nombre_completo'],
		'alias_singular' => 'cocinero',
		'alias_plural' => 'cocineros',
		'campos' => array(
			'nombres' => array('value' => $cocinero['Cocinero']['nombres'], 'disabled' => TRUE),
			'apellidos' => array('value' => $cocinero['Cocinero']['apellidos'], 'disabled' => TRUE)
		),
		'lista_asociacion' => $lista_asociacion,
		'asociacion_singular' => 'platillo',
		'asociacion_plural' => 'platillos',
		'campos_asociacion' => array('foto', 'nombre', 'precio')
	)
);
?>
