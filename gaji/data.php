<?php
include_once('../_header.php');
include('functions.php');
$bulan = date('m');
$tahun = date('Y');
$waktu = $bulan.$tahun;   
if(isset($_POST['submitBl'])){
    if(isset($_POST['bulan']) ){
        $bulan = $_POST['bulan'];    
    }
    if(isset($_POST['tahun']) ){
            $tahun = $_POST['tahun'];                
    }
    if(isset($_POST['bulan']) && isset($_POST['tahun'])){
        $waktu = $_POST['bulan'].$_POST['tahun'];    
    }
    if(empty($_POST['bulan']) || empty($_POST['tahun'])){
        $waktu = date('m').date('Y');
    }
}

$query = "SELECT pegawai.nip,pegawai.nama_pegawai,jabatan.nama_jabatan,golongan.nama_golongan,pegawai.`status`,pegawai.jumlah_anak,
jabatan.gapok,jabatan.tunjangan,
ROUND((jabatan.gapok / 20)) AS gajiPerhari,
IF(pegawai.status ='menikah',golongan.tunjangan_suami_istri,0) AS tjsi,
IF(pegawai.status ='menikah',golongan.tunjangan_anak*pegawai.jumlah_anak,0) AS tjanak,
(golongan.uang_makan * gaji.masuk) as uangMakan,
(gaji.lembur * golongan.uang_lembur) as uangLembur,
golongan.askes,
ROUND((SELECT gajiPerhari) * gaji.alpa) as potonganGaji,
((SELECT gajiPerhari)*gaji.masuk + jabatan.tunjangan +(SELECT tjsi) +(SELECT tjanak) +(SELECT uangMakan) + (SELECT uangLembur)+ askes) as pendapatan ,
(SELECT pendapatan) - (SELECT potonganGaji)as totalGaji
FROM pegawai
INNER JOIN gaji ON gaji.nip = pegawai.nip
INNER JOIN golongan ON golongan.kode_golongan = pegawai.kode_golongan
INNER JOIN jabatan ON jabatan.kode_jabatan = pegawai.kode_jabatan
WHERE gaji.bulan = '$waktu'
ORDER BY gaji.bulan";
$datas = query($query);



?>

<div class="box">
    <font style="font-family: Jokerman" color="#376E6F">
        <h2><b> GAJI KARYAWAN </b></h2>
    </font>
    
    <br>        
        <div class="panel-body">
            <form action="" method="post" class="form-inline">
                <div class="form-group">
                    <label for="bulan">Bulan</label>
                    <select name="bulan" id="bulan" class="form-control">
                        <option value=""> ~ Pilih ~</option>
                        <option value="01">Januari</option>
                        <option value="02">Februari</option>
                        <option value="03">Maret</option>
                        <option value="04">April</option>
                        <option value="05">Mei</option>
                        <option value="06">Juni</option>
                        <option value="07">Juli</option>
                        <option value="08">Agustus</option>
                        <option value="09">September</option>
                        <option value="10">Oktober</option>
                        <option value="11">November</option>
                        <option value="12">Desember</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="tahun">Tahun</label>
                    <select name="tahun" id="tahun" class="form-control">
                        <option value=""> ~ Pilih ~</option>
                        <?php
                            $tahun = date('Y');
                            for($x = $tahun; $x <= date('Y')+4; $x++){
                        ?>
                            <option value="<?= $x ;?>"><?= $x ;?></option>
                        <?php        
                            }
                        ?>
                    </select>

                </div>
                <button type="submit" value="submit" name="submitBl" class="btn btn-primary">Tampil Data</button>
            </form>            
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover" id="gaji">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>NIP</th>
                        <th>Nama Pegawai</th>
                        <th>Nama Jabatan</th>
                        <th>Nama Golongan</th>
                        <th>Status</th>
                        <th>Jumlah Anak</th>
                        <th>Gapok</th>
                        <th>Tunjangan Jabatan</th>
                        <th>Gaji Perhari</th>
                        <th>Tunjangan Suami Istri</th>
                        <th>Tunjangan Anak</th>
                        <th>Uang Makan</th>
                        <th>Uang Lembur</th>
                        <th>Akses</th>
                        <th>Potongan</th>
                        <th>Total Gaji</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $no = 1;
                        foreach ($datas as $data) :
                    ?>       
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $data['nip']; ?></td>
                            <td><?= $data['nama_pegawai']; ?></td>
                            <td><?= $data['nama_jabatan']; ?></td>
                            <td><?= $data['nama_golongan']; ?></td>
                            <td><?= $data['status']; ?></td>
                            <td><?= $data['jumlah_anak']; ?></td>
                            <td><?= $data['gapok']; ?></td>
                            <td><?= $data['tunjangan']; ?></td>
                            <td><?= $data['gajiPerhari']; ?></td>
                            <td><?= $data['tjsi']; ?></td>
                            <td><?= $data['tjanak']; ?></td>
                            <td><?= $data['uangMakan']; ?></td>
                            <td><?= $data['uangLembur']; ?></td>
                            <td><?= $data['askes']; ?></td>
                            <td><?= $data['potonganGaji']; ?></td>
                            <td><?= $data['pendapatan']; ?></td>
                           


                        </tr>
                    <?php                                   
                        endforeach;
                    ?>

                </tbody>
            </table>        
        </div>

        <div class="panel-footer">
                <div class="alert alert-info">Bulan = <?= $bulan . ", tahun " .$tahun ?></div>
                <center><a href="cetak.php?waktu=<?= $waktu; ?>" class="btn btn-primary" id="Cetak">Export pdf</a>
                </center>
        </div>

    <a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Toggle Menu</a>

</div>



<?php include('../_footer.php'); ?>