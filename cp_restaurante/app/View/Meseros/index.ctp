<div class="row">
	<div class="col-lg-12">
		<h1 class="well page-header"><i class="fa fa-users fa-fw"></i> Módulo de Meseros</h1>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-primary">
			<div class="panel-heading">
				Listado de Meseros
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-lg-12">
						<?= $this->Html->link(__('<i class="fa fa-user-plus"></i> Agregar Mesero'), array('controller' => 'meseros', 'action' => 'nuevo'), array('class' => 'btn btn-success', 'escape' => false)); ?>
					</div>
				</div>
				<div class="row"><div class="col-lg-12">&nbsp;</div></div>
				<div class="row">
					<div class="col-lg-12">
						<table class="table table-striped table-bordered table-hover">
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
										<?= $this->Html->link(__('<i class="fa fa-file-text-o"></i> Ver'), array('controller' => 'meseros', 'action' => 'ver', $mesero['Mesero']['id']), array('class' => 'btn btn-sm btn-default', 'escape' => false)); ?>
										<?= $this->Html->link(__('<i class="fa fa-pencil"></i> Editar'), array('controller' => 'meseros', 'action' => 'editar', $mesero['Mesero']['id']), array('class' => 'btn btn-sm btn-default', 'escape' => false)); ?>
										<?= $this->Form->postLink(__('<i class="fa fa-trash"></i> Eliminar'), array('controller' => 'meseros', 'action' => 'eliminar', $mesero['Mesero']['id']), array('class' => 'btn btn-sm btn-default', 'escape' => false, 'confirm' => __('¿Eliminar a %s %s?', $mesero['Mesero']['nombres'], $mesero['Mesero']['apellidos']))); ?>
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
