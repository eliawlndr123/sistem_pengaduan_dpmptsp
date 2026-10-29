<?php

session_start();

// Cek apakah admin sudah login
if (
    !isset($_SESSION['user_id']) ||
    !isset($_SESSION['role']) ||
    $_SESSION['role'] !== 'admin'
) {
    header("Location: ../login.php");
    exit;
}

// Koneksi database
require_once "../config/database.php";

// Cek ID dan status
if (!isset($_GET['id']) || !isset($_GET['status'])) {
    header("Location: admin_pengaduan.php");
    exit;
}

$id = intval($_GET['id']);
$status = $_GET['status'];

// Status yang diperbolehkan
$status_valid = [
    "Diproses",
    "Selesai",
    "Ditolak"
];

// Cek status
if (!in_array($status, $status_valid)) {
    header("Location: admin_pengaduan.php");
    exit;
}

// Update status
$query = "UPDATE pengaduan SET status = ? WHERE id = ?";

$stmt = mysqli_prepare($conn, $query);

mysqli_stmt_bind_param(
    $stmt,
    "si",
    $status,
    $id
);

// Jalankan update
if (mysqli_stmt_execute($stmt)) {

    header("Location: admin_pengaduan.php");
    exit;

} else {

    echo "Gagal mengubah status pengaduan.";
}

?>