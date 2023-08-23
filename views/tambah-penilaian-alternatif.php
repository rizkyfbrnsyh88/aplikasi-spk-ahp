<?php
include '../includes/sidebar.inc.php';

include '../includes/alternatif.inc.php';
$altObj = new Alternatif($db);
$alt = $altObj->readAll();

include '../includes/kriteria.inc.php';
$kriObj = new Kriteria($db);
$kri = $kriObj->readAll();

if ($_POST) {
    include '../includes/penilaian-awal-alternatif.inc.php';
    $nilObj = new NilaiAwal($db);
    $nilObj->id_alternatif = $_POST['alt'];
    $nilai = (array_sum($_POST["kriteria"]) / $kriObj->countAll());
    $nilObj->nilai = $nilai;
    $nilObj->keterangan = $nilObj->getRange($nilai);
    $nilObj->periode = $_POST['periode'];

    if ($nilObj->insert()) {
        $id = $db->lastInsertId();
        include '../includes/detail-penilaian-awal.inc.php';
        $nilDObj = new DetailPenilaian($db);
        foreach ($_POST["kriteria"] as $k => $v) {
            $nilDObj->id_penilaian = $id;
            $nilDObj->id_kriteria = $k;
            $nilDObj->nilai = $_POST["kriteria"][$k];
            if (!$nilDObj->insert()) {
                echo "<script type=\"text/javascript\">
  						window.onload=function(){
  							showStickyErrorToast();
                              setTimeout(function() {
                                location.href = location.href
                            }, 2000);
  						};
  				</script>";
            }
        }
        echo "<script type=\"text/javascript\">
						window.onload=function(){
							showStickySuccessToast();
                            setTimeout(function() {
                                location.href = location.href
                            }, 2000);
						};
				</script>";
    } else {
        echo "<script type=\"text/javascript\">
						window.onload=function(){
							showStickyErrorToast();
                            setTimeout(function() {
                                location.href = location.href
                            }, 2000);
						};
				</script>";
    }
}
?>

<div class="main-content">
    <div class="content">
        <div class="navigasi">
            <a href="dashboard.php">Dashboard</a>
            <span>/</span>
            <a href="penilaian-alternatif.php">Penilaian Alternatif</a>
            <span>/</span>
            <span>Tambah Data</span>
        </div>
        <form method="post">
            <div class="judul-content">
                <div class="text-judul">
                    <i class="fa-solid fa-book icon"></i>
                    <h2>Tambah Data Penilaian Alternatif</h2>
                </div>
            </div>
            <div class="box-input">
                <div class="input">
                    <label for="alt">Alternatif</label>
                    <select name="alt" id="alt" required>
                        <option value="">-----</option>
                        <?php while ($row = $alt->fetch(PDO::FETCH_ASSOC)) : ?>
                            <option value="<?= $row["id_alternatif"] ?>"><?= $row["nama"] ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <?php while ($row = $kri->fetch(PDO::FETCH_ASSOC)) : ?>
                    <div class="input">
                        <label for="<?= $row["nama_kriteria"] ?>"><?= ucfirst($row["nama_kriteria"]) ?></label>
                        <input type="text" id="kriteria[<?= $row["id_kriteria"] ?>]" name="kriteria[<?= $row["id_kriteria"] ?>]" required>
                    </div>
                <?php endwhile; ?>
                <div class="input">
                    <label for="periode">Periode</label>
                    <select name="periode" id="periode" required>
                        <option value="">-----</option>
                        <?php for ($i = 2020; $i <= 2030; $i++) : ?>
                            <option value="<?= $i ?>"><?= $i ?></option>
                        <?php endfor; ?>
                    </select>
                </div>
                <div class="btn-input">
                    <div class="btn-simpan">
                        <button type="submit">
                            <i class="fa-solid fa-floppy-disk"></i><span>Simpan</span>
                        </button>
                    </div>
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