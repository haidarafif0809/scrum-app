$(document).ready(function() {
	$('.js-selectize-reguler').selectize({
		sortField: 'text',
	});
	$('.js-selectize-multi').selectize({
		sortField: 'text',
		delimiter: ',',
		maxItems: null
	});
	// confirm delete
	$(document.body).on('submit', '.js-confirm', function() {
		var $el = $(this)
		var text = $el.data('confirm') ? $el.data('confirm') : 'Anda yakin melakukan tindakan ini?'
		var c = confirm(text);
		return c;
	});
	var title = $('title');
	if (title.text() == "" || title.text() == " ") {
		title.text("Aplikasi Scrum");
	} else {
		title.text(title.text() + " | Aplikasi Scrum");
	}
	$("#datepicker").datepicker({
		dateFormat: "yy/mm/dd",
		changeMonth: true,
		changeYear: true,
		yearRange: "-100:+0",
		minDate: new Date()
	});
	$(function() {
		$('#timepicker').timepicker();
	});
	// Alert semua Backlog telah ditambahkan pada Sprint saat ini
	$('#backlogHabis').click(function() {
		// Membuat div container untuk alert
		var divContainer = document.createElement('div');
		// Tambahkan class container
		divContainer.setAttribute('class', 'container');
		// Membuat div untuk alert
		var divAlert = document.createElement('div');
		// Membuat teks alert
		var teksAlert = document.createTextNode('Semua Backlog sudah ditambahkan pada Sprint ini.');
		// Membuat button dismiss
		var button = document.createElement('button');
		// Membuat teks x untuk dijadikan teks pada button
		var dismissLink = document.createTextNode('×');
		// Mendapatkan element kedua di halaman yang memiliki class container
		var container = document.getElementsByClassName('container')[1];
		// Menambahkan atribut pada element button
		button.setAttribute('type', 'button');
		button.setAttribute('class', 'close');
		button.setAttribute('data-dismiss', 'alert');
		button.setAttribute('aria-hidden', 'true');
		// Memasukkan teks x ke dalam button 
		button.appendChild(dismissLink);
		// Menambahkan atribut pada element div untuk alert
		divAlert.setAttribute('id', 'blockWarning');
		divAlert.setAttribute('class', 'alert alert-danger');
		// Memasukkan teks alert kedalam div alert
		divAlert.appendChild(teksAlert);
		// Memasukkan button x kedalam div alert 
		divAlert.appendChild(button);
		// Memasukkan div alert kedalam container alert
		divContainer.appendChild(divAlert);
		// Memasukkan div container alert ke halaman sebelum div container kedua pada halaman
		container.before(divContainer);
	});
	// Efek untuk inputan Sprint pada halaman penambahan Backlog
	// Membuat element span untuk dijadikan tombol palsu (supaya tidak bisa diklik)
	// Element ini akan muncul jika semua inputan yg dibutuhkan oleh inputan Sprint ada yang belum diisi 
	var spanSubmit = '<span id="spanBacklog" class="btn btn-primary">Simpan</span>';
	// Membuat element button untuk submit atau menyimpan Backlog
	// Element ini akan muncul hanya jika semua inputan yang diperlukan inputan Sprint sudah diisi
	var buttonSubmit = '<input class="btn btn-primary" type="submit" value="Simpan">';
	// Mendapatkan element container untuk tombol submit
	var simpanBacklog = $('#simpanBacklog');
	// Mendapatkan element select untuk Sprint
	var inputSprintId = $('#sprint_id');
	// Ketika nilai pada select Sprint berubah maka jalankan..
	inputSprintId.change(function() {
		// Mendapatkan element untuk dimasuki inputan yang diperlukan Sprint jika user memilih Sprint
		var conInputanSprint = $('#inputanSprint');
		// Membuat element2 yang dibutuhkan oleh Sprint
		var inputanSprint = '<div class="form-group">';
		inputanSprint += '<label for="isi_kepentingan" class="col-md-2 control-label">Isi Kepentingan</label>';
		inputanSprint += '<div class="col-md-4">';
		inputanSprint += '<input class="form-control" id="isi_kepentingan" name="isi_kepentingan" type="number">';
		inputanSprint += '<div id="errorIsiKepentingan" style="margin-top: 2px;"></div>';
		inputanSprint += '</div>';
		inputanSprint += '</div>';
		inputanSprint += '<div class="form-group">';
		inputanSprint += '<label for="perkiraan_waktu" class="col-md-2 control-label">Perkiraan Waktu</label>';
		inputanSprint += '<div class="col-md-4">';
		inputanSprint += '<input class="form-control" id="perkiraan_waktu" placeholder="Jumlah Hari" name="perkiraan_waktu" type="text">';
		inputanSprint += '<div id="errorPerkiraanWaktu" style="margin-top: 2px;"></div>';
		inputanSprint += '</div>';
		inputanSprint += '</div>';
		// Jika nilai dari select Sprint kosong maka jalankan..
		if ($(this).val() == '') {
			// Sembunyikan element dengan efek slide up
			conInputanSprint.slideUp(200);
			// Kosongkan element
			conInputanSprint.html('');
		}
		// Jika select Sprint berisi nilai maka jalankan..
		else {
			// Mencegah slide ulang ketika user mengganti nilai dari select Sprint
			if ($(this).val() != '' && conInputanSprint.html() == '') {
				// Sembunyikan element penampung inputan untuk Sprint terlebih dahulu
				// Supaya efek slide downnya terlihat
				conInputanSprint.hide();
				// Isi element dengan element yang dibutuhkan oleh Sprint
				conInputanSprint.html(inputanSprint);
				// Lalu munculkan element dengan efek slide down
				conInputanSprint.slideDown(200);
			}
			// Mendapatkan element untuk memunculkan error
			var errIsiKepentingan = $('#errorIsiKepentingan');
			var errPerkiraanWaktu = $('#errorPerkiraanWaktu');
			// Mendapatkan element2 yang dibutuhkan Sprint yang telah ditambahkan
			var isiKepentingan = $('#isi_kepentingan');
			var perkiraanWaktu = $('#perkiraan_waktu');
			var errTextIsiKepentingan = "Isi kepentingan harus diisi!";
			var errTextPerkiraanWaktu = "Perkiraan waktu harus diisi!";
			// Ketika inputan untuk isi kepentingan blur maka jalankan..
			isiKepentingan.blur(function() {
				// Jika inputan isi kepentingan kosong
				if (isiKepentingan.val() == '') {
					// Jika error isi kepentingan kosong
					if (errIsiKepentingan.html() == '') {
						// Tambahkan atribut style
						isiKepentingan.attr('style', 'border: 1px solid red;').fadeIn();
						// Sembunyikan element penampung teks error
						errIsiKepentingan.hide();
						// Ubah warna teks menjadi merah
						errIsiKepentingan.css('color', 'red');
						// Masukkan teks dan munculkan dengan efek slide down
						errIsiKepentingan.html(errTextIsiKepentingan).slideDown(200);
					}
					// Jika error isi kepentingan tidak kosong
					// Maka hentikan script
					else {
						return;
					}
				}
				// Jika inputan isi kepentingan tidak kosong
				else {
					// Sembunyikan element dengan efek slide up
					errIsiKepentingan.slideUp(200);
					// Kosongkan element
					errIsiKepentingan.html('');
					// Hapus atribut style
					isiKepentingan.removeAttr('style');
				}
				// Jika inputan isi kepentingan dan perkiraan waktu tidak kosong
				if (isiKepentingan.val() != '' && perkiraanWaktu.val() != '') {
					// Ganti tombol dengan button asli 
					simpanBacklog.html(buttonSubmit);
				}
				// Jika inputan kosong
				else {
					// Ganti tombol dengan button palsu
					simpanBacklog.html(spanSubmit);
				}
			});
			// Ketika inputan untuk perkiraan waktu blur maka jalankan..
			perkiraanWaktu.blur(function() {
				// Jika inputan perkiraan waktu kosong
				if (perkiraanWaktu.val() == '') {
					// Jika error perkiraan waktu kosong
					if (errPerkiraanWaktu.html() == '') {
						// Tambahkan atribut style
						perkiraanWaktu.attr('style', 'border: 1px solid red;').fadeIn();
						// Sembunyikan element penampung teks error
						errPerkiraanWaktu.hide();
						// Ubah warna teks menjadi merah
						errPerkiraanWaktu.css('color', 'red');
						// Masukkan teks dan munculkan dengan efek slide down
						errPerkiraanWaktu.html(errTextPerkiraanWaktu).slideDown(200);
					}
					// Jika error perkiraan waktu tidak kosong
					// Maka hentikan script
					else {
						return;
					}
				}
				// Jika inputan perkiraan waktu tidak kosong
				else {
					// Sembunyikan element dengan efek slide up
					errPerkiraanWaktu.slideUp(200);
					// Kosongkan element
					errPerkiraanWaktu.html('');
					// Hapus atribut style
					perkiraanWaktu.removeAttr('style');
				}
				// Jika inputan isi kepentingan dan perkiraan waktu tidak kosong
				if (isiKepentingan.val() != '' && perkiraanWaktu.val() != '') {
					// Ganti tombol dengan button asli
					simpanBacklog.html(buttonSubmit);
				}
				// Jika inputan kosong
				else {
					// Ganti tombol dengan button palsu
					simpanBacklog.html(spanSubmit);
				}
			});
			$('#simpanBacklog').mousemove(function() {
				if (isiKepentingan.val() != '' && perkiraanWaktu.val() != '') {
					// Ganti tombol dengan button asli
					$(this).html(buttonSubmit);
				}
				// Jika inputan kosong
				else {
					// Ganti tombol dengan button palsu
					$(this).html(spanSubmit);
				}
			});
			// Efek jika button diklik
			$('#simpanBacklog').click(function() {
				// Jika inputan isi kepentingan kosong
				if (isiKepentingan.val() == '') {
					if (errIsiKepentingan.html() == '') {
						isiKepentingan.attr('style', 'border: 1px solid red;').fadeIn();
						errIsiKepentingan.hide();
						errIsiKepentingan.css('color', 'red');
						errIsiKepentingan.html(errTextIsiKepentingan).slideDown(200);
					} else {
						return;
					}
				}
				// Jika inputan perkiraan waktu kosong
				if (perkiraanWaktu.val() == '') {
					if (errPerkiraanWaktu.html() == '') {
						perkiraanWaktu.attr('style', 'border: 1px solid red;').fadeIn();
						errPerkiraanWaktu.hide();
						errPerkiraanWaktu.css('color', 'red');
						errPerkiraanWaktu.html(errTextPerkiraanWaktu).slideDown(200);
					} else {
						return;
					}
				}
				// Jika kedua inputan kosong
				if (isiKepentingan.val() == '' && perkiraanWaktu.val() == '') {
					if (errIsiKepentingan.html() == '' && errPerkiraanWaktu.html() == '') {
						isiKepentingan.attr('style', 'border: 1px solid red;').fadeIn();
						errIsiKepentingan.hide();
						errIsiKepentingan.css('color', 'red');
						errIsiKepentingan.html(errTextIsiKepentingan).slideDown(200);
						perkiraanWaktu.attr('style', 'border: 1px solid red;').fadeIn();
						errPerkiraanWaktu.hide();
						errPerkiraanWaktu.css('color', 'red');
						errPerkiraanWaktu.html(errTextPerkiraanWaktu).slideDown(200);
					} else {
						return;
					}
				}
			});
		}
		// Jika inputan select Sprint kosong
		if ($(this).val() == '') {
			// Munculkan tombol asli
			simpanBacklog.html(buttonSubmit);
		}
		// Jika inputan select Sprint tidak kosong
		else {
			// Jika inputan isi kepentingan dan perkiraan waktu tidak kosong
			if (isiKepentingan.val() != '' && perkiraanWaktu.val() != '') {
				// Munculkan tombol asli
				simpanBacklog.html(buttonSubmit);
			}
			// Jika keduanya kosong
			else {
				// Munculkan tombol palsu
				simpanBacklog.html(spanSubmit);
			}
		}
	});
});