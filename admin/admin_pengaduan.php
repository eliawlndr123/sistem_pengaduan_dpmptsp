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

// Ambil semua data pengaduan
$query = "SELECT * FROM pengaduan ORDER BY id DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Data Pengaduan</title>

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

        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background-color: #23456d;
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
            padding: 15px 0;
            font-size: 18px;
        }

        .sidebar a:hover {
            background-color: #315b89;
            padding-left: 10px;
        }

        .content {
            margin-left: 250px;
            padding: 35px;
        }

        .box {
            background: white;
            padding: 25px;
            border-radius: 10px;
        }

        h1 {
            margin-bottom: 25px;
            color: #23456d;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th,
        table td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        table th {
            background-color: #23456d;
            color: white;
        }

        table tr:nth-child(even) {
            background-color: #f8f8f8;
        }

        .kosong {
            text-align: center;
            padding: 30px;
            color: #777;
        }

        /* Tombol aksi */
        .aksi {
            display: flex;
            gap: 5px;
            flex-wrap: wrap;
        }

        .btn {
            display: inline-block;
            padding: 8px 12px;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 14px;
        }

        .btn-proses {
            background-color: #f0ad4e;
        }

        .btn-selesai {
            background-color: #28a745;
        }

        .btn-tolak {
            background-color: #dc3545;
        }

        .btn:hover {
            opacity: 0.8;
        }

        .status {
            font-weight: bold;
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


<!-- ISI HALAMAN -->

<div class="content">

    <div class="box">

        <h1>Data Pengaduan Masyarakat</h1>

        <table>

            <tr>

                <th>No</th>

                <th>Nama</th>

                <th>Email</th>

                <th>No. HP</th>

                <th>Pengaduan</th>

                <th>Tanggal</th>

                <th>Status</th>

                <th>Aksi</th>

            </tr>


            <?php

            $no = 1;

            if (mysqli_num_rows($result) > 0) {

                while ($data = mysqli_fetch_assoc($result)) {

            ?>

            <tr>

                <td>
                    <?= $no++; ?>
                </td>

                <td>
                    <?= htmlspecialchars($data['nama']); ?>
                </td>

                <td>
                    <?= htmlspecialchars($data['email']); ?>
                </td>

                <td>
                    <?= htmlspecialchars($data['no_hp']); ?>
                </td>

                <td>
                    <?= htmlspecialchars($data['isi']); ?>
                </td>

                <td>
                    <?= htmlspecialchars($data['created_at']); ?>
                </td>

                <td class="status">
                    <?= htmlspecialchars($data['status']); ?>
                </td>

                <td>

                    <div class="aksi">

                        <a
                            class="btn btn-proses"
                            href="ubah_status.php?id=<?= $data['id']; ?>&status=Diproses"
                            onclick="return confirm('Ubah status menjadi Diproses?')">
                            Proses
                        </a>

                        <a
                            class="btn btn-selesai"
                            href="ubah_status.php?id=<?= $data['id']; ?>&status=Selesai"
                            onclick="return confirm('Ubah status menjadi Selesai?')">
                            Selesai
                        </a>

                        <a
                            class="btn btn-tolak"
                            href="ubah_status.php?id=<?= $data['id']; ?>&status=Ditolak"
                            onclick="return confirm('Ubah status menjadi Ditolak?')">
                            Tolak
                        </a>

                    </div>

                </td>

            </tr>

            <?php

                }

            } else {

            ?>

            <tr>

                <td colspan="8" class="kosong">
                    Belum ada pengaduan dari masyarakat.
                </td>

            </tr>

            <?php

            }

            ?>

        </table>

    </div>

</div>

</body>

</html>