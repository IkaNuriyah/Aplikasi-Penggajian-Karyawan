<?php
include_once('../_header.php');
include_once('functions.php');
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
// $datas = query("SELECT gaji.*,pegawai.*,golongan.*,jabatan.* from gaji,pegawai,golongan,jabatan WHERE gaji.nip = pegawai.nip AND pegawai.kode_jabatan = jabatan.kode_jabatan AND pegawai.kode_golongan = golongan.kode_golongan AND gaji.bulan = '$waktu'");
$datas = query("SELECT gaji.*,pegawai.nama_pegawai,pegawai.nip AS nipp ,jabatan.nama_jabatan,golongan.nama_golongan FROM gaji RIGHT JOIN pegawai ON gaji.nip = pegawai.nip RIGHT JOIN jabatan ON pegawai.kode_jabatan = jabatan.kode_jabatan RIGHT JOIN golongan ON pegawai.kode_golongan = golongan.kode_golongan WHERE bulan = '$waktu' ");
?>
    <div class="box">
        <font style="font-family: Jokerman" color="#376E6F">
            <h2><b> KEHADIRAN </b></h2>
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
                <a href="tambah.php" class="btn btn-primary">Tambah data</a>
            </form>            
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover" id="karyawan">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>NIP</th>
                        <th>Nama Pegawai</th>
                        <th>Jabatan</th>
                        <th>Golongan</th>
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
                        foreach ($datas as $data) :
                    ?>       
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $data['nip']; ?></td>
                            <td><?= $data['nama_pegawai']; ?></td>
                            <td><?= $data['nama_jabatan']; ?></td>
                            <td><?= $data['nama_golongan']; ?></td>
                            <?php
                                if($data['bulan'] === null){
                            ?>
                                <td colspan="6">
                                    Data Belum diinput
                                </td>
                            <?php        
                                }else{
                            ?>      
                            <td><?= $data['masuk']; ?></td>
                            <td><?= $data['sakit']; ?></td>
                            <td><?= $data['izin']; ?></td>
                            <td><?= $data['alpa']; ?></td>
                            <td><?= $data['lembur']; ?></td>
                            <td><?= $data['potongan']; ?></td>                              
                            <?php        
                                }
                            ?>

                        </tr>
                    <?php                                   
                        endforeach;
                    ?>

                </tbody>
            </table>        
        </div>

        <div class="panel-footer">
                <div class="alert alert-info">Bulan = <?= $bulan . ", tahun " .$tahun ?></div>
        </div>

    </div>
    
<?php include('../_footer.php'); ?>