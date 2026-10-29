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


if (!isset($_GET['id']) || !isset($_GET['status'])) {
    header("Location: admin_konsultasi.php");
    exit;
}


$id = intval($_GET['id']);

$status = $_GET['status'];


$status_valid = [
    "Diproses",
    "Selesai",
    "Ditolak"
];


if (!in_array($status, $status_valid)) {
    header("Location: admin_konsultasi.php");
    exit;
}


$query = "UPDATE konsultasi SET status = ? WHERE id = ?";

$stmt = mysqli_prepare($conn, $query);

mysqli_stmt_bind_param(
    $stmt,
    "si",
    $status,
    $id
);


if (mysqli_stmt_execute($stmt)) {

    header("Location: admin_konsultasi.php");
    exit;

} else {

    echo "Gagal mengubah status konsultasi.";

}

?>