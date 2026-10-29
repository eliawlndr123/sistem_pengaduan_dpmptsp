<?php
session_start();
?>

<!DOCTYPE html>

<html lang="id">

<head>

<meta charset="UTF-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title>SIPK DPMPTSP Langkat</title>

<link rel="stylesheet"
      href="assets/style.css">

<style>

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Segoe UI", Arial, sans-serif;
    }

    body {
        background: #f4f8fc;
        color: #263238;
    }

    /* ================= NAVBAR ================= */

    .navbar {
        width: 100%;
        background: linear-gradient(135deg, #075985, #0e7490);
        color: white;
        padding: 16px 7%;
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: sticky;
        top: 0;
        z-index: 1000;
        box-shadow: 0 4px 15px rgba(0,0,0,0.12);
    }

    .logo {
        .navbar a {
    color: white !important;
}
    }

    .navbar div:last-child {
        display: flex;
        gap: 6px;
        align-items: center;
    }

    .navbar a {
        color: white;
        text-decoration: none;
        padding: 10px 14px;
        border-radius: 8px;
        font-size: 14px;
        transition: 0.3s;
    }

    .navbar a:hover {
        background: rgba(255,255,255,0.18);
    }

    .navbar a:last-child {
        background: white;
        color: #075985;
        font-weight: 600;
    }

    .navbar a:last-child:hover {
        background: #e0f2fe;
    }


    /* ================= HERO ================= */

    .hero {
        min-height: 440px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        padding: 60px 20px;

        background:
            linear-gradient(
                rgba(7, 89, 133, 0.88),
                rgba(14, 116, 144, 0.88)
            );

        color: white;
    }

    .hero h1 {
        font-size: 43px;
        max-width: 800px;
        line-height: 1.2;
        margin-bottom: 20px;
        font-weight: 700;
    }

    .hero p {
        max-width: 750px;
        font-size: 17px;
        line-height: 1.7;
    }

    .hero .slogan {
        margin-top: 28px;
        background: rgba(255,255,255,0.15);
        padding: 12px 25px;
        border-radius: 30px;
        font-weight: 600;
    }


    /* ================= CONTAINER ================= */

    .container {
        width: 86%;
        max-width: 1150px;
        margin: auto;
        padding: 55px 0;
    }


    /* ================= CARDS ================= */

    .cards {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 25px;
        margin-bottom: 55px;
    }

    .card {
        background: white;
        padding: 30px 25px;
        border-radius: 18px;
        text-align: center;
        box-shadow: 0 7px 25px rgba(0,0,0,0.07);
        border: 1px solid #e8eef3;
        transition: 0.3s;
    }

    .card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.12);
    }

    .card-icon {
        width: 65px;
        height: 65px;
        margin: 0 auto 18px;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 28px;
        background: #e0f2fe;
    }

    .card h3 {
        color: #075985;
        font-size: 21px;
        margin-bottom: 12px;
    }

    .card p {
        color: #64748b;
        line-height: 1.7;
        font-size: 14px;
    }


    /* ================= BUTTON ================= */

    .card-button {
        display: inline-block;
        margin-top: 20px;
        padding: 10px 18px;
        background: #075985;
        color: white;
        text-decoration: none;
        border-radius: 8px;
        font-size: 13px;
        transition: 0.3s;
    }

    .card-button:hover {
        background: #0e7490;
    }


    /* ================= INFO ================= */

    .info {
        background: white;
        border-radius: 20px;
        padding: 35px;
        box-shadow: 0 7px 25px rgba(0,0,0,0.07);
    }

    .info h2 {
        text-align: center;
        color: #075985;
        margin-bottom: 30px;
        font-size: 25px;
    }

    .alur {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 25px;
    }

    .alur-item {
        text-align: center;
        padding: 20px;
    }

    .nomor {
        width: 45px;
        height: 45px;
        background: #075985;
        color: white;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 0 auto 15px;
        font-weight: bold;
        font-size: 18px;
    }

    .alur-item h3 {
        color: #334155;
        margin-bottom: 8px;
        font-size: 16px;
    }

    .alur-item p {
        color: #64748b;
        line-height: 1.6;
        font-size: 13px;
    }


    /* ================= FOOTER ================= */

    footer {
        background: #082f49;
        color: white;
        text-align: center;
        padding: 25px;
        font-size: 13px;
        line-height: 1.7;
    }


    /* ================= RESPONSIVE ================= */

    @media (max-width: 900px) {

        .navbar {
            flex-direction: column;
            gap: 15px;
        }

        .navbar div:last-child {
            flex-wrap: wrap;
            justify-content: center;
        }

        .hero h1 {
            font-size: 34px;
        }

        .cards {
            grid-template-columns: 1fr;
        }

        .alur {
            grid-template-columns: 1fr;
        }

    }


    @media (max-width: 600px) {

        .logo {
            font-size: 17px;
        }

        .navbar a {
            font-size: 12px;
            padding: 8px;
        }

        .hero {
            min-height: 400px;
        }

        .hero h1 {
            font-size: 28px;
        }

        .hero p {
            font-size: 14px;
        }

        .container {
            width: 92%;
        }

    }

</style>

</head>

<body>

<!-- ================= NAVBAR ================= -->

<nav class="navbar">

<div class="logo">
    SIPK DPMPTSP LANGKAT
</div>

<div>

    <a href="index.php">
        Beranda
    </a>

    <a href="pengaduan.php">
        Pengaduan
    </a>

    <a href="konsultasi.php">
        Konsultasi
    </a>

    <a href="riwayat.php">
        Riwayat
    </a>

    <a href="login.php">
        Login Admin
    </a>

</div>

</nav>

<!-- ================= HERO ================= -->

<section class="hero">

<h1>
   <h1 style="color: white !important;">
    Sistem Informasi Pengaduan
    dan Konsultasi
</h1>
</h1>

<p>
    Dinas Penanaman Modal dan
    Pelayanan Perizinan Terpadu
    Satu Pintu Kabupaten Langkat
</p>

<p class="slogan">
    📢 Sampaikan Pengaduan dan Konsultasi Anda,
    Kami Siap Melayani
</p>


</section>

<!-- ================= CONTENT ================= -->

<div class="container">


<!-- CARD LAYANAN -->

<div class="cards">


    <!-- PENGADUAN -->

    <div class="card">

        <div class="card-icon">
            📝
        </div>

        <h3>
            Pengaduan
        </h3>

        <p>
            Masyarakat dapat menyampaikan
            pengaduan terkait pelayanan
            perizinan dengan mudah dan cepat.
        </p>

        <a href="pengaduan.php"
           class="card-button">
            Buat Pengaduan
        </a>

    </div>


    <!-- KONSULTASI -->

    <div class="card">

        <div class="card-icon">
            💬
        </div>

        <h3>
            Konsultasi
        </h3>

        <p>
            Masyarakat dapat melakukan
            konsultasi mengenai pelayanan
            dan perizinan.
        </p>

        <a href="konsultasi.php"
           class="card-button">
            Mulai Konsultasi
        </a>

    </div>


    <!-- RIWAYAT -->

    <div class="card">

        <div class="card-icon">
            📋
        </div>

        <h3>
            Informasi Status
        </h3>

        <p>
            Masyarakat dapat melihat
            riwayat pengaduan dan mengetahui
            perkembangan proses pengaduan.
        </p>

        <a href="riwayat.php"
           class="card-button">
            Lihat Riwayat
        </a>

    </div>


</div>


<!-- ================= ALUR ================= -->

<div class="info">

    <h2>
        Alur Pengaduan dan Konsultasi
    </h2>

    <div class="alur">


        <div class="alur-item">

            <div class="nomor">
                1
            </div>

            <h3>
                Sampaikan
            </h3>

            <p>
                Masyarakat mengisi formulir
                pengaduan atau konsultasi
                melalui sistem.
            </p>

        </div>


        <div class="alur-item">

            <div class="nomor">
                2
            </div>

            <h3>
                Diproses
            </h3>

            <p>
                Data pengaduan masuk ke sistem
                dan diterima oleh admin untuk
                diproses.
            </p>

        </div>


        <div class="alur-item">

            <div class="nomor">
                3
            </div>

            <h3>
                Selesai
            </h3>

            <p>
                Admin memberikan tanggapan
                dan masyarakat dapat melihat
                status pengaduannya.
            </p>

        </div>


    </div>

</div>


</div>

<!-- ================= FOOTER ================= -->

<footer>

<strong>
    DPMPTSP Kabupaten Langkat
</strong>

<br>

Sistem Informasi Pengaduan dan Konsultasi

<br>

&copy; 2026


</footer>

</body>

</html>
