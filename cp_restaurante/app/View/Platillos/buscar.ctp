<script type="text/javascript">$(document).ready(function(){ $('#buscar-platillo').val(''); });</script>
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
<?php
if (!$ajax) {
	$formulario = array(
		'class' => 'form-horizontal',
		'url' => array('controller' => 'platillos', 'action' => 'buscar'),
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
?>
				<div class="row">
					<div class="col-lg-4 col-lg-offset-4">
						<?= $this->Form->create('Platillo', $formulario); ?>
						<fieldset>
							<legend>Buscar Platillo</legend>
							<?= $this->Form->input('busqueda', array('label' => array('text' => 'Platillo', 'class' => 'col-lg-3 control-label'), 'autocomplete' => 'off', 'value' => $busqueda)); ?>
							<div class="form-group">
								<div class="col-lg-12 text-center">
									<span class="submit"><?= $this->Form->button(__('<i class="fa fa-search"></i> Buscar'), array('type' => 'submit', 'class' => 'btn btn-primary', 'escape' => FALSE)); ?></span>
								</div>
							</div>
						</fieldset>
						<?= $this->Form->end(); ?>
					</div>
				</div>
<?php
}
if (!empty($busqueda)) {
	if (empty($platillos)) {
?>
				
				<div class="row">
					<div class="col-lg-12">
						<p>No se encontraron platillos.</p>
					</div>
				</div>
<?php
	}
	else {
?>
				<div class="row">
					<div class="col-lg-12">
						<p><?= count($platillos) ?> platillos encontrados.</p>
					</div>
				</div>
				<div class="row text-center">
					<?php foreach ($platillos as $platillo): ?>
					<div class="col-lg-3">
						<div class="row">
							<div class="col-lg-12">
								<figure class="platillo margen-inferior">
									<?php if (empty($platillo['Platillo']['foto'])) { ?>
									<figure><?= $this->Html->image('../img/plato_vacio/thumb_plato_vacio.jpg'); ?></figure>
									<?php } else { ?>
									<?= $this->Html->link($this->Html->image('../files/platillo/foto/'.$platillo['Platillo']['foto_dir'].'/'.'thumb_'.$platillo['Platillo']['foto']), array('controller' => 'platillos', 'action' => 'ver', $platillo['Platillo']['id']), array('escape' => FALSE)); ?>
									<?php } ?>
								</figure>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-12">
								<?= $platillo['Platillo']['nombre']; ?>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-12">
								$ <?= number_format($platillo['Platillo']['precio'], 2, '.', ','); ?>
							</div>
						</div>
						<div class="row margen-inferior">
							<div class="col-lg-12">
								<?= $this->Html->link($platillo['CategoriaPlatillo']['categoria'], array('controller' => 'categoria_platillos', 'action' => 'ver', $platillo['CategoriaPlatillo']['id'])) ?>
							</div>
						</div>
					</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
	}
}
?>
