<?= $this->Html->script(array('agregar_pedido_carrito'), array('inline' => FALSE)); ?>
<div class="row">
	<div class="col-lg-12">
		<h1 class="well page-header"><i class="fa fa-cutlery"></i> Módulo de Platillos</h1>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-primary">
			<div class="panel-heading">
				Ver Platillo
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="form-horizontal">
						<div class="col-lg-7 text-center">
							<?php if (empty($platillo['Platillo']['foto'])) { ?>
							<?= $this->Html->image('../img/plato_vacio/thumb_plato_vacio.jpg'); ?>
							<?php } else { ?>
							<?= $this->Html->image('../files/platillo/foto/'.$platillo['Platillo']['foto_dir'].'/'.'vga_'.$platillo['Platillo']['foto']); ?>
							<?php } ?>
						</div>
						<div class="col-lg-5">
							<div class="form-group">
								<?= $this->Form->label('nombre', 'Nombre', array('class' => 'col-lg-3 control-label')); ?>
								<div class="col-lg-9">
									<?= $this->Form->input('nombre', array('label' => FALSE, 'value' => $platillo['Platillo']['nombre'], 'disabled' => TRUE, 'class' => 'form-control', 'div' => FALSE)); ?>
								</div>
							</div>
							<div class="form-group">
								<?= $this->Form->label('descripcion', 'Descripción', array('class' => 'col-lg-3 control-label')); ?>
								<div class="col-lg-9">
									<?= $this->Form->input('descripcion', array('label' => FALSE, 'value' => $platillo['Platillo']['descripcion'], 'disabled' => TRUE, 'rows' => 4, 'class' => 'form-control', 'div' => FALSE)); ?>
								</div>
							</div>
							<div class="form-group">
								<?= $this->Form->label('precio', 'Precio', array('class' => 'col-lg-3 control-label')); ?>
								<div class="col-lg-9">
									<?= $this->Form->input('precio', array('label' => FALSE, 'value' => $platillo['Platillo']['precio'], 'disabled' => TRUE, 'class' => 'form-control', 'div' => FALSE)); ?>
								</div>
							</div>
							<div class="form-group">
								<?= $this->Form->label('categoria', 'Categoría', array('class' => 'col-lg-3 control-label')); ?>
								<div class="col-lg-9 margen-superior">
									<?php echo $this->Html->link($platillo['CategoriaPlatillo']['categoria'], array('controller' => 'categoria_platillos', 'action' => 'ver', $platillo['CategoriaPlatillo']['id'])); ?>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-4 text-right">
									<?= $this->Html->link(__('<i class="fa fa-pencil"></i> Editar'), array('controller' => 'platillos', 'action' => 'editar', $platillo['Platillo']['id']), array('class' => 'btn btn-primary', 'escape' => FALSE)); ?>
								</div>
								<div class="col-lg-4 text-center">
									<?= $this->Form->postLink(__('<i class="fa fa-trash"></i> Eliminar'), array('controller' => 'platillos', 'action' => 'eliminar', $platillo['Platillo']['id']), array('class' => 'btn btn-danger', 'escape' => FALSE, 'confirm' => __('¿Eliminar %s?', $platillo['Platillo']['nombre']))); ?>
								</div>
								<div class="col-lg-4 text-left">
									<?= $this->Html->link(__('<i class="fa fa-times-circle"></i> Cancelar'), array('controller' => 'platillos', 'action' => 'index'), array('class' => 'btn btn-sm btn-default', 'escape' => FALSE)); ?>
								</div>
							</div>
							<div class="row margen-superior">
								<div class="col-lg-12 text-center">
									<?= $this->Form->button(__('<i class="fa fa-cart-plus"></i> Agregar a Pedido'), array('class' => 'btn btn-success agregar_pedido_carrito', 'id' => $platillo['Platillo']['id']) ); ?>
								</div>
							</div>
						</div>
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
											<?= $this->Html->link(__('<i class="fa fa-pencil"></i> Editar'), array('controller' => 'cocineros', 'action' => 'editar', $cocinero['id']), array('class' => 'btn btn-sm btn-default', 'escape' => FALSE)); ?>
											<?= $this->Form->postLink(__('<i class="fa fa-trash"></i> Eliminar'), array('controller' => 'cocineros', 'action' => 'eliminar', $cocinero['id']), array('class' => 'btn btn-sm btn-default', 'escape' => FALSE, 'confirm' =>  __('¿Eliminar a %s?', $cocinero['nombre_completo']))); ?>
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
