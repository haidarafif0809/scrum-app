$(document).ready(function () {

	$('.js-selectize-reguler').selectize({
		sortField: 'text',
	});
	$('.js-selectize-multi').selectize({
		sortField: 'text',
		delimiter: ',',
		maxItems: null 
	});
	// confirm delete
	$(document.body).on('submit', '.js-confirm', function () {
		var $el = $(this)
		var text = $el.data('confirm') ? $el.data('confirm') : 'Anda yakin melakukan tindakan ini?'
		var c = confirm(text);
		return c;
	});
	var title = $('title');
	if (title.text() == "" || title.text() == " ") {
		title.text("Aplikasi Scrum");
	}
	else {
		title.text(title.text() + " | Aplikasi Scrum");
	}
	$("#datepicker").datepicker({
		dateFormat: "yy/mm/dd",
		changeMonth: true,
		changeYear: true ,
		yearRange: "-100:+0",
		minDate: new Date()
	});
	$(function() {
		$('#timepicker').timepicker();
	});


	// Alert semua Backlog telah ditambahkan pada Sprint saat ini
	$('#backlogHabis').click(function () {
		var divContainer = document.createElement('div');
		divContainer.setAttribute('class', 'container');
		var divAlert = document.createElement('div');
		var teksAlert = document.createTextNode('Semua Backlog sudah ditambahkan pada Sprint ini.');
		var button = document.createElement('button');
		var dismissLink = document.createTextNode('×');
		var container = document.getElementsByClassName('container')[1];
		button.setAttribute('type', 'button');
		button.setAttribute('class', 'close');
		button.setAttribute('data-dismiss', 'alert');
		button.setAttribute('aria-hidden', 'true');
		button.appendChild(dismissLink);
		divAlert.setAttribute('id', 'blockWarning');
		divAlert.setAttribute('class', 'alert alert-danger');
		divAlert.appendChild(teksAlert);
		divAlert.appendChild(button);
		divContainer.appendChild(divAlert);
		container.before(divContainer);
	});
});