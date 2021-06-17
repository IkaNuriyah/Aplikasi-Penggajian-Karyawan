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

$jabatans = query("SELECT * FROM jabatan");
$golongans = query("SELECT * FROM golongan");

?>

<div class="box">
    <h1>Pegawai</h1>
    <h4>
        <small>Tambah Data Pegawai</small>
        <div class="pull-right">
            <a href="data.php" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-chevron-left"></i>Kembali</a>
        </div>
    </h4>

    <div class="box">
        <div class="col-lg-6 col-lg-offset-2">
            <form action="" method="post">
                <div class="form-group">
                    <label for="nip">NIP</label>
                    <input type="text" name="nip" class="form-control" id="nip" required autofocus autocomplete="off" placeholder="Masukkan NIP pegawai">
                </div>
                <div class="form-group">
                    <label for="nama">Nama Pegawai</label>
                    <input type="text" name="nama" class="form-control" id="nama" required autofocus autocomplete="off" placeholder="Masukkan nama pegawai">
                </div>
                <div class="form-group">
                    <label>Jenis Kelamin</label>
                    <div class="radio-inline">
                        <input type="radio" name="jk" class="radio-inline" id="jkl" value="laki-laki"><label for="jkl">Laki-laki </label>                   
                    </div>
                    <div class="radio-inline">
                        <input type="radio" name="jk" class="radio-inline" id="jkp" value="perempuan"><label for="jkp">Perempuan</label>                   
                    </div>


                </div>
                <div class="form-group">
                    <label for="jabatan">Jabatan : </label>
                    <select name="jabatan" id="jabatan" class="form-control" required>
                        <option value="">Silahkan Pilih Jabatan</option>
                        <?php foreach ($jabatans as $jabatan) : ?>
                        <option value="<?= $jabatan['kode_jabatan'] ?>"><?= $jabatan['nama_jabatan'] ?></option>
                        <?php
                        endforeach;
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="golongan">Golongan : </label>
                    <select name="golongan" id="golongan" class="form-control" required>
                        <option value="">Silahkan Pilih Golongan</option>
                        <?php foreach ($golongans as $golongan) : ?>
                        <option value="<?= $golongan['kode_golongan'] ?>"><?= $golongan['nama_golongan'] ?></option>
                        <?php
                        endforeach;
                        ?>
                    </select>
                </div> 
                <div class="form-group">
                    <label for="status">Status Pernikahan Pegawai</label>
                    <input type="text" name="status" class="form-control" id="status" required autofocus autocomplete="off" placeholder="Masukkan Status Pernikahan">
                </div>
                <div class="form-group">
                    <label for="ja">Jumlah Anak</label>
                    <input type="number" name="ja" class="form-control" id="ja" required autofocus autocomplete="off" placeholder="Masukkan Jumlah Anak pegawai">
                </div>                                                               
                <div class="form-group pull-right">
                    <input type="submit" name="tambah" value="TAMBAH" class="btn btn-success">
                </div>
            </form>
        </div>
    </div>
</div>

<?php require '../_footer.php'; ?>