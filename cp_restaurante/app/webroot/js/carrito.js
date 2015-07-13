$(document).ready(function() {
	$('.cantidad').on('keyup change', function(event) {
		if ($(this).val() == 0) $(this).val(1);
		else actualizar_pedido($(this).attr('cantidad-id'), Math.round($(this).val()));
	});
	
	function actualizar_pedido(p_id, p_cantidad) {
		$.ajax({
			type: 'POST',
			url: url_base + 'pedidos/actualizar_pedido',
			data: {
				id: p_id,
				cantidad: p_cantidad
			},
			dataType: 'json',
			success: function(resultado) {
				if ($('#subtotal-' + resultado.pedido.id).html() != resultado.pedido.subtotal) {
					$('#subtotal-' + resultado.pedido.id).html('$ ' + resultado.pedido.subtotal).animate({backgroundColor: '#ff8'}, 200).animate({backgroundColor: '#fff'});
				}
				$('#total-orden').html('$ ' + resultado.pedido.total_orden).animate({backgroundColor: '#ff8'}, 200).animate({backgroundColor: '#fff'});
			}
		});
	}
	
	$('.eliminar').on('click', function(event) {
		eliminar_pedido($(this).attr('id'), 0);
		return false;
	});
	
	function eliminar_pedido(p_id, p_cantidad) {
		if (p_cantidad === 0) $('#pedido-' + p_id).fadeOut(1000, function(){$('#pedido-' + p_id).remove();});
		$.ajax({
			type: 'POST',
			url: url_base + 'pedidos/eliminar_pedido',
			data: {
				id: p_id
			},
			dataType: 'json',
			success: function(resultado) {
				$('#mensaje').html('<div class="alert alert-success flash-mensaje">Pedido eliminado de la orden.</div>');
				$('.flash-mensaje').delay(2000).fadeOut('slow');
				$('#total-orden').html('$ ' + resultado.total_orden).animate({backgroundColor: '#ff8'}, 200).animate({backgroundColor: '#fff'});
				if (resultado.pedidos == '') window.location.replace(url_base + 'platillos/index');
			},
			error: function(){
				alert('¡Error!');
			}
		});
	}
});
