<?php
include "../connect.php";

$keterangan = $_POST['keterangan'];
$nominal = $_POST['jumlah'];
$tanggal = $_POST['tanggal_pengeluaran'];
$no = $_POST['no'];

if(isset($_POST['hapus'])) {

    $beda = 0;
    $beda -= $nominal;

$delete = mysqli_query($connect, "DELETE FROM `pengeluaran` WHERE `no` = '$no'");

$insert = mysqli_query($connect, "INSERT INTO `log`(`keterangan`, `user`, `isi`) VALUES ('Mengahapus Pengeluaran','Admin','$keterangan')");


if($insert){
header("location:../pengeluaran.php");
}
else
echo "Input Gagal";

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style-form.css">
    <link rel="shortcut icon" href="image/icon.svg" type="">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <title>SPMP</title>
</head>
<body> 
    <form action="../process-edit-keluar.php" METHOD="POST">
    <div class="container">
        <div class="header-form">
            <a class="undo" href="../pengeluaran.php"><i class='bx bx-chevron-left-circle' ></i></a>
            <span class="title-form">Edit Pengeluaran</span>
        </div>
       
            <div class="main-form">
                <div class="input-data">
                    <div class="data input-text">
                        <span class="text">Keterangan</span>
                        <textarea name="keterangan" id="" cols="30" rows="5"><?=$keterangan?></textarea>
                    </div>
                    <div class="data input-number">
                        <span class="text">Nominal</span>
                        <input type="text" name="nominal" id="" value="<?=$nominal?>">
                    </div>
                </div>
            </div>
        <div class="btn-form">
            <input type="hidden" name="no" value="<?=$no?>">
            <input class="btn-form" type="submit" value="Edit">
            <a href="../pengeluaran.php">Cancel</a>
        </div>
    
    </div>
    </form>
</body>
</html>