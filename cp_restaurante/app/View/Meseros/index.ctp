<div class="page-header">
	<h2>Listado de Meseros</h2>
</div>
<div class="row">
	<div class="col-md-12">
		<p><?= $this->Html->link(__('Agregar Mesero'), array('controller' => 'meseros', 'action' => 'nuevo'), array('class' => 'btn btn-sm btn-default')); ?></p>
		<table class="table table-striped">
			<thead>
				<tr>
					<th>Identificador</th>
					<th>Nombres</th>
					<th>Apellidos</th>
					<th>Creado</th>
					<th>Acción</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($meseros as $mesero): ?>
				<tr>
					<td><?= $mesero['Mesero']['id']; ?></td>
					<td><?= $mesero['Mesero']['nombres']; ?></td>
					<td><?= $mesero['Mesero']['apellidos']; ?></td>
					<td><?= $this->Time->format('d/m/Y h:i A', $mesero['Mesero']['created']); ?></td>
					<td>
						<?= $this->Html->link(__('Ver'), array('controller' => 'meseros', 'action' => 'ver', $mesero['Mesero']['id']), array('class' => 'btn btn-sm btn-default')); ?>
						<?= $this->Html->link(__('Editar'), array('controller' => 'meseros', 'action' => 'editar', $mesero['Mesero']['id']), array('class' => 'btn btn-sm btn-default')); ?>
						<?= $this->Form->postLink(__('Eliminar'), array('controller' => 'meseros', 'action' => 'eliminar', $mesero['Mesero']['id']), array('class' => 'btn btn-sm btn-default', 'confirm' => __('¿Eliminar a %s %s?', $mesero['Mesero']['nombres'], $mesero['Mesero']['apellidos']))); ?>
					</td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>
