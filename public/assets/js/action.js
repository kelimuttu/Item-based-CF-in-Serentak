function hapus_user(id){
    var konfirmasi = confirm('Apakah anda yakin ingin menghapus pengguna ini?');
    if(konfirmasi===true){
        $.post('/beranda/users/hapus/'+id, function(data) {
            window.location.href = "";
        });
    }
}

function hapus_komunitas(id){
    var konfirmasi = confirm('Apakah anda yakin ingin menghapus komunitas ini?');
    if(konfirmasi===true){
        $.post('/beranda/komunitas/hapus/'+id, function(data) {
            window.location.href = "";
        });
    }
}

function hapus_acara(id){
    var konfirmasi = confirm('Apakah anda yakin ingin menghapus acara ini?');
    if(konfirmasi===true){
        $.post('/beranda/acara/hapus/'+id, function(data) {
            window.location.href = "";
        });
    }
}