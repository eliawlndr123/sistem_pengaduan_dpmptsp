<?php

session_start();

require 'config/database.php';

$pesan = "";
$berhasil = false;
$nomor_laporan = "";

// Jika tombol kirim ditekan
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nama   = trim($_POST['nama']);
    $email  = trim($_POST['email']);
    $no_hp  = trim($_POST['no_hp']);
    $jenis  = (int)$_POST['jenis'];
    $judul  = trim($_POST['judul']);
    $isi    = trim($_POST['isi']);

    // Validasi
    if (
        empty($nama) ||
        empty($email) ||
        empty($judul) ||
        empty($isi)
    ) {

        $pesan = "Semua data wajib diisi.";

    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $pesan = "Format email tidak valid.";

    } else {

        // User ID jika masyarakat sudah login
        $user_id = $_SESSION['user_id'] ?? null;

        // Simpan ke database
        $stmt = $conn->prepare(
            "INSERT INTO pengaduan
            (
                user_id,
                nama,
                email,
                no_hp,
                jenis,
                judul,
                isi
            )
            VALUES (?, ?, ?, ?, ?, ?, ?)"
        );

       $stmt->bind_param(
    "isssiss", // Perhatikan: huruf ke-5 berubah dari 's' jadi 'i'
    $user_id,
    $nama,
    $email,
    $no_hp,
    $jenis,
    $judul,
    $isi
);

        if ($stmt->execute()) {

            $nomor_laporan = $stmt->insert_id;

            $berhasil = true;

        } else {

            $pesan = "Data gagal disimpan.";

        }

    }
}

?>

<!DOCTYPE html>

<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Pengaduan dan Konsultasi
    </title>

    <link
        rel="stylesheet"
        href="assets/style.css"
    >

</head>

<body>


<!-- NAVBAR -->

<nav class="navbar">

    <div class="logo">
        SIPK DPMPTSP LANGKAT
    </div>

    <div>

        <a href="index.php">
            Beranda
        </a>

        <a href="form_pengaduan.php">
            Pengaduan / Konsultasi
        </a>

        <a href="login.php">
            Login Admin
        </a>

    </div>

</nav>


<!-- FORM -->

<div class="container">

    <div class="form-box">

        <h2>
            Form Pengaduan dan Konsultasi
        </h2>

        <p>
            Silakan isi data berikut dengan
            lengkap dan benar.
        </p>


        <?php if ($berhasil): ?>

            <div class="alert">

                <h3>
                    Pengaduan Berhasil Dikirim!
                </h3>

                <p>
                    Nomor laporan Anda:
                </p>

                <h2>
                    #<?= $nomor_laporan ?>
                </h2>

                <p>
                    Simpan nomor laporan tersebut
                    untuk keperluan pengecekan.
                </p>

                <a
                    href="index.php"
                    class="btn"
                >
                    Kembali ke Beranda
                </a>

            </div>


        <?php else: ?>


            <?php if ($pesan): ?>

                <div class="alert">

                    <?= htmlspecialchars($pesan) ?>

                </div>

            <?php endif; ?>


            <form
                method="POST"
                action=""
            >


                <!-- NAMA -->

                <label>
                    Nama Lengkap
                </label>

                <input
                    type="text"
                    name="nama"
                    placeholder="Masukkan nama lengkap"
                    required
                >


                <!-- EMAIL -->

                <label>
                    Email
                </label>

                <input
                    type="email"
                    name="email"
                    placeholder="Contoh: nama@email.com"
                    required
                >


                <!-- NO HP -->

                <label>
                    Nomor HP
                </label>

                <input
                    type="text"
                    name="no_hp"
                    placeholder="Masukkan nomor HP"
                >


                <!-- JENIS -->

                <label>
                    Jenis Layanan
                </label>

                <select name="jenis" required>
    <option value="">-- Pilih Jenis --</option>
    <?php
    // Ambil daftar dari tabel jenis_pengaduan
    $query_jenis = mysqli_query($conn, "SELECT * FROM jenis_pengaduan");
    while ($row = mysqli_fetch_assoc($query_jenis)) {
        echo "<option value='" . $row['id'] . "'>" . htmlspecialchars($row['nama_jenis']) . "</option>";
    }
    ?>
</select>


                <!-- JUDUL -->

                <label>
                    Judul Pengaduan / Konsultasi
                </label>

                <input
                    type="text"
                    name="judul"
                    placeholder="Masukkan judul"
                    required
                >


                <!-- ISI -->

                <label>
                    Isi Pengaduan / Konsultasi
                </label>

                <textarea
                    name="isi"
                    rows="8"
                    placeholder="Tuliskan pengaduan atau pertanyaan Anda..."
                    required
                ></textarea>


                <!-- BUTTON -->

                <button
                    type="submit"
                    class="btn"
                >
                    Kirim Pengaduan
                </button>


                <a
                    href="index.php"
                    class="btn"
                >
                    Batal
                </a>


            </form>


        <?php endif; ?>

    </div>

</div>


<!-- FOOTER -->

<footer>

    DPMPTSP Kabupaten Langkat
    &copy; 2026

</footer>


</body>

</html>