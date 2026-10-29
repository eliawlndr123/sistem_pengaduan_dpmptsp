<?php
session_start();

// 1. Pengecekan Session Admin (sesuai login.php Anda)
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

// 2. Hubungkan ke Database (keluar 1 folder untuk mengambil config)
require '../config/database.php';

// 3. Query SQL untuk mengambil seluruh data pengaduan masyarakat
// Sesuaikan 'tgl_pengaduan' dengan nama kolom tanggal di database Anda jika berbeda
$query = "SELECT * FROM pengaduan ORDER BY id DESC";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query error: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Pengaduan - Admin</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background: #f4f6f9;
        }

        .sidebar {
            width: 230px;
            height: 100vh;
            background: #1e3a5f;
            position: fixed;
            left: 0;
            top: 0;
            padding-top: 20px;
        }

        .sidebar h2 {
            color: white;
            text-align: center;
        }

        .sidebar a {
            display: block;
            color: white;
            text-decoration: none;
            padding: 15px 20px;
        }

        .sidebar a:hover, .sidebar a.active {
            background: #2d527d;
        }

        .content {
            margin-left: 230px;
            padding: 30px;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        /* Styling Tabel Pengaduan */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th, table td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        table th {
            background-color: #1e3a5f;
            color: white;
        }

        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .badge {
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: bold;
            color: white;
        }

        .badge-proses { background-color: #ffc107; color: #000; }
        .badge-selesai { background-color: #28a745; }
        .badge-pending { background-color: #dc3545; }
    </style>
</head>
<body>

<div class="sidebar">
    <h2>ADMIN</h2>
    <a href="dashboard.php">Dashboard</a>
    <a href="pengaduan.php" class="active">Pengaduan</a>
    <a href="admin_konsultasi.php">Konsultasi</a>
    <a href="../logout.php">Logout</a>
</div>

<div class="content">
    <div class="card">
        <h1>Data Pengaduan Masyarakat</h1>
        <p>Berikut adalah daftar laporan pengaduan yang masuk dari masyarakat:</p>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Pelapor</th>
                    <th>Judul / Isi Pengaduan</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $no = 1;
                // Memeriksa apakah ada data pengaduan
                if (mysqli_num_rows($result) > 0): 
                    while ($row = mysqli_fetch_assoc($result)): 
                ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <!-- Sesuaikan nama kolom di bawah dengan nama kolom pada tabel database Anda -->
                        <td><?= htmlspecialchars($row['nama'] ?? $row['nama_pelapor'] ?? 'Anonim'); ?></td>
                        <td><?= htmlspecialchars($row['isi_pengaduan'] ?? $row['laporan'] ?? '-'); ?></td>
                        <td><?= htmlspecialchars($row['tgl_pengaduan'] ?? $row['created_at'] ?? '-'); ?></td>
                        <td>
                            <?php 
                            $status = strtolower($row['status'] ?? 'pending');
                            if ($status == 'selesai') {
                                echo '<span class="badge badge-selesai">Selesai</span>';
                            } elseif ($status == 'proses') {
                                echo '<span class="badge badge-proses">Proses</span>';
                            } else {
                                echo '<span class="badge badge-pending">Pending</span>';
                            }
                            ?>
                        </td>
                    </tr>
                <?php 
                    endwhile; 
                else: 
                ?>
                    <tr>
                        <td colspan="5" style="text-align: center;">Belum ada data pengaduan masuk.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>