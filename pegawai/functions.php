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

    $nip = trim(mysqli_real_escape_string($conn, $data['nip']));
    $nama = trim(mysqli_real_escape_string($conn, $data['nama']));
    $jk = trim(mysqli_real_escape_string($conn, $data['jk']));
    $jabatan = trim(mysqli_real_escape_string($conn, $data['jabatan']));
    $golongan = trim(mysqli_real_escape_string($conn, $data['golongan']));
    $status = trim(mysqli_real_escape_string($conn, $data['status']));
    $ja = (int) trim(mysqli_real_escape_string($conn, $data['ja']));    

    $query = "INSERT INTO pegawai VALUES ('$nip','$nama','$jk','$jabatan','$golongan','$status','$ja')";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}


function hapus($id)
{
    global $conn;
    $query = "DELETE FROM pegawai WHERE nip = '$id'";
    $rs = mysqli_query($conn, $query) or die(mysqli_error($conn));    
    return mysqli_affected_rows($conn);
}

function edit($data)
{
    global $conn;
    $nip = trim(mysqli_real_escape_string($conn, $data['nip']));
    $nama = trim(mysqli_real_escape_string($conn, $data['nama']));
    $jk = trim(mysqli_real_escape_string($conn, $data['jk']));
    $jabatan = trim(mysqli_real_escape_string($conn, $data['jabatan']));
    $golongan = (int)trim(mysqli_real_escape_string($conn, $data['golongan']));
    $status = trim(mysqli_real_escape_string($conn, $data['status']));
    $ja = (int) trim(mysqli_real_escape_string($conn, $data['ja']));  

    $query = "UPDATE pegawai SET 
    nama_pegawai = '$nama',
    gender = '$jk',
    kode_jabatan = '$jabatan',
    kode_golongan = $golongan,
    `status` = '$status',
    `jumlah_anak` = $ja
    WHERE nip = '$nip'";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}
