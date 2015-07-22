<?php
$this->Paginator->options(array(
	'upadte' => '#contenedor-'.$alias_plural,
	'before' => $this->Js->get('#procesando')->effect('fadeIn', array('buffer' => FALSE)),
	'complete' => $this->Js->get('#procesando')->effect('fadeOut', array('buffer' => FALSE))
));
?>
<div id="contenedor-<?= $alias_plural; ?>">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="well page-header"><i class="fa fa-<?= $icono; ?>"></i> Módulo de <?= ucwords(str_replace('_', ' ', $alias_plural)); ?></h1>
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
					Listado de <?= ucwords(str_replace('_', ' ', $alias_plural)); ?>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-lg-12">
							<?= $this->Html->link(__('<i class="fa fa-plus-square"></i> Agregar %s', ucwords(str_replace('_', ' ', $alias_singular))), array('controller' => $alias_plural, 'action' => 'nuevo'), array('class' => 'btn btn-success', 'escape' => FALSE)); ?>
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
										<?php
										foreach ($campos as $campo)
											echo '<th>'.$this->Paginator->sort($campo, ucwords(str_replace(array('_id', '_'), array('', ' '), $this->Funciones->extraer($campo, '.')))).'</th>';
										?>
										<th class="actions">Acción</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($lista_valores as $valor): ?>
									<tr>
										<?php foreach ($campos as $campo) echo '<td>'.$valor[$campo].'</td>'; ?>
										<td>
											<?= $this->Html->link(__('<i class="fa fa-file-text-o"></i>'), array('controller' => $alias_plural, 'action' => 'ver', $valor['id']), array('class' => 'btn btn-sm btn-default', 'escape' => FALSE, 'title' => 'Ver')); ?>
											<?= $this->Html->link(__('<i class="fa fa-pencil"></i>'), array('controller' => $alias_plural, 'action' => 'editar', $valor['id']), array('class' => 'btn btn-sm btn-default', 'escape' => FALSE, 'title' => 'Editar')); ?>
											<?= $this->Form->postLink(__('<i class="fa fa-trash"></i>'), array('controller' => $alias_plural, 'action' => 'eliminar', $valor['id']), array('class' => 'btn btn-sm btn-default', 'escape' => FALSE, 'title' => 'Eliminar', 'confirm' => __('¿Eliminar %s %s?', $alias_singular, $valor['elemento_eliminar']))); ?>
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
