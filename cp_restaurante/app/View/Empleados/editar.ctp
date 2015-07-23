<?php
if ($empleado['Persona']['cargo'] == 'mesero') {
	$lista_asociacion = array(); $contador = 0;
	foreach ($empleado['Mesa'] as $mesa) {
		$lista_asociacion[$contador]['id'] = $mesa['id'];
		$lista_asociacion[$contador]['mesa'] = h($mesa['serie']);
		$lista_asociacion[$contador]['puestos'] = h($mesa['puestos']);
		$lista_asociacion[$contador]['posicion'] = h($mesa['posicion']);
		$lista_asociacion[$contador]['creado'] = $this->Time->format('d/m/Y h:i A', $mesa['created']);
		$lista_asociacion[$contador]['modificado'] = $this->Time->format('d/m/Y h:i A', $mesa['modified']);
		$lista_asociacion[$contador]['elemento_eliminar'] = h($mesa['serie']);
		$contador++;
	}
	$asociacion_singular = 'mesa';
	$asociacion_plural = 'mesas';
	$campos_asociacion = array('mesa', 'puestos', 'posicion', 'creado', 'modificado');
	$lista = array(); $contador = 0;
	foreach ($ordenes as $orden) {
		$lista[$contador]['id'] = $orden['Orden']['id'];
		$lista[$contador]['mesa'] = h($orden['Mesa']['serie']);
		$lista[$contador]['cliente'] = h($orden['Cliente']['nombres'].' '.$orden['Cliente']['apellidos']);
		$lista[$contador]['dui'] = h($orden['Cliente']['dui']);
		$lista[$contador]['total'] = '$'.number_format($orden['Orden']['total'], 2, '.', ',');
		$contador++;
	}
	$singular = 'orden';
	$plural = 'ordenes';
	$titulos = array('mesa', 'cliente', 'dui', 'total');
}
elseif ($empleado['Persona']['cargo'] == 'cocinero') {
	$lista_asociacion = array(); $contador = 0;
	foreach ($empleado['Platillo'] as $platillo) {
		$lista_asociacion[$contador]['id'] = $platillo['id'];
		$lista_asociacion[$contador]['foto'] = empty($platillo['foto']) ? '<figure>'.$this->Html->image('../img/plato_vacio/thumb_plato_vacio.jpg').'</figure>' : '<figure>'.$this->Html->image('../files/platillo/foto/'.$platillo['foto_dir'].'/'.'thumb_'.$platillo['foto']).'</figure>';
		$lista_asociacion[$contador]['nombre'] = h($platillo['nombre']);
		$lista_asociacion[$contador]['precio'] = '$ '.number_format($platillo['precio'], 2, '.', ',');
		$lista_asociacion[$contador]['elemento_eliminar'] = h($platillo['nombre']);
		$contador++;
	}
	$asociacion_singular = 'platillo';
	$asociacion_plural = 'platillos';
	$campos_asociacion = array('foto', 'nombre', 'precio');
	$lista = $singular = $plural = $titulos = NULL;
}
echo $this->element(
	'editar', array(
		'id' => $empleado['Persona']['id'],
		'alias_singular' => 'empleado',
		'alias_plural' => 'empleados',
		'modelo' => 'Persona',
		'campos' => array(
			'dui' => array('label' => array('text' => 'DUI', 'class' => 'col-lg-3 control-label')),
			'nombres' => array(),
			'apellidos' => array(),
			'telefono' => array('label' => array('text' => 'Teléfono', 'class' => 'col-lg-3 control-label')),
			'cargo' => array('options' => $this->Funciones->cargos())
		),
		'lista_asociacion' => $lista_asociacion,
		'asociacion_singular' => $asociacion_singular,
		'asociacion_plural' => $asociacion_plural,
		'campos_asociacion' => $campos_asociacion,
		'lista' => $lista,
		'singular' => $singular,
		'plural' => $plural,
		'titulos' => $titulos
	)
);
?>
