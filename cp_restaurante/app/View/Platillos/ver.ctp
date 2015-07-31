<?= $this->Html->script(array('agregar_pedido', 'quitar_registro'), array('inline' => FALSE)); ?>
<?php
$formulario = array(
	'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
	'div' => array('class' => 'form-group'),
	'label' => array('class' => 'col-lg-3 control-label'),
	'autocomplete' => 'off',
	'class' => 'form-control',
	'between' => '<div class="col-lg-9">',
	'after' => '</div>',
	'error' => array('attributes' => array('wrap' => 'span', 'class' => 'error-message'))
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
				Ver Platillo
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="form-horizontal">
						<div class="col-lg-7 text-center table-responsive">
							<?php if (empty($platillo['Platillo']['foto'])) { ?>
							<figure><?= $this->Html->image('../img/plato_vacio/thumb_plato_vacio.jpg'); ?></figure>
							<?php } else { ?>
							<?= $this->Html->image('../files/platillo/foto/'.$platillo['Platillo']['foto_dir'].'/'.'vga_'.$platillo['Platillo']['foto']); ?>
							<?php } ?>
						</div>
						<div class="col-lg-5">
							<?= $this->Form->input('nombre', array_merge($formulario, array('value' => $platillo['Platillo']['nombre'], 'disabled' => TRUE))); ?>
							<?= $this->Form->input('descripcion', array_merge($formulario, array('value' => $platillo['Platillo']['descripcion'], 'disabled' => TRUE, 'rows' => 4))); ?>
							<?= $this->Form->input('precio', array_merge($formulario, array('value' => $platillo['Platillo']['precio'], 'disabled' => TRUE))); ?>
							<?= $this->Funciones->campo_enlace('categoría', $this->Html->link($platillo['CategoriaPlatillo']['categoria'], array('controller' => 'categoria_platillos', 'action' => 'ver', $platillo['CategoriaPlatillo']['id']))); ?>
							<?php if (isset($usuario_actual)): ?>
							<div class="form-group">
								<div class="col-lg-12 text-center">
									<?= $this->Html->link(__('<i class="fa fa-pencil"></i> Editar'), array('controller' => 'platillos', 'action' => 'editar', $platillo['Platillo']['id']), array('class' => 'btn btn-primary', 'escape' => FALSE)); ?>
									<?php if($usuario_actual['rol'] == 'admin'): ?>
									<?= $this->Form->postLink(__('<i class="fa fa-trash"></i> Eliminar'), array('controller' => 'platillos', 'action' => 'eliminar', $platillo['Platillo']['id']), array('class' => 'btn btn-danger', 'escape' => FALSE, 'confirm' => __('¿Eliminar %s?', $platillo['Platillo']['nombre']))); ?>
									<?php endif; ?>
									<?= $this->Html->link(__('<i class="fa fa-arrow-left"></i> Regresar'), array('controller' => 'platillos', 'action' => 'index'), array('class' => 'btn btn-default', 'escape' => FALSE)); ?>
								</div>
							</div>
							<div class="row margen-superior">
								<div class="col-lg-12 text-center">
									<?= $this->Form->button(__('<i class="fa fa-cart-plus"></i> Agregar a Pedido'), array('class' => 'btn btn-success agregar_pedido', 'id' => $platillo['Platillo']['id']) ); ?>
								</div>
							</div>
							<?php else: ?>
							<div class="form-group">
								<div class="col-lg-12 text-center">
									<?= $this->Html->link(__('<i class="fa fa-arrow-left"></i> Regresar'), array('controller' => 'platillos', 'action' => 'index'), array('class' => 'btn btn-default', 'escape' => FALSE)); ?>
								</div>
							</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
				<?php if (isset($usuario_actual)): ?>
				<div class="row"><div class="col-lg-12">&nbsp;</div></div>
				<div class="row">
					<div class="col-lg-12 table-responsive">
						<fieldset>
							<legend>Cocineros</legend>
							<?php if (empty($platillo['Persona'])) { ?>
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
									<?php foreach ($platillo['Persona'] as $cocinero): ?>
									<tr class="registro-<?= $cocinero['id']; ?>" id="<?= $cocinero['CocinerosPlatillo']['id']; ?>">
										<td><?= $cocinero['nombres']; ?></td>
										<td><?= $cocinero['apellidos']; ?></td>
										<td><?= $this->Time->format('d/m/Y h:i A', $cocinero['created']); ?></td>
										<td><?= $this->Time->format('d/m/Y h:i A', $cocinero['modified']); ?></td>
										<td>
											<?= $this->Html->link(__('<i class="fa fa-file-text-o"></i>'), array('controller' => 'empleados', 'action' => 'ver', $cocinero['id']), array('class' => 'btn btn-sm btn-default', 'escape' => FALSE, 'title' => 'Ver')); ?>
											<?= $this->Html->link(__('<i class="fa fa-pencil"></i>'), array('controller' => 'empleados', 'action' => 'editar', $cocinero['id']), array('class' => 'btn btn-sm btn-default', 'escape' => FALSE, 'title' => 'Editar')); ?>
											<?php if($usuario_actual['rol'] == 'admin'): ?>
											<?= $this->Form->postLink(__('<i class="fa fa-trash"></i>'), array('controller' => 'empleados', 'action' => 'eliminar', $cocinero['id']), array('class' => 'btn btn-sm btn-default', 'escape' => FALSE, 'title' => 'Eliminar', 'confirm' =>  __('¿Eliminar a %s?', $cocinero['nombre_completo']))); ?>
											<?= $this->Form->button(__('<span style="color: #d9534f;"><i class="fa fa-minus-circle"></i></span>'), array('class' => 'btn btn-sm btn-default quitar_registro', 'title' => 'Quitar cocinero', 'id' => $cocinero['id'], 'modelo' => 'cocinero')); ?>
											<?php endif; ?>
										</td>
									</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
							<?php } ?>
						</fieldset>
					</div>
				</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>
