<?php
session_start();

if (!isset($_SESSION['user_id']) || !isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}

require_once "../config/database.php";

if (isset($_POST['simpan'])) {

    $id = $_POST['id'];
    $status = $_POST['status'];
    $tanggapan = $_POST['tanggapan'];

    $query = mysqli_query($conn, "
        UPDATE pengaduan
        SET status = '$status',
            tanggapan = '$tanggapan'
        WHERE id = '$id'
    ");

    if ($query) {
        header("Location: admin_pengaduan.php");
        exit;
    }
}

$id = $_GET['id'];

$result = mysqli_query($conn, "
    SELECT * FROM pengaduan
    WHERE id = '$id'
");

$data = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Ubah Status</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f1f3f6;
            padding: 40px;
        }

        .box {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
        }

        h2 {
            color: #23456d;
            margin-bottom: 25px;
        }

        label {
            display: block;
            margin-top: 15px;
            margin-bottom: 7px;
        }

        select,
        textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        textarea {
            height: 120px;
        }

        button {
            margin-top: 20px;
            padding: 12px 20px;
            background: #23456d;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>

<body>

<div class="box">

    <h2>Proses Pengaduan / Konsultasi</h2>

    <p>
        <strong>Nama:</strong>
        <?= htmlspecialchars($data['nama']); ?>
    </p>

    <p>
        <strong>Judul:</strong>
        <?= htmlspecialchars($data['judul']); ?>
    </p>

    <form method="POST">

        <input type="hidden" name="id" value="<?= $data['id']; ?>">

        <label>Status</label>

        <select name="status" required>
            <option value="Menunggu"
                <?= $data['status'] == 'Menunggu' ? 'selected' : ''; ?>>
                Menunggu
            </option>

            <option value="Diproses"
                <?= $data['status'] == 'Diproses' ? 'selected' : ''; ?>>
                Diproses
            </option>

            <option value="Selesai"
                <?= $data['status'] == 'Selesai' ? 'selected' : ''; ?>>
                Selesai
            </option>

            <option value="Ditolak"
                <?= $data['status'] == 'Ditolak' ? 'selected' : ''; ?>>
                Ditolak
            </option>
        </select>

        <label>Tanggapan Admin</label>

        <textarea name="tanggapan"
            placeholder="Masukkan tanggapan untuk masyarakat..."><?= htmlspecialchars($data['tanggapan'] ?? ''); ?></textarea>

        <button type="submit" name="simpan">
            Simpan
        </button>

    </form>

</div>

</body>
</html>