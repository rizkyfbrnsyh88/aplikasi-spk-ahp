<?php
include '../includes/sidebar.inc.php';
include '../includes/alternatif.inc.php';
include '../includes/kriteria.inc.php';
include '../includes/ranking.inc.php';

$altObj = new Alternatif($db);

$kriObj = new Kriteria($db);

$ranObj = new Ranking($db);
$stmt = $ranObj->readKhusus();
$stmty = $ranObj->readKhusus();
$count = $ranObj->countAll();
$stmtx1y = $ranObj->readBob();
$stmtx2y = $ranObj->readBob();
?>

<div class="main-content">
    <div class="content">
        <div class="navigasi">
            <a href="dashboard.php">Dashboard</a>
            <span>/</span>
            <span>Hasil Ranking</span>
        </div>
        <div class="judul-content">
            <div class="text-judul">
                <i class="fa-solid fa-user icon"></i>
                <h2>Hasil Ranking</h2>
            </div>
            <div class="btn-judul">
                <div class="btn-hapus">
                    <button type="button" name="cetak" onclick="location.href='cetak-ranking.php'">
                        <i class="fa-solid fa-print"></i><span>Cetak</span>
                    </button>
                </div>
            </div>
        </div>
        <div class="box-ranking">
            <?php for ($i = 2020; $i <= 2030; $i++) : ?>
                <h4>Tahun <?= $i ?></h4>
                <table>
                    <thead>
                        <tr>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Hasil Akhir</th>
                            <th>Ranking</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $altObj->periode = $i;
                        $rank = 1;
                        $alt1c = $altObj->readByRank();
                        while ($row = $alt1c->fetch(PDO::FETCH_ASSOC)) : ?>
                            <tr>
                                <td><?= $row["nip"] ?></td>
                                <td><?= $row["nama"] ?></td>
                                <td><?= number_format($row["hasil_akhir"], 4, '.', ',') ?></td>
                                <td><?= $rank++ ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>

            <?php endfor; ?>
        </div>

        <?php include '../includes/footer.inc.php'; ?>