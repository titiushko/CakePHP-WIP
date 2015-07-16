<?= $this->Html->script(array('carrito', 'jquery.animate-colors-min'), array('inline' => FALSE)); ?>
<div class="row">
	<div class="col-lg-12">
		<h1 class="well page-header"><i class="fa fa-shopping-cart"></i> Módulo de Pedidos</h1>
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
				<div class="row">
					<div class="col-lg-12 table-responsive">
						<?php if (empty($pedidos)) { ?>
							<p>No se han realizado pedidos.</p>
						<?php } else { ?>
						<table class="table table-striped table-bordered table-hover">
							<thead>
								<tr>
									<th>Platillo</th>
									<th><strong>Foto</th>
									<th><strong>Precio</th>
									<th><strong>Cantidad</th>
									<th><strong>SubTotal</th>
									<th>&nbsp;</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$indice_tabulador = 1;
								foreach ($pedidos as $platillo):
								?>
								<tr id="pedido-<?= $platillo['Pedido']['id']; ?>">
									<td><?= $this->Html->link(__('%s', $platillo['Platillo']['nombre']), array('controller' => 'platillos', 'action' => 'ver', $platillo['Platillo']['id'])); ?></td>
									<?php if (empty($platillo['Platillo']['foto'])) { ?>
									<td><figure><?= $this->Html->image('../img/plato_vacio/thumb_plato_vacio.jpg', array('class' => 'imagen-pedidos')); ?></figure></td>
									<?php } else { ?>
									<td><figure><?= $this->Html->image('../files/platillo/foto/'.$platillo['Platillo']['foto_dir'].'/'.'thumb_'.$platillo['Platillo']['foto'], array('class' => 'imagen-pedidos')); ?></figure></td>
									<?php } ?>
									<td id="precio-<?= $platillo['Pedido']['id']; ?>">$ <?= number_format($platillo['Platillo']['precio'], 2, '.', ','); ?></td>
									<td><?= $this->Form->input($platillo['Pedido']['id'], array('value' => $platillo['Pedido']['cantidad'], 'label' => FALSE, 'div' => FALSE, 'class' => 'cantidad form-control', 'type' => 'number', 'size' => 2, 'minlenght' => 1, 'maxlenght' => 2, 'indice-tabulador' => $indice_tabulador++, 'cantidad-id' => $platillo['Pedido']['id'])); ?></td>
									<td id="subtotal-<?= $platillo['Pedido']['id']; ?>">$ <?= number_format($platillo['Pedido']['subtotal'], 2, '.', ','); ?></td>
									<td><?= $this->Html->link(__('<i class="fa fa-trash"></i>'), '#', array('class' => 'btn btn-default eliminar', 'escape' => FALSE, 'title' => __('¿Eliminar pedido de %s?', $platillo['Platillo']['nombre']), 'escapeTitle' => FALSE, 'id' => $platillo['Pedido']['id'])); ?></td>
								</tr>
								<?php
								endforeach;
								}
								?>
							</tbody>
						</table>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12 text-right">
						<?= $this->Html->link(__('Quitar Pedidos'), array('controller' => 'pedidos', 'action' => 'eliminar_pedidos'), array('class' => 'btn btn-danger', 'escape' => FALSE, 'confirm' => __('¿Eliminar todos los pedidos de la orden?'))); ?>
					</div>
				</div>
				<hr style="border-color: #000000;">
				<div class="row">
					<div class="col-sm-12">
						<h3 class="pull-right">
							<strong>
								Total Orden: <span id="total-orden">$ <?= number_format($total_orden, 2, '.', ','); ?></span>
							</strong>
						</h3>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
