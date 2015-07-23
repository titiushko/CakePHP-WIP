<?php
$lista_valores = array(); $contador = 0;
foreach ($categoria_platillos as $categoria_platillo) {
	$lista_valores[$contador]['id'] = $categoria_platillo['CategoriaPlatillo']['id'];
	$lista_valores[$contador]['categoria'] = h($categoria_platillo['CategoriaPlatillo']['categoria']);
	$lista_valores[$contador]['elemento_eliminar'] = h($categoria_platillo['CategoriaPlatillo']['categoria']);
	$contador++;
}
echo $this->element('index', array(
	'alias_singular' => 'categoria_platillo',
	'alias_plural' => 'categoria_platillos',
	'lista_valores' => $lista_valores,
	'campos' => array('categoria')
));
?>
