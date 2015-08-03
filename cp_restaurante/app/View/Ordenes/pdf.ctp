<table align="center">
	<tr>
		<td align="center">
			<fieldset>
				<legend align="left">Orden Cliente</legend>
				<table>
					<tr>
						<th align="left">Nombres</th><td><?= $orden['Persona']['nombres']; ?></td>
						<th align="left">Apellidos</th><td><?= $orden['Persona']['apellidos']; ?></td>
						<th align="left">DUI</th><td><?= $orden['Persona']['dui']; ?></td>
					</tr>
				</table>
				<table>
					<tr>
						<th align="left">Mesero</th><td><?= $orden['Persona']['nombre_completo']; ?></td>
						<th align="left">Mesa</th><td><?= $orden['Mesa']['serie']; ?></td>
					</tr>
				</table>
			</fieldset>
		</td>
	</tr>
	<tr>
		<td align="center">
			<fieldset>
				<legend align="left">Pedidos</legend>
				<table border="1">
					<thead>
						<tr>
							<th>Platillo</th>
							<th>Precio</th>
							<th>Cantidad</th>
							<th>SubTotal</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$platillo = 0;
						foreach ($orden['PlatillosOrden'] as $platillos_orden):
						?>
						<tr>
							<td><?= $platillos[$platillo]['Platillo']['nombre']; ?></td>
							<td>$ <?= number_format($platillos[$platillo]['Platillo']['precio'], 2, '.', ','); ?></td>
							<td><?= number_format($platillos_orden['cantidad'], 0, '', ','); ?></td>
							<td>$ <?= number_format($platillos_orden['subtotal'], 2, '.', ','); ?></td>
						</tr>
						<?php
						$platillo++;
						endforeach;
						?>
					</tbody>
					<tfoot>
						<tr>
							<th colspan="3" align="right">Total Orden</th>
							<th>$ <?= number_format($orden['Orden']['total'], 2, '.', ','); ?></th>
						</tr>
					</tfoot>
				</table>
			</fieldset>
		</td>
	</tr>
</table>
