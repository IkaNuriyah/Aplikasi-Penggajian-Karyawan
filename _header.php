<?php
require 'config/config.php';
require '_asset/libs/vendor/autoload.php';


if (!$_SESSION['user']) {
    header("Location: " . urlAwal('auth/login.php'));
    exit;
} ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title> Aplikasi Penggajian Karyawan</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?= urlAwal('_asset/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link href="<?= urlAwal('_asset/css/simple-sidebar.css'); ?>" rel="stylesheet">
    <link href="<?= urlAwal('_asset/libs/dataTable/datatables.min.css'); ?>" rel="stylesheet">
    <style>
        div.error {
            color: red;
            font-style: italic;
            font-weight: bold;
        }

        .tengah,
        th {
            text-align: center;
        }
    </style>

</head>

<body>
    <script src="<?= urlAwal('_asset/js/jquery.js'); ?>"></script>
    <script src="<?= urlAwal('_asset/js/bootstrap.min.js'); ?>"></script>
    <script src="<?= urlAwal('_asset/libs/dataTable/datatables.min.js'); ?>"></script>
    <div id="wrapper">
        <div id="sidebar-wrapper" style="background-color: #1C3334;">
            <ul class="sidebar-nav">
                <br><br><br>
                <li>
                    <a href="<?= urlAwal('Dashboard'); ?>">Dashboard</a>
                </li>
                <li>
                    <a href="<?= urlAwal('kehadiran/data.php'); ?>">Data Kehadiran</a>
                </li>
                <li>
                    <a href="<?= urlAwal('golongan/data.php'); ?>">Data Golongan</a>
                </li>
                <li>
                    <a href=" <?= urlAwal('jabatan/data.php'); ?>">Data Jabatan</a>
                </li>
                <li>
                    <a href="<?= urlAwal('pegawai/data.php'); ?>">Data Pegawai</a>
                </li>
                <li>
                    <a href="<?= urlAwal('gaji/data.php'); ?>">Data Gaji</a>
                </li>
                <li>
                    <a href="<?= urlAwal('auth/logout.php'); ?>"><span class="text-danger"><b> Logout</b></span></a>
                </li>
                <br><br>
                <p><hr size="2px;" color="silver"></p>

                <font style="font-family: Georgia; font-size: 12px; color: white; padding: 20px;">PT. KIRITO SAN</font>
                    
                <br> <font style="font-family: Georgia; font-size: 12px; color: white; padding: 20px;">JL. Rawamangun No.7 Jakarta Timur </font>
                    
                <br> <font style="font-family: Georgia; font-size: 12px; color: white; padding: 20px;">Telp : 081213579085 </font>
            </ul>
            
        </div>
        <div id="page-content-wrapper">
            <div class="container-fluid"></div>