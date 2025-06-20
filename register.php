<?php
$koneksi = mysqli_connect("localhost", "root", "", "greenharvest");
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $username = $_POST["username"];
    $address = $_POST["address"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT); // Hash password

    $query = "INSERT INTO `green harvest` (`id`, `email_or_phone`, `username`, `address`, `Password`)
              VALUES (NULL, '$email', '$username', '$address', '$password')";
    
    if (mysqli_query($koneksi, $query)) {
        echo "Registrasi berhasil! <a href='login.php'>Login sekarang</a>";
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register Green Harvest</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        input { margin-bottom: 10px; width: 300px; padding: 5px; }
    </style>
</head>
<body>
    <h2>Form Register Green Harvest</h2>
    <form method="POST">
        Email / Phone:<br>
        <input type="text" name="email" required><br>
        Username:<br>
        <input type="text" name="username" required><br>
        Address:<br>
        <input type="text" name="address" required><br>
        Password:<br>
        <input type="password" name="password" required><br>
        <button type="submit">Register</button>
    </form>
</body>
</html>
