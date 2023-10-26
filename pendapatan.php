
<!--PHP PEMASUKAN-->


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
                <li><a href="login.php">
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
               <form action="{{ route('siswa.search') }}" METHOD="GET">
                <input class="submit" type="submit" value="">
                <input class="search" type="text" placeholder="Cari NIS / Nama" name="pencarian">
                </form>
            </div>
        </div>
        <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <i class='bx bx-line-chart'></i>
                    <span class="text">Data Siswa</span>
                </div>
                <div class="boxes">
                    <div class="box box1">
                        <div class="header-box">
                            <i class='bx bx-money'></i>
                            <span class="text">Total Murid</span>
                        </div>
                        <span class="number">TOTAL MURID ADALAH =</span>
                    </div>
                    <div class="box box2">
                        <div class="header-box">
                            <i class='bx bxs-graduation'></i>
                            <span class="text">Tahun Kelahiran</span>
                        </div>
                        <span class="number">Tahun Kelahiran BLABLABLA</span>
                    </div>
                    <div class="box box3">
                        <div class="header-box">
                            <i class='bx bxs-school'></i>
                            <span class="text">NAMA KELAS</span>
                        </div>
                        <span class="number">JUMLAH SISWA DI KELAS</span>
                    </div>
                </div>
            </div>

            <div class="activity">
                <div class="header-activity">
                    <div class="select-1">
                         <span class="select-title">TAHUN KELAHIRAN</span>
                        <select name="tahun" id="tahunSelect">
                            <option value="">Tahun Kelahiran</option>
    <option value="2006">2006</option>
    <option value="2007">2007</option>
    <option value="2008">2008</option>
                        </select>
                    </div>
                    <div class="select-2">
                        <span class="select-title">Kelas</span>
                       <select name="kelas" id="kelasSelect">
                            <option value="">Semua Kelas</option>
    <option value="X-TM-1">X-TM-1</option>
    <option value="X-TM-2">X-TM-2</option>
    <option value="X-TM-3">X-TM-3</option>  
    <option value="X-TPFL-1">X-TPFL-1</option>  
    <option value="X-TPFL-2">X-TPFL-2</option>  
    <option value="X-PPLG-1">X-PPLG-1</option>
    <option value="X-PPLG-2">X-PPLG-2</option>
    <option value="X-TJKT-1">X-TJKT-1</option>
    <option value="X-TJKT-2">X-TJKT-2</option>
    <option value="X-DKV-1">X-DKV-1</option>
    <option value="X-DKV-2">X-DKV-2</option>
    <option value="X-DKV-3">X-DKV-3</option>
    <option value="X-AM-1">X-AM-1</option>
    <option value="X-AM-2">X-AM-2</option>
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

                                <table>
                                <tr class="data-title">
                                    <th>No</th>
                                </tr>
                                <?php $nomm = 1;?>
                                @foreach($siswa as $s)
                                <tr class="data-list">
                                    <td><button id="hireBtn"><?=$nomm?></button></td>
                                </tr>
                                <?php $nomm = $nomm +1; ?>
                                @endforeach
                            </table>
                        </div>

                        <div class="table-fixed">

                                <table>
                                <tr class="data-title">
                                    <th>NIS</th>
                                </tr>
                                @foreach($siswa as $s)
                                <tr class="data-list">
                                    <td><button id="hireBtn">{{$s->nis}}</button></td>
                                </tr>@endforeach
                            </table>
                        </div>


                        <div class="table-fixed">
                            <table>
                                <tr class="data-title">
                                    <th>Nama</th>
                                </tr>
                                @foreach($siswa as $s)
                                <tr class="data-list">
                                    <td><button id="hireBtn">{{ $s->nama }}</button></td>
                                </tr>@endforeach
                            </table>
                            </div>

                            <div class="table-fixed">
                                <table>
                                    <tr class="data-title">
                                    <th>Kelas</th>
                                    </tr>
                                    @foreach($siswa as $s)
                                    <tr class="data-list">
                                    <td><button id="hireBtn">{{$s->kelas}}</button></td>
                                    </tr> @endforeach
                                </table>
                           
                            </div>
                            <div class="table-fixed">
                                <table>
                                    <tr class="data-title">
                                    <th>Jenis Kelamin</th>
                                    </tr>
                                    @foreach($siswa as $s)
                                    <tr class="data-list">
                                    <td><button id="hireBtn">{{$s->jenis_kelamin}}</button></td>
                                    </tr> @endforeach
                                </table>
                           
                            </div>

                            <div class="table-fixed">
                                <table>
                                    <tr class="data-title">
                                    <th>Agama</th>
                                    </tr>
                                    @foreach($siswa as $s)
                                    <tr class="data-list">
                                    <td><button id="hireBtn">{{$s->agama}}</button></td>
                                    </tr> @endforeach
                                </table>
                           
                            </div>

                            <div class="table-fixed">
                                <table>
                                    <tr class="data-title">
                                    <th>Tempat Lahir</th>
                                    </tr>
                                    @foreach($siswa as $s)
                                    <tr class="data-list">
                                    <td><button id="hireBtn">{{$s->tempat_lahir}}</button></td>
                                    </tr> @endforeach
                                </table>
                           
                            </div>

                            <div class="table-fixed">
                                <table>
                                    <tr class="data-title">
                                    <th>Tanggal Lahir</th>
                                    </tr>
                                    @foreach($siswa as $s)
                                    <tr class="data-list">
                                    <td><button id="hireBtn">{{$s->tanggal_lahir}}</button></td>
                                    </tr> @endforeach
                                </table>
                           
                            </div>

                            <div class="table-fixed">
                                <table>
                                    <tr class="data-title">
                                    <th>Nomor Telephone</th>
                                    </tr>
                                    @foreach($siswa as $s)
                                    <tr class="data-list">
                                    <td><button id="hireBtn">{{$s->no_hp}}</button></td>
                                    </tr> @endforeach
                                </table>
                           
                            </div>

                            <div class="table-fixed">
                                <table>
                                    <tr class="data-title">
                                    <th>Alamat</th>
                                    </tr>
                                    @foreach($siswa as $s)
                                    <tr class="data-list">
                                    <td><button id="hireBtn">{{$s->alamat}}</button></td>
                                    </tr> @endforeach
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
                <input type="submit" class="btn btn3" name="print" value="Print">
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

                <!-- <form action="proses-pendapatan.php?kelas=<$kelas?>&tahun=<$tahun?>&pencarian==$pencarian?>" method="POST">
    <div class="data input-box">
        <input type="text" name="nis" id="nisInput" readonly>
        <input type="text" name="nama" id="namaInput" readonly>
        <input type="text" name="nominal" id="" value="">
        <input type="text" name="bulan" id="bulanInput" readonly>
        <input type="text" name="kelas" id="kelasInput" readonly>
    </div>
    <div class="btnAdd-action">
        <input type="submit" value="Tambah" class="btn btn1">
        <a id="closeBtn" class="btn closeBtn" href="#">Batal</a>
    </div>
</form> -->

                                    
        </div>
    </div>
    <script src="js/script-pendapatan.js"></script>
    <script src="js/script.js"></script>
    <script src="js/script-indicator.js"></script>
</body>
</html>