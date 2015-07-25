<?php
$formulario = array(
	'class' => 'form-horizontal',
	'type' => 'file',
	'novalidate' => 'novalidate',
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
								<?= $this->Form->input('foto', array('type' => 'file', 'label' => array('text' => 'Foto', 'class' => 'col-lg-3 control-label'), 'class' => 'file', 'data-show-upload' => 'false', 'data-show-caption' => 'true')); ?>
								<?= $this->Form->input('foto_dir', array('type' => 'hidden')); ?>
							</div>
							<div class="col-lg-5">
								<?= $this->Form->input('nombre'); ?>
								<?= $this->Form->input('descripcion', array('rows' => 4)); ?>
								<?= $this->Form->input('precio'); ?>
								<?= $this->Form->input('categoria_platillo_id', array('label' => array('text' => 'Categoría', 'class' => 'col-lg-3 control-label'))); ?>
								<?= $this->Form->input('Persona'); ?>
								<div class="form-group">
									<div class="col-lg-12 text-center">
										<span class="submit"><?= $this->Form->button(__('<i class="fa fa-save"></i> Guardar'), array('type' => 'submit', 'class' => 'btn btn-primary', 'escape' => FALSE)); ?></span>
										<?= $this->Html->link(__('<i class="fa fa-times-circle"></i> Cancelar'), array('controller' => 'platillos', 'action' => 'index'), array('class' => 'btn btn-default', 'escape' => FALSE)); ?>
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
