<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'Restaurante');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version());
$this->Html->docType('html5');
?>
<html>
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
	?>
	<title>
		<?= $cakeDescription ?>:
		<?= $this->fetch('title'); ?>
	</title>
	<?php
		echo $this->Html->meta('icon');
		echo $this->Html->css(array('style', 'bootstrap.min', 'bootstrap-theme.min', 'font-awesome.min', 'fileinput.min', 'jquery-ui.min'));
		echo $this->Html->script(array('jquery.min', 'docs.min', 'bootstrap.min', 'fileinput.min', 'jquery-ui.min', 'buscar_platillo'));
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
	<script type="text/javascript">
		$("#foto").fileinput();
		var url_base = '<?= Router::url('/'); ?>';
	</script>
</head>
<body>
	<?= $this->element('menu'); ?>
	<div class="container theme-showcase" role="main">
		<?php
		echo $this->Session->flash();
		echo $this->fetch('content');
		//echo $this->element('sql_dump');
		?>
	</div>
	<div id="mensaje"></div>
</body>
</html>
