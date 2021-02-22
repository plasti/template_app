const App = {
	version: '1.0.0',
	log: (data) => {
		if (typeof data == 'string') {
			console.log("%c"+data, "color: white; font-size: x-large");
		}
		if (typeof data == 'object') {
			console.log("%cObjeto", "color: white; font-size: x-large");
			console.table(data);
		}
		if (typeof data == 'function') {
			console.log("%cFunción", "color: white; font-size: x-large");
			console.log(data);
		}
		console.log('--------------------------------------------');
		console.log('typeof: '+typeof data);
		if (data.prototype != undefined) {console.log(data.prototype);}
	},
	showLoader: (msg = 'Cargando..') => {
		$('body').append('<div class="loader"><p>'+msg+'</p></div>');
	},
	hideLoader: () => {
		$('.loader').remove();
	},
	showSplash: () => {
		$('#content_app_dinamic').append('<div class="splash-screen"><span class="icon-loader">Cargando..</span></div>');
	},
	hideSplash: () => {
		$('.splash-screen').fadeOut(200);
		setTimeout(() => {$('.splash-screen').remove();}, 300)
	},
	mensaje: (text, time = 3000, type = 'success') => {
		$('body').append('<div class="alert-mensaje '+type+'"><p>'+text+'</p></div>');
		setTimeout(() => {
			$('.alert-mensaje').fadeIn(300);
		}, 500);
		setTimeout(() => {
			$('.alert-mensaje').fadeOut(500);
		}, time);
		setTimeout(() => {
			$('.alert-mensaje').remove();
		}, time + 1000);
	},
	go: (url) => {
		App.showSplash();
		$.get(url, function (data) {
			$('#content_app_dinamic').html(data.data);
			$('#header_app_dinamic > .title').text(data.title);
			App.hideSplash();

			// active of menu
			if (data.active != undefined) {
				$('a').each(function () {$(this).removeClass('active');})
				$('a[active="'+data.active+'"]').addClass('active');
			}
			if (data.back != null) {
				$('#header_app_dinamic > .icon-arrow-left').remove();
				$('#header_app_dinamic').prepend('<a href="#" id="go" url="'+data.back+'" class="icon-arrow-left"></a>');
			}else {
				$('#header_app_dinamic > .icon-arrow-left').remove();
			}
		});
	},
	send: (form) =>  {
		$.ajax({
			url: form.attr('action'),
			method: form.attr('method'),
			data: new FormData(form[0]),
			dataType: 'JSON',
			contentType: false,
			cache: false,
			processData: false,
			beforeSend: () => {
				App.showLoader('Enviando..');
			},
			complete: () => {
				App.hideLoader();
			},
			success: function (data) {
				if (data.status == 'Ok') {
					App.go(data.redirect);
					if (data.msg != '') {
						App.mensaje(data.msg);	
					}
					if (data.update_component != undefined) {
						$(data.update_component.component).html(data.update_component.newComponent);
					}
				}else {
					App.mensaje(data.msg, 7000, 'error');
				}
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
	},

	get getversion() {
		return this.version;
	},
}
// console.dinamic = App;
console.version = App.version;
// Window.dinamic = App;
Window.version = App.version;
// document.dinamic = App;
document.version = App.version;
export default App;