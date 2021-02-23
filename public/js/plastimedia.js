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
});
