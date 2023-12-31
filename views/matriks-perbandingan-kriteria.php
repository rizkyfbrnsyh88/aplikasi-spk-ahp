<?php
ob_start();
include '../includes/sidebar.inc.php';

include '../includes/bobot.inc.php';
include '../includes/kriteria.inc.php';

$bobotObj = new Bobot($db);
$count = $bobotObj->countAll();

if (isset($_POST['submit'])) {
    $kriteriaObj = new Kriteria($db);
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

    $no = 1;
    foreach ($r as $k => $v) {
        for ($i = 1; $i <= $v; $i++) {
            $pcs = explode("C", $k);
            $nid = "C" . ($pcs[1] + $i);

            if ($bobotObj->insert($_POST[$k . $no], $_POST['nl' . $no], $_POST[$nid . $no])) {
                // ...
            } else {
                $bobotObj->update($_POST[$k . $no], $_POST['nl' . $no], $_POST[$nid . $no]);
            }

            if ($bobotObj->insert($_POST[$nid . $no], 1 / $_POST['nl' . $no], $_POST[$k . $no])) {
                // ...
            } else {
                $bobotObj->update($_POST[$nid . $no], 1 / $_POST['nl' . $no], $_POST[$k . $no]);
            }
            $no++;
        }
    }
}

if (isset($_POST['hapus'])) {
    $bobotObj->delete();
    ob_end_clean();
    header("location: perbandingan-kriteria.php");
}


?>

<div class="main-content">
    <div class="content">
        <div class="navigasi">
            <a href="dashboard.php">Dashboard</a>
            <span>/</span>
            <a href="perbandingan-kriteria.php">Perbandingan Kriteria</a>
            <span>/</span>
            <span>Matriks Perbandingan Kriteria</span>
        </div>
        <div class="judul-content">
            <div class="text-judul">
                <i class="fa-solid fa-code-compare icon"></i>
                <h2>Perbandingan Kriteria</h2>
            </div>
            <form method="post">
                <div class="btn-judul">
                    <div class="btn-hapus">
                        <button type="submit" name="hapus">
                            <i class="fa-solid fa-eraser"></i><span>Hapus Semua</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="tabel">
            <table>
                <thead>
                    <tr>
                        <th>Antar Kriteria</th>
                        <?php $bobots1 = $bobotObj->readAll2();
                        while ($row = $bobots1->fetch(PDO::FETCH_ASSOC)) : ?>
                            <th><?= $row['nama_kriteria'] ?></th>
                        <?php endwhile; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php $bobots2 = $bobotObj->readAll2();
                    while ($baris = $bobots2->fetch(PDO::FETCH_ASSOC)) : ?>
                        <tr>
                            <th><?= $baris['nama_kriteria'] ?></th>
                            <?php $bobots3 = $bobotObj->readAll2();
                            while ($kolom = $bobots3->fetch(PDO::FETCH_ASSOC)) : ?>
                                <td>
                                    <?php if (isset($_POST['submit'])) : ?>
                                        <?php
                                        if ($baris['id_kriteria'] == $kolom['id_kriteria']) {
                                            echo $nilaiDefault = '1';
                                            if ($bobotObj->insert($baris['id_kriteria'], $nilaiDefault, $kolom['id_kriteria'])) {
                                                // ...
                                            } else {
                                                $bobotObj->update($baris['id_kriteria'], $nilaiDefault, $kolom['id_kriteria']);
                                            }
                                        } else {
                                            $bobotObj->readAll1($baris['id_kriteria'], $kolom['id_kriteria']);
                                            echo number_format($bobotObj->kp, 4, '.', ',');
                                        }
                                        ?>
                                    <?php endif; ?>
                                </td>
                            <?php endwhile; ?>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>Jumlah</th>
                        <?php $stmt5 = $bobotObj->readAll2();
                        while ($row = $stmt5->fetch(PDO::FETCH_ASSOC)) : ?>
                            <th>
                                <?php
                                $bobotObj->readSum1($row['id_kriteria']);
                                echo number_format($bobotObj->nak, 4, '.', ',');
                                $bobotObj->insert3($bobotObj->nak, $row['id_kriteria']);
                                ?>
                            </th>
                        <?php endwhile; ?>
                    </tr>
                </tfoot>
            </table>

            <table>
                <thead>
                    <tr>
                        <th>Perbandingan</th>
                        <?php $bobots1x = $bobotObj->readAll2();
                        while ($row2x = $bobots1x->fetch(PDO::FETCH_ASSOC)) : ?>
                            <th><?= $row2x['nama_kriteria'] ?></th>
                        <?php endwhile; ?>
                        <th>Jumlah</th>
                        <th>Prioritas</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $bobots2x = $bobotObj->readAll2();
                    while ($baris = $bobots2x->fetch(PDO::FETCH_ASSOC)) : ?>
                        <tr>
                            <th><?= $baris['nama_kriteria'] ?></th>
                            <?php $stmt4x = $bobotObj->readAll2();
                            while ($kolom = $stmt4x->fetch(PDO::FETCH_ASSOC)) : ?>
                                <td>
                                    <?php
                                    if ($baris['id_kriteria'] == $kolom['id_kriteria']) {
                                        $c = 1 / $kolom['jumlah_kriteria'];
                                        $bobotObj->insert2($c, $baris['id_kriteria'], $kolom['id_kriteria']);
                                        echo number_format($c, 4, '.', ',');
                                    } else {
                                        $bobotObj->readAll1($baris['id_kriteria'], $kolom['id_kriteria']);
                                        $c = $bobotObj->kp / $kolom['jumlah_kriteria'];
                                        $bobotObj->insert2($c, $baris['id_kriteria'], $kolom['id_kriteria']);
                                        echo number_format($c, 4, '.', ',');
                                    }
                                    ?>
                                </td>
                            <?php endwhile; ?>
                            <th>
                                <?php
                                $bobotObj->readSum2($baris['id_kriteria']);
                                $j = $bobotObj->hak;
                                echo number_format($j, 4, '.', ',');
                                ?>
                            </th>
                            <th>
                                <?php
                                $bobotObj->readAvg($baris['id_kriteria']);
                                $b = $bobotObj->hak;
                                $bobotObj->insert4($b, $baris['id_kriteria']);
                                echo number_format($b, 4, '.', ',');
                                ?>
                            </th>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>

            <table>
                <thead>
                    <tr>
                        <th>Penjumlahan</th>
                        <?php $bobots1y = $bobotObj->readAll2();
                        while ($row = $bobots1y->fetch(PDO::FETCH_ASSOC)) : ?>
                            <th><?= $row['nama_kriteria'] ?></th>
                        <?php endwhile; ?>
                        <th>Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $sumRow = [];
                    $bobots2y = $bobotObj->readAll2();
                    while ($baris = $bobots2y->fetch(PDO::FETCH_ASSOC)) : ?>
                        <tr>
                            <th><?= $baris['nama_kriteria'] ?></th>
                            <?php $jumlah = 0;
                            $bobots3y = $bobotObj->readAll2();
                            while ($kolom = $bobots3y->fetch(PDO::FETCH_ASSOC)) : ?>
                                <td>
                                    <?php
                                    if ($baris['id_kriteria'] == $kolom['id_kriteria']) {
                                        $c = $kolom['bobot_kriteria'] * 1;
                                        echo number_format($c, 4, '.', ',');
                                        $jumlah += $c;
                                    } else {
                                        $bobotObj->readAll1($baris['id_kriteria'], $kolom['id_kriteria']);
                                        $c = $kolom['bobot_kriteria'] * $bobotObj->kp;
                                        echo number_format($c, 4, '.', ',');
                                        $jumlah += $c;
                                    }
                                    ?>
                                </td>
                            <?php endwhile; ?>
                            <th>
                                <?php
                                $sumRow[$baris['id_kriteria']] = $jumlah;
                                echo number_format($jumlah, 4, '.', ',');
                                ?>
                            </th>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>

            <table>
                <thead>
                    <tr>
                        <th>Rasio Konsistensi</th>
                        <th>Jumlah</th>
                        <th>Prioritas</th>
                        <th>Hasil</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $total = 0;
                    $bobots1z = $bobotObj->readAll2();
                    while ($row1 = $bobots1z->fetch(PDO::FETCH_ASSOC)) : ?>
                        <tr>
                            <th><?= $row1["nama_kriteria"] ?></th>
                            <th><?= number_format($sumRow[$row1["id_kriteria"]], 4, '.', ',') ?></th>
                            <th><?= number_format($row1["bobot_kriteria"], 4, '.', ','); ?></th>
                            <?php $jumlah = $sumRow[$row1["id_kriteria"]] + $row1["bobot_kriteria"]; ?>
                            <th><?= number_format($jumlah, 4, '.', ','); ?></th>
                            <?php $total += $jumlah; ?>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="3">Rata-rata</th>
                        <th><?php $rata = $total / $count;
                            echo number_format($rata, 4, '.', ','); ?></th>
                    </tr>
                </tfoot>
            </table>

            <table>
                <tbody>
                    <tr>
                        <th>N (kriteria)</th>
                        <td><?= $count ?></td>
                    </tr>
                    <tr>
                        <th>Hasil Akhir (X maks)</th>
                        <td><?= number_format($rata, 4, '.', ','); ?></td>
                    </tr>
                    <tr>
                        <th>IR</th>
                        <td><?php echo $ir = $bobotObj->getIr($count); ?></td>
                    </tr>
                    <tr>
                        <th>CI</th>
                        <td><?php $ci = ($rata - $count) / ($count - 1);
                            echo number_format($ci, 4, '.', ','); ?></td>
                    </tr>
                    <tr>
                        <th>CR</th>
                        <td><?php $cr = $ci / $ir;
                            echo number_format($cr, 4, '.', ','); ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="btn-input">
            <div class="btn-next">
                <button type="button" name="next" onclick="location.href='perbandingan-alternatif.php'">
                    <span>Selanjutnya</span><i class="fa-solid fa-arrow-right"></i>
                </button>
            </div>
        </div>

        <?php
        include '../includes/footer.inc.php';
        ?>