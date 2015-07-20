<?php
$this->Paginator->options(array(
	'upadte' => '#contenedor-usuarios',
	'before' => $this->Js->get('#procesando')->effect('fadeIn', array('buffer' => FALSE)),
	'complete' => $this->Js->get('#procesando')->effect('fadeOut', array('buffer' => FALSE))
));
?>
<div id="contenedor-usuarios">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="well page-header"><i class="fa fa-users"></i> Módulo de Usuarios</h1>
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
					Listado de Usuarios
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-lg-12">
							<?= $this->Html->link(__('<i class="fa fa-user-plus"></i> Agregar Usuario'), array('controller' => 'usuarios', 'action' => 'nuevo'), array('class' => 'btn btn-success', 'escape' => FALSE)); ?>
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
										<th><?= $this->Paginator->sort('nombre_completo', 'Nombre Completo'); ?></th>
										<th><?= $this->Paginator->sort('usuario', 'Nombre Usuario'); ?></th>
										<th><?= $this->Paginator->sort('rol', 'Rol'); ?></th>
										<th><?= $this->Paginator->sort('created', 'Creado'); ?></th>
										<th><?= $this->Paginator->sort('modified', 'Modificado'); ?></th>
										<th class="actions">Acción</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($usuarios as $usuario): ?>
									<tr>
										<td><?= h($usuario['Usuario']['nombre_completo']); ?></td>
										<td><?= h($usuario['Usuario']['usuario']); ?></td>
										<td><?= h($this->Funciones->rol($usuario['Usuario']['rol'])); ?></td>
										<td><?= $this->Time->format('d/m/Y h:i A', $usuario['Usuario']['created']); ?></td>
										<td><?= $this->Time->format('d/m/Y h:i A', $usuario['Usuario']['modified']); ?></td>
										<td>
											<?= $this->Html->link(__('<i class="fa fa-file-text-o"></i>'), array('controller' => 'usuarios', 'action' => 'ver', $usuario['Usuario']['id']), array('class' => 'btn btn-sm btn-default', 'escape' => FALSE, 'title' => 'Ver')); ?>
											<?= $this->Html->link(__('<i class="fa fa-pencil"></i>'), array('controller' => 'usuarios', 'action' => 'editar', $usuario['Usuario']['id']), array('class' => 'btn btn-sm btn-default', 'escape' => FALSE, 'title' => 'Editar')); ?>
											<?= $this->Form->postLink(__('<i class="fa fa-trash"></i>'), array('controller' => 'usuarios', 'action' => 'eliminar', $usuario['Usuario']['id']), array('class' => 'btn btn-sm btn-default', 'escape' => FALSE, 'title' => 'Eliminar', 'confirm' => __('¿Eliminar a %s?', $usuario['Usuario']['usuario']))); ?>
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
