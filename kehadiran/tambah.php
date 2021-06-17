<?php
include_once('../_header.php');
include_once('functions.php');

$bulan = date('m');
$tahun = date('Y');
$waktu = $bulan.$tahun;
$query = "SELECT pegawai.nip,pegawai.nama_pegawai,jabatan.nama_jabatan,golongan.nama_golongan FROM `pegawai` INNER JOIN jabatan ON pegawai.kode_jabatan = jabatan.kode_jabatan INNER JOIN golongan ON pegawai.kode_golongan = golongan.kode_golongan WHERE NOT EXISTS ( SELECT gaji.nip FROM gaji WHERE gaji.nip = pegawai.nip ";
if(isset($_POST['submit'])){
    if(empty($_POST['sakit']) || empty($_POST['izin']) || empty($_POST['masuk']) || empty($_POST['alpa']) || empty($_POST['lembur']) || empty($_POST['potongan']) || empty($_POST['sakit'])){
        header('Location: data.php');
        exit();
    }else{        
        if(tambah($_POST) > 0){
            echo "<script>
            alert('Data berhasil ditambah');
            document.location.href = 'data.php';
        </script>";
        } else {
            echo "<script>
            alert('Data Gagal ditambah');
            document.location.href = 'data.php';
        </script>";
        }
    }
}
$where = "AND gaji.bulan LIKE '%$waktu%' )";
$datas = query($query.$where);
?>
    <div class="box">
    <h1>Kehadiran</h1>
    <h4>
        <small>Tambah Data Kehadiran Karyawan</small> </h4>
        <div class="panel-body">
            <form action="" method="post" class="form-inline" id="form-kehadiran">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="pasien">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>NIP</th>
                            <th>Nama Pegawai</th>
                            <th>Jabatan</th>
                            <th>Masuk</th>
                            <th>Sakit</th>
                            <th>Izin</th>
                            <th>Alpa</th>
                            <th>Lembur</th>
                            <th>Potongan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $no = 1;
                            if(count($datas) < 1){
                        ?>
                            <td colspan="9" style="color:blue;">
                             <center> <h2>Pegawai Sudah didata semua pada bulan ini</h2>
                             </center>
                             </td>
                        <?php
                                
                            }
                            foreach ($datas as $data) :
                        ?>       
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $data['nip']; ?></td>
                                <td><?= $data['nama_pegawai']; ?></td>
                                <td><?= $data['nama_jabatan']; ?></td>

                                    <td>                                    <input type="hidden" name="nip[]" value="<?= $data['nip']; ?>">
                                    <input type="hidden" name="waktu[]" value="<?= $waktu; ?>">
                                    <input type="number" class="form-control" name="masuk[]" id="masuk" size="5">
                                    </td>
                                    <td>
                                        <input type="number" class="form-control" name="sakit[]" id="sakit" size="5">
                                    </td>
                                    <td>
                                        <input type="number" class="form-control" name="izin[]" id="izin" size="5">
                                    </td>
                                    <td>
                                        <input type="number" class="form-control" name="alpa[]" id="alpa" size="5">
                                    </td>
                                    <td>
                                        <input type="number" class="form-control" name="lembur[]" id="lembur" size="5">
                                    </td>
                                    <td>
                                        <input type="number" class="form-control" name="potongan[]" id="potongan" size="7">
                                    </td>
                            </tr>
                        <?php                                   
                            endforeach;
                        ?>

                    </tbody>
                </table>
                <button name="submit" value="submit" class="btn btn-warning btn-md">Save Data!
                 </button>
            </form>           
        </div>

        <div class="panel-footer">
                <div class="alert alert-info">Bulan = <?= $bulan . ", tahun".$tahun ?></div>
        </div>

    </div>
    <a href="data.php" class="btn btn-primary" id="">KEMBALI</a>   
    <a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Toggle Menu</a>   
<?php include('../_footer.php'); ?>