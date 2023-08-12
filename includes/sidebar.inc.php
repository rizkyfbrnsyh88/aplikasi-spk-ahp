<?php
include("koneksi.php");
// session_start();
// if (!isset($_SESSION['nama_lengkap'])) {
//     echo "<script>location.href='login.php'</script>";
// }
$config = new Koneksi();
$db = $config->getConnection();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPK | Analitycal Hierarchy Process</title>
    <link rel="stylesheet" href="../assets/css/sidebar.css">
    <link rel="stylesheet" href="../assets/css/main-content.css">
    <link rel="stylesheet" href="../assets/css/jquery.toastmessage.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="../assets/js/sweetalert.min.js"></script>
    <script type="text/javascript" src="../assets/js/jquery-1.11.3.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="sidebar">
            <div class="header">
                <div class="judul">
                    <h1>SPK-AHP</h1>
                </div>
                <div class="img-header">
                    <img src="../assets/images/img-header.png" alt="image-header">
                </div>
            </div>
            <div class="menus">
                <div class="item-menu">
                    <a href="../views/dashboard.php">
                        <i class="fa-solid fa-gauge icon"></i>
                        <span>Dashboard</span>
                    </a>
                </div>
                <div class="item-menu">
                    <a href="../views/data-alternatif.php">
                        <i class="fa-brands fa-cloudscale icon"></i>
                        <span>Pegawai</span>
                    </a>
                </div>
                <div class="item-menu">
                    <a href="../views/nilai-preferensi.php">
                        <i class="fa-brands fa-cloudscale icon"></i>
                        <span>Skala Dasar AHP</span>
                    </a>
                </div>
                <div class="dropdown">
                    <div class="item-menu">
                        <a href="">
                            <i class="fa-solid fa-database icon"></i>
                            <span>Data</span>
                            <i class="fa-solid fa-circle-chevron-down icon-dropdown"></i>
                        </a>
                    </div>
                    <div class="dropdown-menu">
                        <a href="">Alternatif</a>
                        <a href="">Kriteria</a>
                        <a href="">Nilai Awal</a>
                    </div>
                </div>
                <div class="dropdown">
                    <div class="item-menu">
                        <a href="">
                            <i class="fa-solid fa-code-compare icon"></i>
                            <span>Perbandingan</span>
                            <i class="fa-solid fa-circle-chevron-down icon-dropdown"></i>
                        </a>
                    </div>
                    <div class="dropdown-menu">
                        <a href="">Perbandingan Kriteria</a>
                        <a href="">Perbandingan Alternatif</a>
                    </div>
                </div>
                <div class="dropdown">
                    <div class="item-menu">
                        <a href="">
                            <i class="fa-solid fa-file icon"></i>
                            <span>Laporan</span>
                            <i class="fa-solid fa-circle-chevron-down icon-dropdown"></i>
                        </a>
                    </div>
                    <div class="dropdown-menu">
                        <a href="">Hasil Akhir</a>
                        <a href="">Rangking</a>
                    </div>
                </div>
                <div class="dropdown">
                    <span class="btn-dropdown">Data</span>
                    <div class="dropdown-menu">
                        <a href="">Profile</a>
                        <a href="">Kelola User</a>
                        <a href="">Logout</a>
                    </div>
                </div>
            </div>
        </div>