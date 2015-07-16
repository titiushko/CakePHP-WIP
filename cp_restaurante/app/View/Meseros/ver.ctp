<div class="row">
	<div class="col-lg-12">
		<h1 class="well page-header"><i class="fa fa-users"></i> Módulo de Meseros</h1>
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
									<?= $this->Form->input('dui', array('label' => FALSE, 'value' => $mesero['Mesero']['dui'], 'disabled' => TRUE, 'class' => 'form-control', 'div' => FALSE)); ?>
								</div>
							</div>
							<div class="form-group">
								<?= $this->Form->label('nombres', 'Nombres', array('class' => 'col-lg-3 control-label')); ?>
								<div class="col-lg-9">
									<?= $this->Form->input('nombres', array('label' => FALSE, 'value' => $mesero['Mesero']['nombres'], 'disabled' => TRUE, 'class' => 'form-control', 'div' => FALSE)); ?>
								</div>
							</div>
							<div class="form-group">
								<?= $this->Form->label('apellidos', 'Apellidos', array('class' => 'col-lg-3 control-label')); ?>
								<div class="col-lg-9">
									<?= $this->Form->input('apellidos', array('label' => FALSE, 'value' => $mesero['Mesero']['apellidos'], 'disabled' => TRUE, 'class' => 'form-control', 'div' => FALSE)); ?>
								</div>
							</div>
							<div class="form-group">
								<?= $this->Form->label('telefono', 'Teléfono', array('class' => 'col-lg-3 control-label')); ?>
								<div class="col-lg-9">
									<?= $this->Form->input('telefono', array('label' => FALSE, 'value' => $mesero['Mesero']['telefono'], 'disabled' => TRUE, 'class' => 'form-control', 'div' => FALSE)); ?>
								</div>
							</div>
							<div class="form-group">
								<div class="col-lg-12 text-center">
									<?= $this->Html->link(__('<i class="fa fa-pencil"></i> Editar'), array('controller' => 'meseros', 'action' => 'editar', $mesero['Mesero']['id']), array('class' => 'btn btn-primary', 'escape' => FALSE)); ?>
									<?= $this->Form->postLink(__('<i class="fa fa-trash"></i> Eliminar'), array('controller' => 'meseros', 'action' => 'eliminar', $mesero['Mesero']['id']), array('class' => 'btn btn-danger', 'escape' => FALSE, 'confirm' => __('¿Eliminar a %s?', $mesero['Mesero']['nombre_completo']))); ?>
									<?= $this->Html->link(__('<i class="fa fa-times-circle"></i> Cancelar'), array('controller' => 'meseros', 'action' => 'index'), array('class' => 'btn btn-default', 'escape' => FALSE)); ?>
								</div>
							</div>
						</fieldset>
						</div>
					</div>
				</div>
				<div class="row"><div class="col-lg-12">&nbsp;</div></div>
				<div class="row">
					<div class="col-lg-12 table-responsive">
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
											<?= $this->Html->link(__('<i class="fa fa-file-text-o"></i>'), array('controller' => 'mesas', 'action' => 'ver', $mesa['id']), array('class' => 'btn btn-sm btn-default', 'escape' => FALSE, 'title' => 'Ver')); ?>
											<?= $this->Html->link(__('<i class="fa fa-pencil"></i>'), array('controller' => 'mesas', 'action' => 'editar', $mesa['id']), array('class' => 'btn btn-sm btn-default', 'escape' => FALSE, 'title' => 'Editar')); ?>
											<?= $this->Form->postLink(__('<i class="fa fa-trash"></i>'), array('controller' => 'mesas', 'action' => 'eliminar', $mesa['id']), array('class' => 'btn btn-sm btn-default', 'escape' => FALSE, 'title' => 'Eliminar', 'confirm' => __('¿Eliminar mesa %s?', $mesa['serie']))); ?>
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
