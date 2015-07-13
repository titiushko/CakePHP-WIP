$(document).ready(function() {
	$('.agregar_pedido_carrito').on('click', function(event) {
		$.ajax({
			type: 'POST',
			url: url_base + 'pedidos/agregar',
			data: {
				id: $(this).attr('id'),
				cantidad: 1
			},
			dataType: 'html',
			success: function(resultado) {
				$('#mensaje').html('<div class="alert alert-success flash-mensaje">Pedido agregado a la orden.</div>');
				$('.flash-mensaje').delay(2000).fadeOut('slow');
			},
			error: function(){
				alert('¡Error!');
			}
		});
		return false;
	});
});
