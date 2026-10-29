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

$query = "SELECT * FROM konsultasi ORDER BY id DESC";
$result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <title>Data Konsultasi</title>

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

            padding: 15px 10px;

            font-size: 17px;

            border-radius: 6px;
        }

        .sidebar a:hover {
            background-color: #315b89;
        }

        .content {
            margin-left: 250px;
            padding: 35px;
        }

        .box {
            background-color: white;

            padding: 25px;

            border-radius: 10px;

            overflow-x: auto;
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

            vertical-align: top;
        }

        table th {
            background-color: #23456d;

            color: white;
        }

        table tr:nth-child(even) {
            background-color: #f8f8f8;
        }

        .btn {
            display: inline-block;

            padding: 7px 10px;

            margin: 2px;

            color: white;

            text-decoration: none;

            border-radius: 5px;

            font-size: 13px;
        }

        .proses {
            background-color: #3498db;
        }

        .selesai {
            background-color: #27ae60;
        }

        .tolak {
            background-color: #e74c3c;
        }

        .btn:hover {
            opacity: 0.8;
        }

        .kosong {
            text-align: center;

            padding: 30px;

            color: #777;
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

    <div class="box">

        <h1>
            Data Konsultasi Masyarakat
        </h1>


        <table>

            <tr>

                <th>No</th>

                <th>No. Konsultasi</th>

                <th>Nama</th>

                <th>No. HP</th>

                <th>Email</th>

                <th>Topik</th>

                <th>Isi Konsultasi</th>

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
                        <?= htmlspecialchars($data['nomor_konsultasi']); ?>
                    </td>

                    <td>
                        <?= htmlspecialchars($data['nama']); ?>
                    </td>

                    <td>
                        <?= htmlspecialchars($data['no_hp']); ?>
                    </td>

                    <td>
                        <?= htmlspecialchars($data['email']); ?>
                    </td>

                    <td>
                        <?= htmlspecialchars($data['topik']); ?>
                    </td>

                    <td>
                        <?= htmlspecialchars($data['isi']); ?>
                    </td>

                    <td>
                        <?= htmlspecialchars($data['created_at']); ?>
                    </td>

                    <td>
                        <?= htmlspecialchars($data['status']); ?>
                    </td>

                    <td>

                        <a
                            class="btn proses"
                            href="ubah_status_konsultasi.php?id=<?= $data['id']; ?>&status=Diproses"
                            onclick="return confirm('Ubah status menjadi Diproses?')"
                        >
                            Proses
                        </a>


                        <a
                            class="btn selesai"
                            href="ubah_status_konsultasi.php?id=<?= $data['id']; ?>&status=Selesai"
                            onclick="return confirm('Ubah status menjadi Selesai?')"
                        >
                            Selesai
                        </a>


                        <a
                            class="btn tolak"
                            href="ubah_status_konsultasi.php?id=<?= $data['id']; ?>&status=Ditolak"
                            onclick="return confirm('Ubah status menjadi Ditolak?')"
                        >
                            Tolak
                        </a>

                    </td>

                </tr>

            <?php

                }

            } else {

            ?>

                <tr>

                    <td colspan="10" class="kosong">
                        Belum ada konsultasi dari masyarakat.
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