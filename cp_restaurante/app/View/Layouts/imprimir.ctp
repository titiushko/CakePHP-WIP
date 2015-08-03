<?php
$cakeDescription = __d('cake_dev', 'Restaurante');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version());
$this->Html->docType('html5');
?>
<html lang="en">
	<head>
		<?php
		echo $this->Html->meta(array('name' => 'robots', 'content' => 'no-cache'));
		echo $this->Html->meta(array('name' => 'description', 'content' => 'Práctica de CakePHP: Desarrollando una aplicación completa de restaurante.'));
		echo $this->Html->meta(array('name' => 'keywords', 'content' => 'cakephp, restaurante, práctica, aplicación'));
		echo $this->Html->meta(array('name' => 'X-UA-Compatible', 'content' => 'IE=edge', 'type' => 'equiv'));
		echo $this->Html->meta(array('name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no'));
		echo $this->Html->meta(array('name' => 'Content-type', 'content' => 'text/html; charset=utf-8', 'type' => 'equiv'));
		echo $this->Html->meta(array('name' => 'expires', 'content' => '0', 'type' => 'equiv'));
		echo $this->Html->meta(array('name' => 'pragma', 'content' => 'no-cache', 'type' => 'equiv'));
		echo $this->Html->meta('icon');
		?>
		<title>
			<?= $cakeDescription ?>:
			<?= $this->fetch('title'); ?>
		</title>
		<script type="text/javascript">
			window.onload = function () {
				window.print();
			}
		</script>
	</head>
	<body>
		<table align="center">
			<tr><th align="center"><h1>RESTAURANTE</h1></th></tr>
			<tr><th align="center"><h2>REPORTE DE ORDEN DE PEDIDOS</h2></th></tr>
		</table>
		<?= $this->fetch('content'); ?>
	</body>
</html>
