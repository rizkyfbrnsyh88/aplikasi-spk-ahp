<?php
include '../includes/sidebar.inc.php';
?>

<div class="main-content">
    <div class="content">
        <div class="navigasi">
            <a href="dashboard.php">Dashboard</a>
            <span>/</span>
            <a href="user.php">Penilaian Alternatif</a>
            <span>/</span>
            <span>Tambah Data</span>
        </div>
        <form method="post">
            <div class="judul-content">
                <div class="text-judul">
                    <i class="fa-solid fa-user icon"></i>
                    <h2>Tambah Data Penilaian Alternatif</h2>
                </div>
            </div>
            <div class="box-input">
                <div class="input">
                    <label for="alt">Alternatif</label>
                    <select name="alt" id="alt" required>
                        <option value="">-----</option>
                        <!-- <option value="Penilai">Penilai</option>
                        <option value="TU">Tata Usaha</option>
                        <option value="Kepsek">Kepala Sekolah</option> -->
                    </select>
                </div>
                <div class="input">
                    <label for="tj">Tanggung Jawab</label>
                    <input type="text" id="tj" name="tj" required>
                </div>
                <div class="input">
                    <label for="username">Kedisiplinan</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="input">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="input">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="input">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="input">
                    <label for="alt">Periode</label>
                    <select name="alt" id="alt" required>
                        <option value="">-----</option>
                        <!-- <option value="Penilai">Penilai</option>
                        <option value="TU">Tata Usaha</option>
                        <option value="Kepsek">Kepala Sekolah</option> -->
                    </select>
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