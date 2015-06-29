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
		<h1 class="well page-header"><i class="fa fa-male"></i> Módulo de Cocineros</h1>
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
				Editar Cocinero
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-lg-4 col-lg-offset-4">
						<?= $this->Form->create('Cocinero', $formulario); ?>
						<fieldset>
							<legend>Datos Personales</legend>
							<?= $this->Form->input('nombres', $etiqueta); ?>
							<?= $this->Form->input('apellidos', $etiqueta); ?>
							<div class="form-group">
								<div class="col-lg-6 text-right submit">
									<?= $this->Form->button(__('<i class="fa fa-save"></i> Guardar'), array('type' => 'submit', 'class' => 'btn btn-primary', 'escape' => FALSE)); ?>
								</div>
								<div class="col-lg-6 text-left">
									<?= $this->Html->link(__('<i class="fa fa-times-circle"></i> Cancelar'), array('controller' => 'cocineros', 'action' => 'ver', $cocinero['Cocinero']['id']), array('class' => 'btn btn-default', 'escape' => FALSE)); ?>
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
							<legend>Encargado de los Platillos</legend>
							<?php if (empty($cocinero['Platillo'])) { ?>
								<p>No tiene platillos asociados.</p>
							<?php } else { ?>
							<table class="table table-striped table-bordered table-hover">
								<thead>
									<tr>
										<th>Nombre</th>
										<th>Precio</th>
										<th>Categoría</th>
										<th>Creado</th>
										<th>Modificado</th>
										<th>Acción</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($cocinero['Platillo'] as $platillo): ?>
									<tr>
										<td><?= $platillo['nombre']; ?></td>
										<td><?= $platillo['precio']; ?></td>
										<td><?= $this->Html->link($categoriaPlatillos[$platillo['categoria_platillo_id']], array('controller' => 'categoriaplatillos', 'action' => 'ver', $platillo['id'])) ?></td>
										<td><?= $this->Time->format('d/m/Y h:i A', $platillo['created']); ?></td>
										<td><?= $this->Time->format('d/m/Y h:i A', $platillo['modified']); ?></td>
										<td>
											<?= $this->Html->link(__('<i class="fa fa-file-text-o"></i> Ver'), array('controller' => 'platillos', 'action' => 'ver', $platillo['id']), array('class' => 'btn btn-sm btn-default', 'escape' => FALSE)); ?>
											<?= $this->Html->link(__('<i class="fa fa-pencil"></i> Editar'), array('controller' => 'platillos', 'action' => 'editar', $platillo['id']), array('class' => 'btn btn-default', 'escape' => FALSE)); ?>
											<?= $this->Form->postLink(__('<i class="fa fa-trash"></i> Eliminar'), array('controller' => 'platillos', 'action' => 'eliminar', $platillo['id']), array('class' => 'btn btn-default', 'escape' => FALSE, 'confirm' => __('¿Eliminar platillo %s?', $platillo['nombre']))); ?>
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
