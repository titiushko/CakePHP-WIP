<?php
$this->Paginator->options(array(
	'upadte' => '#contenedor-cocineros',
	'before' => $this->Js->get('#procesando')->effect('fadeIn', array('buffer' => false)),
	'complete' => $this->Js->get('#procesando')->effect('fadeOut', array('buffer' => false))
));
?>
<div id="contenedor-cocineros">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="well page-header"><i class="fa fa-users fa-fw"></i> Módulo de Cocineros</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					Listado de Cocineros
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-lg-12">
							<?= $this->Html->link(__('<i class="fa fa-user-plus"></i> Agregar Cocinero'), array('controller' => 'cocineros', 'action' => 'nuevo'), array('class' => 'btn btn-success', 'escape' => false)); ?>
						</div>
					</div>
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
						<div class="col-lg-12 table-responsive">
							<table class="table table-striped table-bordered table-hover">
								<thead>
									<tr>
										<th><?= $this->Paginator->sort('id', 'Identificador'); ?></th>
										<th><?= $this->Paginator->sort('nombres', 'Nombres'); ?></th>
										<th><?= $this->Paginator->sort('apellidos', 'Apellidos'); ?></th>
										<th><?= $this->Paginator->sort('created', 'Creado'); ?></th>
										<th class="actions">Acción</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($cocineros as $cocinero): ?>
									<tr>
										<td><?= $cocinero['Cocinero']['id']; ?></td>
										<td><?= h($cocinero['Cocinero']['nombres']); ?></td>
										<td><?= h($cocinero['Cocinero']['apellidos']); ?></td>
										<td><?= $this->Time->format('d/m/Y h:i A', $cocinero['Cocinero']['created']); ?></td>
										<td>
											<?= $this->Html->link(__('<i class="fa fa-file-text-o"></i> Ver'), array('controller' => 'cocineros', 'action' => 'ver', $cocinero['Cocinero']['id']), array('class' => 'btn btn-sm btn-default', 'escape' => false)); ?>
											<?= $this->Html->link(__('<i class="fa fa-pencil"></i> Editar'), array('controller' => 'cocineros', 'action' => 'editar', $cocinero['Cocinero']['id']), array('class' => 'btn btn-sm btn-default', 'escape' => false)); ?>
											<?= $this->Form->postLink(__('<i class="fa fa-trash"></i> Eliminar'), array('controller' => 'cocineros', 'action' => 'eliminar', $cocinero['Cocinero']['id']), array('class' => 'btn btn-sm btn-default', 'escape' => false, 'confirm' => __('¿Eliminar a %s %s?', $cocinero['Cocinero']['nombres'], $cocinero['Cocinero']['apellidos']))); ?>
										</td>
									</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<p><?= $this->Paginator->counter(array('format' => __('Página {:page} de {:pages}, mostrando {:current} registros de un total de {:count}, del {:start} al {:end}'))); ?></p>
			<ul class="pagination">
				<li><?= $this->Paginator->first(__('<< Primero'), array('tag' => false), null, array('class' => 'first disabled')); ?></li>
				<li><?= $this->Paginator->prev(__('< Anterior'), array('tag' => false), null, array('class' => 'prev disabled')); ?></li>
				<?= $this->Paginator->numbers(array('separator' => '', 'tag' => 'li', 'currentTag' => 'a', 'currentClass' => 'active', 'modulus' => 2)); ?>
				<li><?= $this->Paginator->next(__('Próximo >'), array('tag' => false), null, array('class' => 'next disabled')); ?></li>
				<li><?= $this->Paginator->last(__('​Último >>'), array('tag' => false), null, array('class' => 'last disabled')); ?></li>
			</ul>
		</div>
	</div>
	<?= $this->Js->writeBuffer(); ?>
</div>
