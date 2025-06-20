<?php
session_start();
$koneksi = mysqli_connect("localhost", "root", "", "greenharvest");

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $query = "SELECT * FROM `green harvest` WHERE username='$username'";
    $result = mysqli_query($koneksi, $query);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row["Password"])) {
            $_SESSION["username"] = $username;
            header("Location: dashboard.php");
            exit;
        } else {
            $error = "Password salah!";
        }
    } else {
        $error = "Username tidak ditemukan!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Green Harvest</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        input { margin-bottom: 10px; width: 300px; padding: 5px; }
    </style>
</head>
<body>
    <h2>Login Green Harvest</h2>
    <?php if (!empty($error)) { echo "<p style='color:red;'>$error</p>"; } ?>
    <form method="POST">
        Username:<br>
        <input type="text" name="username" required><br>
        Password:<br>
        <input type="password" name="password" required><br>
        <button type="submit">Login</button>
    </form>
    <p>Belum punya akun? <a href="register.php">Register di sini</a></p>
</body>
</html>
