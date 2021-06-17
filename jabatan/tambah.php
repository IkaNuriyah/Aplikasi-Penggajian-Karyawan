<?php
require '../_header.php';
require 'functions.php';

if (isset($_POST['tambah'])) {
    if (tambah($_POST) > 0) {
        echo "<script>
                alert('Data berhasil ditambahkan');
                document.location.href = 'data.php';
            </script>";
    } else {
        echo "<script>
        alert('Data Gagal ditambahkan');
        document.location.href = 'data.php';
    </script>";
    }
}

?><div class="box">
<h1>Jabatan</h1>
<h4>
    <small>Tambah Data Jabatan</small>
    <div class="pull-right">
        <a href="data.php" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-chevron-left"></i>Kembali</a>
    </div>
</h4>

<div class="box">
    <div class="col-lg-6 col-lg-offset-2">
        <form action="" method="post">

            <div class="form-group">
                <label for="kode">Kode Jabatan</label>
                <input type="text" name="kode" class="form-control" id="kode" required autofocus autocomplete="off" placeholder="Masukkan kode jabatan">
            </div>
            <div class="form-group">
                <label for="nama">Nama Jabatan</label>
                <input type="text" name="nama" class="form-control" id="nama" required autofocus autocomplete="off" placeholder="Masukkan nama jabatan">
            </div>

            <div class="form-group">
                <label for="gapok">Gaji Pokok</label>
                <input type="number" name="gapok" class="form-control" id="gapok" required autofocus autocomplete="off" placeholder="Masukkan gaji pokok">
            </div>
            <div class="form-group">
                <label for="tunjangan">Tunjangan</label>
                <input type="number" name="tunjangan" class="form-control" id="tunjangan" required autofocus autocomplete="off" placeholder="Masukkan tunjangan">
            </div>                                                               
            <div class="form-group pull-right">
                <input type="submit" name="tambah" value="Tambah" class="btn btn-success">
            </div>
        </form>
    </div>
</div>
</div>

<?php require '../_footer.php'; ?>