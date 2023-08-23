<?php
include '../includes/sidebar.inc.php';
include '../includes/kriteria.inc.php';
include '../includes/nilai-preferensi.inc.php';

$kriteriaObj = new Kriteria($db);
$nilaiObj = new NilaiPreferensi($db);

$kriteriaCount = $kriteriaObj->countAll();

$r = [];
$kriterias = $kriteriaObj->readAll();
while ($row = $kriterias->fetch(PDO::FETCH_ASSOC)) {
    $kriteriass = $kriteriaObj->readSatu($row['id_kriteria']);
    while ($roww = $kriteriass->fetch(PDO::FETCH_ASSOC)) {
        $pcs = explode("C", $roww['id_kriteria']);
        $c = $kriteriaCount - $pcs[1];
    }
    if ($c >= 1) {
        $r[$row['id_kriteria']] = $c;
    }
}

?>

<div class="main-content">
    <div class="content">
        <div class="navigasi">
            <a href="dashboard.php">Dashboard</a>
            <span>/</span>
            <span>Perbandingan Kriteria</span>
            <span>/</span>
            <a href="matriks-perbandingan-kriteria.php">Matriks Perbandingan Kriteria</a>
        </div>
        <form method="post" action="matriks-perbandingan-kriteria.php">
            <div class="judul-content">
                <div class="text-judul">
                    <i class="fa-solid fa-code-compare icon"></i>
                    <h2>Perbandingan Kriteria</h2>
                </div>
            </div>
            <div class="box-input">
                <div class="row">
                    <div class="kotak-input">
                        <label>Kriteria Pertama</label>
                    </div>
                    <div class="kotak-input">
                        <label>Penilaian</label>
                    </div>
                    <div class="kotak-input">
                        <label>Kriteria Kedua</label>
                    </div>
                </div>
                <?php $no = 1;
                foreach ($r as $k => $v) : ?>
                    <?php for ($i = 1; $i <= $v; $i++) : ?>
                        <?php $rows = $kriteriaObj->readSatu($k);
                        while ($row = $rows->fetch(PDO::FETCH_ASSOC)) : ?>
                            <div class="row">
                                <div class="kotak-input">
                                    <div class="kotak-isi">
                                        <?php $rows = $kriteriaObj->readSatu($k);
                                        while ($row = $rows->fetch(PDO::FETCH_ASSOC)) : ?>
                                            <input type="text" class="kri colbox" value="<?= $row['nama_kriteria'] ?>" readonly />
                                            <input type="hidden" name="<?= $k ?><?= $no ?>" value="<?= $row['id_kriteria'] ?>" />
                                        <?php endwhile; ?>
                                    </div>
                                </div>
                                <div class="kotak-input">
                                    <div class="kotak-isi">
                                        <select class="kri colbox" name="nl<?= $no ?>">
                                            <?php $rows = $nilaiObj->readAll();
                                            while ($row = $rows->fetch(PDO::FETCH_ASSOC)) : ?>
                                                <option value="<?= $row['jum_nilai'] ?>"><?= $row['jum_nilai'] ?> - <?= $row['ket_nilai'] ?></option>
                                            <?php endwhile; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="kotak-input">
                                    <div class="kotak-isi">
                                        <?php $pcs = explode("C", $k);
                                        $nid = "C" . ($pcs[1] + $i); ?>
                                        <?php $rows = $kriteriaObj->readSatu($nid);
                                        while ($row = $rows->fetch(PDO::FETCH_ASSOC)) : ?>
                                            <input type="text" class="kri colbox" value="<?= $row['nama_kriteria'] ?>" readonly />
                                            <input type="hidden" name="<?= $nid ?><?= $no ?>" value="<?= $row['id_kriteria'] ?>" />
                                        <?php endwhile; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile;
                        $no++; ?>
                    <?php endfor; ?>
                <?php endforeach; ?>
                <div class="btn-input">
                    <div class="btn-next">
                        <button type="submit" name="submit">
                            <span>Selanjutnya</span><i class="fa-solid fa-arrow-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </form>

        <?php
        include '../includes/footer.inc.php';
        ?>