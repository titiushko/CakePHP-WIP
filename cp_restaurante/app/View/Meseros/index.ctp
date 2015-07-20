<?php
$this->Paginator->options(array(
	'upadte' => '#contenedor-meseros',
	'before' => $this->Js->get('#procesando')->effect('fadeIn', array('buffer' => FALSE)),
	'complete' => $this->Js->get('#procesando')->effect('fadeOut', array('buffer' => FALSE))
));
?>
<div id="contenedor-meseros">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="well page-header"><i class="fa fa-user"></i> Módulo de Meseros</h1>
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
					Listado de Meseros
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-lg-12">
							<?= $this->Html->link(__('<i class="fa fa-user-plus"></i> Agregar Mesero'), array('controller' => 'meseros', 'action' => 'nuevo'), array('class' => 'btn btn-success', 'escape' => FALSE)); ?>
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
										<th><?= $this->Paginator->sort('nombres', 'Nombres'); ?></th>
										<th><?= $this->Paginator->sort('apellidos', 'Apellidos'); ?></th>
										<th><?= $this->Paginator->sort('created', 'Creado'); ?></th>
										<th><?= $this->Paginator->sort('modified', 'Modificado'); ?></th>
										<th class="actions">Acción</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($meseros as $mesero): ?>
									<tr>
										<td><?= h($mesero['Mesero']['nombres']); ?></td>
										<td><?= h($mesero['Mesero']['apellidos']); ?></td>
										<td><?= $this->Time->format('d/m/Y h:i A', $mesero['Mesero']['created']); ?></td>
										<td><?= $this->Time->format('d/m/Y h:i A', $mesero['Mesero']['modified']); ?></td>
										<td>
											<?= $this->Html->link(__('<i class="fa fa-file-text-o"></i>'), array('controller' => 'meseros', 'action' => 'ver', $mesero['Mesero']['id']), array('class' => 'btn btn-sm btn-default', 'escape' => FALSE, 'title' => 'Ver')); ?>
											<?= $this->Html->link(__('<i class="fa fa-pencil"></i>'), array('controller' => 'meseros', 'action' => 'editar', $mesero['Mesero']['id']), array('class' => 'btn btn-sm btn-default', 'escape' => FALSE, 'title' => 'Editar')); ?>
											<?= $this->Form->postLink(__('<i class="fa fa-trash"></i>'), array('controller' => 'meseros', 'action' => 'eliminar', $mesero['Mesero']['id']), array('class' => 'btn btn-sm btn-default', 'escape' => FALSE, 'title' => 'Eliminar', 'confirm' => __('¿Eliminar a %s?', $mesero['Mesero']['nombre_completo']))); ?>
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
								<?= $this->Paginator->numbers(array('separator' => '', 'tag' => 'li', 'currentTag' => 'a', 'currentClass' => 'active', 'modulus' => 2)); ?>
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
