<?php
session_start();

if(isset($_SESSION['privilege'])) {
    echo $_SESSION['privilege'];
}

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
            $_SESSION['privilege'] = "admin";

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
<html>
<head>
    <title>Form Login</title>
    <link rel="stylesheet" href="css/style-login.css">
</head>
<body>
    <h2>Form Login</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="nip">NIP:</label>
        <input type="text" name="nip" required><br><br>
        <label for="password">Password:</label>
        <input type="password" name="password" required><br><br>
        <input type="submit" value="login">
    </form>
</body>
</html>
