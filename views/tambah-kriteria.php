<?php
include '../includes/sidebar.inc.php';
?>

<div class="main-content">
    <div class="content">
        <div class="navigasi">
            <a href="dashboard.php">Dashboard</a>
            <span>/</span>
            <a href="data-kriteria.php">Kriteria</a>
            <span>/</span>
            <span>Tambah Data</span>
        </div>
        <form method="post">
            <div class="judul-content">
                <div class="text-judul">
                    <i class="fa-solid fa-user icon"></i>
                    <h2>Tambah Data Kriteria</h2>
                </div>
            </div>
            <div class="box-input">
                <div class="input">
                    <label for="idKriteria">Id Kriteria</label>
                    <input type="text" id="idKriteria" name="idKriteria" required>
                </div>
                <div class="input">
                    <label for="namaKriteria">Nama Kriteria</label>
                    <input type="text" id="namaKriteria" name="namaKriteria" required>
                </div>
                <div class="btn-input">
                    <div class="btn-simpan">
                        <button type="submit">
                            <i class="fa-solid fa-floppy-disk"></i><span>Simpan</span>
                        </button>
                    </div>
                    <div class="btn-kembali">
                        <button type="button" name="kembali" onclick="location.href='user.php'">
                            <i class="fa-solid fa-backward"></i><span>Kembali</span>
                        </button>
                    </div>
                </div>
            </div>
        </form>


        <?php
        include '../includes/footer.inc.php';
        ?>