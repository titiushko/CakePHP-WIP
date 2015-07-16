<div class="row">
	<div class="col-lg-12">
		<h1 class="well page-header"><i class="fa fa-coffee"></i> Módulo de Mesas</h1>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-primary">
			<div class="panel-heading">
				Ver Mesa
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-lg-4 col-lg-offset-4">
						<div class="form-horizontal">
						<fieldset>
							<legend>Mesa</legend>
							<div class="form-group">
								<?= $this->Form->label('serie', 'Serie', array('class' => 'col-lg-3 control-label')); ?>
								<div class="col-lg-9">
									<?= $this->Form->input('serie', array('label' => FALSE, 'value' => $mesa['Mesa']['serie'], 'disabled' => TRUE, 'class' => 'form-control', 'div' => FALSE)); ?>
								</div>
							</div>
							<div class="form-group">
								<?= $this->Form->label('puestos', 'Puestos', array('class' => 'col-lg-3 control-label')); ?>
								<div class="col-lg-9">
									<?= $this->Form->input('puestos', array('label' => FALSE, 'value' => $mesa['Mesa']['puestos'], 'disabled' => TRUE, 'class' => 'form-control', 'div' => FALSE)); ?>
								</div>
							</div>
							<div class="form-group">
								<?= $this->Form->label('posicion', 'Posicion', array('class' => 'col-lg-3 control-label')); ?>
								<div class="col-lg-9">
									<?= $this->Form->input('posicion', array('label' => FALSE, 'value' => $mesa['Mesa']['posicion'], 'disabled' => TRUE, 'class' => 'form-control', 'div' => FALSE, 'rows' => 3)); ?>
								</div>
							</div>
							<div class="form-group">
								<?= $this->Form->label('mesero', 'Mesero', array('class' => 'col-lg-3 control-label')); ?>
								<div class="col-lg-9" style="margin-top: 6px;">
									<?php echo $this->Html->link($mesa['Mesero']['nombre_completo'], array('controller' => 'meseros', 'action' => 'ver', $mesa['Mesero']['id'])); ?>
								</div>
							</div>
							<div class="form-group">
								<div class="col-lg-12 text-center">
									<?= $this->Html->link(__('<i class="fa fa-pencil"></i> Editar'), array('controller' => 'mesas', 'action' => 'editar', $mesa['Mesa']['id']), array('class' => 'btn btn-primary', 'escape' => FALSE)); ?>
									<?= $this->Form->postLink(__('<i class="fa fa-trash"></i> Eliminar'), array('controller' => 'mesas', 'action' => 'eliminar', $mesa['Mesa']['id']), array('class' => 'btn btn-danger', 'escape' => FALSE, 'confirm' => __('¿Eliminar a %s?', $mesa['Mesa']['serie']))); ?>
									<?= $this->Html->link(__('<i class="fa fa-times-circle"></i> Cancelar'), array('controller' => 'mesas', 'action' => 'index'), array('class' => 'btn btn-default', 'escape' => FALSE)); ?>
								</div>
							</div>
						</fieldset>
						</div>
					</div>
				</div>
				<div class="row"><div class="col-lg-12">&nbsp;</div></div>
			</div>
		</div>
	</div>
</div>
