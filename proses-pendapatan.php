<?php
include "connect.php";

$nis = $_POST['nis'];
$nama = $_POST['nama'];
$nominal = $_POST['nominal'];
$bulan = $_POST['bulan'];
$kelas = $_POST['kelas'];

$getTahun = $_GET['tahun'];
$getKelas = $_GET['kelas'];
$getPencarian = $_GET['pencarian'];

$query = "SELECT `total` FROM `pemasukan` WHERE `nis` = $nis";
$result = mysqli_query($connect, $query);
$row = mysqli_fetch_assoc($result);
$total = $row['total'];

$total += $nominal;


$update = mysqli_query($connect, "UPDATE `pemasukan` SET `$bulan` = '$nominal', `tanggal_$bulan` = CURRENT_TIMESTAMP, `total` = '$total' WHERE `nis` = '$nis'");
$insert = mysqli_query($connect, "INSERT INTO `kwitansi_masuk`(`tanggal_cetak`, `nis`, `nama`, `kelas`, `jumlah_bayar`) VALUES (CURRENT_TIMESTAMP,'$nis','$nama','$kelas','$nominal')");

$insert = mysqli_query($connect, "INSERT INTO `log`(`keterangan`, `user`, `target`) VALUES ('Mencatat Pemasukan Dari','Admin','$nama')");


if($update){
header("location:pendapatan.php?kelas=$getKelas&tahun=$getTahun&pencarian=$getPencarian");
}
else
echo "Input Gagal";

?>