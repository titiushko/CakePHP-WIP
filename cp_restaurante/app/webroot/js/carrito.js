$(document).ready(function() {
	$('.cantidad').on('keyup change', function(event) {
		if ($(this).val() == 0) $(this).val(1);
		else actualizar_orden($(this).attr('cantidad-id'), Math.round($(this).val()));
		
		function actualizar_orden(p_id, p_cantidad) {
			$.ajax({
				type: 'POST',
				url: url_base + 'pedidos/actualizar_orden',
				data: {
					id: p_id,
					cantidad: p_cantidad
				},
				dataType: 'json',
				success: function(resultado) {
					if ($('#subtotal-' + resultado.orden.id).html() != resultado.orden.subtotal) {
						$('#subtotal-' + resultado.orden.id).html('$ ' + resultado.orden.subtotal).animate({backgroundColor: '#ff8'}, 200).animate({backgroundColor: '#fff'});
					}
					$('#total-orden').html('$ ' + resultado.orden.total_orden).animate({backgroundColor: '#ff8'}, 200).animate({backgroundColor: '#fff'});
				}
			});
		}
	});
});
