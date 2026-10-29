<?php
session_start();

// Cek apakah admin sudah login
if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - DPMPTSP</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #f1f3f6;
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: #23456d;
            position: fixed;
            left: 0;
            top: 0;
            padding: 20px;
        }

        .sidebar h2 {
            color: white;
            text-align: center;
            margin-bottom: 40px;
        }

        .sidebar a {
            display: block;
            color: white;
            text-decoration: none;
            padding: 15px 2px;
            font-size: 18px;
            margin-bottom: 5px;
        }

        .sidebar a:hover {
            background-color: #315b89;
            padding-left: 10px;
        }

        .content {
            margin-left: 250px;
            padding: 40px;
        }

        .welcome {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
        }

        .welcome h1 {
            font-size: 36px;
            margin-bottom: 20px;
            color: #000;
        }

        .welcome p {
            font-size: 18px;
        }
    </style>
</head>

<body>

   <div class="sidebar">
    <h2>ADMIN</h2>

    <a href="dashboard.php">Dashboard</a>
    <a href="admin_pengaduan.php">Pengaduan</a>
    <a href="admin_konsultasi.php">Konsultasi</a>
    <a href="../logout.php">Logout</a>
</div>

    <div class="content">

        <div class="welcome">

            <h1>Selamat Datang, Admin</h1>

            <p>
                Silakan kelola pengaduan dan konsultasi masyarakat.
            </p>

        </div>

    </div>

</body>
</html>