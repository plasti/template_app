import App from './dinamic.js';


$(document).ready(function () {

	// setiar componente App (dinamic)
	$(document).on('click', '#go', function (e) {
		e.preventDefault();
		App.go($(this).attr('url'));
	});

	$(document).on('click', 'a', function (e) {
		e.preventDefault();
		if ($(this).attr('href') != '' && $(this).attr('href') != '#') {
			if ($(this).attr('target') == '_blank') {
				var link = $(this).attr('href');
				window.open(link);
			}else {
				App.go($(this).attr('href'));
			}
		}
	});

	$(document).on('submit', '#send', function (e) {
		e.preventDefault();
		App.send($(this));
	});




	// ---------------

	$(document).on('change', '#avatar_change', function () {
		$('#send').submit();
	});

	$(document).on('change','#envios_gratuitos', function () {
		if ($(this).is(':checked')) {
			$('#envios_gratuitos_adicionales').fadeIn(300);			
		}else {
			$('#envios_gratuitos_adicionales').fadeOut(300);			
		}
	});

	$(document).on('change','#envios_gratuitos_ciudades_costo', function () {
		if ($(this).is(':checked')) {
			$('#ciudades_gratuitas').fadeIn(300);			
			$('#umbral').fadeOut(300);
		}else {
			$('#ciudades_gratuitas').fadeOut(300);			
			$('#umbral').fadeIn(300);
		}
	});
	const addCiudad = (state, city) => {
		var cities = ($('input[name="ciudades_gratuitas"]').val() != '') ? JSON.parse($('input[name="ciudades_gratuitas"]').val()) : {};
		if (cities[state] == undefined) {
			cities[state] = [];
		}
		cities[state].push(city);
		$('input[name="ciudades_gratuitas"]').val(JSON.stringify(cities));
	}

	const removeCiudad = (state, city) => {
		var cities = ($('input[name="ciudades_gratuitas"]').val() != '') ? JSON.parse($('input[name="ciudades_gratuitas"]').val()) : {};
		if (cities[state] != undefined) {
			cities[state].splice(cities[state].findIndex(c => c == city), 1);
			if (cities[state].length == 0) {
				delete cities[state];
			}
		}
		$('input[name="ciudades_gratuitas"]').val(JSON.stringify(cities));

	}
	$(document).on('click', '#ciudad_add', function () {
		if ($(this).hasClass('add')) {
			$(this).removeClass('add');
			removeCiudad($(this).attr('state'), $(this).text());
		}else {
			$(this).addClass('add');
			addCiudad($(this).attr('state'), $(this).text());
		}
	});

	$(document).on('change', '#departamento_init', function () {
		var ciudades = JSON.parse($('#ciudad_init').attr('cities'));
		var html= '<option value="">Seleccionar..</option>';
		var state = $(this).val();
		for (var i = 0; i <= ciudades[state].length - 1; i++) {
			html += '<option value="'+ciudades[state][i]+'">'+ciudades[state][i]+'</option>';
		}
		$('#ciudad_init').html(html);
	});

	$(document).on('change', '#departamento_finish', function () {
		var ciudades = JSON.parse($('#ciudad_finish').attr('cities'));
		var html= '<option value="">Seleccionar..</option>';
		var state = $(this).val();
		for (var i = 0; i <= ciudades[state].length - 1; i++) {
			html += '<option value="'+ciudades[state][i]+'">'+ciudades[state][i]+'</option>';
		}
		$('#ciudad_finish').html(html);
	});

	$(document).on('click', '#cerrar_mensaje_cotizacion', function (e) {
		e.preventDefault();
		$('#mensaje_cotizacion').remove();
	});


	$(document).on('submit', '#cotizar', function (e) {
		e.preventDefault();
		var form = $(this);
		$.ajax({
			url: form.attr('action'),
			method: form.attr('method'),
			data: new FormData(form[0]),
			dataType: 'JSON',
			contentType: false,
			cache: false,
			processData: false,
			beforeSend: () => {
				$('#mensaje_cotizacion').remove();
				App.showLoader('Enviando..');
			},
			complete: () => {
				App.hideLoader();
			},
			success: function (data) {
					var html = '<div class="respuesta-cotizacion '+data.status+'" id="mensaje_cotizacion">'
					html + '<p class="cerrar" id="cerrar_mensaje_cotizacion">Cerrar</p>'
					html += '<strong>Respuesta cotización</strong>';
					html += '<span>'+((data.status == 'Ok') ? 'Cotización exitosa' : 'Cotización exitosa')+'</span>';
					html += '<ul>';
					if(data.status == 'Ok') {
						html += '<li>Producto permitido: '+data.data.permitido+'</li>';
						html += '<li>Total envio: $'+data.data.total.parsing+'</li>';
						html += '<li>Tiempo de entrega: '+data.data.tiempo_entrega.parsing.date+' - '+data.data.tiempo_entrega.parsing.time+'</li>';
					}else {
						html += '<li>'+data.error+'</li>';
					}
					html += '</ul>';
					html += '</div>';
					$('#catizar_c').append(html);
			},
			error : function(xhr, status) {
				var msg = xhr.responseJSON || null;
				if (msg != null) {
					var ss = '';
					for (var i in msg.errors) {
						ss += '\n '+msg.errors[i][0];
					}
					App.mensaje(ss, 7000, 'error');
				}else {
					App.mensaje(status, 2000, 'error');
				}
		    },
		})
	});
});