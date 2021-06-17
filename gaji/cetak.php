<?php
require_once '../_asset/libs/vendor/autoload.php';
require_once 'functions.php';
$mpdf = new \Mpdf\Mpdf();
$waktu = '';
if(isset($_GET['waktu'])){
  $waktu = $_GET['waktu'];
}else{
  header('Location: data.php');
  exit;
}

$query = "SELECT pegawai.nip,pegawai.nama_pegawai,jabatan.nama_jabatan,golongan.nama_golongan,pegawai.`status`,pegawai.jumlah_anak,
jabatan.gapok,jabatan.tunjangan,
ROUND((jabatan.gapok / 20)) AS gajiPerhari,
IF(pegawai.status ='menikah',golongan.tunjangan_suami_istri,0) AS tjsi,
IF(pegawai.status ='menikah',golongan.tunjangan_anak*pegawai.jumlah_anak,0) AS tjanak,
(golongan.uang_makan * gaji.masuk) as uangMakan,
(gaji.lembur * golongan.uang_lembur) as uangLembur,
golongan.askes,
ROUND((SELECT gajiPerhari) * gaji.alpa) as potonganGaji,
((SELECT gajiPerhari)*gaji.masuk + jabatan.tunjangan +(SELECT tjsi) +(SELECT tjanak) +(SELECT uangMakan) + (SELECT uangLembur)+ askes) as pendapatan ,
(SELECT pendapatan) - (SELECT potonganGaji)as totalGaji
FROM pegawai
INNER JOIN gaji ON gaji.nip = pegawai.nip
INNER JOIN golongan ON golongan.kode_golongan = pegawai.kode_golongan
INNER JOIN jabatan ON jabatan.kode_jabatan = pegawai.kode_jabatan
WHERE gaji.bulan = '$waktu'
ORDER BY gaji.bulan"; 
$datas = query($query);
$html = '
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pdf Print</title>
</head>
<body>
<center><h1>Daftar Gaji karyawan</h1></center>
<table border="1" cellpadding="0" cellspacing="0">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>NIP</th>
                        <th>Nama Pegawai</th>
                        <th>Jbatan</th>
                        <th>Golongan</th>
                        <th>Status</th>
                        <th>Anak</th>
                        <th>Gapok</th>
                        <th>Tunj Jbatan</th>
                        <th>Gaji Perhari</th>
                        <th>Tunj suami istri</th>
                        <th>Tunj Anak</th>
                        <th>Uang makan</th>
                        <th>uang lembur</th>
                        <th>ASKES</th>
                        <th>potongan</th>
                        <th>pendapatan</th>
                        <th>Total gaji</th>
                    </tr>
                </thead>
                <tbody>';
                        $no = 1;
                        foreach ($datas as $data) {     
                        $html .= '
                        <tr>
                            <td> '.$no++.' </td>
                            <td> '.$data["nip"].' </td>
                            <td> '.$data["nama_pegawai"].' </td>
                            <td> '.$data["nama_jabatan"].' </td>
                            <td> '.$data["nama_golongan"].' </td>
                            <td> '.$data["status"].' </td>
                            <td> '.$data["jumlah_anak"].' </td>
                            <td> '.$data["gapok"].' </td>
                            <td> '.$data["tunjangan"].' </td>
                            <td> '.$data["gajiPerhari"].' </td>
                            <td> '.$data["tjsi"].' </td>
                            <td> '.$data["tjanak"].' </td>
                            <td> '.$data["uangMakan"].' </td>
                            <td> '.$data["uangLembur"].' </td>
                            <td> '.$data["askes"].' </td>
                            <td> '.$data["potonganGaji"].' </td>
                            <td> '.$data["pendapatan"].' </td>
                            <td> '.$data["totalGaji"].' </td>
                        </tr>';
                                                    
                        }
                  
               $html .= '</tbody>
            </table>        
</body>
</html>';
$mpdf->WriteHTML($html);
$mpdf->Output("Gaji-Karyawan-$waktu.pdf", 'I');
?>