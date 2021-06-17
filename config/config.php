<?php
session_start();
date_default_timezone_set('Asia/Jakarta');

require_once 'conn.php';

//koneksi
$conn = mysqli_connect($conn['host'], $conn['user'], $conn['pass'], $conn['db']);

if (!$conn) {
    echo 'Koneksi ke database GAGAL! ' . mysqli_connect_errno() . " - " . mysqli_connect_error();
}

//url awal
function urlAwal($url = null)
{
    $urlDasar = "http://localhost/penggajian";
    if ($url != null) {
        return $urlDasar . '/' . $url;
    } else {
        return $urlDasar;
    }
}

function tanggal_indo($tgl)
{
    $hari = substr($tgl, 8, 2);
    $bulan = substr($tgl, 5, 2);
    $tahun = substr($tgl, 0, 4);
    return $hari . " / " . $bulan . " / " . $tahun;
}
