<?php

session_start();

require 'config/database.php';

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = trim($_POST["username"]);
    $password = md5($_POST["password"]);

    $query = "SELECT * FROM users
              WHERE username = ?
              AND password = ?
              AND role = 'admin'";

    $stmt = $conn->prepare($query);

    $stmt->bind_param(
        "ss",
        $username,
        $password
    );

    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows == 1) {

        $data = $result->fetch_assoc();

        $_SESSION["user_id"] = $data["id"];
        $_SESSION["nama"] = $data["nama"];
        $_SESSION["role"] = $data["role"];

        header("Location: admin/dashboard.php");
        exit();

    } else {

        $error = "Username atau password salah.";

    }
}

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Login Admin</title>

    <link rel="stylesheet"
          href="assets/style.css">

</head>

<body>

<div class="login">

    <h2>Login Admin</h2>

    <p>
        Silakan masuk untuk mengelola
        pengaduan dan konsultasi.
    </p>

    <?php if ($error != ""): ?>

        <div class="alert">
            <?= htmlspecialchars($error) ?>
        </div>

    <?php endif; ?>


    <form method="POST">

        <label>Username</label>

        <input
            type="text"
            name="username"
            placeholder="Masukkan username"
            required
        >


        <label>Password</label>

        <input
            type="password"
            name="password"
            placeholder="Masukkan password"
            required
        >


        <button
            type="submit"
            class="btn">
            Login
        </button>

    </form>


    <br>

    <a href="index.php">
        Kembali ke Beranda
    </a>

</div>

</body>

</html>