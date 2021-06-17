<?php
include_once('../_header.php');
include_once('functions.php');
 
$jmlDataPerhalaman = 3;
$jmlhSemuaData = count(query("SELECT * FROM pegawai"));
$jmlHalaman = ceil($jmlhSemuaData / $jmlDataPerhalaman);
$halAktif = (isset($_GET['halaman'])) ? $_GET['halaman'] : 1;
$awalData = ($jmlDataPerhalaman * $halAktif) - $jmlDataPerhalaman;

if (isset($_POST['submit'])) {
    $cari = $_POST['cari'];
    if (empty($cari)) {
        $datas = query("SELECT pegawai.*,golongan.kode_golongan as kg,golongan.nama_golongan as ng,jabatan.kode_jabatan as kj, jabatan.nama_jabatan as nj FROM `pegawai`,jabatan,golongan WHERE pegawai.kode_jabatan = jabatan.kode_jabatan AND golongan.kode_golongan = pegawai.kode_golongan ");
    } else {
        $datas = query("SELECT pegawai.*,golongan.kode_golongan as kg,golongan.nama_golongan as ng,jabatan.kode_jabatan as kj, jabatan.nama_jabatan as nj FROM `pegawai`,jabatan,golongan WHERE pegawai.kode_jabatan = jabatan.kode_jabatan AND golongan.kode_golongan = pegawai.kode_golongan AND pegawai.nama_pegawai LIKE '%$cari%' ");
    }
} else {
    $datas = query("SELECT pegawai.*,golongan.kode_golongan as kg,golongan.nama_golongan as ng,jabatan.kode_jabatan as kj, jabatan.nama_jabatan as nj FROM `pegawai`,jabatan,golongan WHERE pegawai.kode_jabatan = jabatan.kode_jabatan AND golongan.kode_golongan = pegawai.kode_golongan ORDER BY nama_pegawai ASC ");
}

?>

<div class="box">
    <font style="font-family: Jokerman" color="#376E6F">
        <h2><b> PEGAWAI </b></h2>
    </font>

    <br>
    <h4>
        <div class="pull-right">
            <a href="" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-refresh"></i></a>
            <a href="tambah.php" class="btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i>Tambah Pegawai</a>
        </div>
    </h4>
    <div style="margin-bottom:25px;">
        <form action="" method="post" class="form-inline">
            <div class="form-group">
                <input type="text" name="cari" class="form-control" placeholder="Cari Data pegawai" autocomplete="off" size="25">
            </div>
            <div class="form-group">
                <button type="submit" name="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search" aria-hidden="true" value="Tampilkan Data"></span></button>
            </div>
        </form>
    </div>
    <?php if ($cekKetemu = count($datas) <= 0) : ?>
        <?php $notFound = true; ?>
        <p style="color : red; font-weight:bold; font-size:40px;">Maaf,Data tidak ditemukan</p>
    <?php endif; ?>
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover" id="tPegawai">
            <tr>
                <th>No.</th>
                <th>NIP</th>
                <th>Nama Pegawai </th>
                <th>Gender </th>
                <th>Jabatan </th>
                <th>Golongan </th>
                <th>Status </th>
                <th>Jumlah anak </th>
                <th><i class="glyphicon glyphicon-cog"></i></th>
            </tr>
            <?php
            $no_urut = $awalData + 1;
            foreach ($datas as $data) :
                ?>
                <tr>
                    <td><?= $no_urut; ?></td>
                    <td><?= $data['nip']; ?></td>
                    <td><?= $data['nama_pegawai']; ?></td>
                    <td><?= $data['gender']; ?></td>
                    <td><?= $data['nj']; ?></td>
                    <td><?= $data['ng']; ?></td>
                    <td><?= $data['status']; ?></td>
                    <td><?= $data['jumlah_anak']; ?></td>
                    <td class="text-center">
                        <a href="edit.php?nip=<?= $data['nip']; ?>" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-edit"></i></a>
                        <a href="hapus.php?nip=<?= $data['nip']; ?>" onclick="return confirm('Yakin untuk menghapus?');" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a>
                    </td>
                </tr>
                <?php
                $no_urut++;
            endforeach;
            ?>
        </table>         
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#tPegawai').DataTable({
            columnDefs: [{
                "searchable": true,
                "orderable": true,
                "targets": [0, 6]
            }],
            "order": [1, "asc"]            
        })

    })    
</script>

<?php include('../_footer.php'); ?>