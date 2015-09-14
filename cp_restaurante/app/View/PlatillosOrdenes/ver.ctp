<?php
$this->Paginator->options(array(
	'upadte' => '#contenedor-pedidos',
	'before' => $this->Js->get('#procesando')->effect('fadeIn', array('buffer' => FALSE)),
	'complete' => $this->Js->get('#procesando')->effect('fadeOut', array('buffer' => FALSE))
));
?>
<div id="contenedor-pedidos">
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
					Listado de Pedidos
				</div>
				<div class="panel-body">
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
						<div class="col-lg-12 table-responsive">
							<table class="table table-striped table-bordered table-hover">
								<thead>
									<tr>
										<th><?= $this->Paginator->sort('platillo_id', 'Platillo'); ?></th>
										<th><?= $this->Paginator->sort('cantidad', 'Cantidad'); ?></th>
										<th><?= $this->Paginator->sort('subtotal', 'SubTotal'); ?></th>
										<th><?= $this->Paginator->sort('created', 'Creado'); ?></th>
										<th><?= $this->Paginator->sort('modified', 'Modificado'); ?></th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($platillos_ordenes as $platillo): ?>
									<tr>
										<td><?= $platillo['Platillo']['nombre']; ?></td>
										<td><?= number_format($platillo['PlatillosOrden']['cantidad'], 0, '', ','); ?></td>
										<td>$ <?= number_format($platillo['PlatillosOrden']['subtotal'], 2, '.', ','); ?></td>
										<td><?= $this->Time->format('d/m/Y h:i A', $platillo['PlatillosOrden']['created']); ?></td>
										<td><?= $this->Time->format('d/m/Y h:i A', $platillo['PlatillosOrden']['modified']); ?></td>
									</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<p><?= $this->Paginator->counter(array('format' => __('Página {:page} de {:pages}, mostrando {:current} registros de un total de {:count}, del {:start} al {:end}'))); ?></p>
							<ul class="pagination">
								<li><?= $this->Paginator->first(__('<< Primero'), array('tag' => FALSE), null, array('class' => 'first disabled')); ?></li>
								<li><?= $this->Paginator->prev(__('< Anterior'), array('tag' => FALSE), null, array('class' => 'prev disabled')); ?></li>
								<?= $this->Paginator->numbers(array('separator' => '', 'tag' => 'li', 'currentTag' => 'a', 'currentClass' => 'active', 'modulus' => 4)); ?>
								<li><?= $this->Paginator->next(__('Siguiente >'), array('tag' => FALSE), null, array('class' => 'next disabled')); ?></li>
								<li><?= $this->Paginator->last(__('Último >>'), array('tag' => FALSE), null, array('class' => 'last disabled')); ?></li>
							</ul>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<?= $this->Html->link(__('<i class="fa fa-arrow-left"></i> Regresar'), array('controller' => 'ordenes', 'action' => 'index'), array('class' => 'btn btn-default', 'escape' => FALSE)); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?= $this->Js->writeBuffer(); ?>
