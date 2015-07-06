<div class="row">
	<div class="col-lg-12">
		<h1 class="well page-header"><i class="fa fa-random"></i> Módulo de Categoría de Platillos</h1>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-primary">
			<div class="panel-heading">
				Ver Categoría de Platillo
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-lg-4 col-lg-offset-4">
						<div class="form-horizontal">
						<fieldset>
							<legend>Datos</legend>
							<div class="form-group">
								<?= $this->Form->label('categoria', 'Categoría', array('class' => 'col-lg-3 control-label')); ?>
								<div class="col-lg-9">
									<?= $this->Form->input('categoria', array('label' => FALSE, 'value' => $categoria_platillo['CategoriaPlatillo']['categoria'], 'disabled' => TRUE, 'class' => 'form-control', 'div' => FALSE)); ?>
								</div>
							</div>
							<div class="form-group">
								<div class="col-lg-4 text-right">
									<?= $this->Html->link(__('<i class="fa fa-pencil"></i> Editar'), array('controller' => 'categoria_platillos', 'action' => 'editar', $categoria_platillo['CategoriaPlatillo']['id']), array('class' => 'btn btn-primary', 'escape' => FALSE)); ?>
								</div>
								<div class="col-lg-4 text-center">
									<?= $this->Form->postLink(__('<i class="fa fa-trash"></i> Eliminar'), array('controller' => 'categoria_platillos', 'action' => 'eliminar', $categoria_platillo['CategoriaPlatillo']['id']), array('class' => 'btn btn-danger', 'escape' => FALSE, 'confirm' => __('¿Eliminar a %s?', $categoria_platillo['CategoriaPlatillo']['categoria']))); ?>
								</div>
								<div class="col-lg-4 text-left">
									<?= $this->Html->link(__('<i class="fa fa-times-circle"></i> Cancelar'), array('controller' => 'categoria_platillos', 'action' => 'index'), array('class' => 'btn btn-default', 'escape' => FALSE)); ?>
								</div>
							</div>
						</fieldset>
						</div>
					</div>
				</div>
				<div class="row"><div class="col-lg-12">&nbsp;</div></div>
				<div class="row">
					<div class="col-lg-12">
						<fieldset>
							<legend>Platillos Asociados</legend>
							<?php if (empty($categoria_platillo['Platillo'])) { ?>
								<p>No tiene platillos asociados.</p>
							<?php } else { ?>
							<table class="table table-striped table-bordered table-hover">
								<thead>
									<tr>
										<th>Nombre</th>
										<th>Foto</th>
										<th>Precio</th>
										<th>Acción</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($categoria_platillo['Platillo'] as $platillo): ?>
									<tr>
										<td><?= $platillo['nombre']; ?></td>
										<?php if (empty($platillo['foto'])) { ?>
										<td><?= $this->Html->image('../img/plato_vacio/thumb_plato_vacio.jpg'); ?></td>
										<?php } else { ?>
										<td><?= $this->Html->image('../files/platillo/foto/'.$platillo['foto_dir'].'/'.'thumb_'.$platillo['foto']); ?></td>
										<?php } ?>
										<td>$ <?= number_format($platillo['precio'], 2, '.', ','); ?></td>
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
