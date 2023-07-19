<?php
include "connect.php";

$keterangan = $_POST['keterangan'];
$nominal = $_POST['nominal'];



$insert = mysqli_query($connect, "INSERT INTO `pengeluaran`(`tanggal_pengeluaran`, `keterangan`, `jumlah`) VALUES (CURRENT_TIMESTAMP,'$keterangan','$nominal')");
$insert = mysqli_query($connect, "INSERT INTO `kwitansi_keluar`(`tanggal_cetak`, `keterangan`, `jumlah`) VALUES (CURRENT_TIMESTAMP,'$keterangan','$nominal')");
$insert = mysqli_query($connect, "INSERT INTO `log`(`keterangan`, `user`, `tanggal`) VALUES ('Menambahkan Pengeluaran','Admin', CURRENT_TIMESTAMP)");

if($insert){
header("location:pengeluaran.php");
}
else
echo "Input Gagal";
?>