<div class="row">
	<div class="col-lg-12">
		<h1 class="well page-header"><i class="fa fa-cutlery"></i> Módulo de Mesas</h1>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-primary">
			<div class="panel-heading">
				Listado de Mesas
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-lg-12">
						<?= $this->Html->link(__('<i class="fa fa-plus-square"></i> Agregar Mesa'), array('controller' => 'mesas', 'action' => 'nuevo'), array('class' => 'btn btn-success', 'escape' => false)); ?>
					</div>
				</div>
				<div class="row"><div class="col-lg-12">&nbsp;</div></div>
				<div class="row">
					<div class="col-lg-12">
						<table class="table table-striped table-bordered table-hover">
							<thead>
								<tr>
									<th>Serie</th>
									<th>Puestos</th>
									<th>Posición</th>
									<th>Creado</th>
									<th>Modificado</th>
									<th>Responsable</th>
									<th>Acción</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($mesas as $mesa): ?>
								<tr>
									<td><?= $mesa['Mesa']['serie']; ?></td>
									<td><?= $mesa['Mesa']['puestos']; ?></td>
									<td><?= $mesa['Mesa']['posicion']; ?></td>
									<td><?= $this->Time->format('d/m/Y h:i A', $mesa['Mesa']['created']); ?></td>
									<td><?= $this->Time->format('d/m/Y h:i A', $mesa['Mesa']['modified']); ?></td>
									<td><?= $this->Html->link(__('%s %s', $mesa['Mesero']['nombres'], $mesa['Mesero']['apellidos']), array('controller' => 'meseros', 'action' => 'ver', $mesa['Mesero']['id'])) ?></td>
									<td>
										<?= $this->Html->link(__('<i class="fa fa-pencil"></i> Editar'), array('controller' => 'mesas', 'action' => 'editar', $mesa['Mesa']['id']), array('class' => 'btn btn-sm btn-default', 'escape' => false)); ?>
										<?= $this->Form->postLink(__('<i class="fa fa-trash"></i> Eliminar'), array('controller' => 'mesas', 'action' => 'eliminar', $mesa['Mesa']['id']), array('class' => 'btn btn-sm btn-default', 'escape' => false, 'confirm' => __('¿Eliminar mesa %s?', $mesa['Mesa']['serie']))); ?>
									</td>
								</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
