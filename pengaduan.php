<?php
require_once "config/database.php";

$pesan = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nama = trim($_POST["nama"]);
    $no_hp = trim($_POST["no_hp"]);
    $email = trim($_POST["email"]);
    $judul = trim($_POST["judul"]);
    $isi = trim($_POST["isi"]);

    // Nomor pengaduan otomatis
    $nomor_pengaduan = "PGD-" . date("YmdHis");

    $query = "INSERT INTO pengaduan
              (nomor_pengaduan, nama, no_hp, email, jenis, judul, isi, status)
              VALUES (?, ?, ?, ?, 'Pengaduan', ?, ?, 'Menunggu')";

    $stmt = $conn->prepare($query);

    $stmt->bind_param(
        "ssssss",
        $nomor_pengaduan,
        $nama,
        $no_hp,
        $email,
        $judul,
        $isi
    );

    if ($stmt->execute()) {

        $pesan = "Pengaduan berhasil dikirim. Nomor Pengaduan Anda: "
               . $nomor_pengaduan;

    } else {

        $pesan = "Pengaduan gagal dikirim.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Pengaduan Masyarakat</title>

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
            width: 700px;
            margin: 40px auto;
        }

        .box {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        }

        h1 {
            color: #23456d;
            margin-bottom: 10px;
        }

        .keterangan {
            color: #666;
            margin-bottom: 25px;
        }

        label {
            display: block;
            margin-top: 15px;
            margin-bottom: 6px;
            font-weight: bold;
        }

        input,
        textarea {
            width: 100%;
            padding: 12px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        textarea {
            height: 150px;
            resize: vertical;
        }

        button {
            width: 100%;
            padding: 13px;
            margin-top: 25px;
            background: #23456d;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background: #183653;
        }

        .pesan {
            background: #d1e7dd;
            color: #0f5132;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
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

        <h1>Form Pengaduan</h1>

        <p class="keterangan">
            Silakan isi formulir berikut untuk menyampaikan
            pengaduan kepada DPMPTSP Kabupaten Langkat.
        </p>

        <?php if ($pesan != ""): ?>

            <div class="pesan">
                <?= htmlspecialchars($pesan) ?>
            </div>

        <?php endif; ?>


        <form method="POST">

            <label>Nama Lengkap</label>

            <input
                type="text"
                name="nama"
                placeholder="Masukkan nama lengkap"
                required
            >


            <label>Nomor HP</label>

            <input
                type="text"
                name="no_hp"
                placeholder="Masukkan nomor HP"
                required
            >


            <label>Email</label>

            <input
                type="email"
                name="email"
                placeholder="Masukkan email"
            >


            <label>Judul Pengaduan</label>

            <input
                type="text"
                name="judul"
                placeholder="Masukkan judul pengaduan"
                required
            >


            <label>Isi Pengaduan</label>

            <textarea
                name="isi"
                placeholder="Tuliskan pengaduan Anda"
                required
            ></textarea>


            <button type="submit">
                Kirim Pengaduan
            </button>

        </form>

    </div>

</div>

</body>
</html>