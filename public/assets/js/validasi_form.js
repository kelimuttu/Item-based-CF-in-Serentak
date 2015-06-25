function daftar(){
	$('#errmessage').remove();

	event.preventDefault();

	var nama_lengkap = document.getElementsByName('nama_lengkap')[0].value.trim();
	var password = document.getElementsByName('pass')[0].value;

	var email = document.getElementsByName('email')[0].value.trim();
	var email_confirm = document.getElementsByName('email_confirm')[0].value.trim();
	var nomor_telepon = document.getElementsByName('nomor_telepon')[0].value.trim();

	var check;

	if (nama_lengkap.length == 0 || password.length == 0 || email.length == 0 || email_confirm.length == 0 || nomor_telepon.length == 0){
		check = false;
	} else {
		check = true;
	}

	if (check){
		$.ajax({
			type: 'post',
			url: base_url + '/validasi_daftar',
			data: {email: email, email_confirm: email_confirm, nomor_telepon: nomor_telepon},
			dataType: 'json'
		}).success(function(data){
			if (data.status == 'sukses'){
				console.log('success');
				$('#form_daftar').submit();
			} else {
				var errmessage;
				switch(data.issue){
					case 'bukan_email':
						errmessage = 'Masukkan e-mail dengan benar';
						break;
					case 'email_terpakai':
						errmessage = 'E-mail yang Anda masukkan telah terdaftar';
						break;
					case 'email_tidak_sama':
						errmessage = 'E-mail konfirmasi yang Anda masukkan tidak cocok';
						break;
					case 'bukan_nomor_telepon':
						errmessage = 'Masukkan nomor telepon secara tepat';
						break;
				}
				$('.signup-panel').prepend('<div class="formInput" id="errmessage">' + errmessage + '</div>');
			}
		});
	} else {
		$('.signup-panel').prepend('<div class="formInput" id="errmessage">' + 'Isi data Anda secara lengkap' + '</div>');
	}
}
