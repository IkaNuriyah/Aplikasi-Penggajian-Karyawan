<?php
require 'functions.php';
$id = $_GET['nip'];
 

if (hapus($id) > 0) {
    echo "<script>
                alert('Data berhasil dihapus');
                document.location.href = 'data.php';
            </script>";
} else {
    echo "<script>
        alert('Data Gagal dihapus');
        document.location.href = 'data.php';    
    </script>";
}
