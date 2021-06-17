<?php
include_once('../_header.php');
include_once('functions.php');


$data = query("SELECT * FROM jabatan ORDER BY kode_jabatan ASC");
?>

<div class="box">
    <font style="font-family: Jokerman" color="#376E6F">
        <h2><b> JABATAN </b></h2>
    </font>

    <br>
    <h4>
        <div class="">
            <a href="" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-refresh"></i></a>
            <a href="tambah.php" class="btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i>Tambah Jabatan</a>
        </div>
    </h4>
    <form method="post" name="proses" action="">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <tr>
                    <th>No.</th>
                    <th>Kode Jabatan</th>
                    <th>Nama Jabatan </th>
                    <th>Gaji Pokok </th>
                    <th>Tunjangan </th>
                    <th>
                        <i class="glyphicon glyphicon-cog"></i>
                    </th>
                </tr>
                <?php
                $i = 1;
                foreach ($data as $jabat) :
                    ?>
                    <tr>
                        <td><?= $i;  ?></td>
                        <td><?= $jabat['kode_jabatan']; ?></td>
                        <td><?= $jabat['nama_jabatan']; ?></td>
                        <td><?= $jabat['gapok']; ?></td>
                        <td><?= $jabat['tunjangan']; ?></td>
                        <td class="text-center">
                            <a href="edit.php?kode=<?= $jabat['kode_jabatan']; ?>" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-edit"></i>
                            </a>
                            <a href="hapus.php?kode=<?= $jabat['kode_jabatan']; ?>" onclick="return confirm('Yakin untuk menghapus?');" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i>
                            </a>
                        </td>
                    </tr>
                <?php
                    $i++;
                endforeach;
                ?>
            </table>
        </div>
    </form>
</div>
<script>
    $(document).ready(function() {
        $('#selectAll').on('click', function() {
            if (this.checked) {
                $('.check').each(function() {
                    this.checked = true;
                })
            } else {
                $('.check').each(function() {
                    this.checked = false;
                })
            }
        });
        $('.check').on('click', function() {
            if ($('.check:checked').length == $('.check').length) {
                $('#selectAll').prop('checked', true)
            } else {
                $('#selectAll').prop('checked', false)
            }
        })
    })

    function edit() {
        document.proses.action = 'edit.php';
        document.proses.submit();
    }

    function hapus() {
        var conf = confirm('anda yakin akan menghapus data ?');
        if (conf) {
            document.proses.action = 'hapus.php';
            document.proses.submit();
        }
    }
</script>

<?php include('../_footer.php'); ?>