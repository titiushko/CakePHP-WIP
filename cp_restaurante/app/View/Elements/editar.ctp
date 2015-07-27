<?php
$formulario = array(
	'class' => 'form-horizontal',
	'inputDefaults' => array(
		'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
		'div' => array('class' => 'form-group'),
		'label' => array('class' => 'col-lg-3 control-label'),
		'autocomplete' => 'off',
		'class' => 'form-control',
		'between' => '<div class="col-lg-9">',
		'after' => '</div>',
		'error' => array('attributes' => array('wrap' => 'span', 'class' => 'error-message')),
	)
);
if (!isset($controlador)) {
	$controlador = $alias_plural;
}
if (!isset($modelo)) {
	$modelo_palabras = explode('_', $alias_singular);
	$modelo = ''; foreach ($modelo_palabras as $modelo_palabra) $modelo .= ucwords($modelo_palabra);
}
?>
<div class="row">
	<div class="col-lg-12">
		<h1 class="well page-header"><?= $this->Funciones->icono_modulo($alias_plural); ?> Módulo de <?= ucwords(str_replace('_', ' ', $alias_plural)); ?></h1>
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
				Editar <?= ucwords(str_replace('_', ' ', $alias_singular)); ?>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-lg-4 col-lg-offset-4">
						<?= $this->Form->create($modelo, $formulario); ?>
						<fieldset>
							<legend>Datos Principales</legend>
							<?php foreach ($campos as $nombre => $opciones) echo $this->Form->input($nombre, $opciones); ?>
							<div class="form-group">
								<div class="col-lg-12 text-center">
									<span class="submit"><?= $this->Form->button(__('<i class="fa fa-save"></i> Guardar'), array('type' => 'submit', 'class' => 'btn btn-primary', 'escape' => FALSE)); ?></span>
									<?= $this->Html->link(__('<i class="fa fa-times-circle"></i> Cancelar'), array('controller' => $controlador, 'action' => 'ver', $id), array('class' => 'btn btn-default', 'escape' => FALSE)); ?>
								</div>
							</div>
						</fieldset>
						<?= $this->Form->end(); ?>
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
											<?php if($usuario_actual['rol'] == 'admin'): ?>
											<?= $this->Form->postLink(__('<i class="fa fa-trash"></i>'), array('controller' => $asociacion_plural, 'action' => 'eliminar', $valor['id']), array('class' => 'btn btn-sm btn-default', 'escape' => FALSE, 'title' => 'Eliminar', 'confirm' => __('¿Eliminar %$ %s?', $asociacion_singular, $valor['elemento_eliminar']))); ?>
											<?php endif; ?>
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
				<?php if (isset($singular) && isset($plural)): ?>
				<div class="row"><div class="col-lg-12">&nbsp;</div></div>
				<div class="row">
					<div class="col-lg-12 table-responsive">
						<fieldset>
							<legend><?= ucwords(str_replace('_', ' ', $plural)); ?></legend>
							<?php if (empty($lista)) { ?>
								<p>No tiene <?= str_replace('_', ' ', $plural); ?>.</p>
							<?php } else { ?>
							<table class="table table-striped table-bordered table-hover">
								<thead>
									<tr>
										<?php
										foreach ($titulos as $campo)
											echo '<th>'.ucwords(str_replace(array('_id', '_'), array('', ' '), $this->Funciones->extraer($campo, '.'))).'</th>';
										?>
										<th>Acción</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($lista as $valor): ?>
									<tr>
										<?php foreach ($titulos as $campo) echo '<td>'.$valor[$campo].'</td>'; ?>
										<td>
											<?= $this->Html->link(__('<i class="fa fa-file-text-o"></i>'), array('controller' => 'platillos_'.$plural, 'action' => 'ver', $valor['id']), array('class' => 'btn btn-sm btn-default', 'escape' => FALSE, 'title' => 'Ver')); ?>
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
