<?php
require_once '../config/config.php';
require '../_asset/libs/vendor/autoload.php';
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
function tambah($datas){
     global $conn;
     $waktu = $datas['waktu'][0];
     $query = "INSERT INTO gaji(bulan,nip,masuk,sakit,izin,alpa,lembur,potongan) VALUES";
     for($x = 0; $x < count($datas['nip']); $x++){        
        $nip = $datas['nip'][$x];
        $masuk = (int)$datas['masuk'][$x];
        $sakit = (int)$datas['sakit'][$x];
        $izin = (int)$datas['izin'][$x];
        $alpa = (int)$datas['alpa'][$x];
        $potongan = (int)$datas['potongan'][$x];
        $lembur = (int)$datas['lembur'][$x];
        $query .= "('$waktu','$nip',$masuk,$sakit,$izin,$alpa,$lembur,$potongan),";        
     }
     $query = rtrim($query,',');
     mysqli_query($conn,$query);
     return mysqli_affected_rows($conn);
}