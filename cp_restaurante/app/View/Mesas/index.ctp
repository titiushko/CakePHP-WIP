<div class="page-header">
	<h2>Listado de Mesas</h2>
</div>
<div class="row">
	<div class="col-md-12">
		<p><?= $this->Html->link(__('Agregar Mesa'), array('controller' => 'mesas', 'action' => 'nuevo'), array('class' => 'btn btn-sm btn-default')); ?></p>
		<table class="table table-striped">
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
						<?= $this->Html->link(__('Editar'), array('controller' => 'mesas', 'action' => 'editar', $mesa['Mesa']['id']), array('class' => 'btn btn-sm btn-default')); ?>
						<?= $this->Form->postLink(__('Eliminar'), array('controller' => 'mesas', 'action' => 'eliminar', $mesa['Mesa']['id']), array('class' => 'btn btn-sm btn-default', 'confirm' => __('¿Eliminar mesa %s?', $mesa['Mesa']['serie']))); ?>
					</td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>
