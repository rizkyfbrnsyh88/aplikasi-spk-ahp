<?php
include '../includes/sidebar.inc.php';


?>

<div class="main-content">
    <div class="content">
        <div class="navigasi">
            <a href="dashboard.php">Dashboard</a>
            <span>/</span>
            <span>Perbandingan Kriteria</span>
        </div>
        <form method="post">
            <div class="judul-content">
                <div class="text-judul">
                    <i class="fa-solid fa-user icon"></i>
                    <h2>Perbandingan Kriteria</h2>
                </div>
            </div>
            <div class="box-input">
                <div class="btn-input">
                    <div class="btn-simpan">
                        <button type="submit">
                            <i class="fa-solid fa-floppy-disk"></i><span>Simpan</span>
                        </button>
                    </div>
                </div>
            </div>

            <?php
            include '../includes/footer.inc.php';
            ?>