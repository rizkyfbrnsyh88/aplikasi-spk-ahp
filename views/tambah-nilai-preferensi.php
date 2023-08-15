<?php
include '../includes/sidebar.inc.php';

if ($_POST) {
    include '../includes/nilai-preferensi.inc.php';
    $eks = new Nilai($db);
    $eks->jm = $_POST['jumlahNilai'];
    $eks->kt = $_POST['keterangan'];
    if ($eks->insert()) { ?>
        <script type="text/javascript">
            window.onload = function() {
                showStickySuccessToast();
            };
        </script> <?php
                } else { ?>
        <script type="text/javascript">
            window.onload = function() {
                showStickyErrorToast();
            };
        </script> <?php
                }
            }
                    ?>
?>

<div class="main-content">
    <div class="content">
        <div class="navigasi">
            <a href="dashboard.php">Dashboard</a>
            <span>/</span>
            <a href="nilai-preferensi.php">Nilai Preferensi</a>
            <span>/</span>
            <span>Tambah Data</span>
        </div>
        <form method="post">
            <div class="judul-content">
                <div class="text-judul">
                    <i class="fa-solid fa-user icon"></i>
                    <h2>Tambah Data Nilai Preferensi</h2>
                </div>
            </div>
            <div class="box-input">
                <div class="input">
                    <label for="jumlahNilai">Jumlah Nilai</label>
                    <input type="text" id="jumlahNilai" name="jumlahNilai" required>
                </div>
                <div class="input">
                    <label for="keterangan">Keterangan</label>
                    <input type="text" id="keterangan" name="keterangan" required>
                </div>
                <div class="btn-input">
                    <div class="btn-simpan">
                        <button type="submit">
                            <i class="fa-solid fa-floppy-disk"></i><span>Simpan</span>
                        </button>
                    </div>
                    <div class="btn-kembali">
                        <button type="button" name="kembali" onclick="location.href='nilai-preferensi.php'">
                            <i class="fa-solid fa-backward"></i><span>Kembali</span>
                        </button>
                    </div>
                </div>
            </div>
        </form>


        <?php
        include '../includes/footer.inc.php';
        ?>