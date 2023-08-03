<?php
include("includes/config.php");
session_start();
if (!isset($_SESSION['nama_lengkap'])) {
    echo "<script>location.href='login.php'</script>";
}
$config = new koneksi();
$db = $config->getConnection();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPK | Analitycal Hierarchy Process</title>
    <link rel="stylesheet" href="../assets/css/header.css">
</head>

<body>
    <div class="sidebar">
        <div class="judul">
            <h1>SPK-AHP</h1>
        </div>
        <div class="menus">
            <a href="">Home</a>
            <a href="">Skala Dasar AHP</a>
            <a href="">Kriteria</a>
            <a href="">Alternatif</a>
            <a href="">Nilai Awal</a>
            <a href="">Perbandingan</a>
            <a href="">Laporan</a>
        </div>
    </div>