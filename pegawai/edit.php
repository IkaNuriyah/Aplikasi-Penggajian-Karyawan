<?php
require '../_header.php';
require 'functions.php';
require_once '../config/config.php';
$nip = $_GET['nip'];
$dataEdit = query("SELECT * FROM pegawai WHERE nip = '$nip'")[0];
$jabatans = query("SELECT * FROM jabatan");
$golongans = query("SELECT * FROM golongan");
$cekLaki = $cekPerempuan = '';
if($dataEdit['gender'] ==='laki-laki'){
    $cekLaki = 'checked';
}else{
    $cekPerempuan = 'checked';
}



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
                    <input type="hidden" name="nip" class="form-control" id="nip" value="<?= $dataEdit['nip'] ?>">
                </div>
                <div class="form-group">
                    <label for="nama">Nama Pegawai</label>
                    <input type="text" name="nama" class="form-control" id="nama" required autofocus autocomplete="off" placeholder="Masukkan nama pegawai" value="<?= $dataEdit['nama_pegawai'] ?>">
                </div>
                <div class="form-group">
                    <label>Jenis Kelamin</label>
                    <div class="radio-inline">
                        <input type="radio" name="jk" class="radio-inline" id="jkl" value="laki-laki" <?= $cekLaki; ?> ><label for="jkl">Laki-laki </label>                   
                    </div>
                    <div class="radio-inline">
                        <input type="radio" name="jk" class="radio-inline" id="jkp" value="perempuan" <?= $cekPerempuan; ?>><label for="jkp">Perempuan</label>                   
                    </div>


                </div>
                <div class="form-group">
                    <label for="jabatan">Jabatan : </label>
                    <select name="jabatan" id="jabatan" class="form-control" required>
                        <option value="">Silahkan Pilih Jabatan</option>
                        <?php foreach ($jabatans as $jabatan) : ?>
                            <option value="<?= $jabatan['kode_jabatan']; ?>"                             
                            <?php if($jabatan['kode_jabatan'] === $dataEdit['kode_jabatan']){ echo 'selected';} ?>><?= $jabatan['nama_jabatan']; ?>
                            </option>
                        <?php
                        endforeach;
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="golongan">Golongan : </label>
                    <select name="golongan" id="golongan" class="form-control" required>
                        <option value="">Silahkan Pilih golongan</option>
                        <?php foreach ($golongans as $golongan) : ?>
                            <option value="<?= $golongan['kode_golongan']; ?>"            
                                
                            <?php if($golongan['kode_golongan'] === $dataEdit['kode_golongan']){ echo 'selected';}
                            ?>><?= $golongan['nama_golongan']; ?>
                            </option>
                        <?php
                        endforeach;
                        ?>
                    </select>
                </div> 
                <div class="form-group">
                    <label for="status">Status Pernikahan Pegawai</label>
                    <input type="text" name="status" class="form-control" id="status" required autofocus autocomplete="off" placeholder="Masukkan Status Pernikahan" value="<?= $dataEdit['status']; ?>">
                </div>
                <div class="form-group">
                    <label for="ja">Jumlah Anak</label>
                    <input type="number" name="ja" class="form-control" id="ja" required autofocus autocomplete="off" placeholder="Masukkan Jumlah Anak pegawai" value="<?= $dataEdit['jumlah_anak'] ?>">
                </div>                                                               
                <div class="form-group pull-right">
                    <input type="submit" name="edit" value="Edit" class="btn btn-success">
                </div>
            </form>
        </div>
    </div>
</div>

<?php require '../_footer.php'; ?>