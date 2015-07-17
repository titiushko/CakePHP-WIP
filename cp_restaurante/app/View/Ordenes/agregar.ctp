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
$control_label = 'col-lg-3 control-label';
$etiqueta = array('label' => array('class' => $control_label));
?>
<div class="row">
	<div class="col-lg-12">
		<h1 class="well page-header"><i class="fa fa-cutlery"></i> Módulo de Ordenes</h1>
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
				Procesar Orden
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-lg-4 col-lg-offset-4">
						<?= $this->Form->create('Orden', $formulario); ?>
						<fieldset>
							<legend>Orden</legend>
							<?= $this->Form->input('cliente', $etiqueta); ?>
							<?= $this->Form->input('dui', $etiqueta); ?>
							<?= $this->Form->input('mesa_id', $etiqueta); ?>
							<?= $this->Form->input('total', array('type' => 'hidden', 'value' => $total_orden)); ?>
							<div class="form-group">
								<div class="col-lg-12 text-center">
									<span class="submit"><?= $this->Form->button(__('<i class="fa fa-money"></i> Procesar Orden'), array('type' => 'submit', 'class' => 'btn btn-primary', 'escape' => FALSE)); ?></span>
									<?= $this->Html->link(__('<i class="fa fa-times-circle"></i> Cancelar'), array('controller' => 'pedidos', 'action' => 'index'), array('class' => 'btn btn-default', 'escape' => FALSE)); ?>
								</div>
							</div>
						</fieldset>
						<?= $this->Form->end(); ?>
					</div>
				</div>
				<div class="row"><div class="col-lg-12">&nbsp;</div></div>
				<div class="row">
					<div class="col-lg-12 table-responsive">
						<fieldset>
							<legend>Pedidos</legend>
							<table class="table table-striped table-bordered table-hover">
								<thead>
									<tr>
										<th>Platillo</th>
										<th>Precio</th>
										<th>Cantidad</th>
										<th>SubTotal</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($pedidos as $platillo): ?>
									<tr>
										<td><?= $platillo['Platillo']['nombre']; ?></td>
										<td>$ <?= number_format($platillo['Platillo']['precio'], 2, '.', ','); ?></td>
										<td><?= number_format($platillo['Pedido']['cantidad'], 0, '', ','); ?></td>
										<td>$ <?= number_format($platillo['Pedido']['subtotal'], 2, '.', ','); ?></td>
									</tr>
									<?php endforeach; ?>
								</tbody>
								<tfoot>
									<tr>
										<th colspan="3" class="text-right">Total Orden</th>
										<th>$ <?= number_format($total_orden, 2, '.', ','); ?></th>
									</tr>
								</tfoot>
							</table>
						</fieldset>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>