<?php
include "connect.php";

$_POST['testing'] = "";

$keterangan = $_GET['keterangan'];
$nominal = $_GET['nominal'];



$insert = mysqli_query($connect, "INSERT INTO `pengeluaran`(`tanggal_pengeluaran`, `keterangan`, `jumlah`) VALUES (CURRENT_TIMESTAMP,'$keterangan','$nominal')");
$insert = mysqli_query($connect, "INSERT INTO `kwitansi_keluar`(`tanggal_cetak`, `keterangan`, `jumlah`) VALUES (CURRENT_TIMESTAMP,'$keterangan','$nominal')");
if ($insert) {
    $no = mysqli_insert_id($connect); 
}
$insert = mysqli_query($connect, "INSERT INTO `log`(`keterangan`, `user`, `tanggal`) VALUES ('Menambahkan Pengeluaran','Admin', CURRENT_TIMESTAMP)");

if($insert){
header("location:print_pengeluaran.php?no=$no");
}
else
echo "Input Gagal";
?>