<?php
require_once '../config/config.php';
require '../_asset/libs/vendor/autoload.php';

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;

function query($query)
{
    global $conn;

    $result = mysqli_query($conn, $query);
    $rows = [];
    if (!$result) {
        echo mysqli_error($conn);
    } else {
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
    }
    return $rows;
}

function tambah($data)
{
    global $conn;

    $kode = trim(mysqli_real_escape_string($conn, $data['kode']));
    $nama = trim(mysqli_real_escape_string($conn, $data['nama']));
    $gapok = (int)trim(mysqli_real_escape_string($conn, $data['gapok']));
    $tunjangan = (int)trim(mysqli_real_escape_string($conn, $data['tunjangan']));


    $query = "INSERT INTO jabatan(kode_jabatan,nama_jabatan,gapok,tunjangan) VALUES ('$kode','$nama',$gapok,$tunjangan)";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function hapus($id)
{
    global $conn;
    $query = "DELETE FROM jabatan WHERE kode_jabatan = '$id'";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function edit($data)
{
    global $conn;
    $kode = trim(mysqli_real_escape_string($conn, $data['kode']));
    $nama = trim(mysqli_real_escape_string($conn, $data['nama']));
    $gapok = (int)trim(mysqli_real_escape_string($conn, $data['gapok']));
    $tunjangan = (int)trim(mysqli_real_escape_string($conn, $data['tunjangan']));

    $query = "UPDATE jabatan SET 
    nama_jabatan = '$nama',
    gapok = '$gapok',
    tunjangan = $tunjangan
    WHERE kode_jabatan = '$kode'";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}


if (isset($_POST['submitTambah'])) {
    for ($i = 1; $i <= $_POST['total']; $i++) {
        $uuid4 = Uuid::uuid4()->toString();
        $nama = trim(mysqli_real_escape_string($conn, $_POST['nama-' . $i]));
        $gedung = trim(mysqli_real_escape_string($conn, $_POST['gedung-' . $i]));
        $query = mysqli_query($conn, "INSERT INTO poliklinik VALUES ('$uuid4','$nama','$gedung')") or die(mysqli_error($conn));
    }
    if ($query) {
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

if (isset($_POST['submitEdit'])) {
    for ($i = 0; $i < count($_POST['id']); $i++) {
        $id = $_POST['id'][$i];
        $nama = $_POST['nama'][$i];;
        $gedung = $_POST['gedung'][$i];
        $query = mysqli_query($conn, "UPDATE poliklinik SET nama_poli = '$nama', gedung = '$gedung' WHERE id_poli = '$id'") or die(mysqli_error($conn));
    }
    if ($query) {
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
