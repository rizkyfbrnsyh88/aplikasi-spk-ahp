<?php
include '../includes/sidebar.inc.php';
include '../includes/kriteria.inc.php';

$kriObj = new Kriteria($db);

if ($_POST) {

    $kriObj->id = $_POST['idKriteria'];
    $kriObj->nama = $_POST['namaKriteria'];

    if ($kriObj->insert()) { ?>
        <script type="text/javascript">
            window.onload = function() {
                showStickySuccessToast();
                setTimeout(function() {
                    location.href = location.href
                }, 2000);
            };
        </script> <?php
                } else { ?>
        <script type="text/javascript">
            window.onload = function() {
                showStickyErrorToast();
                setTimeout(function() {
                    location.href = location.href
                }, 2000);
            };
        </script> <?php
                }
            }
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
                    <label for="idKriteria">ID Kriteria</label>
                    <input type="text" style="outline: none;" id="idKriteria" name="idKriteria" required readonly="on" value="<?= $kriObj->getNewID() ?>">
                </div>
                <div class="input">
                    <label for="namaKriteria">Nama Kriteria</label>
                    <input type="text" id="namaKriteria" name="namaKriteria" required autofocus>
                </div>
                <div class="btn-input">
                    <div class="btn-simpan">
                        <button type="submit">
                            <i class="fa-solid fa-floppy-disk"></i><span>Simpan</span>
                        </button>
                    </div>
                    <div class="btn-kembali">
                        <button type="button" name="kembali" onclick="location.href='data-kriteria.php'">
                            <i class="fa-solid fa-backward"></i><span>Kembali</span>
                        </button>
                    </div>
                </div>
            </div>
        </form>


        <?php
        include '../includes/footer.inc.php';
        ?>