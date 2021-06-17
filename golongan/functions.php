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
    $nama = trim(mysqli_real_escape_string($conn, $data['nama']));
    $tjSuamiIstri = (int)trim(mysqli_real_escape_string($conn, $data['tjSuamiIstri']));
    $tjAnak = (int)trim(mysqli_real_escape_string($conn, $data['tjAnak']));
    $uMakan = (int)trim(mysqli_real_escape_string($conn, $data['uMakan']));
    $uLembur = (int)trim(mysqli_real_escape_string($conn, $data['uLembur']));
    $askes = (int)trim(mysqli_real_escape_string($conn, $data['askes']));



    $query = "INSERT INTO golongan(nama_golongan,tunjangan_suami_istri,tunjangan_anak,uang_makan,uang_lembur,askes) VALUES ('$nama',$tjSuamiIstri,$tjAnak,$uMakan,$uLembur,$askes)";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}


function hapus($id)
{
    global $conn;
    $query = "DELETE FROM golongan WHERE kode_golongan = $id";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function edit($data)
{
    global $conn;
    $kode = $data['kode'];
    $nama = trim(mysqli_real_escape_string($conn, $data['nama']));
    $tjSuamiIstri = (int)trim(mysqli_real_escape_string($conn, $data['tjSuamiIstri']));
    $tjAnak = (int)trim(mysqli_real_escape_string($conn, $data['tjAnak']));
    $uMakan = (int)trim(mysqli_real_escape_string($conn, $data['uMakan']));
    $uLembur = (int)trim(mysqli_real_escape_string($conn, $data['uLembur']));
    $askes = (int)trim(mysqli_real_escape_string($conn, $data['askes']));

    $query = "UPDATE golongan SET 
    nama_golongan = '$nama',
    tunjangan_suami_istri = $tjSuamiIstri,
    tunjangan_anak = $tjAnak,
    uang_makan = $uMakan,
    uang_lembur = $uLembur,
    askes = $askes
    WHERE kode_golongan = $kode";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}
