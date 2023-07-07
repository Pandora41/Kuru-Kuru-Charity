<!--PHP PEMASUKAN-->
<?php
include "connect.php";
session_start();

if ($_SESSION['privilege'] == "user") {
    header("location:index.php");
}

elseif ($_SESSION['privilege'] != 'admin') {
    header("location:login.php");
}


$kelas = "";
$tahun = "";
$alert = "";
$nis = "";

if (isset($_POST['pencarian'])) {
    $pencarian = $_POST['pencarian'];
    $query = mysqli_query($connect, "SELECT * FROM `pemasukan` WHERE `nis` LIKE '%$pencarian%' OR `nama` LIKE '%$pencarian%'");
    $results = mysqli_fetch_all($query, MYSQLI_ASSOC);

} 
else {

    $query = mysqli_query($connect, "SELECT * FROM `pemasukan` ORDER BY tahun, kelas");
    $results = mysqli_fetch_all($query, MYSQLI_ASSOC);

    if(isset($_GET['kelas']) && $_GET['kelas'] != '') {

        $kelas = $_GET['kelas'];
        $query = mysqli_query($connect, "SELECT * FROM `pemasukan` WHERE `kelas` = '$kelas'");
        $results = mysqli_fetch_all($query, MYSQLI_ASSOC);

    }


    if(isset($_GET['tahun'])) {
        $tahun = $_GET['tahun'];
        $query = mysqli_query($connect, "SELECT * FROM `pemasukan` WHERE `tahun` = '$tahun'");
        $results = mysqli_fetch_all($query, MYSQLI_ASSOC);

        if(isset($kelas) && $_GET['kelas'] != '') {
            $query = mysqli_query($connect, "SELECT * FROM `pemasukan` WHERE `kelas` = '$kelas' AND `tahun` = '$tahun'");
            $results = mysqli_fetch_all($query, MYSQLI_ASSOC);
        }
    }

    if(!isset($_GET['tahun']) || $_GET['tahun'] == '') {
        if(!isset($_GET['NIS'])) {
        $alert = "Silahkan Pilih Tahun Ajaran";
        }
    }

    if(isset($_GET['NIS']) && $_GET['NIS'] != '') {

        $nis = $_GET['NIS'];
        $query = mysqli_query($connect, "SELECT * FROM `pemasukan` WHERE `nis` = '$nis'");
        $results = mysqli_fetch_all($query, MYSQLI_ASSOC);

    }

}

$querys = mysqli_query($connect, "SELECT * FROM `data`");
    $resultss = mysqli_fetch_assoc($querys);


$total = "SELECT SUM(total) as total_sum FROM pemasukan";
$hasiltotal = $connect->query($total);
$rowa = $hasiltotal->fetch_assoc();
$totalSum = $rowa['total_sum'];

$TotalAngkatan = "SELECT SUM(total) as total_sum FROM `pemasukan` WHERE tahun = '$tahun'";
$hasiltotalAng = $connect->query($TotalAngkatan);
$rowAng = $hasiltotalAng->fetch_assoc();
$totalSumAngkatan = $rowAng['total_sum'];

$TotalKelas = "SELECT SUM(total) as total_sum FROM `pemasukan` WHERE tahun = '$tahun' AND kelas = '$kelas'";
$hasiltotalKelas = $connect->query($TotalKelas);
$rowKelas = $hasiltotalKelas->fetch_assoc();
$totalSumKelas = $rowKelas['total_sum'];
?>


<!-- AKHIR PHP PEMASUKAN -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style-pendapatan.css">
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
                    <img src="image/icon.png" alt="">
                </span>
                <div class="text header-text">
                    <span class="name">SPMP</span>
                    <span class="subname">SMKN 2 Bandung</span>
                </div>
            </div>
        </header>

        <div class="menu-items">
            <ul class="nav-links">
                <li><a href="index.php">
                    <i class='bx bx-home-alt'></i>
                    <span class="link-name">Dahsboard</span>
                </a></li>
                <li><a href="pendapatan.php">
                    <i class='bx bxs-archive-in'></i>
                    <span class="link-name">Pendapatan</span>
                </a></li>
                <li><a href="#">
                    <i class='bx bx-archive-out'></i>
                    <span class="link-name">Pengeluaran</span>
                </a></li>
                <li><a href="#">
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
                <form action="#" METHOD="POST">
                <input class="submit" type="submit" value="">
                <input class="search" type="text" placeholder="Cari NIS / Nama" name="pencarian">
                </form>
            </div> 
        </div>
        <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <i class='bx bx-line-chart'></i>
                    <span class="text">Pendapatan</span>
                </div>
                <div class="boxes">
                    <div class="box box1">
                        <div class="header-box">
                            <i class='bx bx-money'></i>
                            <span class="text">Total Keseluruhan</span>
                        </div>
                        <?php $formattedValue = number_format($totalSum, 0, ',', '.'); ?>
        <span class="number">Rp. <?= $formattedValue ?></span>
                    </div>
                    <div class="box box2">
                        <div class="header-box">
                            <i class='bx bxs-graduation'></i>
                            <span class="text">Angkatan <?php echo $tahun;?></span>
                        </div>
                         <?php 

                         if($totalSumAngkatan == 0) {
                            $masukangkatan = "-";
                         } else {
                         
                         $formattedValue = number_format($totalSumAngkatan, 0, ',', '.'); 
                         $masukangkatan = "Rp. " . $formattedValue;
                
                         }
                         ?>
        <span class="number"><?= $masukangkatan ?></span>
                    </div>
                    <div class="box box3">
                        <div class="header-box">
                            <i class='bx bxs-school'></i>

                            <?php 
                            if ($kelas == "") {
                                $KelasTitle = "Kelas";
                            }
                            else {
                                $KelasTitle = $kelas;
                            }
                            ?>
                            <span class="text"><?=$KelasTitle?></span>


                        </div>
                        <?php 
                        if($totalSumKelas == 0) {
                            $masukkelas = "-";
                         } else {
                         
                         $formattedValue = number_format($totalSumKelas, 0, ',', '.'); 
                         $masukkelas = "Rp. " . $formattedValue;
                
                         }?>
        <span class="number"><?= $masukkelas ?></span>
                    </div>
                </div>
            </div>

            <div class="activity">
                <div class="header-activity">
                    <div class="select-1">
                        <span class="select-title">Angkatan</span>
                        <select name="tahun" id="tahunSelect">
                            <option value="">Tahun Ajaran</option>
    <option value="2022/2023" <?php echo ($tahun== '2022/2023') ? 'selected' : ''; ?>>2022/2023</option>
    <option value="2023/2024" <?php echo ($tahun== '2023/2024') ? 'selected' : ''; ?>>2023/2024</option>
                        </select>
                    </div>
                    <div class="select-2">
                        <span class="select-title">Kelas</span>
                        <select name="kelas" id="kelasSelect">
                            <option value="">Semua Kelas</option>
    <option value="X-PPLG-1" <?php echo ($kelas== 'X-PPLG-1') ? 'selected' : ''; ?>>X-PPLG-1</option>
    <option value="X-PPLG-2" <?php echo ($kelas== 'X-PPLG-2') ? 'selected' : ''; ?>>X-PPLG-2</option>
    <option value="X-TM-5" <?php echo ($kelas== 'X-TM-5') ? 'selected' : ''; ?>>X-TM-5</option>
                        </select>
                    </div>
                </div>

    <!-- JS SCRIPT AUTO REFRESH -->
    <script>
   
    const tahunSelect = document.getElementById('tahunSelect');
    const kelasSelect = document.getElementById('kelasSelect');


    tahunSelect.addEventListener('change', refreshPage);
    kelasSelect.addEventListener('change', refreshPage);

   
    function handleKelasSelectChange() {
        refreshPage();
    }

   
    function refreshPage() {
        const selectedKelas = kelasSelect.value;
        const selectedTahun = tahunSelect.value;
        window.location.href = `?kelas=${selectedKelas}&tahun=${selectedTahun}`;
    }
    </script>

    <h3><?php echo $alert?></h3>

                <div class="activity-data">
                    <div class="data nis">
                        <span class="data-title">NIS</span>
                         <?php 
            foreach ($results as $result) :?>
                        <span class="data-list"><?=$result['nis']?></span>
                        <?php endforeach?>
                    </div>

                    <div class="data name">
                        <span class="data-title">Nama</span>
                        <?php 
            foreach ($results as $result) :?>
                        <span class="data-list"><?=$result['nama']?></span>
                        <?php endforeach?>
                    </div>

                    <div class="data nis">
                        <span class="data-title">Kelas</span>
                         <?php 
            foreach ($results as $result) :?>
                        <span class="data-list"><?=$result['kelas']?></span>
                        <?php endforeach?>
                    </div>

                    <div class="data name">
                        <span class="data-title">Tahun Ajaran</span>
                         <?php 
            foreach ($results as $result) :?>
                        <span class="data-list"><?=$result['tahun']?></span>
                        <?php endforeach?>
                    </div>

                    <div class="data-month">
                        <div class="data ">
                            <span class="data-title">Juli</span>
                            <?php 
            foreach ($results as $result) :?>
                        <?php $formattedValue = number_format($result['juli'], 0, ',', '.'); ?>
        <span class="data-list"><?= $formattedValue ?></span>
                        <?php endforeach?>
                        </div>
                        <div class="data ">
                            <span class="data-title">Agustus</span>
                            <?php 
            foreach ($results as $result) :?>
                        <?php $formattedValue = number_format($result['agustus'], 0, ',', '.'); ?>
        <span class="data-list"><?= $formattedValue ?></span>
                        <?php endforeach?>
                        </div>
                        <div class="data ">
                            <span class="data-title">September</span>
                            <?php 
            foreach ($results as $result) :?>
                        <?php $formattedValue = number_format($result['september'], 0, ',', '.'); ?>
        <span class="data-list"><?= $formattedValue ?></span>
                        <?php endforeach?>
                        </div>
                        <div class="data ">
                            <span class="data-title">Oktober</span>
                            <?php 
            foreach ($results as $result) :?>
                        <?php $formattedValue = number_format($result['oktober'], 0, ',', '.'); ?>
        <span class="data-list"><?= $formattedValue ?></span>
                        <?php endforeach?>
                        </div>
                        <div class="data ">
                            <span class="data-title">November</span>
                            <?php 
            foreach ($results as $result) :?>
                        <?php $formattedValue = number_format($result['november'], 0, ',', '.'); ?>
        <span class="data-list"><?= $formattedValue ?></span>
                        <?php endforeach?>
                        </div>
                        <div class="data ">
                            <span class="data-title">Desember</span>
                            <?php 
            foreach ($results as $result) :?>
                        <?php $formattedValue = number_format($result['desember'], 0, ',', '.'); ?>
        <span class="data-list"><?= $formattedValue ?></span>
                        <?php endforeach?>
                        </div>
                        <div class="data ">
                            <span class="data-title">Januari</span>
                            <?php 
            foreach ($results as $result) :?>
                        <?php $formattedValue = number_format($result['januari'], 0, ',', '.'); ?>
        <span class="data-list"><?= $formattedValue ?></span>
                        <?php endforeach?>
                        </div>
                        <div class="data ">
                            <span class="data-title">Februari</span>
                            <?php 
            foreach ($results as $result) :?>
                        <?php $formattedValue = number_format($result['februari'], 0, ',', '.'); ?>
        <span class="data-list"><?= $formattedValue ?></span>
                        <?php endforeach?>
                        </div>
                        <div class="data ">
                            <span class="data-title">Maret</span>
                            <?php 
            foreach ($results as $result) :?>
                        <?php $formattedValue = number_format($result['maret'], 0, ',', '.'); ?>
        <span class="data-list"><?= $formattedValue ?></span>
                        <?php endforeach?>
                        </div>
                        <div class="data ">
                            <span class="data-title">April</span>
                            <?php 
            foreach ($results as $result) :?>
                        <?php $formattedValue = number_format($result['april'], 0, ',', '.'); ?>
        <span class="data-list"><?= $formattedValue ?></span>
                        <?php endforeach?>
                        </div>
                        <div class="data ">
                            <span class="data-title">Mei</span>
                            <?php 
            foreach ($results as $result) :?>
                        <?php $formattedValue = number_format($result['mei'], 0, ',', '.'); ?>
        <span class="data-list"><?= $formattedValue ?></span>
                        <?php endforeach?>
                        </div>
                        <div class="data ">
                            <span class="data-title">Juni</span>
                            <?php 
            foreach ($results as $result) :?>
                        <?php $formattedValue = number_format($result['juni'], 0, ',', '.'); ?>
        <span class="data-list"><?= $formattedValue ?></span>
                        <?php endforeach?>
                        </div>
                    </div>
                    <div class="data ">
                        <span class="data-title">Total</span>
                        <?php 
            foreach ($results as $result) :?>
                        <?php $formattedValue = number_format($result['total'], 0, ',', '.'); ?>
        <span class="data-list"><?= $formattedValue ?></span>
                        <?php endforeach?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="js/script.js"></script>
</body>
</html>