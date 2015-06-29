<?php
$formulario = array(
	'class' => 'form-horizontal',
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
$etiqueta = array(
	'label' => array(
		'class' => 'col-lg-3 control-label',
		// 'text' => __('DUI')
	),
);
?>
<div class="row">
	<div class="col-lg-12">
		<h1 class="well page-header"><i class="fa fa-users"></i> Módulo de Meseros</h1>
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
				Agregar Mesero
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-lg-4 col-lg-offset-4">
						<?= $this->Form->create('Mesero', $formulario); ?>
						<fieldset>
							<legend>Datos Personales</legend>
							<?= $this->Form->input('dui', $etiqueta); ?>
							<?= $this->Form->input('nombres', $etiqueta); ?>
							<?= $this->Form->input('apellidos', $etiqueta); ?>
							<?= $this->Form->input('telefono', $etiqueta); ?>
							<div class="form-group">
								<div class="col-lg-6 text-right submit">
									<?= $this->Form->button(__('<i class="fa fa-save"></i> Guardar'), array('type' => 'submit', 'class' => 'btn btn-primary', 'escape' => FALSE)); ?>
								</div>
								<div class="col-lg-6 text-left">
									<?= $this->Html->link(__('<i class="fa fa-times-circle"></i> Cancelar'), array('controller' => 'meseros', 'action' => 'index'), array('class' => 'btn btn-default', 'escape' => FALSE)); ?>
								</div>
							</div>
						</fieldset>
						<?= $this->Form->end(/* array('label' => __('Guardar Mesero'), 'div' => array('class' => 'col-lg-offset-3 col-lg-9 submit')) */); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
