<?php
include_once('../_header.php');
include_once('functions.php');


$data = query("SELECT * FROM golongan");

?>

<div class="box">
    <font style="font-family: Jokerman" color="#376E6F">
        <h2><b> GOLONGAN </b></h2>
    </font>

    <br>
    <h4>
        <div class="">
            <a href="" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-refresh"></i></a>
            <a href="tambah.php" class="btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i>Tambah Golongan</a>
        </div>
    </h4>
    <form method="post" name="proses" action="">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover" id="golongan">
                <thead>
                    <tr>
                        <th>
                            <center>
                                <input type="checkbox" name="selectAll" id="selectAll" value="all">
                            </center>
                        </th>
                        <th>No.</th>
                        <th>Nama Golongan</th>
                        <th>Tunjangan Suami Istri</th>
                        <th>Tunjangan Anak</th>
                        <th>Uang Makan</th>
                        <th>Uang Lembur</th>
                        <th>Askes</th>
                        <th><i class="glyphicon glyphicon-cog"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    foreach ($data as $golongan) :
                    ?>
                        <tr>
                            <td class="text-center">
                                <center>
                                    <input type="checkbox" name="checked[]" class="check" value="<?= $golongan['kode_golongan'];  ?>">
                                </center>
                            </td>
                            <td><?= $i;  ?></td>
                            <td><?= $golongan['nama_golongan']; ?></td>
                            <td><?= $golongan['tunjangan_suami_istri']; ?></td>
                            <td><?= $golongan['tunjangan_anak']; ?></td>
                            <td><?= $golongan['uang_makan']; ?></td>
                            <td><?= $golongan['uang_lembur']; ?></td>
                            <td><?= $golongan['askes']; ?></td>
                            <td align="center">
                                <a href="edit.php?p=<?= $golongan['kode_golongan']; ?>" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-cog-edit">EDIT</i></a>

                            </td>
                        </tr>
                    <?php
                        $i++;
                    endforeach;
                    ?>
                </tbody>
            </table>
        </div>
        <div class="box pull-right">
            <button class="btn btn-warning btn-sm glyphicon glyphicon-trash" onclick="hapus()">HAPUS</button>
        </div>
    </form>

</div>
<script>
    $(document).ready(function() {

        // $('#golongan').DataTable({
        //     columnDefs: [{
        //         "searchable": true,
        //         "orderable": true,
        //         "targets": [0, 6]
        //     }],
        //     "order": [1, "asc"]
        // });

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

    function hapus() {
        var conf = confirm('anda yakin akan menghapus data ?');
        if (conf) {
            document.proses.action = 'hapus.php';
            document.proses.submit();
        }
    }
</script>

<?php include('../_footer.php'); ?>