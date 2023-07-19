<?php
include "connect.php";

$keterangan = $_POST['keterangan'];
$nominal = $_POST['nominal'];
$no = $_POST['no'];



$insert = mysqli_query($connect, "UPDATE `pengeluaran` SET`keterangan`='$keterangan',`jumlah`='$nominal' WHERE `no` = '$no'");
$insert = mysqli_query($connect, "INSERT INTO `kwitansi_keluar`(`tanggal_cetak`, `keterangan`, `jumlah`) VALUES (CURRENT_TIMESTAMP,'$keterangan','$nominal')");
$insert = mysqli_query($connect, "INSERT INTO `log`(`keterangan`, `user`, `tanggal`) VALUES ('Mengedit Pengeluaran','Admin', CURRENT_TIMESTAMP)");

if($insert){
header("location:pengeluaran.php");
}
else
echo "Input Gagal";
?>