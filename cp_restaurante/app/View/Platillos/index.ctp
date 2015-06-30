<?php
$this->Paginator->options(array(
	'upadte' => '#contenedor-platillos',
	'before' => $this->Js->get('#procesando')->effect('fadeIn', array('buffer' => FALSE)),
	'complete' => $this->Js->get('#procesando')->effect('fadeOut', array('buffer' => FALSE))
));
?>
<div id="contenedor-platillos">
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
					Listado de Platillos
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-lg-12">
							<?= $this->Html->link(__('<i class="fa fa-plus-square"></i> Agregar Platillo'), array('controller' => 'platillos', 'action' => 'nuevo'), array('class' => 'btn btn-success', 'escape' => FALSE)); ?>
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
						<div class="col-lg-12">
							<table class="table table-striped table-bordered table-hover">
								<thead>
									<tr>
										<th><?= $this->Paginator->sort('nombre', 'Nombre'); ?></th>
										<th><?= $this->Paginator->sort('precio', 'Precio'); ?></th>
										<th><?= $this->Paginator->sort('foto', 'Foto'); ?></th>
										<th><?= $this->Paginator->sort('created', 'Creado'); ?></th>
										<th><?= $this->Paginator->sort('modified', 'Modificado'); ?></th>
										<th><?= $this->Paginator->sort('CategoriaPlatillo.categoria', 'Categoría'); ?></th>
										<th>Acción</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($platillos as $platillo): ?>
									<tr>
										<td><?= $platillo['Platillo']['nombre']; ?></td>
										<td><?= $platillo['Platillo']['precio']; ?></td>
										<?php if (empty($platillo['Platillo']['foto'])) { ?>
										<td><?= $this->Html->image('../img/plato_vacio/thumb_plato_vacio.jpg'); ?></td>
										<?php } else { ?>
										<td><?= $this->Html->image('../files/platillo/foto/'.$platillo['Platillo']['foto_dir'].'/'.'thumb_'.$platillo['Platillo']['foto']); ?></td>
										<?php } ?>
										<td><?= $this->Time->format('d/m/Y h:i A', $platillo['Platillo']['created']); ?></td>
										<td><?= $this->Time->format('d/m/Y h:i A', $platillo['Platillo']['modified']); ?></td>
										<td><?= $this->Html->link($platillo['CategoriaPlatillo']['categoria'], array('controller' => 'categoria_platillos', 'action' => 'ver', $platillo['CategoriaPlatillo']['id'])) ?></td>
										<td>
											<?= $this->Html->link(__('<i class="fa fa-file-text-o"></i> Ver'), array('controller' => 'platillos', 'action' => 'ver', $platillo['Platillo']['id']), array('class' => 'btn btn-sm btn-default', 'escape' => FALSE)); ?>
											<?= $this->Html->link(__('<i class="fa fa-pencil"></i> Editar'), array('controller' => 'platillos', 'action' => 'editar', $platillo['Platillo']['id']), array('class' => 'btn btn-sm btn-default', 'escape' => FALSE)); ?>
											<?= $this->Form->postLink(__('<i class="fa fa-trash"></i> Eliminar'), array('controller' => 'platillos', 'action' => 'eliminar', $platillo['Platillo']['id']), array('class' => 'btn btn-sm btn-default', 'escape' => FALSE, 'confirm' => __('¿Eliminar platillo %s?', $platillo['Platillo']['nombre']))); ?>
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
								<li><?= $this->Paginator->last(__('​Último >>'), array('tag' => FALSE), null, array('class' => 'last disabled')); ?></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?= $this->Js->writeBuffer(); ?>
