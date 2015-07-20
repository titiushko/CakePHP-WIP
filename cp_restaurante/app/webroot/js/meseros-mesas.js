$(document).ready(function() {
	$('#OrdenMeseroId').on('change', function(event) {
		$.ajax({
			type: 'POST',
			url: url_base + 'meseros/mesas',
			data: {
				mesero_id: $(this).val() != '' ? $(this).val() : '%'
			},
			dataType: 'json',
			success: function(resultado) {
				$('#OrdenMesaId').empty();
				$.each(resultado.mesas, function(indice, valor) {
					$('#OrdenMesaId').append($('<option></option>').attr({'value': valor.Mesa.id}).text(valor.Mesa.serie));
				});
			}
		});
	}).change();
});
