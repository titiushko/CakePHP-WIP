<?php
$this->Paginator->options(array(
	'upadte' => '#contenedor-categoria_platillos',
	'before' => $this->Js->get('#procesando')->effect('fadeIn', array('buffer' => FALSE)),
	'complete' => $this->Js->get('#procesando')->effect('fadeOut', array('buffer' => FALSE))
));
?>
<div id="contenedor-categoria_platillos">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="well page-header"><i class="fa fa-random"></i> Módulo de Categoría de Platillos</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					Listado de Categoría de Platillos
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-lg-12">
							<?= $this->Html->link(__('<i class="fa fa-plus"></i> Agregar Categoría de Platillo'), array('controller' => 'categoriaplatillos', 'action' => 'nuevo'), array('class' => 'btn btn-success', 'escape' => FALSE)); ?>
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
										<th><?= $this->Paginator->sort('categoria', 'Categoría'); ?></th>
										<th class="actions">Acción</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($categoria_platillos as $categoria_platillo): ?>
									<tr>
										<td><?= $categoria_platillo['CategoriaPlatillo']['id']; ?></td>
										<td><?= h($categoria_platillo['CategoriaPlatillo']['categoria']); ?></td>
										<td>
											<?= $this->Html->link(__('<i class="fa fa-file-text-o"></i> Ver'), array('controller' => 'categoriaplatillos', 'action' => 'ver', $categoria_platillo['CategoriaPlatillo']['id']), array('class' => 'btn btn-sm btn-default', 'escape' => FALSE)); ?>
											<?= $this->Html->link(__('<i class="fa fa-pencil"></i> Editar'), array('controller' => 'categoriaplatillos', 'action' => 'editar', $categoria_platillo['CategoriaPlatillo']['id']), array('class' => 'btn btn-sm btn-default', 'escape' => FALSE)); ?>
											<?= $this->Form->postLink(__('<i class="fa fa-trash"></i> Eliminar'), array('controller' => 'categoriaplatillos', 'action' => 'eliminar', $categoria_platillo['CategoriaPlatillo']['id']), array('class' => 'btn btn-sm btn-default', 'escape' => FALSE, 'confirm' => __('¿Eliminar a %s?', $categoria_platillo['CategoriaPlatillo']['categoria']))); ?>
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