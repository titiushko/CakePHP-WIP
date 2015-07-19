$(document).ready(function() {
	$('#buscar-platillo').autocomplete( {
		minLenght: 2,
		select: function(evento, objeto) {
			$('#buscar-platillo').val(objeto.item.lable);
		},
		source: function(peticion, respuesta) {
			$.ajax( {
				url: url_base + 'platillos/busqueda',
				data: {
					busqueda: peticion.term
				},
				dataType: 'json',
				success: function(resultado) {
					respuesta($.map(resultado, function(elemento, indice) {
						return {
							value: elemento.Platillo.nombre,
							nombre: elemento.Platillo.nombre,
							foto: elemento.Platillo.foto,
							foto_dir: elemento.Platillo.foto_dir
						};
					}));
				}
			});
		}
	}).data('ui-autocomplete')._renderItem = function(lista, valor) {
		return $('<li></li>')
		.data('valor.autocomplete', valor)
		.append('<a><img width="40px" src="' + url_base + 'files/platillo/foto/' + valor.foto_dir + '/' + valor.foto + '" /> ' + valor.nombre + '</a>')
		.appendTo(lista);
	};
});
