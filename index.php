<?php
include "connect.php";
session_start();

// if ($_SESSION['privilege'] == "user") {
//     header("location:index.php");
// }

// elseif ($_SESSION['privilege'] != 'admin') {
//     header("location:login.php");
// }
$total = "SELECT SUM(total) as total_sum FROM pemasukan";
$hasiltotal = $connect->query($total);
$rowa = $hasiltotal->fetch_assoc();
$totalSum = $rowa['total_sum'];

$totalPengeluaran = "SELECT SUM(jumlah) as total_sum_keluar FROM pengeluaran";
$hasiltotal1 = $connect->query($totalPengeluaran);
$rowa1 = $hasiltotal1->fetch_assoc();
$totalPengeluaran = $rowa1['total_sum_keluar'];

$saldo = $totalSum - $totalPengeluaran;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style-dashboard.css">
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
                <li><a class="list-link" href="kuitansi.php">
                    <i class='bx bx-receipt'></i>
                    <span class="link-name">Kuitansi</span>
                </a></li>
            </ul>
            
            <ul class="logout-mode">
                <li><a class="list-link" href="login.php">
                    <i class="uil uil-signout"></i>
                    <span class="link-name">Logout</span>
                </a></li>
                <li class="mode list-link">
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
                <input class="submit" type="submit" value="">
                <input class="search"  type="text" placeholder="-">
            </div>
        </div>
        <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <i class="uil uil-tachometer-fast-alt"></i>
                    <span class="text">Dashboard</span>
                </div>
                <div class="boxes">
                    <div class="box box1">
                        <div class="header-box">
                            <i class='bx bx-down-arrow-circle'></i>
                            <span class="text">Pendapatan</span>
                        </div>
                        <?php $formattedValue = number_format($totalSum, 0, ',', '.'); ?>
        <span class="number">Rp. <?= $formattedValue ?></span>
                    </div>
                    <div class="box box2">
                        <div class="header-box">
                            <i class='bx bx-up-arrow-circle'></i>
                            <span class="text">Pengeluaran</span>
                        </div>
                        <?php $formattedValue = number_format($totalPengeluaran, 0, ',', '.'); ?>
        <span class="number">Rp. <?= $formattedValue ?></span>
                    </div>
                    <div class="box box3">
                        <div class="header-box">
                            <i class='bx bx-purchase-tag-alt'></i>
                            <span class="text">Saldo</span>
                        </div>
                        <?php $formattedValue = number_format($saldo, 0, ',', '.'); ?>
        <span class="number">Rp. <?= $formattedValue ?></span>
                    </div>
                </div>
            </div>

            <div class="activity">
                <div class="title">
                    <i class="uil uil-clock-three"></i>
                    <span class="text">Aktivitas</span>
                </div>

                <!-- <div class="activity-data">
                    <div class="data time">
                        <span class="data-title">Waktu</span>
                        <span class="data-list">3 April 2007 -  02:20:37</span>
                        <span class="data-list">‎‎‎‎‎‎‎‎‎‎‎‎‎‎</span>
                        <span class="data-list">‎‎‎‎‎‎‎‎‎‎‎‎‎‎</span>
                        <span class="data-list">29 April 2007 -  02:20:37</span>
                        <span class="data-list">‎‎‎‎‎‎‎‎‎‎‎‎‎‎</span>
                        <span class="data-list">3 April 2007 -  02:20:37</span>
                        <span class="data-list">‎‎‎‎‎‎‎‎‎‎‎‎‎‎</span>
                        <span class="data-list">‎‎‎‎‎‎‎‎‎‎‎‎‎‎</span>
                        <span class="data-list">29 April 2007 -  02:20:37</span>
                        <span class="data-list">‎‎‎‎‎‎‎‎‎‎‎‎‎‎</span>
                        <span class="data-list">3 April 2007 -  02:20:37</span>
                        <span class="data-list">‎‎‎‎‎‎‎‎‎‎‎‎‎‎</span>
                        <span class="data-list">‎‎‎‎‎‎‎‎‎‎‎‎‎‎</span>
                        <span class="data-list">29 April 2007 -  02:20:37</span>
                        <span class="data-list">‎‎‎‎‎‎‎‎‎‎‎‎‎‎</span>
                    </div>
                    <div class="data log">
                        <span class="data-title">Log aktivitas</span>
                        <span class="data-list"> - Komite@gmail.com log in</span>
                        <span class="data-list"> - Komite@gmail.com viewed Pendapatan</span>
                        <span class="data-list"> - Komite@gmail.com log out</span>
                        <span class="data-list"> - Kepsek@gmail.com log in</span>
                        <span class="data-list"> - Komite@gmail.com viewed Pengeluaran</span>
                        <span class="data-list"> - Komite@gmail.com log in</span>
                        <span class="data-list"> - Komite@gmail.com viewed Pendapatan</span>
                        <span class="data-list"> - Komite@gmail.com log out</span>
                        <span class="data-list"> - Kepsek@gmail.com log in</span>
                        <span class="data-list"> - Komite@gmail.com viewed Pengeluaran</span>
                        <span class="data-list"> - Komite@gmail.com log in</span>
                        <span class="data-list"> - Komite@gmail.com viewed Pendapatan</span>
                        <span class="data-list"> - Komite@gmail.com log out</span>
                        <span class="data-list"> - Kepsek@gmail.com log in</span>
                        <span class="data-list"> - Komite@gmail.com viewed Pengeluaran</span>
                    </div>
                </div> -->
            </div>
        </div>
    </section>

    <script src="js/script-indicator.js"></script>
    <script src="js/script.js"></script>
    
</body>
</html>