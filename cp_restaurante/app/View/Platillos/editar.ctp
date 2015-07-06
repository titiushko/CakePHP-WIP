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
				Editar Platillo
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
										<?= $this->Html->link(__('<i class="fa fa-times-circle"></i> Cancelar'), array('controller' => 'platillos', 'action' => 'ver', $platillo['Platillo']['id']), array('class' => 'btn btn-default', 'escape' => FALSE)); ?>
									</div>
								</div>
							</div>
						<?= $this->Form->end(); ?>
					</div>
				</div>
				<div class="row"><div class="col-lg-12">&nbsp;</div></div>
				<div class="row">
					<div class="col-lg-12">
						<fieldset>
							<legend>Cocineros Encargados</legend>
							<?php if (empty($platillo['Cocinero'])) { ?>
								<p>No tiene cocineros asociados.</p>
							<?php } else { ?>
							<table class="table table-striped table-bordered table-hover">
								<thead>
									<tr>
										<th>Nombres</th>
										<th>Apellidos</th>
										<th>Creado</th>
										<th>Modificado</th>
										<th>Acción</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($platillo['Cocinero'] as $cocinero): ?>
									<tr>
										<td><?= $cocinero['nombres']; ?></td>
										<td><?= $cocinero['apellidos']; ?></td>
										<td><?= $this->Time->format('d/m/Y h:i A', $cocinero['created']); ?></td>
										<td><?= $this->Time->format('d/m/Y h:i A', $cocinero['modified']); ?></td>
										<td>
											<?= $this->Html->link(__('<i class="fa fa-file-text-o"></i> Ver'), array('controller' => 'cocineros', 'action' => 'ver', $cocinero['id']), array('class' => 'btn btn-sm btn-default', 'escape' => FALSE)); ?>
											<?= $this->Html->link(__('<i class="fa fa-pencil"></i> Editar'), array('controller' => 'cocineros', 'action' => 'editar', $cocinero['id']), array('class' => 'btn btn-default', 'escape' => FALSE)); ?>
											<?= $this->Form->postLink(__('<i class="fa fa-trash"></i> Eliminar'), array('controller' => 'cocineros', 'action' => 'eliminar', $cocinero['id']), array('class' => 'btn btn-default', 'escape' => FALSE, 'confirm' =>  __('¿Eliminar a %s?', $cocinero['nombre_completo']))); ?>
										</td>
									</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
							<?php } ?>
						</fieldset>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
