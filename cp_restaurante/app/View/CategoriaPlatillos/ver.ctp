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
			<h1 class="well page-header"><i class="fa fa-random"></i> Módulo de Categoría de Platillos</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					Ver Categoría de Platillo
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-lg-4 col-lg-offset-4">
							<div class="form-horizontal">
							<fieldset>
								<legend>Categoría</legend>
								<div class="form-group">
									<?= $this->Form->label('nombre', 'Nombre', array('class' => 'col-lg-3 control-label')); ?>
									<div class="col-lg-9">
										<?= $this->Form->input('categoria', array('label' => FALSE, 'value' => $categoria['nombre'], 'disabled' => TRUE, 'class' => 'form-control', 'div' => FALSE)); ?>
									</div>
								</div>
								<div class="form-group">
									<div class="col-lg-4 text-right">
										<?= $this->Html->link(__('<i class="fa fa-pencil"></i> Editar'), array('controller' => 'categoria_platillos', 'action' => 'editar', $categoria['id']), array('class' => 'btn btn-primary', 'escape' => FALSE)); ?>
									</div>
									<div class="col-lg-4 text-center">
										<?= $this->Form->postLink(__('<i class="fa fa-trash"></i> Eliminar'), array('controller' => 'categoria_platillos', 'action' => 'eliminar', $categoria['id']), array('class' => 'btn btn-danger', 'escape' => FALSE, 'confirm' => __('¿Eliminar a %s?', $categoria['nombre']))); ?>
									</div>
									<div class="col-lg-4 text-left">
										<?= $this->Html->link(__('<i class="fa fa-times-circle"></i> Cancelar'), array('controller' => 'categoria_platillos', 'action' => 'index'), array('class' => 'btn btn-sm btn-default', 'escape' => FALSE)); ?>
									</div>
								</div>
							</fieldset>
							</div>
						</div>
					</div>
					<div class="row"><div class="col-lg-12">&nbsp;</div></div>
					<div class="row">
						<div class="col-lg-12">
							<fieldset>
								<legend>Platillos Asociados</legend>
								<?php if (empty($platillos)) { ?>
									<p>No tiene platillos asociados.</p>
								<?php } else { ?>
								<table class="table table-striped table-bordered table-hover">
									<thead>
										<tr>
											<th>Nombre</th>
											<th>Foto</th>
											<th>Precio</th>
											<th>Acción</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($platillos as $platillo): ?>
										<tr>
											<td><?= $platillo['Platillo']['nombre']; ?></td>
											<?php if (empty($platillo['Platillo']['foto'])) { ?>
											<td><?= $this->Html->image('../img/plato_vacio/thumb_plato_vacio.jpg'); ?></td>
											<?php } else { ?>
											<td><?= $this->Html->image('../files/platillo/foto/'.$platillo['Platillo']['foto_dir'].'/'.'thumb_'.$platillo['Platillo']['foto']); ?></td>
											<?php } ?>
											<td>$ <?= number_format($platillo['Platillo']['precio'], 2, '.', ','); ?></td>
											<td>
												<?= $this->Html->link(__('<i class="fa fa-file-text-o"></i> Ver'), array('controller' => 'platillos', 'action' => 'ver', $platillo['Platillo']['id']), array('class' => 'btn btn-sm btn-default', 'escape' => FALSE)); ?>
												<?= $this->Html->link(__('<i class="fa fa-pencil"></i> Editar'), array('controller' => 'platillos', 'action' => 'editar', $platillo['Platillo']['id']), array('class' => 'btn btn-sm btn-default', 'escape' => FALSE)); ?>
												<?= $this->Form->postLink(__('<i class="fa fa-trash"></i> Eliminar'), array('controller' => 'platillos', 'action' => 'eliminar', $platillo['Platillo']['id']), array('class' => 'btn btn-sm btn-default', 'escape' => FALSE, 'confirm' => __('¿Eliminar platillo %s?', $platillo['Platillo']['nombre']))); ?>
											</td>
										</tr>
										<?php endforeach; ?>
									</tbody>
								</table>
								<?php } ?>
							</fieldset>
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
