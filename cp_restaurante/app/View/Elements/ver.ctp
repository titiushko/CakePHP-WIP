<?php
$formulario = array(
	'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
	'div' => array('class' => 'form-group'),
	'label' => array('class' => 'col-lg-3 control-label'),
	'autocomplete' => 'off',
	'class' => 'form-control',
	'between' => '<div class="col-lg-9">',
	'after' => '</div>',
	'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-inline'))
);
$modelo_palabras = explode('_', $alias_singular);
$modelo = ''; foreach ($modelo_palabras as $modelo_palabra) $modelo .= ucwords($modelo_palabra);
?>
<div class="row">
	<div class="col-lg-12">
		<h1 class="well page-header"><i class="fa fa-user"></i> Módulo de <?= ucwords($alias_plural); ?></h1>
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
				Ver <?= ucwords($alias_singular); ?>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-lg-4 col-lg-offset-4">
						<div class="form-horizontal">
						<fieldset>
							<legend>Datos Principales</legend>
							<?php foreach ($campos as $nombre => $opciones) echo $this->Form->input($nombre, array_merge($formulario, $opciones)); ?>
							<div class="form-group">
								<div class="col-lg-12 text-center">
									<?= $this->Html->link(__('<i class="fa fa-pencil"></i> Editar'), array('controller' => $alias_plural, 'action' => 'editar', $id), array('class' => 'btn btn-primary', 'escape' => FALSE)); ?>
									<?= $this->Form->postLink(__('<i class="fa fa-trash"></i> Eliminar'), array('controller' => $alias_plural, 'action' => 'eliminar', $id), array('class' => 'btn btn-danger', 'escape' => FALSE, 'confirm' => __('¿Eliminar %s %s?', $alias_singular, $elemento_eliminar))); ?>
									<?= $this->Html->link(__('<i class="fa fa-times-circle"></i> Cancelar'), array('controller' => $alias_plural, 'action' => 'index'), array('class' => 'btn btn-default', 'escape' => FALSE)); ?>
								</div>
							</div>
						</fieldset>
						</div>
					</div>
				</div>
				<?php if (isset($asociacion_singular) && isset($asociacion_plural)): ?>
				<div class="row"><div class="col-lg-12">&nbsp;</div></div>
				<div class="row">
					<div class="col-lg-12 table-responsive">
						<fieldset>
							<legend><?= ucwords(str_replace('_', ' ', $asociacion_plural)); ?></legend>
							<?php if (empty($lista_asociacion)) { ?>
								<p>No tiene <?= str_replace('_', ' ', $asociacion_plural); ?>.</p>
							<?php } else { ?>
							<table class="table table-striped table-bordered table-hover">
								<thead>
									<tr>
										<?php
										foreach ($campos_asociacion as $campo)
											echo '<th>'.ucwords(str_replace(array('_id', '_'), array('', ' '), $this->Funciones->extraer($campo, '.'))).'</th>';
										?>
										<th>Acción</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($lista_asociacion as $valor): ?>
									<tr>
										<?php foreach ($campos_asociacion as $campo) echo '<td>'.$valor[$campo].'</td>'; ?>
										<td>
											<?= $this->Html->link(__('<i class="fa fa-file-text-o"></i>'), array('controller' => $asociacion_plural, 'action' => 'ver', $valor['id']), array('class' => 'btn btn-sm btn-default', 'escape' => FALSE, 'title' => 'Ver')); ?>
											<?= $this->Html->link(__('<i class="fa fa-pencil"></i>'), array('controller' => $asociacion_plural, 'action' => 'editar', $valor['id']), array('class' => 'btn btn-sm btn-default', 'escape' => FALSE, 'title' => 'Editar')); ?>
											<?= $this->Form->postLink(__('<i class="fa fa-trash"></i>'), array('controller' => $asociacion_plural, 'action' => 'eliminar', $valor['id']), array('class' => 'btn btn-sm btn-default', 'escape' => FALSE, 'title' => 'Eliminar', 'confirm' => __('¿Eliminar %$ %s?', $asociacion_singular, $valor['elemento_eliminar']))); ?>
										</td>
									</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
							<?php } ?>
						</fieldset>
					</div>
				</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>
