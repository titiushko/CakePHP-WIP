<?php
$this->Paginator->options(array(
	'upadte' => '#contenedor-ordenes',
	'before' => $this->Js->get('#procesando')->effect('fadeIn', array('buffer' => FALSE)),
	'complete' => $this->Js->get('#procesando')->effect('fadeOut', array('buffer' => FALSE))
));
?>
<div id="contenedor-ordenes">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="well page-header"><i class="fa fa-coffee"></i> Módulo de Ordenes</h1>
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
					Listado de Ordenes
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
										<th><?= $this->Paginator->sort('mesero_id', 'Mesero'); ?></th>
										<th><?= $this->Paginator->sort('mesa_id', 'Mesa'); ?></th>
										<th><?= $this->Paginator->sort('cliente', 'Cliente'); ?></th>
										<th><?= $this->Paginator->sort('dui', 'DUI'); ?></th>
										<th><?= $this->Paginator->sort('total', 'Total'); ?></th>
										<th><?= $this->Paginator->sort('created', 'Creado'); ?></th>
										<th><?= $this->Paginator->sort('modified', 'Modificado'); ?></th>
										<th>Acción</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($ordenes as $orden): ?>
									<tr>
										<td><?= $orden['Mesero']['nombre_completo']; ?></td>
										<td><?= $orden['Mesa']['serie']; ?></td>
										<td><?= $orden['Orden']['cliente']; ?></td>
										<td><?= $orden['Orden']['dui']; ?></td>
										<td>$ <?= number_format($orden['Orden']['total'], 2, '.', ','); ?></td>
										<td><?= $this->Time->format('d/m/Y h:i A', $orden['Orden']['created']); ?></td>
										<td><?= $this->Time->format('d/m/Y h:i A', $orden['Orden']['modified']); ?></td>
										<td>
											<?= $this->Html->link(__('<i class="fa fa-file-text-o"></i>'), array('controller' => 'platillos_ordenes', 'action' => 'ver', $orden['Orden']['id']), array('class' => 'btn btn-sm btn-default', 'escape' => FALSE, 'title' => 'Ver')); ?>
										</td>
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
				</div>
			</div>
		</div>
	</div>
</div>
<?= $this->Js->writeBuffer(); ?>
