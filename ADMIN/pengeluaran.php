<?php
include "connect.php";
session_start();

if ($_SESSION['privilege'] == "user") {
    header("location:index.php");
}

elseif ($_SESSION['privilege'] != 'admin') {
    header("location:login.php");
}

$pencarian = "";

if (isset($_GET['pencarian']) && $_GET['pencarian'] != '') {
    $pencarian = $_GET['pencarian'];
    $query = mysqli_query($connect, "SELECT * FROM `pengeluaran` WHERE `no` LIKE '%$pencarian%' OR `tanggal_pengeluaran` LIKE '%$pencarian%' OR `keterangan` LIKE '%$pencarian%' OR `jumlah` LIKE '%$pencarian%'");
    $results = mysqli_fetch_all($query, MYSQLI_ASSOC);

}

$total = "SELECT SUM(total) as total_sum FROM pemasukan";
$hasiltotal = $connect->query($total);
$rowa = $hasiltotal->fetch_assoc();
$totalSum = $rowa['total_sum'];

$totalPengeluaran = "SELECT SUM(jumlah) as total_sum_keluar FROM pengeluaran";
$hasiltotal1 = $connect->query($totalPengeluaran);
$rowa1 = $hasiltotal1->fetch_assoc();
$totalPengeluaran = $rowa1['total_sum_keluar'];

$saldo = $totalSum - $totalPengeluaran;

$query = mysqli_query($connect, "SELECT * FROM `pengeluaran` ORDER BY `no`");
$results = mysqli_fetch_all($query, MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style-pengeluaran.css">
    <link rel="shortcut icon" href="image/icon.svg" type="">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <title>SPMP</title>
</head>

<body>
    <nav>
        <header>
            <div class="image-text">
                <span class="image">
                    <img src="image/icon.svg" alt="">
                </span>
                <div class="text header-text">
                    <span class="name">SPMP</span>
                    <span class="subname">SMKN 2 Bandung</span>
                </div>
            </div>
        </header>

        <div class="menu-items">
            <ul class="nav-links">
                <li><a class="list-link" href="index.php">
                        <i class='bx bx-home-alt'></i>
                        <span class="link-name">Dashboard</span>
                    </a></li>
                <li><a class="list-link" href="pendapatan.php">
                        <i class='bx bxs-archive-in'></i>
                        <span class="link-name">Pendapatan</span>
                    </a></li>
                <li><a class="list-link" href="pengeluaran.php">
                        <i class='bx bx-archive-out'></i>
                        <span class="link-name">Pengeluaran</span>
                    </a></li>
                <li><a href="kuitansi.php">
                        <i class='bx bx-receipt'></i>
                        <span class="link-name">Kuitansi</span>
                    </a></li>
            </ul>
    
            <ul class="logout-mode">
                <li><a href="./../login.php">
                        <i class="uil uil-signout"></i>
                        <span class="link-name">Logout</span>
                    </a></li>
                <li class="mode">
                    <a href="#">
                        <i class="uil uil-moon"></i>
                        <span class="link-name">Dark Mode</span>
                    </a>
                    <div class="mode-toggle">
                        <span class="switch"></span>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    
    <section class="dashboard">
        
        <div class="top">
            <i class="uil uil-bars sidebar-toggle"></i>

            <div class="search-box">
                <i class="uil uil-search"></i>
                <form action="#" METHOD="GET">
                <input class="submit" type="submit" value="">
                <input class="search" type="text" placeholder="Cari Disini . . ." name="pencarian">
                </form>
            </div>
        </div>
        <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <i class='bx bx-line-chart-down'></i>
                    <span class="text">Pengeluaran</span>
                </div>
                <div class="boxes">
                    
                    <div class="box box3">
                        <div class="header-box">
                            <i class='bx bxs-graduation'></i>
                            <span class="text">Saldo</span>
                        </div>
                        <?php $formattedValue = number_format($saldo, 0, ',', '.'); ?>
                        <span class="number">Rp. <?= $formattedValue ?></span>
                    </div>
                    <div class="box box1">
                        <div class="header-box">
                            <i class='bx bx-money'></i>
                            <span class="text">Total Pengeluaran</span>
                        </div>
                        <?php $formattedValue = number_format($totalPengeluaran, 0, ',', '.'); ?>
                        <span class="number">Rp. <?= $formattedValue ?></span>
                    </div>
                </div>
            </div>

            <div class="activity">
                <div class="header-activity">
                    <a class="links add-link" href="dist/add-pengeluaran.php"><i class='bx bx-plus-circle'></i>Tambah</a>
                </div>
                <div class="activity-data">
                    <div class="table-container">
                        <table>
                          <tr>
                            <th class="small-column">No</th>
                            <th>Tanggal</th>
                            <th class="wide-column">Keterangan</th>
                            <th>Nominal</th>
                            <!-- fitur admin -->
                            <th>Opsi</th>
                            <!-- fitur admin -->
                          </tr>
                          <?php 
                        foreach ($results as $result) :?>
                         <form action="dist/edit-pengeluaran.php" method="POST">
                          <tr>
                            <td><?=$result['no']?></td>
                            <td><?=$result['tanggal_pengeluaran']?></td>
                            <td><?=$result['keterangan']?></td>
                            <?php $formattedValue = number_format($result['jumlah'], 0, ',', '.'); ?>
                            <td><?=$formattedValue?></td>

                            <!-- fitur admin -->
                            <td class="option">
                                <input type="hidden" name="no" value="<?=$result['no']?>">
                                <input type="hidden" name="tanggal_pengeluaran" value="<?=$result['tanggal_pengeluaran']?>">
                                <input type="hidden" name="keterangan" value="<?=$result['keterangan']?>">
                                <input type="hidden" name="jumlah" value="<?=$result['jumlah']?>">
                                <button type="submit" class="links edit-link" name="edit" value="edit"><i class='bx bx-edit-alt' ></i></button>
                                <button type="submit" class="links delete-link" name="hapus" value="hapus"><i class='bx bx-trash' ></i></button>
                                
                                

                            </td>
                            <!-- fitur admin -->
                          </tr>
                        </form>
                          <?php endforeach?>
                        </table>
                      </div>
                      
                </div>
            </div>
        </div>
    </section>
    <script src="js/script.js"></script>
    <script src="js/script-indicator.js"></script>
</body>

</html>