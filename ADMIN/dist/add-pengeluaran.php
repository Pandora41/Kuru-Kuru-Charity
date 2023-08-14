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
    <form action="../process-tambah-pengeluaran.php" METHOD="POST">
    <div class="container">
        <div class="header-form">
            <a class="undo" href="../pengeluaran.php"><i class='bx bx-chevron-left-circle' ></i></a>
            <span class="title-form">Tambah Pengeluaran</span>
        </div>
       
            <div class="main-form">
                <div class="input-data">
                    <div class="data input-text">
                        <span class="text">Keterangan</span>
                        <textarea name="keterangan" id="" cols="30" rows="5" placeholder="ketik disini"></textarea>
                    </div>
                    <div class="data input-number">
                        <span class="text">Nominal</span>
                        <input type="text" name="nominal" id="" placeholder="Rp. -">
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