<?php

session_start();

if (
    !isset($_SESSION['user_id']) ||
    !isset($_SESSION['role']) ||
    $_SESSION['role'] !== 'admin'
) {
    header("Location: ../login.php");
    exit;
}

require_once "../config/database.php";


// ===============================
// DATA PENGADUAN
// ===============================

// Total pengaduan
$query_total = mysqli_query(
    $conn,
    "SELECT COUNT(*) AS total FROM pengaduan"
);

$total_pengaduan = mysqli_fetch_assoc($query_total)['total'];


// Pengaduan Menunggu
$query_menunggu = mysqli_query(
    $conn,
    "SELECT COUNT(*) AS total 
     FROM pengaduan 
     WHERE status = 'Menunggu'"
);

$menunggu = mysqli_fetch_assoc($query_menunggu)['total'];


// Pengaduan Diproses
$query_diproses = mysqli_query(
    $conn,
    "SELECT COUNT(*) AS total 
     FROM pengaduan 
     WHERE status = 'Diproses'"
);

$diproses = mysqli_fetch_assoc($query_diproses)['total'];


// Pengaduan Selesai
$query_selesai = mysqli_query(
    $conn,
    "SELECT COUNT(*) AS total 
     FROM pengaduan 
     WHERE status = 'Selesai'"
);

$selesai = mysqli_fetch_assoc($query_selesai)['total'];


// Pengaduan Ditolak
$query_ditolak = mysqli_query(
    $conn,
    "SELECT COUNT(*) AS total 
     FROM pengaduan 
     WHERE status = 'Ditolak'"
);

$ditolak = mysqli_fetch_assoc($query_ditolak)['total'];


// ===============================
// DATA KONSULTASI
// ===============================

$query_konsultasi = mysqli_query(
    $conn,
    "SELECT COUNT(*) AS total FROM konsultasi"
);

$total_konsultasi = mysqli_fetch_assoc($query_konsultasi)['total'];

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard Admin</title>

    <style>

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #f1f3f6;
        }

        /* SIDEBAR */

        .sidebar {
            width: 250px;
            height: 100vh;

            position: fixed;
            left: 0;
            top: 0;

            background-color: #23456d;

            padding: 25px 20px;
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

            padding: 15px 10px;

            font-size: 17px;

            border-radius: 6px;

            margin-bottom: 5px;
        }

        .sidebar a:hover {
            background-color: #315b89;
        }


        /* CONTENT */

        .content {
            margin-left: 250px;

            padding: 35px;
        }

        .content h1 {
            margin-bottom: 10px;

            color: #23456d;
        }

        .welcome {
            color: #666;

            margin-bottom: 30px;
        }


        /* STATISTIK */

        .cards {
            display: grid;

            grid-template-columns:
                repeat(3, 1fr);

            gap: 20px;

            margin-bottom: 30px;
        }


        .card {
            background-color: white;

            padding: 25px;

            border-radius: 12px;

            box-shadow:
                0 3px 10px rgba(0,0,0,0.08);

            border-left: 6px solid #23456d;
        }

        .card h3 {
            color: #666;

            font-size: 16px;

            margin-bottom: 15px;
        }

        .card .angka {
            font-size: 32px;

            font-weight: bold;

            color: #23456d;
        }


        /* WARNA STATUS */

        .menunggu {
            border-left-color: #f0ad4e;
        }

        .menunggu .angka {
            color: #f0ad4e;
        }


        .diproses {
            border-left-color: #3498db;
        }

        .diproses .angka {
            color: #3498db;
        }


        .selesai {
            border-left-color: #27ae60;
        }

        .selesai .angka {
            color: #27ae60;
        }


        .ditolak {
            border-left-color: #e74c3c;
        }

        .ditolak .angka {
            color: #e74c3c;
        }


        .konsultasi {
            border-left-color: #8e44ad;
        }

        .konsultasi .angka {
            color: #8e44ad;
        }


        /* INFORMASI */

        .info {
            background-color: white;

            padding: 25px;

            border-radius: 12px;

            box-shadow:
                0 3px 10px rgba(0,0,0,0.08);
        }

        .info h2 {
            color: #23456d;

            margin-bottom: 10px;
        }

    </style>

</head>

<body>


<!-- SIDEBAR -->

<div class="sidebar">

    <h2>ADMIN</h2>

    <a href="dashboard.php">
        Dashboard
    </a>

    <a href="admin_pengaduan.php">
        Pengaduan
    </a>

    <a href="admin_konsultasi.php">
        Konsultasi
    </a>

    <a href="../logout.php">
        Logout
    </a>

</div>



<!-- CONTENT -->

<div class="content">

    <h1>Dashboard Admin</h1>

    <p class="welcome">
        Selamat datang di Sistem Informasi Pengaduan dan Konsultasi DPMPTSP Kabupaten Langkat.
    </p>



    <!-- KARTU STATISTIK -->

    <div class="cards">


        <!-- TOTAL PENGADUAN -->

        <div class="card">

            <h3>
                Total Pengaduan
            </h3>

            <div class="angka">
                <?= $total_pengaduan; ?>
            </div>

        </div>



        <!-- MENUNGGU -->

        <div class="card menunggu">

            <h3>
                Menunggu
            </h3>

            <div class="angka">
                <?= $menunggu; ?>
            </div>

        </div>



        <!-- DIPROSES -->

        <div class="card diproses">

            <h3>
                Sedang Diproses
            </h3>

            <div class="angka">
                <?= $diproses; ?>
            </div>

        </div>



        <!-- SELESAI -->

        <div class="card selesai">

            <h3>
                Pengaduan Selesai
            </h3>

            <div class="angka">
                <?= $selesai; ?>
            </div>

        </div>



        <!-- DITOLAK -->

        <div class="card ditolak">

            <h3>
                Pengaduan Ditolak
            </h3>

            <div class="angka">
                <?= $ditolak; ?>
            </div>

        </div>



        <!-- KONSULTASI -->

        <div class="card konsultasi">

            <h3>
                Total Konsultasi
            </h3>

            <div class="angka">
                <?= $total_konsultasi; ?>
            </div>

        </div>


    </div>



    <!-- INFORMASI -->

    <div class="info">

        <h2>
            Informasi Sistem
        </h2>

        <p>
            Dashboard ini digunakan untuk memantau data
            pengaduan dan konsultasi masyarakat yang masuk
            ke DPMPTSP Kabupaten Langkat.
        </p>

    </div>


</div>

</body>

</html>