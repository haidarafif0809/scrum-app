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
});