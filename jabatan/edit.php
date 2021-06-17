<?php
require '../_header.php';
require 'functions.php';

$kode = $_GET['kode'];
$dataEdit = query("SELECT * FROM jabatan WHERE kode_jabatan = '$kode'")[0];



if (isset($_POST['edit'])) {
    if (edit($_POST) > 0) {
        echo "<script>
                alert('Data berhasil diubah');
                document.location.href = 'data.php';
            </script>";
    } else {
        echo "<script>
        alert('Data Gagal diubah');
        document.location.href = 'data.php';
    </script>";
    }
}

?>

<div class="box">
    <h1>Pegawai</h1>
    <h4>
        <small>Ubah Data Pegawai</small>
        <div class="pull-right">
            <a href="data.php" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-chevron-left"></i>kembali</a>
        </div>
    </h4>

    <?php

    ?>

    <div class="box">
        <div class="col-lg-6 col-lg-offset-2">
                        <form action="" method="post">
                <div class="form-group">
                    <input type="hidden" name="kode" class="form-control" id="kode" value="<?= $dataEdit['kode_jabatan'] ?>">
                </div>
                <div class="form-group">
                    <label for="nama">nama jabatan</label>
                    <input type="text" name="nama" class="form-control" id="nama" required autofocus autocomplete="off" placeholder="Masukkan nama jabatan" value="<?= $dataEdit['nama_jabatan'] ?>">
                </div>
                <div class="form-group">
                    <label for="gapok">Gaji Pokok</label>
                    <input type="text" name="gapok" class="form-control" id="gapok" required autofocus autocomplete="off" placeholder="Masukkan Gaji Pokok" value="<?= $dataEdit['gapok'] ?>">
                </div>
                <div class="form-group">
                    <label for="tunjangan">Tunjangan jabatan</label>
                    <input type="text" name="tunjangan" class="form-control" id="tunjangan" required autofocus autocomplete="off" placeholder="Masukkan tunjangan jabatan" value="<?= $dataEdit['tunjangan'] ?>">
                </div>
                <div class="form-group pull-right">
                    <input type="submit" name="edit" value="Edit" class="btn btn-success">
                </div>
            </form>
        </div>
    </div>
</div>

<?php require '../_footer.php'; ?>