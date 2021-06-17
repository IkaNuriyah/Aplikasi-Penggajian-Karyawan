<?php
require 'functions.php';
$counCek = $cek = 0;
if (empty($_POST['checked'])) {
    echo "<script>
        alert('Tidak ada data yang dipilih!');
        document.location.href= 'data.php';
    </script>";
} else {
    $hapus = "";
    //$check berasal dari form yang tipe checkbox yang diceklis berisi nilai id
    $checked = $_POST['checked'];
    $count = count($checked);


    for ($k = 0; $k < $count; $k++) {
        // $hapus = mysqli_query($conn, "DELETE FROM dokter WHERE id_dokter = '$checked[$k]'");
        // $cek = mysqli_affected_rows($conn);
        $id = (int)$checked[$k];
        $cek += hapus($id);
        if ($cek >= 1) {
            $counCek = $counCek + 1;
        } else {
            $counCek = 0;
        }
    }
    if ($counCek >= 1) {
        echo "<script>
            alert('$counCek Data berhasil dihapus!');
            document.location.href = 'data.php';
        </script>";
    } else{
        echo "<script>
        alert('Data Gagal dihapus!');
        document.location.href = 'data.php';
    </script>";
    }
    //hapusnya uda bisa , tinggal benerin logika di alert nya (maksudnya waktu data gagal dihapus)
}
