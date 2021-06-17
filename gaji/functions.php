<?php
require_once '../config/config.php';
require '../_asset/libs/vendor/autoload.php';

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;

$uuid4 = Uuid::uuid4()->toString();

function query($query)
{
    global $conn;
    $rows = [];
    $result = mysqli_query($conn, $query);
    if (!$result) {
        echo "Query bermasalah : " . mysqli_error($conn) . " " . mysqli_errno($conn);
    }
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function tambah($data)
{
    global $conn, $uuid4;
    $pasien = trim(mysqli_real_escape_string($conn, $data['pasien']));
    $keluhan = trim(mysqli_real_escape_string($conn, $data['keluhan']));
    $tgl = trim(mysqli_real_escape_string($conn, $data['tgl']));
    $poli = trim(mysqli_real_escape_string($conn, $data['poli']));
    $dokter = trim(mysqli_real_escape_string($conn, $data['dokter']));
    $diagnosa = trim(mysqli_real_escape_string($conn, $data['diagnosa']));
    $obat =  $data['obat'];
    $query2 = "INSERT INTO obat_rm (id_rm,id_obat) VALUES";
    foreach ($obat as $ob) {
        $query2 .=  "('$uuid4','$ob'),";
    }
    $query2 = rtrim($query2, ',');

    $query = "INSERT INTO rekam_medis VALUES(
        '$uuid4','$pasien','$keluhan','$dokter','$diagnosa','$poli','$tgl'
    )";


    if (!mysqli_error($conn)) {
        mysqli_query($conn, $query);
        mysqli_query($conn, $query2);
    } else {
        return false;
    }

    return mysqli_affected_rows($conn);
}

function hapus($id)
{
    global $conn;
    $query = "DELETE FROM rekam_medis WHERE id_rm = '$id'";
    mysqli_query($conn, $query) or die(mysqli_error($conn));
    return mysqli_affected_rows($conn);
}
