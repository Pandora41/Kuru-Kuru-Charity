<?php
include "connect.php";

$nis = $_POST['nis'];
$nama = $_POST['nama'];
$nominal = $_POST['nominal'];
$bulan = $_POST['bulan'];
$kelas = $_POST['kelas'];
$nominalAwal = ($_POST['nominalAwal']);


$getTahun = $_GET['tahun'];
$getKelas = $_GET['kelas'];
$getPencarian = $_GET['pencarian'];

$query = "SELECT `total` FROM `pemasukan` WHERE `nis` = $nis";
$result = mysqli_query($connect, $query);
$row = mysqli_fetch_assoc($result);
$totalasli = $row['total'];
$total = $row['total'];

$total -= $nominalAwal;
$total += $nominal;

$selisih = $nominal - $nominalAwal;
$totalasli += $selisih;



// echo $total;

if (isset($_POST['edit'])) {

$update = mysqli_query($connect, "UPDATE `pemasukan` SET `$bulan` = '$nominal', `tanggal_$bulan` = CURRENT_TIMESTAMP, `total` = '$total' WHERE `nis` = '$nis'");
$insert = mysqli_query($connect, "INSERT INTO `kwitansi_masuk`(`tanggal_cetak`, `nis`, `nama`, `kelas`, `bulan`, `jumlah_bayar`) VALUES (CURRENT_TIMESTAMP,'$nis','$nama','$kelas','$bulan','$nominal')");
if ($insert) {
    $no = mysqli_insert_id($connect); 
}
$insert = mysqli_query($connect, "INSERT INTO `log`(`keterangan`, `user`, `target`) VALUES ('Mengedit Pemasukan Dari','Admin','$nama')");


if($update){
header("location:print.php?no=$no");
}
else
echo "Input Gagal";
}


if (isset($_POST['hapus'])) {
    $beda = 0;

    $total -= $nominal;
    $beda -= $nominalAwal;

    $update = mysqli_query($connect, "UPDATE `pemasukan` SET `$bulan` = 0, `tanggal_$bulan` = CURRENT_TIMESTAMP, `total` = '$total' WHERE `nis` = '$nis'");
// $insert = mysqli_query($connect, "INSERT INTO `kwitansi_masuk`(`tanggal_cetak`, `nis`, `nama`, `kelas`, `bulan`, `jumlah_bayar`) VALUES (CURRENT_TIMESTAMP,'$nis','$nama','$kelas','$bulan','$beda')");

$insert = mysqli_query($connect, "INSERT INTO `log`(`keterangan`, `user`, `target`) VALUES ('Mengahapus Pemasukan Dari','Admin','$nama')");

$queryo = "SELECT MAX(no) AS max_number FROM `kwitansi_masuk`";
$resulto = mysqli_query($connect, $queryo);

//Fetch the result  
$rowo = mysqli_fetch_assoc($resulto);
$no = $rowo['max_number'];




if($update){
header("location:pendapatan.php?kelas=$getKelas&tahun=$getTahun&pencarian=$getPencarian");
}
else
echo "Input Gagal";

}

if (isset($_POST['print'])) {
    header("location:print.php?nis=$nis&bulan=$bulan");
}

?>