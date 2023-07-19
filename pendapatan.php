
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
$pencarian = "";

if (isset($_GET['pencarian']) && $_GET['pencarian'] != '') {
    $pencarian = $_GET['pencarian'];
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
                        <span class="link-name">Dahsboard</span>
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
               <form action="#" METHOD="GET">
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
                            <span class="text">Total Pemasukan</span>
                        </div>
                        <?php $formattedValue = number_format($totalSum, 0, ',', '.'); ?>
                        <span class="number">Rp. <?= $formattedValue ?></span>
                    </div>
                    <div class="box box2">
                        <div class="header-box">
                            <i class='bx bxs-graduation'></i>
                            <span class="text">Angkatan</span>
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
    <option value="X-TJKT-1" <?php echo ($kelas== 'X-TJKT-1') ? 'selected' : ''; ?>>X-TJKT-1</option>
    <option value="X-TJKT-2" <?php echo ($kelas== 'X-TJKT-2') ? 'selected' : ''; ?>>X-TJKT-2</option>
    <option value="X-DKV-1" <?php echo ($kelas== 'X-DKV-1') ? 'selected' : ''; ?>>X-DKV-1</option>
    <option value="X-DKV-2" <?php echo ($kelas== 'X-DKV-2') ? 'selected' : ''; ?>>X-DKV-2</option>
    <option value="X-DKV-3" <?php echo ($kelas== 'X-DKV-3') ? 'selected' : ''; ?>>X-DKV-3</option>
    <option value="X-AM-1" <?php echo ($kelas== 'X-AM-1') ? 'selected' : ''; ?>>X-AM-1</option>
    <option value="X-AM-2" <?php echo ($kelas== 'X-AM-2') ? 'selected' : ''; ?>>X-AM-2</option>
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
    <!--JS AUTO REFRESH END-->
     <h3><?php echo $alert?></h3>

                <div class="activity-data">
                    <div class="table-wrapper">
                        <div class="table-fixed">
                            <div class="overlay"></div>
                            <table>
                                <tr class="data-title">
                                    <th>NIS</th>
                                    <th>Nama</th>
                                    <th>Kelas</th>
                                </tr>
                                <?php 
            foreach ($results as $result) :?>
                                <tr class="data-list ">
                                    <td><button id="hireBtn"><?=$result['nis']?></button></td>
                                    <td class="data-name"><button id="hireBtn"><?=$result['nama']?></button></td>
                                    <td><button id="hireBtn"><?=$result['kelas']?></button></td>
                                </tr>
                                <?php endforeach?>
                            </table>
                            </div>
                            <div class="table-scrollable">
                            <table>
                                <tr class="data-title">
                                <th>Juli</th>
                                <th>Agustus</th>
                                <th>September</th>
                                <th>Oktober</th>
                                <th>November</th>
                                <th>Desember</th>
                                <th>Januari</th>
                                <th>Februari</th>
                                <th>Maret</th>
                                <th>April</th>
                                <th>Mei</th>
                                <th>Juni</th>
                                </tr>
                                <?php 
            foreach ($results as $result) :?>
                                <tr class="data-list">

                                <?php $formattedValue = number_format($result['juli'], 0, ',', '.'); 
                                if ($formattedValue == 0) {?>
                                <td><button class="addBtn" 
                                data-nis="<?= $result['nis'] ?>"
                                data-nama="<?= $result['nama'] ?>"
                                data-bulan="Juli"
                                data-kelas="<?= $result['kelas'] ?>"
                                ><i class='bx bx-plus'></i></button></td> 
                                
                                <?php } else {?>
                                <td><button class="hireBtn"
                                data-nis="<?= $result['nis'] ?>"
                                data-nama="<?= $result['nama'] ?>"
                                data-bulan="Juli"
                                data-kelas="<?= $result['kelas'] ?>"
                                data-nominal="<?= $result['juli'] ?>"
                                ><?=$formattedValue?></button></td><?php }?>

                                <?php $formattedValue = number_format($result['agustus'], 0, ',', '.'); 
                                if ($formattedValue == 0) {?>
                                <td><button class="addBtn"
                                data-nis="<?= $result['nis'] ?>"
                                data-nama="<?= $result['nama'] ?>"
                                data-bulan="Agustus"
                                data-kelas="<?= $result['kelas'] ?>"
                                ><i class='bx bx-plus'></i></button></td> 
                                
                                <?php } else {?>
                                <td><button class="hireBtn"
                                data-nis="<?= $result['nis'] ?>"
                                data-nama="<?= $result['nama'] ?>"
                                data-bulan="Agustus"
                                data-kelas="<?= $result['kelas'] ?>"
                                data-nominal="<?= $result['agustus'] ?>"
                                ><?=$formattedValue?></button></td><?php }?>

                                <?php $formattedValue = number_format($result['september'], 0, ',', '.'); 
                                if ($formattedValue == 0) {?>
                                <td><button class="addBtn"
                                data-nis="<?= $result['nis'] ?>"
                                data-nama="<?= $result['nama'] ?>"
                                data-bulan="September"
                                data-kelas="<?= $result['kelas'] ?>"><i class='bx bx-plus'></i></button></td>
                                
                                <?php } else {?>
                                <td><button class="hireBtn"
                                data-nis="<?= $result['nis'] ?>"
                                data-nama="<?= $result['nama'] ?>"
                                data-bulan="September"
                                data-kelas="<?= $result['kelas'] ?>"
                                data-nominal="<?= $result['september'] ?>"
                                ><?=$formattedValue?></button></td><?php }?>

                                <?php $formattedValue = number_format($result['oktober'], 0, ',', '.'); 
                                if ($formattedValue == 0) {?>
                                <td><button class="addBtn"
                                data-nis="<?= $result['nis'] ?>"
                                data-nama="<?= $result['nama'] ?>"
                                data-bulan="Oktober"
                                data-kelas="<?= $result['kelas'] ?>"><i class='bx bx-plus'></i></button></td>
                                
                                <?php } else {?>
                                <td><button class="hireBtn"
                                data-nis="<?= $result['nis'] ?>"
                                data-nama="<?= $result['nama'] ?>"
                                data-bulan="Oktober"
                                data-kelas="<?= $result['kelas'] ?>"
                                data-nominal="<?= $result['oktober'] ?>"
                                ><?=$formattedValue?></button></td><?php }?>

                                <?php $formattedValue = number_format($result['november'], 0, ',', '.'); 
                                if ($formattedValue == 0) {?>
                                <td><button class="addBtn"
                                data-nis="<?= $result['nis'] ?>"
                                data-nama="<?= $result['nama'] ?>"
                                data-bulan="November"
                                data-kelas="<?= $result['kelas'] ?>"><i class='bx bx-plus'></i></button></td>
                                
                                <?php } else {?>
                                <td><button class="hireBtn"
                                data-nis="<?= $result['nis'] ?>"
                                data-nama="<?= $result['nama'] ?>"
                                data-bulan="November"
                                data-kelas="<?= $result['kelas'] ?>"
                                data-nominal="<?= $result['november'] ?>"
                                ><?=$formattedValue?></button></td><?php }?>

                                <?php $formattedValue = number_format($result['desember'], 0, ',', '.'); 
                                if ($formattedValue == 0) {?>
                                <td><button class="addBtn"
                                data-nis="<?= $result['nis'] ?>"
                                data-nama="<?= $result['nama'] ?>"
                                data-bulan="Desember"
                                data-kelas="<?= $result['kelas'] ?>"><i class='bx bx-plus'></i></button></td>
                                
                                <?php } else {?>
                                <td><button class="hireBtn"
                                data-nis="<?= $result['nis'] ?>"
                                data-nama="<?= $result['nama'] ?>"
                                data-bulan="Desember"
                                data-kelas="<?= $result['kelas'] ?>"
                                data-nominal="<?= $result['desember'] ?>"
                                ><?=$formattedValue?></button></td><?php }?>

                                <?php $formattedValue = number_format($result['januari'], 0, ',', '.'); 
                                if ($formattedValue == 0) {?>
                                <td><button class="addBtn"
                                data-nis="<?= $result['nis'] ?>"
                                data-nama="<?= $result['nama'] ?>"
                                data-bulan="Januari"
                                data-kelas="<?= $result['kelas'] ?>"><i class='bx bx-plus'></i></button></td>
                                
                                <?php } else {?>
                                <td><button class="hireBtn"
                                data-nis="<?= $result['nis'] ?>"
                                data-nama="<?= $result['nama'] ?>"
                                data-bulan="Januari"
                                data-kelas="<?= $result['kelas'] ?>"
                                data-nominal="<?= $result['januari'] ?>"
                                ><?=$formattedValue?></button></td><?php }?>

                                <?php $formattedValue = number_format($result['februari'], 0, ',', '.'); 
                                if ($formattedValue == 0) {?>
                                <td><button class="addBtn"
                                data-nis="<?= $result['nis'] ?>"
                                data-nama="<?= $result['nama'] ?>"
                                data-bulan="Februari"
                                data-kelas="<?= $result['kelas'] ?>"><i class='bx bx-plus'></i></button></td>

                                <?php } else {?>
                                <td><button class="hireBtn"
                                data-nis="<?= $result['nis'] ?>"
                                data-nama="<?= $result['nama'] ?>"
                                data-bulan="Februari"
                                data-kelas="<?= $result['kelas'] ?>"
                                data-nominal="<?= $result['februari'] ?>"
                                ><?=$formattedValue?></button></td><?php }?>

                                <?php $formattedValue = number_format($result['maret'], 0, ',', '.'); 
                                if ($formattedValue == 0) {?>
                                <td><button class="addBtn"
                                data-nis="<?= $result['nis'] ?>"
                                data-nama="<?= $result['nama'] ?>"
                                data-bulan="Maret"
                                data-kelas="<?= $result['kelas'] ?>"><i class='bx bx-plus'></i></button></td>
                                
                                <?php } else {?>
                                <td><button class="hireBtn"
                                data-nis="<?= $result['nis'] ?>"
                                data-nama="<?= $result['nama'] ?>"
                                data-bulan="Maret"
                                data-kelas="<?= $result['kelas'] ?>"
                                data-nominal="<?= $result['maret'] ?>"
                                ><?=$formattedValue?></button></td><?php }?>

                                <?php $formattedValue = number_format($result['april'], 0, ',', '.'); 
                                if ($formattedValue == 0) {?>
                                <td><button class="addBtn"
                                data-nis="<?= $result['nis'] ?>"
                                data-nama="<?= $result['nama'] ?>"
                                data-bulan="April"
                                data-kelas="<?= $result['kelas'] ?>"><i class='bx bx-plus'></i></button></td>
                                
                                <?php } else {?>
                                <td><button class="hireBtn"
                                data-nis="<?= $result['nis'] ?>"
                                data-nama="<?= $result['nama'] ?>"
                                data-bulan="April"
                                data-kelas="<?= $result['kelas'] ?>"
                                data-nominal="<?= $result['april'] ?>"
                                ><?=$formattedValue?></button></td><?php }?>

                                <?php $formattedValue = number_format($result['mei'], 0, ',', '.'); 
                                if ($formattedValue == 0) {?>
                                <td><button class="addBtn"
                                data-nis="<?= $result['nis'] ?>"
                                data-nama="<?= $result['nama'] ?>"
                                data-bulan="Mei"
                                data-kelas="<?= $result['kelas'] ?>"><i class='bx bx-plus'></i></button></td>
                                
                                <?php } else {?>
                                <td><button class="hireBtn"
                                data-nis="<?= $result['nis'] ?>"
                                data-nama="<?= $result['nama'] ?>"
                                data-bulan="Mei"
                                data-kelas="<?= $result['kelas'] ?>"
                                data-nominal="<?= $result['mei'] ?>"
                                ><?=$formattedValue?></button></td><?php }?>

                                <?php $formattedValue = number_format($result['juni'], 0, ',', '.'); 
                                if ($formattedValue == 0) {?>
                                <td><button class="addBtn"
                                data-nis="<?= $result['nis'] ?>"
                                data-nama="<?= $result['nama'] ?>"
                                data-bulan="Juni"
                                data-kelas="<?= $result['kelas'] ?>"><i class='bx bx-plus'></i></button></td>
                                
                                <?php } else {?>
                                <td><button class="hireBtn"
                                data-nis="<?= $result['nis'] ?>"
                                data-nama="<?= $result['nama'] ?>"
                                data-bulan="Juni"
                                data-kelas="<?= $result['kelas'] ?>"
                                data-nominal="<?= $result['juni'] ?>"
                                ><?=$formattedValue?></button></td><?php }?>

                                


                                </tr>
                                <?php endforeach ?>
                            </table>
                            </div>
                            <div class="table-fixed">
                            <table>
                                <tr class="data-title">
                                <th>Total</th>
                                </tr>
                                <?php foreach ($results as $result) :?>
                                <tr class="data-list">
                                <?php $formattedValue = number_format($result['total'], 0, ',', '.'); ?>
                                <td><button id="hireBtn"><?=$formattedValue?></button></td>
                                </tr>
                                <?php endforeach ?>
                            </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    
    <div class="pop-outer">
        <div class="pop-up">
            <i id="closeBtn" class='bx bx-x'></i>
            <span class="title">Data siswa</span>
            <div class="input-data">
                <div class="data label-input">
                    <span class="text">NIS</span>
                    <span class="text">Nama</span>
                    <span class="text">Nominal</span>
                    <span class="text">Bulan</span>
                    <span class="text">Kelas</span>
                </div>

                <form action="proses-pengeditan.php?kelas=<?=$kelas?>&tahun=<?=$tahun?>&pencarian=<?=$pencarian?>" method="POST">
                <div class="data input-box">
                    <input type="text" name="nis" id="nisInput" readonly>
                    <input type="text" name="nama" id="namaInput" readonly>
                    <input type="text" name="nominal" id="nominalInput">
                    <input type="text" name="bulan" id="bulanInput" readonly>
                    <input type="text" name="kelas" id="kelasInput" readonly>
                    <input type="hidden" name="nominalAwal" id="nominalAwalInput">
                </div>
            </div>
            <div class="btn-action">
                <input type="submit" class="btn btn1" name="edit" value="Edit">
                <input type="submit" class="btn btn2" name="hapus" value="Hapus">
                <a class="btn btn3" href="">Print</a>
            </div>
                </form>
        </div>
    </div>
    <div class="pop-add">
        <div class="pop-up">
            <i id="closeBtn" class='bx bx-x'></i>
            <span class="title">Data siswa</span>
            <div class="input-data">
                <div class="data label-input">
                    <span class="text">NIS</span>
                    <span class="text">Nama</span>
                    <span class="text">Nominal</span>
                    <span class="text">Bulan</span>
                    <span class="text">Kelas</span>
                </div>

                <form action="proses-pendapatan.php?kelas=<?=$kelas?>&tahun=<?=$tahun?>&pencarian=<?=$pencarian?>" method="POST">
    <div class="data input-box">
        <input type="text" name="nis" id="nisInput" readonly>
        <input type="text" name="nama" id="namaInput" readonly>
        <input type="text" name="nominal" id="">
        <input type="text" name="bulan" id="bulanInput" readonly>
        <input type="text" name="kelas" id="kelasInput" readonly>
    </div>
    <div class="btnAdd-action">
        <input type="submit" value="Tambah" class="btn btn1">
        <a id="closeBtn" class="btn closeBtn" href="#">Batal</a>
    </div>
</form>


        </div>
    </div>
    <script src="js/script-pendapatan.js"></script>
    <script src="js/script.js"></script>
    <script src="js/script-indicator.js"></script>
</body>
</html>