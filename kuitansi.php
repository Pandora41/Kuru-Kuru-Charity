<?php
include "connect.php";
session_start();

if ($_SESSION['privilege'] == "user") {
    header("location:index.php");
}

elseif ($_SESSION['privilege'] != 'admin') {
    header("location:login.php");
}
$query = mysqli_query($connect, "SELECT * FROM kwitansi_masuk  ORDER BY `no` DESC");
$results = mysqli_fetch_all($query, MYSQLI_ASSOC);

$querya = mysqli_query($connect, "SELECT * FROM kwitansi_keluar ORDER BY `no` DESC");
$resultsa = mysqli_fetch_all($querya, MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style-kuitansi.css">
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
                <li><a href="#">
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
                <input class="submit" type="submit" value="">
                <input class="search" type="text" placeholder="Search here...">
            </div>
        </div>
        <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <i class='bx bx-line-chart-down'></i>
                    <span class="text">Pendapatan</span>
                </div>
            </div>

            <div class="activity">
                <div class="activity-data">
                    <div class="table-container">
                        <table>
                          <tr>
                            <th class="small-column">No</th>
                            <th>Tanggal</th>
                            <th>NIS</th>
                            <th class="wide-column">Nama</th>
                            <th>Kelas</th>
                            <th>Bulan bayar</th>
                            <th>Nominal</th>
                            <!-- fitur admin -->
                            <th class="medium-column">Opsi</th>
                            <!-- fitur admin -->
                          </tr>
                          <?php 
            foreach ($results as $result) :?>
                          <tr>
                            <td><?=$result['no']?></td>
                            <td><?=$result['tanggal_cetak']?></td>
                            <td><?=$result['nis']?></td>
                            <td><?=$result['nama']?></td>
                            <td><?=$result['kelas']?></td>
                            <td><?=$result['bulan']?></td>
                            <?php $formattedValue = number_format($result['jumlah_bayar'], 0, ',', '.'); ?>
                            <td>Rp. <?=$formattedValue?></td>
                            <!-- fitur admin -->
                            <td class="option">
                               
                                <a class="links print-link" href="print.php?nis=<?=$result['nis']?>&bulan=<?=$result['bulan']?>&no=<?=$result['no']?>"><i class='bx bx-printer'></i></a>
                            </td>
                            <!-- fitur admin -->
                          </tr>
                          <?php endforeach?>  
                        </table>
                      </div>
                      
                </div>
            </div>
            <div class="overview">
                <div class="title">
                    <i class='bx bx-line-chart'></i>
                    <span class="text">Pengeluaran</span>
                </div>
            </div>

            <div class="activity">
                <div class="activity-data">
                    <div class="table-container">
                        <table>
                          <tr>
                            <th class="small-column">No</th>
                            <th>Tanggal</th>
                            <th class="superwide-column">Keterangan</th>
                            <th>Nominal</th>
                            <!-- fitur admin -->
                            <th class="medium-column">Opsi</th>
                            <!-- fitur admin -->
                          </tr>
                          <?php foreach ($resultsa as $result) :?>
                          <tr>
                            <td><?=$result['no']?></td>
                            <td><?=$result['tanggal_cetak']?></td>
                            <td><?=$result['keterangan']?></td>
                            <td><?=$result['jumlah']?></td>
                            <!-- fitur admin -->
                            <td class="option">
                            
                                <a class="links print-link" href="print.php?no=<?=$result['no']?>"><i class='bx bx-printer'></i></a>
                            </td>
                            <!-- fitur admin -->
                          </tr>
                          <?php endforeach?> 
                        </table>
                      </div>
                      
                </div>
            </div>
        </div>
    </section>
    <script src="js/script-indicator.js"></script>
    <script src="js/script.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    
    
</body>

</html>