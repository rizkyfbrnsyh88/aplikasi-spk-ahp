<?php
include("koneksi.php");
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: ../views/login.php");
    exit;
}
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
    <script type="text/javascript" src="../assets/js/script.js"></script>
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
                <?php if ($_SESSION["level"] == "Penilai") : ?>
                    <div class="item-menu">
                        <a href="../views/nilai-preferensi.php">
                            <i class="fa-brands fa-cloudscale icon"></i>
                            <span>Skala Dasar AHP</span>
                        </a>
                    </div>
                <?php endif; ?>
                <?php if ($_SESSION["level"] == "Admin") : ?>
                    <div class="dropdown">
                        <div class="item-menu dropbtn" onclick="myFunction(1)">
                            <p>
                                <i class="fa-solid fa-database icon"></i>
                                <span>Data</span>
                                <i class="fa-solid fa-circle-chevron-down icon-dropdown"></i>
                            </p>
                        </div>
                        <div class="dropdown-menu" id="dropdown-1">
                            <a href="../views/data-alternatif.php">Alternatif</a>
                            <a href="../views/data-kriteria.php">Kriteria</a>
                            <a href="../views/nilai-preferensi.php">Skala Dasar AHP</a>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if ($_SESSION["level"] == "Penilai") : ?>
                    <div class="dropdown">
                        <div class="item-menu dropbtn" onclick="myFunction(2)">
                            <p>
                                <i class="fa-solid fa-code-compare icon"></i>
                                <span>Perhitungan AHP</span>
                                <i class="fa-solid fa-circle-chevron-down icon-dropdown"></i>
                            </p>
                        </div>
                        <div class="dropdown-menu" id="dropdown-2">
                            <a href="../views/penilaian-alternatif.php">Penilaian Awal Alternatif</a>
                            <a href="../views/perbandingan-kriteria.php">Perbandingan Kriteria</a>
                            <a href="../views/perbandingan-alternatif.php">Perbandingan Alternatif</a>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if ($_SESSION["level"] == "Penilai") : ?>
                    <div class="item-menu">
                        <a href="../views/hasil-akhir.php">
                            <i class="fa-regular fa-star-half-stroke icon"></i>
                            <span>Hasil Akhir</span>
                        </a>
                    </div>
                <?php endif; ?>
                <?php if ($_SESSION["level"] == "Penilai") : ?>
                    <div class="item-menu">
                        <a href="../views/ranking.php">
                            <i class="fa-solid fa-ranking-star icon"></i>
                            <span>Ranking</span>
                        </a>
                    </div>
                <?php endif; ?>
                <?php if ($_SESSION["level"] == "Admin") : ?>
                    <div class="item-menu">
                        <a href="../views/user.php">
                            <i class="fa-solid fa-users icon"></i>
                            <span>Kelola User</span>
                        </a>
                    </div>
                <?php endif; ?>
                <?php if ($_SESSION["level"] == "Penilai" or $_SESSION["level"] == "Kepsek") : ?>
                    <div class="dropdown">
                        <div class="item-menu dropbtn" onclick="myFunction(3)">
                            <p>
                                <i class="fa-solid fa-file icon"></i>
                                <span>Laporan</span>
                                <i class="fa-solid fa-circle-chevron-down icon-dropdown"></i>
                            </p>
                        </div>
                        <div class="dropdown-menu" id="dropdown-3">
                            <?php if ($_SESSION["level"] == "kepsek") : ?>
                                <a href="../views/cetak-alternatif.php" target="_blank">Alternatif</a>
                                <a href="../views/cetak-kriteria.php" target="_blank">Kriteria</a>
                            <?php endif; ?>
                            <a href="../views/cetak-ranking.php" target="_blank">Ranking</a>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="dropdown">
                    <div class="item-menu dropbtn" onclick="myFunction(4)">
                        <p>
                            <i class="fa-solid fa-user icon"></i>
                            <span><?php echo $_SESSION["nama_lengkap"] ?></span>
                            <i class="fa-solid fa-circle-chevron-down icon-dropdown"></i>
                        </p>
                    </div>
                    <div class="dropdown-menu" id="dropdown-4">
                        <a href="../views/logout.php">Logout</a>
                    </div>
                </div>
            </div>
        </div>

        <script type="text/javascript" src="../assets/js/script.js"></script>