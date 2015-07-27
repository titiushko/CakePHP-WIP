<?php
$formulario = array(
	'class' => 'form-horizontal',
	'inputDefaults' => array(
		'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
		'div' => array('class' => 'form-group'),
		'label' => array('class' => 'col-lg-3 control-label'),
		'autocomplete' => 'off',
		'class' => 'form-control',
		'between' => '<div class="col-lg-9">',
		'after' => '</div>',
		'error' => array('attributes' => array('wrap' => 'span', 'class' => 'error-message')),
	)
);
if (!isset($controlador)) {
	$controlador = $alias_plural;
}
if (!isset($modelo)) {
	$modelo_palabras = explode('_', $alias_singular);
	$modelo = ''; foreach ($modelo_palabras as $modelo_palabra) $modelo .= ucwords($modelo_palabra);
}
?>
<div class="row">
	<div class="col-lg-12">
		<h1 class="well page-header"><?= $this->Funciones->icono_modulo($alias_plural); ?> Módulo de <?= ucwords(str_replace('_', ' ', $alias_plural)); ?></h1>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<?= $this->Session->flash(); ?>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-primary">
			<div class="panel-heading">
				Agregar <?= ucwords(str_replace('_', ' ', $alias_singular)); ?>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-lg-4 col-lg-offset-4">
						<?= $this->Form->create($modelo, $formulario); ?>
						<fieldset>
							<legend>Datos Principales</legend>
							<?php foreach ($campos as $nombre => $opciones) echo $this->Form->input($nombre, $opciones); ?>
							<div class="form-group">
								<div class="col-lg-12 text-center">
									<span class="submit"><?= $this->Form->button(__('<i class="fa fa-save"></i> Guardar'), array('type' => 'submit', 'class' => 'btn btn-primary', 'escape' => FALSE)); ?></span>
									<?= $this->Html->link(__('<i class="fa fa-times-circle"></i> Cancelar'), array('controller' => $controlador, 'action' => 'index'), array('class' => 'btn btn-default', 'escape' => FALSE)); ?>
								</div>
							</div>
						</fieldset>
						<?= $this->Form->end(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
