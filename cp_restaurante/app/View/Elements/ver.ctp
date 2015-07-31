<?= $this->Html->script(array('quitar_registro'), array('inline' => FALSE)); ?>
<?php
$formulario = array(
	'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
	'div' => array('class' => 'form-group'),
	'label' => array('class' => 'col-lg-3 control-label'),
	'autocomplete' => 'off',
	'class' => 'form-control',
	'between' => '<div class="col-lg-9">',
	'after' => '</div>',
	'error' => array('attributes' => array('wrap' => 'span', 'class' => 'error-message'))
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
				Ver <?= ucwords(str_replace('_', ' ', $alias_singular)); ?>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-lg-4 col-lg-offset-4">
						<div class="form-horizontal">
						<fieldset>
							<legend>Datos Principales</legend>
							<?php
							foreach ($campos as $nombre => $opciones)
								echo is_array($opciones) ? $this->Form->input($nombre, array_merge($formulario, $opciones)) : $opciones;
								?>
							<div class="form-group">
								<div class="col-lg-12 text-center">
									<?php if (isset($usuario_actual)): ?>
									<?= $this->Html->link(__('<i class="fa fa-pencil"></i> Editar'), array('controller' => $controlador, 'action' => 'editar', $id), array('class' => 'btn btn-primary', 'escape' => FALSE)); ?>
									<?php if($usuario_actual['rol'] == 'admin'): ?>
									<?= $this->Form->postLink(__('<i class="fa fa-trash"></i> Eliminar'), array('controller' => $controlador, 'action' => 'eliminar', $id), array('class' => 'btn btn-danger', 'escape' => FALSE, 'confirm' => __('¿Eliminar %s %s?', $alias_singular, $elemento_eliminar))); ?>
									<?php endif; ?>
									<?php endif; ?>
									<?= $this->Html->link(__('<i class="fa fa-arrow-left"></i> Regresar'), array('controller' => $controlador, 'action' => 'index'), array('class' => 'btn btn-default', 'escape' => FALSE)); ?>
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
									<tr class="registro-<?= $valor['id']; ?>">
										<?php foreach ($campos_asociacion as $campo) echo '<td>'.$valor[$campo].'</td>'; ?>
										<td>
											<?= $this->Html->link(__('<i class="fa fa-file-text-o"></i>'), array('controller' => $asociacion_plural, 'action' => 'ver', $valor['id']), array('class' => 'btn btn-sm btn-default', 'escape' => FALSE, 'title' => 'Ver')); ?>
											<?php if (isset($usuario_actual)): ?>
											<?= $this->Html->link(__('<i class="fa fa-pencil"></i>'), array('controller' => $asociacion_plural, 'action' => 'editar', $valor['id']), array('class' => 'btn btn-sm btn-default', 'escape' => FALSE, 'title' => 'Editar')); ?>
											<?php if($usuario_actual['rol'] == 'admin'): ?>
											<?= $this->Form->postLink(__('<i class="fa fa-trash"></i>'), array('controller' => $asociacion_plural, 'action' => 'eliminar', $valor['id']), array('class' => 'btn btn-sm btn-default', 'escape' => FALSE, 'title' => 'Eliminar', 'confirm' => __('¿Eliminar %s %s?', $asociacion_singular, $valor['elemento_eliminar']))); ?>
											<?= $this->Form->button(__('<span style="color: #d9534f;"><i class="fa fa-minus-circle"></i></span>'), array('class' => 'btn btn-sm btn-default quitar_registro', 'title' => 'Quitar '.$asociacion_singular, 'id' => $valor['id'], 'modelo' => $asociacion_singular)); ?>
											<?php endif; ?>
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
