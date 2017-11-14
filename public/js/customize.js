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

	// Start of Tawk.to Script
	var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
	(function(){
		var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
		s1.async=true;
		s1.src='https://embed.tawk.to/5a051b4b198bd56b8c03a4f2/default';
		s1.charset='UTF-8';
		s1.setAttribute('crossorigin','*');
		s0.parentNode.insertBefore(s1,s0);
	})();
	// End of Tawk.to Script

	$(window).scroll(function() {
		if($(this).scrollTop() &gt; 200) {
			$(&#39;#back-to-top&#39;).fadeIn();
		} else {
			$(&#39;#back-to-top&#39;).fadeOut();
		}
	});
	$(&#39;#back-to-top&#39;).hide().click(function() {
		$(&#39;html, body&#39;).animate({scrollTop:0}, 1000);
		return false;
	});

});