<?php
include '../includes/sidebar.inc.php';
include '../includes/skor.inc.php';
include '../includes/alternatif.inc.php';
include '../includes/kriteria.inc.php';
include '../includes/nilai-preferensi.inc.php';

$altObj = new Alternatif($db);
$skoObj = new Skor($db);
$kriObj = new Kriteria($db);
$nilObj = new NilaiPreferensi($db);

$altCount = $altObj->countByFilter();

$no = 1;
$r = [];
$nid = [];
$alt1 = $altObj->readByFilter();
while ($row = $alt1->fetch(PDO::FETCH_ASSOC)) {
    $alt2 = $altObj->readByFilter();
    while ($roww = $alt2->fetch(PDO::FETCH_ASSOC)) {
        $nid[$row['id_alternatif']][] = $roww['id_alternatif'];
    }
    $total = $altCount - $no;
    if ($total >= 1) {
        $r[$row['id_alternatif']] = $total;
    }
    $no++;
}

$ni = 1;
foreach ($nid as $key => $value) {
    array_splice($nid[$key], 0, $ni++);
}
$ne = count($nid) - 1;
array_splice($nid, $ne, 1);

?>

<div class="main-content">
    <div class="content">
        <div class="navigasi">
            <a href="dashboard.php">Dashboard</a>
            <span>/</span>
            <span>Perbandingan Alternatif</span>
        </div>
        <div class="judul-content">
            <div class="text-judul">
                <i class="fa-solid fa-code-compare icon"></i>
                <h2>Perbandingan Alternatif</h2>
            </div>
        </div>
        <table width="100%">
            <thead>
                <tr>
                    <th width="50px"></th>
                    <th width="50px">No</th>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Nilai</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                $alt1a = $altObj->readByFilter();
                while ($row = $alt1a->fetch(PDO::FETCH_ASSOC)) : ?>
                    <tr>
                        <td class="text-center">
                            <div class="btn-aksi-detail">
                                <a href="detail-penilaian-alternatif.php?id=<?= $row['id_alternatif'] ?>">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                            </div>
                        </td>
                        <td><?= $no++ ?></td>
                        <td><?= $row["id_alternatif"] ?></td>
                        <td><?= $row["nama"] ?></td>
                        <td><?= $row["nilai"] ?></td>
                        <td><?php
                            if ($row['keterangan'] == "B") {
                                echo "Baik";
                            } elseif ($row['keterangan'] == "C") {
                                echo "Cukup";
                            } else {
                                echo "Kurang";
                            }
                            ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <form method="post" action="matriks-perbandingan-alternatif.php">
            <div class="box-input">
                <div class="pilih-kriteria">
                    <div class="row">
                        <div class="kotak-pilih" style="width: 100px;">
                            <label>Pilih Kriteria :</label>
                        </div>
                    </div>
                    <div class="kotak-input" style="width: 100%;">
                        <div class="kotak-isi">
                            <select style="width: 100%;" class="kri" id="kriteria" name="kriteria" autofocus>
                                <?php $kri2 = $kriObj->readAll();
                                while ($row = $kri2->fetch(PDO::FETCH_ASSOC)) : ?>
                                    <option value="<?= $row['id_kriteria'] ?>"><?= $row['nama_kriteria'] ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="kotak-input">
                        <label>Alternatif Pertama</label>
                    </div>
                    <div class="kotak-input">
                        <label>Penilaian</label>
                    </div>
                    <div class="kotak-input">
                        <label>Alternatif Kedua</label>
                    </div>
                </div>
                <?php $no = 1;
                foreach ($r as $k => $v) : ?>
                    <?php $j = 0;
                    for ($i = 1; $i <= $v; $i++) : ?>
                        <?php $rows = $altObj->readSatu($k);
                        while ($row = $rows->fetch(PDO::FETCH_ASSOC)) : ?>
                            <div class="row">
                                <div class="kotak-input">
                                    <div class="kotak-isi">
                                        <?php $rows = $skoObj->readAlternatif($k);
                                        while ($row = $rows->fetch(PDO::FETCH_ASSOC)) : ?>
                                            <input type="text" class="kri colbox" value="<?= $row['nama'] ?>" readonly />
                                            <input type="hidden" name="<?= $k ?><?= $no ?>" value="<?= $row['id_alternatif'] ?>" />
                                        <?php endwhile; ?>
                                    </div>
                                </div>
                                <div class="kotak-input">
                                    <div class="kotak-isi">
                                        <select class="kri colbox" name="nl<?= $no ?>">
                                            <?php $stmt1 = $nilObj->readAll();
                                            while ($row2 = $stmt1->fetch(PDO::FETCH_ASSOC)) : ?>
                                                <option value="<?= $row2['jum_nilai'] ?>"><?= $row2['jum_nilai'] ?> - <?= $row2['ket_nilai'] ?></option>
                                            <?php endwhile; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="kotak-input">
                                    <div class="kotak-isi">
                                        <?php $rows = $skoObj->readAlternatif($nid[$k][$j]);
                                        while ($row = $rows->fetch(PDO::FETCH_ASSOC)) : ?>
                                            <input type="text" class="kri colbox" value="<?= $row['nama'] ?>" readonly />
                                            <input type="hidden" name="<?= $nid[$k][$j] ?><?= $no ?>" value="<?= $row['id_alternatif'] ?>" />
                                        <?php endwhile; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile;
                        $no++;
                        $j++; ?>
                    <?php endfor; ?>
                <?php endforeach; ?>
                <div class="btn-input">
                    <div class="btn-simpan">
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