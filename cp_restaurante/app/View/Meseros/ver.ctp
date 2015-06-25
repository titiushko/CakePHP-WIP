<div class="row">
	<div class="col-lg-12">
		<h1 class="well page-header"><i class="fa fa-users fa-fw"></i> Módulo de Meseros</h1>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-primary">
			<div class="panel-heading">
				Ver Mesero
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-lg-4 col-lg-offset-4">
						<div class="form-horizontal">
						<fieldset>
							<legend>Datos Personales</legend>
							<div class="form-group">
								<?= $this->Form->label('dui', 'Dui', array('class' => 'col-lg-3 control-label')); ?>
								<div class="col-lg-9">
									<?= $this->Form->input('dui', array('label' => false, 'value' => $mesero['Mesero']['dui'], 'disabled' => true, 'class' => 'form-control', 'div' => false)); ?>
								</div>
							</div>
							<div class="form-group">
								<?= $this->Form->label('nombres', 'Nombres', array('class' => 'col-lg-3 control-label')); ?>
								<div class="col-lg-9">
									<?= $this->Form->input('nombres', array('label' => false, 'value' => $mesero['Mesero']['nombres'], 'disabled' => true, 'class' => 'form-control', 'div' => false)); ?>
								</div>
							</div>
							<div class="form-group">
								<?= $this->Form->label('apellidos', 'Apellidos', array('class' => 'col-lg-3 control-label')); ?>
								<div class="col-lg-9">
									<?= $this->Form->input('apellidos', array('label' => false, 'value' => $mesero['Mesero']['apellidos'], 'disabled' => true, 'class' => 'form-control', 'div' => false)); ?>
								</div>
							</div>
							<div class="form-group">
								<?= $this->Form->label('telefono', 'Teléfono', array('class' => 'col-lg-3 control-label')); ?>
								<div class="col-lg-9">
									<?= $this->Form->input('telefono', array('label' => false, 'value' => $mesero['Mesero']['telefono'], 'disabled' => true, 'class' => 'form-control', 'div' => false)); ?>
								</div>
							</div>
							<div class="form-group">
								<div class="col-lg-4 text-right">
									<?= $this->Html->link(__('<i class="fa fa-pencil"></i> Editar'), array('controller' => 'meseros', 'action' => 'editar', $mesero['Mesero']['id']), array('class' => 'btn btn-primary', 'escape' => false)); ?>
								</div>
								<div class="col-lg-4 text-center">
									<?= $this->Form->postLink(__('<i class="fa fa-trash"></i> Eliminar'), array('controller' => 'meseros', 'action' => 'eliminar', $mesero['Mesero']['id']), array('class' => 'btn btn-danger', 'escape' => false, 'confirm' => __('¿Eliminar a %s %s?', $mesero['Mesero']['nombres'], $mesero['Mesero']['apellidos']))); ?>
								</div>
								<div class="col-lg-4 text-left">
									<?= $this->Html->link(__('<i class="fa fa-times-circle"></i> Cancelar'), array('controller' => 'meseros', 'action' => 'index'), array('class' => 'btn btn-default', 'escape' => false)); ?>
								</div>
							</div>
						</fieldset>
						</div>
					</div>
				</div>
				<div class="row"><div class="col-lg-12">&nbsp;</div></div>
				<div class="row">
					<div class="col-lg-12">
						<fieldset>
							<legend>Encargado de las Mesas</legend>
							<?php if (empty($mesero['Mesa'])) { ?>
								<p>No tiene mesas asociadas.</p>
							<?php } else { ?>
							<table class="table table-striped table-bordered table-hover">
								<thead>
									<tr>
										<th>Serie</th>
										<th>Puestos</th>
										<th>Posición</th>
										<th>Creado</th>
										<th>Modificado</th>
										<th>Acción</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($mesero['Mesa'] as $mesa): ?>
									<tr>
										<td><?= $mesa['serie']; ?></td>
										<td><?= $mesa['puestos']; ?></td>
										<td><?= $mesa['posicion']; ?></td>
										<td><?= $this->Time->format('d/m/Y h:i A', $mesa['created']); ?></td>
										<td><?= $this->Time->format('d/m/Y h:i A', $mesa['modified']); ?></td>
										<td>
											<?= $this->Html->link(__('<i class="fa fa-pencil"></i> Editar'), array('controller' => 'mesas', 'action' => 'editar', $mesa['id']), array('class' => 'btn btn-default', 'escape' => false)); ?>
											<?= $this->Form->postLink(__('<i class="fa fa-trash"></i> Eliminar'), array('controller' => 'mesas', 'action' => 'eliminar', $mesa['id']), array('class' => 'btn btn-default', 'escape' => false, 'confirm' => __('¿Eliminar mesa %s?', $mesa['serie']))); ?>
										</td>
									</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
							<?php } ?>
						</fieldset>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>