<?php
include '../includes/sidebar.inc.php';
include '../includes/nilai-preferensi.inc.php';

$pgn = new Nilai($db);

$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');

include '../includes/kriteria.inc.php';
$eks = new Kriteria($db);
$eks->id = $id;
$eks->readOne();

if ($_POST) {
    $eks->nama = $_POST['namaKriteria'];
    if ($eks->update()) {
        echo "<script>location.href='data-kriteria.php'</script>";
    } else { ?>
        <script type="text/javascript">
            window.onload = function() {
                showStickyErrorToast();
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
            <span>Ubah Data</span>
        </div>
        <form method="post">
            <div class="judul-content">
                <div class="text-judul">
                    <i class="fa-solid fa-user icon"></i>
                    <h2>Ubah Data Kriteria</h2>
                </div>
            </div>
            <div class="box-input">
                <div class="input">
                    <label for="namaKriteria">Nama Kriteria</label>
                    <input type="text" id="namaKriteria" name="namaKriteria" required value="<?php echo $eks->nama; ?>">
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