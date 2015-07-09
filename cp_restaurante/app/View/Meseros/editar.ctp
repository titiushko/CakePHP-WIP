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
$etiqueta = array('label' => array('class' => 'col-lg-3 control-label'));
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
				Editar Mesero
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
									<?= $this->Html->link(__('<i class="fa fa-times-circle"></i> Cancelar'), array('controller' => 'meseros', 'action' => 'ver', $mesero['Mesero']['id']), array('class' => 'btn btn-sm btn-default', 'escape' => FALSE)); ?>
								</div>
							</div>
						</fieldset>
						<?= $this->Form->end(); ?>
					</div>
				</div>
				<div class="row"><div class="col-lg-12">&nbsp;</div></div>
				<div class="row">
					<div class="col-lg-12">
						<fieldset>
							<legend>Encargado de las Mesas</legend>
							<?php if (empty($mesero['Mesa'])) { ?>
								<p>No tiene mesas asociadas.</p>
							<?php } else { ?>
							<table class="table table-striped table-bordered table-hover">
								<thead>
									<tr>
										<th>Serie</th>
										<th>Puestos</th>
										<th>Posición</th>
										<th>Creado</th>
										<th>Modificado</th>
										<th>Acción</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($mesero['Mesa'] as $mesa): ?>
									<tr>
										<td><?= $mesa['serie']; ?></td>
										<td><?= $mesa['puestos']; ?></td>
										<td><?= $mesa['posicion']; ?></td>
										<td><?= $this->Time->format('d/m/Y h:i A', $mesa['created']); ?></td>
										<td><?= $this->Time->format('d/m/Y h:i A', $mesa['modified']); ?></td>
										<td>
											<?= $this->Html->link(__('<i class="fa fa-file-text-o"></i> Ver'), array('controller' => 'mesas', 'action' => 'ver', $mesa['id']), array('class' => 'btn btn-sm btn-default', 'escape' => FALSE)); ?>
											<?= $this->Html->link(__('<i class="fa fa-pencil"></i> Editar'), array('controller' => 'mesas', 'action' => 'editar', $mesa['id']), array('class' => 'btn btn-sm btn-default', 'escape' => FALSE)); ?>
											<?= $this->Form->postLink(__('<i class="fa fa-trash"></i> Eliminar'), array('controller' => 'mesas', 'action' => 'eliminar', $mesa['id']), array('class' => 'btn btn-sm btn-default', 'escape' => FALSE, 'confirm' => __('¿Eliminar mesa %s?', $mesa['serie']))); ?>
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
