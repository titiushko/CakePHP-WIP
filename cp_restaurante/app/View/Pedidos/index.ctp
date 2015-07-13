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
						<div class="row">
							<div class="col-md-7"><strong>Platillo</strong></div>
							<div class="col-md-1"><strong>Foto</strong></div>
							<div class="col-md-1"><strong>Precio</strong></div>
							<div class="col-md-1"><strong>Cantidad</strong></div>
							<div class="col-md-1"><strong>SubTotal</strong></div>
							<div class="col-md-1">&nbsp;</div>
						</div>
						<?php
						$indice_tabulador = 1;
						foreach ($pedidos as $platillo):
						?>
						<div class="row margen-superior" id="pedido-<?= $platillo['Pedido']['id']; ?>">
							<div class="col-md-7"><?= $this->Html->link(__('%s', $platillo['Platillo']['nombre']), array('controller' => 'platillos', 'action' => 'ver', $platillo['Platillo']['id'])); ?></div>
							<?php if (empty($platillo['Platillo']['foto'])) { ?>
							<div class="col-md-1"><figure><?= $this->Html->image('../img/plato_vacio/thumb_plato_vacio.jpg', array('class' => 'imagen-pedidos')); ?></figure></div>
							<?php } else { ?>
							<div class="col-md-1"><figure><?= $this->Html->image('../files/platillo/foto/'.$platillo['Platillo']['foto_dir'].'/'.'thumb_'.$platillo['Platillo']['foto'], array('class' => 'imagen-pedidos')); ?></figure></div>
							<?php } ?>
							<div class="col-md-1" id="precio-<?= $platillo['Pedido']['id']; ?>">$ <?= number_format($platillo['Platillo']['precio'], 2, '.', ','); ?></div>
							<div class="col-md-1"><?= $this->Form->input($platillo['Pedido']['id'], array('value' => $platillo['Pedido']['cantidad'], 'label' => FALSE, 'div' => FALSE, 'class' => 'cantidad form-control input-small', 'type' => 'number', 'size' => 2, 'minlenght' => 1, 'maxlenght' => 2, 'indice-tabulador' => $indice_tabulador++, 'cantidad-id' => $platillo['Pedido']['id'])); ?></div>
							<div class="col-md-1" id="subtotal-<?= $platillo['Pedido']['id']; ?>">$ <?= number_format($platillo['Pedido']['subtotal'], 2, '.', ','); ?></div>
							<div class="col-md-1">
								<?= $this->Html->link(__('<i class="fa fa-trash"></i>'), '#', array('class' => 'btn btn-default eliminar', 'escape' => FALSE, 'title' => __('¿Eliminar pedido de %s?', $platillo['Platillo']['nombre']), 'escapeTitle' => FALSE, 'id' => $platillo['Pedido']['id'])); ?>
							</div>
						</div>
						<?php
						endforeach;
						}
						?>
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
	</div>
</div>
