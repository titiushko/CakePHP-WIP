<?php
$formulario = array(
	'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
	'div' => array('class' => 'form-group'),
	'label' => array('class' => 'col-lg-3 control-label'),
	'autocomplete' => 'off',
	'disabled' => TRUE,
	'class' => 'form-control',
	'between' => '<div class="col-lg-9">',
	'after' => '</div>',
	'error' => array('attributes' => array('wrap' => 'span', 'class' => 'error-message'))
);
?>
<div class="row">
	<div class="col-lg-12">
		<h1 class="well page-header"><i class="fa fa-archive"></i> Módulo de Ordenes</h1>
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
				Orden
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-lg-4 col-lg-offset-4">
						<div class="form-horizontal">
						<fieldset>
							<legend>Orden Cliente</legend>
							<?= $this->Form->input('nombres', array_merge($formulario, array('value' => $orden['Persona']['nombres']))); ?>
							<?= $this->Form->input('apellidos', array_merge($formulario, array('value' => $orden['Persona']['apellidos']))); ?>
							<?= $this->Form->input('dui', array_merge($formulario, array('value' => $orden['Persona']['dui'], 'label' => array('text' => 'DUI', 'class' => 'col-lg-3 control-label')))); ?>
							<?= $this->Funciones->campo_enlace('mesero', $this->Html->link($orden['Persona']['nombre_completo'], array('controller' => 'empleados', 'action' => 'ver', $orden['Persona']['id']))); ?>
							<?= $this->Funciones->campo_enlace('mesa', $this->Html->link($orden['Mesa']['serie'], array('controller' => 'empleados', 'action' => 'ver', $orden['Mesa']['id']))); ?>
							<div class="form-group">
								<div class="col-lg-12 text-center">
									<div class="btn-group">
										<?= $this->Form->button(__('<i class="fa fa-files-o"></i> Generar Reporte <span class="caret"></span>'), array('type' => 'button', 'class' => 'btn btn-primary dropdown-toggle', 'data-toggle' => 'dropdown', 'escape' => FALSE)); ?>
										<ul class="dropdown-menu" role="menu">
											<li><?= $this->Html->link(__('<i class="fa fa-print"></i> Imprimir'), array('controller' => 'ordenes', 'action' => 'imprimir', $orden['Orden']['id']), array('class' => 'btn btn-warning', 'target' => '_blank', 'escape' => FALSE)); ?></li>
											<li><?= $this->Html->link(__('<i class="fa fa-file-excel-o"></i> Excel'), array('controller' => 'ordenes', 'action' => 'excel', $orden['Orden']['id']), array('class' => 'btn btn-success', 'target' => '_blank', 'escape' => FALSE)); ?></li>
											<li><?= $this->Html->link(__('<i class="fa fa-file-pdf-o"></i> PDF'), array('controller' => 'ordenes', 'action' => 'pdf', $orden['Orden']['id']), array('class' => 'btn btn-danger', 'target' => '_blank', 'escape' => FALSE)); ?></li>
										</ul>
									</div>
									<?= $this->Html->link(__('<i class="fa fa-times-circle"></i> Cancelar'), array('controller' => 'ordenes', 'action' => 'index'), array('class' => 'btn btn-default', 'escape' => FALSE)); ?>
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
									<?php
									$platillo = 0;
									foreach ($orden['PlatillosOrden'] as $platillos_orden):
									?>
									<tr>
										<td><?= $platillos[$platillo]['Platillo']['nombre']; ?></td>
										<td>$ <?= number_format($platillos[$platillo]['Platillo']['precio'], 2, '.', ','); ?></td>
										<td><?= number_format($platillos_orden['cantidad'], 0, '', ','); ?></td>
										<td>$ <?= number_format($platillos_orden['subtotal'], 2, '.', ','); ?></td>
									</tr>
									<?php
									$platillo++;
									endforeach;
									?>
								</tbody>
								<tfoot>
									<tr>
										<th colspan="3" class="text-right">Total Orden</th>
										<th>$ <?= number_format($orden['Orden']['total'], 2, '.', ','); ?></th>
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
