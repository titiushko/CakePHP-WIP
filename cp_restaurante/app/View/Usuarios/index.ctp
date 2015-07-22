<?php
$lista_valores = array(); $contador = 0;
foreach ($usuarios as $usuario) {
	$lista_valores[$contador]['id'] = $usuario['Usuario']['id'];
	$lista_valores[$contador]['nombre_completo'] = h($usuario['Usuario']['nombre_completo']);
	$lista_valores[$contador]['usuario'] = h($usuario['Usuario']['usuario']);
	$lista_valores[$contador]['rol'] = h($this->Funciones->rol($usuario['Usuario']['rol']));
	$lista_valores[$contador]['creado'] = $this->Time->format('d/m/Y h:i A', $usuario['Usuario']['created']);
	$lista_valores[$contador]['modificado'] = $this->Time->format('d/m/Y h:i A', $usuario['Usuario']['modified']);
	$lista_valores[$contador]['elemento_eliminar'] = h($usuario['Usuario']['nombre_completo']);
	$contador++;
}
echo $this->element('index', array(
	'icono' => 'users',
	'alias_singular' => 'usuario',
	'alias_plural' => 'usuarios',
	'lista_valores' => $lista_valores,
	'campos' => array('nombre_completo', 'usuario', 'rol', 'creado', 'modificado')
));
?>
