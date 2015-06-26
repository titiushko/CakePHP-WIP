<div class="row">
	<div class="col-lg-12">
		<h1 class="well page-header"><i class="fa fa-users fa-fw"></i> Módulo de Platillos</h1>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-primary">
			<div class="panel-heading">
				Ver Platillo
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-lg-4 col-lg-offset-4">
						<div class="form-horizontal">
						<fieldset>
							<legend>Datos Personales</legend>
							<div class="form-group">
								<?= $this->Form->label('nombre', 'Nombre', array('class' => 'col-lg-3 control-label')); ?>
								<div class="col-lg-9">
									<?= $this->Form->input('nombre', array('label' => false, 'value' => $platillo['Platillo']['nombre'], 'disabled' => true, 'class' => 'form-control', 'div' => false)); ?>
								</div>
							</div>
							<div class="form-group">
								<?= $this->Form->label('precio', 'Precio', array('class' => 'col-lg-3 control-label')); ?>
								<div class="col-lg-9">
									<?= $this->Form->input('precio', array('label' => false, 'value' => $platillo['Platillo']['precio'], 'disabled' => true, 'class' => 'form-control', 'div' => false)); ?>
								</div>
							</div>
							<div class="form-group">
								<?= $this->Form->label('descripcion', 'Descripción', array('class' => 'col-lg-3 control-label')); ?>
								<div class="col-lg-9">
									<?= $this->Form->input('descripcion', array('label' => false, 'value' => $platillo['Platillo']['descripcion'], 'disabled' => true, 'rows' => 4, 'class' => 'form-control', 'div' => false)); ?>
								</div>
							</div>
							<div class="form-group">
								<?= $this->Form->label('categoria_platillo_id', 'Categoría', array('class' => 'col-lg-3 control-label')); ?>
								<div class="col-lg-9">
									<?= $this->Form->input('categoria_platillo_id', array('label' => false, 'value' => $platillo['Platillo']['categoria_platillo_id'], 'disabled' => true, 'class' => 'form-control', 'div' => false)); ?>
								</div>
							</div>
							<div class="form-group">
								<div class="col-lg-4 text-right">
									<?= $this->Html->link(__('<i class="fa fa-pencil"></i> Editar'), array('controller' => 'platillos', 'action' => 'editar', $platillo['Platillo']['id']), array('class' => 'btn btn-primary', 'escape' => false)); ?>
								</div>
								<div class="col-lg-4 text-center">
									<?= $this->Form->postLink(__('<i class="fa fa-trash"></i> Eliminar'), array('controller' => 'platillos', 'action' => 'eliminar', $platillo['Platillo']['id']), array('class' => 'btn btn-danger', 'escape' => false, 'confirm' => __('¿Eliminar %s?', $platillo['Platillo']['nombre']))); ?>
								</div>
								<div class="col-lg-4 text-left">
									<?= $this->Html->link(__('<i class="fa fa-times-circle"></i> Cancelar'), array('controller' => 'platillos', 'action' => 'index'), array('class' => 'btn btn-default', 'escape' => false)); ?>
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
