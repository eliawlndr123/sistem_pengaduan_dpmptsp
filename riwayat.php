<?php

require_once "config/database.php";

$query = mysqli_query($conn, "
    SELECT *
    FROM pengaduan
    ORDER BY id DESC
");

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Riwayat Pengaduan dan Konsultasi</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f1f3f6;
            margin: 0;
        }

        .navbar {
            background: #23456d;
            padding: 18px 30px;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            margin-right: 25px;
        }

        .container {
            padding: 30px;
        }

        .box {
            background: white;
            padding: 25px;
            border-radius: 10px;
        }

        h1 {
            color: #23456d;
            margin-bottom: 25px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background: #23456d;
            color: white;
        }

        .status {
            font-weight: bold;
        }

        .kosong {
            text-align: center;
            color: #777;
            padding: 30px;
        }
    </style>
</head>

<body>

<div class="navbar">
    <a href="index.php">Dashboard</a>
    <a href="pengaduan.php">Pengaduan</a>
    <a href="konsultasi.php">Konsultasi</a>
    <a href="riwayat.php">Riwayat</a>
</div>

<div class="container">

    <div class="box">

        <h1>Riwayat Pengaduan dan Konsultasi</h1>

        <table>

            <tr>
                <th>No</th>
                <th>Jenis</th>
                <th>Judul</th>
                <th>Isi</th>
                <th>Tanggal</th>
                <th>Status</th>
                <th>Tanggapan Admin</th>
            </tr>

            <?php
            $no = 1;

            if (mysqli_num_rows($query) > 0) {

                while ($data = mysqli_fetch_assoc($query)) {
            ?>

            <tr>

                <td><?= $no++; ?></td>

                <td>
                    <?= htmlspecialchars($data['jenis']); ?>
                </td>

                <td>
                    <?= htmlspecialchars($data['judul']); ?>
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
                    <?php
                    if (!empty($data['tanggapan'])) {
                        echo htmlspecialchars($data['tanggapan']);
                    } else {
                        echo "Belum ada tanggapan";
                    }
                    ?>
                </td>

            </tr>

            <?php
                }

            } else {
            ?>

            <tr>
                <td colspan="7" class="kosong">
                    Belum ada pengaduan atau konsultasi.
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