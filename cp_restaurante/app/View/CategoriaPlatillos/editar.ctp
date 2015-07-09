<?php
$formulario = array(
	'class' => 'form-horizontal',
	'inputDefaults' => array(
		'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
		'div' => array('class' => 'form-group'),
		'label' => array('class' => 'control-label'),
		'class' => 'form-control',
		'between' => '<div class="col-lg-9">',
		'after' => '</div>',
		'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-inline')),
	)
);
$control_label = 'col-lg-3 control-label';
$etiqueta = array('label' => array('class' => $control_label));
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
			<?= $this->Session->flash(); ?>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					Editar Categoría de Platillo
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-lg-4 col-lg-offset-4">
							<?= $this->Form->create('CategoriaPlatillo', $formulario); ?>
							<fieldset>
								<legend>Categoría</legend>
								<?= $this->Form->input('categoria', array('label' => array('text' => 'Nombre', 'class' => $control_label))); ?>
								<div class="form-group">
									<div class="col-lg-6 text-right submit">
										<?= $this->Form->button(__('<i class="fa fa-save"></i> Guardar'), array('type' => 'submit', 'class' => 'btn btn-primary', 'escape' => FALSE)); ?>
									</div>
									<div class="col-lg-6 text-left">
										<?= $this->Html->link(__('<i class="fa fa-times-circle"></i> Cancelar'), array('controller' => 'categoria_platillos', 'action' => 'ver', $categoria['id']), array('class' => 'btn btn-sm btn-default', 'escape' => FALSE)); ?>
									</div>
								</div>
							</fieldset>
							<?= $this->Form->end(); ?>
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
