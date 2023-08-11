<?php

$_SESSION['privilege'] = "";

$conn = mysqli_connect('localhost','root','','SPMP');
if ($conn->connect_error) {
    die("Koneksi ke database gagal: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nip = $_POST['nip'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM akun_tb WHERE nip = '$nip' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

        $row = $result->fetch_assoc();
        $privilege = $row['privilege'];

        if ($privilege == 'admin') {
            echo "Selamat datang, Admin!";
            $_SESSION['privilege'] = 'admin';

            header("Location: index.php");
            exit();

        } elseif ($privilege == 'user') {
            echo "Selamat datang, User!";
            $_SESSION['privilege'] = 'user'; 

            header("Location: user.php");
            exit();

        } elseif ($privilege == 'user') {
            echo "Selamat datang, user!";
            $_SESSION['privilege'] = 'user'; 

            header("Location: user.php");
            exit();

        } else {
            echo "Privilege tidak valid.";
        }

    } else {
        echo "Login gagal. Periksa kembali nip dan password Anda.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style-login.css">
    <link rel="shortcut icon" href="image/icon.svg" type="">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <title>SPMP</title>
</head>

<body>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="container">
            <img class="image" src="image/loginn.jpg" alt="">
            <div class="login">
                <div class="action">
                    <div class="head">
                        <h1 class="title">Selamat datang di SMPM</h1>
                        <h3 class="subtitle">sebuah aplikasi berbasis website yang dirancang untuk menyimpan dan menganalisis data uang sumbangan siswa.</h3>
                    </div>
                    <div class="input">
                        <div class="username">
                            <h3>NIP</h3>
                            <input type="text" name="nip" class="input-username" required>
                        </div>
                        <div class="password">
                            <h3>password</h3>
                            <input type="password" name="password" class="input-password" required>
                        </div>
                    </div>
                    <input type="submit" value="login" class="submit">
                </div>
            </div>
        </div>
    </form>
</body>

</html>