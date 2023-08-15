<?php
include '../includes/sidebar.inc.php';

$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');

include '../includes/alternatif.inc.php';
$altObj = new Alternatif($db);
$altObj->id = $id;
$alt = $altObj->readOne();

include '../includes/penilaian-awal-alternatif.inc.php';
$nilaiAwal = new NilaiAwal($db);
$nilaw = $nilaiAwal->readAll();

include '../includes/detail-penilaian-awal.inc.php';
$detailObj = new DetailPenilaian($db);
$detailObj->id = $id;
$detail = $detailObj->readAllWithCriteria();
?>

<div class="main-content">
    <div class="content">
        <div class="navigasi">
            <a href="dashboard.php">Dashboard</a>
            <span>/</span>
            <a href="penilaian-alternatif.php">Penilaian Alternatif</a>
            <span>/</span>
            <span>Detail Penilaian</span>
        </div>
        <form method="post">
            <div class="judul-content">
                <div class="text-judul">
                    <i class="fa-solid fa-user icon"></i>
                    <h2><?php echo $altObj->nama; ?> (<?php echo $altObj->id; ?>)</h2>
                </div>
            </div>
            <div class="box-input">
                <?php while ($row = $detail->fetch(PDO::FETCH_ASSOC)) : ?>
                    <div class="input">
                        <label for="<?= $row["kriteria"] ?>"><?= ucfirst($row["kriteria"]) ?></label>
                        <input type="text" id="kriteria[<?= $row["id_kriteria"] ?>]" name="kriteria[<?= $row["id_kriteria"] ?>]" required value="<?= $row["nilai"] ?>" readonly="on">
                    </div>
                <?php endwhile; ?>
                <div class="btn-input">
                    <div class="btn-kembali">
                        <button type="button" name="kembali" onclick="location.href='penilaian-alternatif.php'">
                            <i class="fa-solid fa-backward"></i><span>Kembali</span>
                        </button>
                    </div>
                </div>
            </div>
        </form>


        <?php
        include '../includes/footer.inc.php';
        ?>