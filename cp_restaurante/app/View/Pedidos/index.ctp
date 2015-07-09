<div class="row">
	<div class="col-lg-12">
		<h1 class="well page-header"><i class="fa fa-cutlery"></i> Módulo de Pedidos</h1>
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
				Listado de Pedidos
			</div>
			<div class="panel-body">
				<div class="row"><div class="col-lg-12">&nbsp;</div></div>
				<div class="row">
					<div class="col-lg-12">
						<div class="progress oculto" id="procesando">
							<div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">
								<span class="sr-only">100% Complado</span>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<?php if (empty($pedidos)) { ?>
							<p>No tiene pedidos asociados.</p>
						<?php } else { ?>
						<table class="table table-striped table-bordered table-hover">
							<thead>
								<tr>
									<th>Nombre</th>
									<th>Foto</th>
									<th>Precio</th>
									<th>Cantidad</th>
									<th>Sub-Total</th>
									<th>Acción</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($pedidos as $platillo): ?>
								<tr>
									<td><?= $platillo['Platillo']['nombre']; ?></td>
									<?php if (empty($platillo['Platillo']['foto'])) { ?>
									<td><?= $this->Html->image('../img/plato_vacio/thumb_plato_vacio.jpg'); ?></td>
									<?php } else { ?>
									<td><?= $this->Html->image('../files/platillo/foto/'.$platillo['Platillo']['foto_dir'].'/'.'thumb_'.$platillo['Platillo']['foto']); ?></td>
									<?php } ?>
									<td>$ <?= number_format($platillo['Platillo']['precio'], 2, '.', ','); ?></td>
									<td><?= $this->Form->input('cantidad', array('value' => $platillo['Pedido']['cantidad'], 'label' => FALSE, 'class' => 'form-control', 'div' => array('class' => 'col-xs-4'), 'type' => 'number')); ?></td>
									<td>$ <?= number_format($platillo['Pedido']['subtotal'], 2, '.', ','); ?></td>
									<td>
										<?= $this->Html->link(__('<i class="fa fa-file-text-o"></i> Ver'), array('controller' => 'platillos', 'action' => 'ver', $platillo['Platillo']['id']), array('class' => 'btn btn-sm btn-default', 'escape' => FALSE)); ?>
										<?= $this->Form->postLink(__('<i class="fa fa-trash"></i> Eliminar'), array('controller' => 'pedidos', 'action' => 'eliminar', $platillo['Platillo']['id']), array('class' => 'btn btn-sm btn-default', 'escape' => FALSE, 'confirm' => __('¿Eliminar platillo %s?', $platillo['Platillo']['nombre']))); ?>
									</td>
								</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
