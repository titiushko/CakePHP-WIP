<div class="row">
	<div class="col-lg-12">
		<h1 class="well page-header"><i class="fa fa-users fa-fw"></i> Módulo de Cocineros</h1>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-primary">
			<div class="panel-heading">
				Ver Cocinero
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-lg-4 col-lg-offset-4">
						<div class="form-horizontal">
						<fieldset>
							<legend>Datos Personales</legend>
							<div class="form-group">
								<?= $this->Form->label('nombres', 'Nombres', array('class' => 'col-lg-3 control-label')); ?>
								<div class="col-lg-9">
									<?= $this->Form->input('nombres', array('label' => false, 'value' => $cocinero['Cocinero']['nombres'], 'disabled' => true, 'class' => 'form-control', 'div' => false)); ?>
								</div>
							</div>
							<div class="form-group">
								<?= $this->Form->label('apellidos', 'Apellidos', array('class' => 'col-lg-3 control-label')); ?>
								<div class="col-lg-9">
									<?= $this->Form->input('apellidos', array('label' => false, 'value' => $cocinero['Cocinero']['apellidos'], 'disabled' => true, 'class' => 'form-control', 'div' => false)); ?>
								</div>
							</div>
							<div class="form-group">
								<div class="col-lg-4 text-right">
									<?= $this->Html->link(__('<i class="fa fa-pencil"></i> Editar'), array('controller' => 'cocineros', 'action' => 'editar', $cocinero['Cocinero']['id']), array('class' => 'btn btn-primary', 'escape' => false)); ?>
								</div>
								<div class="col-lg-4 text-center">
									<?= $this->Form->postLink(__('<i class="fa fa-trash"></i> Eliminar'), array('controller' => 'cocineros', 'action' => 'eliminar', $cocinero['Cocinero']['id']), array('class' => 'btn btn-danger', 'escape' => false, 'confirm' => __('¿Eliminar a %s %s?', $cocinero['Cocinero']['nombres'], $cocinero['Cocinero']['apellidos']))); ?>
								</div>
								<div class="col-lg-4 text-left">
									<?= $this->Html->link(__('<i class="fa fa-times-circle"></i> Cancelar'), array('controller' => 'cocineros', 'action' => 'index'), array('class' => 'btn btn-default', 'escape' => false)); ?>
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
