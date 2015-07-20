<div class="row">
	<div class="col-lg-12">
		<h1 class="well page-header"><i class="fa fa-users"></i> Módulo de Usuarios</h1>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-primary">
			<div class="panel-heading">
				Ver Usuario
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-lg-4 col-lg-offset-4">
						<div class="form-horizontal">
						<fieldset>
							<legend>Datos Usuario</legend>
							<div class="form-group">
								<?= $this->Form->label('nombre_completo', 'Nombre Completo', array('class' => 'col-lg-3 control-label')); ?>
								<div class="col-lg-9">
									<?= $this->Form->input('nombre_completo', array('label' => FALSE, 'value' => $usuario['Usuario']['nombre_completo'], 'disabled' => TRUE, 'class' => 'form-control', 'div' => FALSE)); ?>
								</div>
							</div>
							<div class="form-group">
								<?= $this->Form->label('usuario', 'Usuario', array('class' => 'col-lg-3 control-label')); ?>
								<div class="col-lg-9">
									<?= $this->Form->input('usuario', array('label' => FALSE, 'value' => $usuario['Usuario']['usuario'], 'disabled' => TRUE, 'class' => 'form-control', 'div' => FALSE)); ?>
								</div>
							</div>
							<div class="form-group">
								<?= $this->Form->label('contrasena', 'Contraseña', array('class' => 'col-lg-3 control-label')); ?>
								<div class="col-lg-9">
									<?= $this->Form->input('contrasena', array('type' => 'password', 'label' => FALSE, 'value' => $usuario['Usuario']['contrasena'], 'disabled' => TRUE, 'class' => 'form-control', 'div' => FALSE)); ?>
								</div>
							</div>
							<div class="form-group">
								<?= $this->Form->label('rol', 'Rol', array('class' => 'col-lg-3 control-label')); ?>
								<div class="col-lg-9">
									<?= $this->Form->input('rol', array('label' => FALSE, 'value' => $this->Funciones->rol($usuario['Usuario']['rol']), 'disabled' => TRUE, 'class' => 'form-control', 'div' => FALSE)); ?>
								</div>
							</div>
							<div class="form-group">
								<div class="col-lg-12 text-center">
									<?= $this->Html->link(__('<i class="fa fa-pencil"></i> Editar'), array('controller' => 'usuarios', 'action' => 'editar', $usuario['Usuario']['id']), array('class' => 'btn btn-primary', 'escape' => FALSE)); ?>
									<?= $this->Form->postLink(__('<i class="fa fa-trash"></i> Eliminar'), array('controller' => 'usuarios', 'action' => 'eliminar', $usuario['Usuario']['id']), array('class' => 'btn btn-danger', 'escape' => FALSE, 'confirm' => __('¿Eliminar a %s?', $usuario['Usuario']['usuario']))); ?>
									<?= $this->Html->link(__('<i class="fa fa-times-circle"></i> Cancelar'), array('controller' => 'usuarios', 'action' => 'index'), array('class' => 'btn btn-default', 'escape' => FALSE)); ?>
								</div>
							</div>
						</fieldset>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
