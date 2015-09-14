$(document).ready(function() {
	$('#OrdenMeseroId').on('change', function(event) {
		$.ajax({
			type: 'POST',
			url: url_base + 'empleados/mesas',
			data: {
				mesero_id: $(this).val() != '' ? $(this).val() : ''
			},
			dataType: 'json',
			success: function(resultado) {
				$('#OrdenMesaId').empty();
				if (resultado.mesas.length != 0) {
					$.each(resultado.mesas, function(indice, valor) {
						$('#OrdenMesaId').append($('<option></option>').attr({'value': valor.Mesa.id}).text(valor.Mesa.serie));
					});
				}
				else {
					$('#OrdenMesaId').append($('<option></option>').attr({'value': ''}).text(''));
				}
				
			}
		});
	}).change();
});
