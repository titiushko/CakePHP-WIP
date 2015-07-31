$(document).ready(function() {
	$('.quitar_registro').on('click', function(event) {
		var modelo = $(this).attr('modelo');
		var controlador = window.location.pathname.split("/", 3)[2];
		var id = $(this).attr('id');
		
		if (controlador == 'empleados' && modelo == 'platillo') {
			$.each($('.platillo-' + id), function(indice, valor) {
				quitar_registro(id, modelo, controlador, valor.value);
			});
		}
		else if (controlador == 'platillos' && modelo == 'cocinero') {
			$.each($('.registro-' + id), function(indice, valor) {
				quitar_registro(valor.id, modelo, controlador, '');
			});
		}
		else {
			quitar_registro(id, modelo, controlador, '');
		}
		
		return false;
	});
	
	function quitar_registro(p_id, p_modelo, p_controlador, p_cocineros_platillo_id) {
		if (p_controlador == 'platillos' && p_modelo == 'cocinero') {
			$('#' + p_id).fadeOut(1000, function(){$('#' + p_id).remove();});
		}
		else {
			$('.registro-' + p_id).fadeOut(1000, function(){$('.registro-' + p_id).remove();});
		}
		
		$.ajax({
			type: 'POST',
			url: url_base + 'ajax/quitar_registro',
			data: {
				id: p_id,
				modelo: p_modelo,
				controlador: p_controlador,
				cocineros_platillo_id: p_cocineros_platillo_id
			},
			dataType: 'json',
			success: function(respuesta) {
				$('#mensaje').html('<div class="alert alert-success flash-mensaje">' + inicial_mayuscula(p_modelo) + ' ' + respuesta.resultado + ' eliminado de ' + nombre_controlador() + '.</div>');
				$('.flash-mensaje').delay(2000).fadeOut('slow');
			},
			error: function(){
				alert('¡Error!');
			}
		});
	}
	
	function nombre_controlador() {
		var controlador = window.location.pathname.split("/", 3)[2];
		//var controlador_palabras = controlador.substr(0, controlador.length - 1).split("_");
		var controlador_palabras = controlador.split("_");
		var nombre = '';
		controlador_palabras.forEach(function(palabra){nombre += ' ' + inicial_mayuscula(palabra)});
		return nombre;
	}
	
	function inicial_mayuscula(cadena) {
		return cadena.charAt(0).toUpperCase() + cadena.slice(1);
	}
});
