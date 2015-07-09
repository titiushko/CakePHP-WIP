<?php
$formulario = array(
	'class' => 'form-horizontal',
	'type' => 'file',
	'novalidate' => 'novalidate',
	'inputDefaults' => array(
		'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
		'div' => array('class' => 'form-group'),
		'label' => array('class' => 'control-label'),
		'class' => 'form-control',
		'between' => '<div class="col-lg-9">',
		'after' => '</div>',
		'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-inline')),
	)
);
$control_label = 'col-lg-3 control-label';
$etiqueta = array('label' => array('class' => $control_label));
?>
<div class="row">
	<div class="col-lg-12">
		<h1 class="well page-header"><i class="fa fa-cutlery"></i> Módulo de Platillos</h1>
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
				Agregar Platillo
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="form-horizontal">
						<?= $this->Form->create('Platillo', $formulario); ?>
							<div class="col-lg-7">
								<?= $this->Form->input('foto', array('type' => 'file', 'label' => array('text' => 'Foto', 'class' => $control_label), 'class' => 'file', 'data-show-upload' => 'false', 'data-show-caption' => 'true')); ?>
								<?= $this->Form->input('foto_dir', array('type' => 'hidden')); ?>
							</div>
							<div class="col-lg-5">
								<?= $this->Form->input('nombre', $etiqueta); ?>
								<?= $this->Form->input('descripcion', array_merge($etiqueta, array('rows' => 4))); ?>
								<?= $this->Form->input('precio', $etiqueta); ?>
								<?= $this->Form->input('categoria_platillo_id', array('label' => array('text' => 'Categoría', 'class' => $control_label))); ?>
								<?= $this->Form->input('Cocinero', $etiqueta); ?>
								<div class="form-group">
									<div class="col-lg-6 text-right submit">
										<?= $this->Form->button(__('<i class="fa fa-save"></i> Guardar'), array('type' => 'submit', 'class' => 'btn btn-primary', 'escape' => FALSE)); ?>
									</div>
									<div class="col-lg-6 text-left">
										<?= $this->Html->link(__('<i class="fa fa-times-circle"></i> Cancelar'), array('controller' => 'platillos', 'action' => 'index'), array('class' => 'btn btn-sm btn-default', 'escape' => FALSE)); ?>
									</div>
								</div>
							</div>
						<?= $this->Form->end(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
