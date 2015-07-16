<div class="row">
	<div class="col-lg-12">
		<h1 class="well page-header"><i class="fa fa-male"></i> Módulo de Cocineros</h1>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-primary">
			<div class="panel-heading">
				Ver Cocinero
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-lg-4 col-lg-offset-4">
						<div class="form-horizontal">
						<fieldset>
							<legend>Datos Personales</legend>
							<div class="form-group">
								<?= $this->Form->label('nombres', 'Nombres', array('class' => 'col-lg-3 control-label')); ?>
								<div class="col-lg-9">
									<?= $this->Form->input('nombres', array('label' => FALSE, 'value' => $cocinero['Cocinero']['nombres'], 'disabled' => TRUE, 'class' => 'form-control', 'div' => FALSE)); ?>
								</div>
							</div>
							<div class="form-group">
								<?= $this->Form->label('apellidos', 'Apellidos', array('class' => 'col-lg-3 control-label')); ?>
								<div class="col-lg-9">
									<?= $this->Form->input('apellidos', array('label' => FALSE, 'value' => $cocinero['Cocinero']['apellidos'], 'disabled' => TRUE, 'class' => 'form-control', 'div' => FALSE)); ?>
								</div>
							</div>
							<div class="form-group">
								<div class="col-lg-12 text-center">
									<?= $this->Html->link(__('<i class="fa fa-pencil"></i> Editar'), array('controller' => 'cocineros', 'action' => 'editar', $cocinero['Cocinero']['id']), array('class' => 'btn btn-primary', 'escape' => FALSE)); ?>
									<?= $this->Form->postLink(__('<i class="fa fa-trash"></i> Eliminar'), array('controller' => 'cocineros', 'action' => 'eliminar', $cocinero['Cocinero']['id']), array('class' => 'btn btn-danger', 'escape' => FALSE, 'confirm' => __('¿Eliminar a %s?', $cocinero['Cocinero']['nombre_completo']))); ?>
									<?= $this->Html->link(__('<i class="fa fa-times-circle"></i> Cancelar'), array('controller' => 'cocineros', 'action' => 'index'), array('class' => 'btn btn-default', 'escape' => FALSE)); ?>
								</div>
							</div>
						</fieldset>
						</div>
					</div>
				</div>
				<div class="row"><div class="col-lg-12">&nbsp;</div></div>
				<div class="row">
					<div class="col-lg-12 table-responsive">
						<fieldset>
							<legend>Encargado de los Platillos</legend>
							<?php if (empty($cocinero['Platillo'])) { ?>
								<p>No tiene platillos asociados.</p>
							<?php } else { ?>
							<table class="table table-striped table-bordered table-hover">
								<thead>
									<tr>
										<th>Nombre</th>
										<th>Foto</th>
										<th>Precio</th>
										<th>Categoría</th>
										<th>Acción</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($cocinero['Platillo'] as $platillo): ?>
									<tr>
										<td><?= $platillo['nombre']; ?></td>
										<?php if (empty($platillo['foto'])) { ?>
										<td><figure><?= $this->Html->image('../img/plato_vacio/thumb_plato_vacio.jpg'); ?></figure></td>
										<?php } else { ?>
										<td><?= $this->Html->image('../files/platillo/foto/'.$platillo['foto_dir'].'/'.'thumb_'.$platillo['foto']); ?></td>
										<?php } ?>
										<td>$ <?= number_format($platillo['precio'], 2, '.', ','); ?></td>
										<td><?= $this->Html->link($categoriaPlatillos[$platillo['categoria_platillo_id']], array('controller' => 'categoria_platillos', 'action' => 'ver', $platillo['categoria_platillo_id'])) ?></td>
										<td>
											<?= $this->Html->link(__('<i class="fa fa-file-text-o"></i>'), array('controller' => 'platillos', 'action' => 'ver', $platillo['id']), array('class' => 'btn btn-sm btn-default', 'escape' => FALSE, 'title' => 'Ver')); ?>
											<?= $this->Html->link(__('<i class="fa fa-pencil"></i>'), array('controller' => 'platillos', 'action' => 'editar', $platillo['id']), array('class' => 'btn btn-sm btn-default', 'escape' => FALSE, 'title' => 'Editar')); ?>
											<?= $this->Form->postLink(__('<i class="fa fa-trash"></i>'), array('controller' => 'platillos', 'action' => 'eliminar', $platillo['id']), array('class' => 'btn btn-sm btn-default', 'escape' => FALSE, 'title' => 'Eliminar', 'confirm' => __('¿Eliminar platillo %s?', $platillo['nombre']))); ?>
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
