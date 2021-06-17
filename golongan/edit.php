<?php
require '../_header.php';
require 'functions.php';

$id = $_GET['p'];
$data = query("SELECT * FROM golongan WHERE kode_golongan = $id")[0];

if (isset($_POST['edit'])) {

    if (edit($_POST) > 0) {
        echo "<script>
                alert('Data Berhasil diedit');
                document.location.href = 'data.php';
            </script>";
    } else {
        echo "<script>
        alert('Data Gagal diedit');

    </script>";
    }
}

?>


<div class="box">
    <h1>Golongan</h1>
    <h4>
        <small>Edit Data Golongan</small>
        <div class="pull-right">
            <a href="data.php" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-chevron-left"></i>Kembali</a>
        </div>
    </h4>

    <div class="box">
        <div class="col-lg-6 col-lg-offset-2">
            <form action="" method="post">
                <input type="hidden" name="kode" value="<?= $data['kode_golongan'];  ?>">
                <div class="form-group">
                    <label for="nama">Nama Golongan</label>
                    <input type="text" name="nama" class="form-control" id="nama" value="<?= $data['nama_golongan'] ?>">
                </div>
                <div class="form-group">
                    <label for="tjSuamiIstri">Tunjangan Suami IStri</label>
                    <input type="number" name="tjSuamiIstri" class="form-control" id="tjSuamiIstri" value="<?= $data['tunjangan_suami_istri'] ?>">
                </div>
                <div class="form-group">
                    <label for="tjAnak">Tunjangan Anak</label>
                    <input type="number" name="tjAnak" class="form-control" id="tjAnak" value="<?= $data['tunjangan_anak'] ?>">
                </div>
                <div class="form-group">
                    <label for="uMakan">Uang Makan</label>
                    <input type="number" name="uMakan" class="form-control" id="uMakan" value="<?= $data['uang_makan'] ?>">
                </div>
                <div class="form-group">
                    <label for="uLembur">Uang Lembur</label>
                    <input type="number" name="uLembur" class="form-control" id="uLembur" value="<?= $data['uang_lembur'] ?>">
                </div>
                <div class="form-group">
                    <label for="askes">Askes</label>
                    <input type="number" name="askes" class="form-control" id="askes" value="<?= $data['askes'] ?>">
                </div>

                <div class="form-group pull-right">
                    <input type="submit" name="edit" value="Edit" class="btn btn-success">
                </div>           
            </form>
        </div>
    </div>
</div>

<?php require '../_footer.php'; ?>