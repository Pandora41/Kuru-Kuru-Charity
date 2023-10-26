<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="{{ asset('css/style-form.css') }}">
    <link rel="shortcut icon" href="image/icon.svg" type="">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <title>SPMP</title>
</head>
<body> 
    @if($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div id="validation-popup" class="popup">
    <div class="popup-content">
        <span class="popup-close-button" onclick="closeValidationPopup()">&times;</span>
        <div id="error-messages" style="color: red;"></div>
    </div>
</div>
    <!-- <form action="../process-tambah-pengeluaran.php" METHOD="POST"> -->
    <form action="{{route('siswa.update', ['siswa' => $siswa])}}" METHOD="POST" onsubmit="return validateForm()">
    @csrf
    @method('put')
    <div class="container">
        <div class="header-form">
            <a class="undo" href="../pengeluaran.php"><i class='bx bx-chevron-left-circle' ></i></a>
            <span class="title-form">Tambah Data Siswa</span>
        </div>
       
            <div class="main-form">
                <div class="input-data">
                    <div class="data input-number">
                        <span class="text">NIS</span>
                        <input type="text" name="nis" id="" placeholder="Masukkan NIS" value="{{$siswa->nis}}">
                    </div>
                    <div class="data input-number">
                        <span class="text">Masukkan Nama</span>
                        <input type="text" name="nama" id="" placeholder="Masukkan Nama" value="{{$siswa->nama}}">
                    </div>
                    <div class="data input-number">
                        <span class="text">Masukkan Jenis Kelamin</span>
                        <p>L</p>
                        <input type="radio" name="jenis_kelamin" id="" value="L">
                        <p>P</p>
                        <input type="radio" name="jenis_kelamin" id="" value="P">
                    </div>
                    <div class="data input-number">
                        <span class="text">Masukkan Tempat Lahir</span>
                        <input type="text" name="tempat_lahir" id="tempat_lahir" placeholder="Masukkan Tempat Lahir" value="{{$siswa->tempat_lahir}}">
                    </div>
                    <div class="data input-number">
                        <span class="text">Masukkan Tanggal Lahir</span>
                        <input type="date" name="tanggal_lahir" id="" value="{{$siswa->tanggal_lahir}}">
                    </div>
                    <div class="data input-number">
                        <span class="text">Masukkan Agama</span>
                        <input type="text" name="agama" id="agama" placeholder="Masukkan agama">
                    </div>
                    <div class="data input-number">
                        <span class="text">Masukkan Nomor HP</span>
                        <input type="text" name="no_hp" id="no_hp" placeholder="Masukkan NO HP">
                    </div>
                    <div class="data input-number">
                        <span class="text">Masukkan Kelas</span>
                        <input type="text" name="kelas" id="kelas" placeholder="Masukkan kelas">
                    </div>
                    <div class="data input-text">
                        <span class="text">Alamat</span>
                        <textarea name="alamat" id="" cols="30" rows="5" placeholder="ketik disini"></textarea>
                    </div>
                </div>
            </div>
        <div class="btn-form">
            <input class="btn-form" type="submit" value="Tambah">
            <a href="../pengeluaran.php">Cancel</a>
        </div>
    
    </div>
    </form>
</body>
</html>