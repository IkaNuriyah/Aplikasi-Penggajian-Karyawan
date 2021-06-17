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
        
    </script>";
    }
}

?>

<div class="box">
    <h1>Golongan</h1>
    <h4>
        <small>Tambah Data Golongan</small>
        <div class="pull-right">
            <a href="data.php" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-chevron-left"></i>kembali</a>
        </div>
    </h4>

    <div class="box">
        <div class="col-lg-6 col-lg-offset-2">
            <form action="" method="post">
                <div class="form-group">
                    <label for="nama">Nama Golongan</label>
                    <input type="text" name="nama" class="form-control" id="nama" required autofocus autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="tjSuamiIstri">Tunjangan Suami Istri</label>
                    <input type="number" name="tjSuamiIstri" class="form-control" id="tjSuamiIstri" required autofocus autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="tjAnak">Tunjangan Anak</label>
                    <input type="number" name="tjAnak" class="form-control" id="tjAnak" required autofocus autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="uMakan">Uang Makan</label>
                    <input type="number" name="uMakan" class="form-control" id="uMakan" required autofocus autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="uLembur">Uang Lembur</label>
                    <input type="number" name="uLembur" class="form-control" id="uLembur" required autofocus autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="askes">Askes</label>
                    <input type="number" name="askes" class="form-control" id="askes" required autofocus autocomplete="off">
                </div>

                <div class="form-group pull-right">
                    <input type="submit" name="tambah" value="Tambah" class="btn btn-success">
                </div>
            </form>
        </div>
    </div>
</div>

<?php require '../_footer.php'; ?>