<?php
ob_start();
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

if (isset($_POST['reset'])) {
    $ranObj->delete();
    ob_end_clean();
    header("location: hasil-akhir.php");
}
?>

<div class="main-content">
    <div class="content">
        <div class="navigasi">
            <a href="dashboard.php">Dashboard</a>
            <span>/</span>
            <span>Hasil Akhir</span>
        </div>
        <div class="judul-content">
            <div class="text-judul">
                <i class="fa-regular fa-star-half-stroke"></i>
                <h2>Hasil Akhir</h2>
            </div>
            <form method="post">
                <div class="btn-judul">
                    <div class="btn-hapus">
                        <button type="submit" name="reset">
                            <i class="fa-solid fa-eraser"></i><span>Reset Hasil</span>
                        </button>
                    </div>
                    <div class="btn-tambah">
                        <button type="button" name="kembali" onclick="location.href='dashboard.php'">
                            <i class="fa-solid fa-backward"></i><span>Kembali</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <h3 class="judul-hasilAkhir">Data Bobot</h3>
        <table>
            <thead>
                <tr>
                    <th rowspan="3">Alternatif</th>
                    <th style="text-align: center;" colspan="<?php $kri1a = $kriObj->readAll();
                                                                echo $kri1a->rowCount(); ?>">Kriteria</th>
                </tr>
                <tr>
                    <?php $kri2a = $kriObj->readAll();
                    while ($row = $kri2a->fetch(PDO::FETCH_ASSOC)) : ?>
                        <th><?= $row['nama_kriteria'] ?></th>
                    <?php endwhile; ?>
                </tr>
                <tr>
                    <?php $bobot1 = $ranObj->readBob();
                    while ($row = $bobot1->fetch(PDO::FETCH_ASSOC)) : ?>
                        <td><?= number_format($row['bobot_kriteria'], 4, '.', ',') ?></td>
                    <?php endwhile; ?>
                </tr>
            </thead>
            <tbody>
                <?php $alt1a = $altObj->readByFilter();
                while ($row1 = $alt1a->fetch(PDO::FETCH_ASSOC)) : ?>
                    <tr>
                        <th><?= $row1['nama'] ?></th>
                        <?php $a = $row1['id_alternatif']; ?>
                        <?php $kri2a = $kriObj->readAll();
                        while ($row2 = $kri2a->fetch(PDO::FETCH_ASSOC)) : ?>
                            <?php $b = $row2['id_kriteria']; ?>
                            <?php $ran1a = $ranObj->readR($a, $b);
                            while ($row3 = $ran1a->fetch(PDO::FETCH_ASSOC)) : ?>
                                <td>
                                    <?php
                                    echo $nor = number_format($row3['skor_alt_kri'], 4, '.', ',');
                                    ?>
                                </td>
                            <?php endwhile; ?>
                        <?php endwhile; ?>
                    </tr>
                <?php endwhile; ?>
                <!-- <tr class="info">
					<th>Jumlah</th>
					<?php //$bobot2 = $ranObj->readBob(); while ($row = $bobot2->fetch(PDO::FETCH_ASSOC)): 
                    ?>
						<td>
							<?php
                            // $rmax1 = $ranObj->readMax($row['id_kriteria']);
                            // $max = $rmax1->fetch(PDO::FETCH_ASSOC);
                            // echo number_format($max['mnr1'], 4, '.', ',');
                            ?>
						</td>
					<?php //endwhile; 
                    ?>
				</tr> -->
            </tbody>
        </table>

        <h3 class="judul-hasilAkhir">Hasil Akhir</h3>
        <table>
            <thead>
                <tr>
                    <th rowspan="2">Alternatif</th>
                    <th style="text-align: center;" colspan="<?php $kri1b = $kriObj->readAll();
                                                                echo $kri1b->rowCount(); ?>">Kriteria</th>
                    <th rowspan="2">Hasil Akhir</th>
                </tr>
                <tr>
                    <?php $kri2b = $kriObj->readAll();
                    while ($row = $kri2b->fetch(PDO::FETCH_ASSOC)) : ?>
                        <th><?= $row['nama_kriteria'] ?></th>
                    <?php endwhile; ?>
                </tr>
            </thead>
            <tbody>
                <?php $alt1b = $altObj->readByFilter();
                while ($row1 = $alt1b->fetch(PDO::FETCH_ASSOC)) : ?>
                    <tr>
                        <th><?= $row1['nama'] ?></th>
                        <?php $a1 = $row1['id_alternatif']; ?>
                        <?php $kri2b = $kriObj->readAll();
                        while ($row2 = $kri2b->fetch(PDO::FETCH_ASSOC)) : ?>
                            <?php $b2 = $row2['id_kriteria']; ?>
                            <?php $ran1b = $ranObj->readR($a1, $b2);
                            while ($row3 = $ran1b->fetch(PDO::FETCH_ASSOC)) : ?>
                                <td>
                                    <?php
                                    $norx = $row3['skor_alt_kri'] * $row2['bobot_kriteria'];
                                    //pow($row3['skor_alt_kri'],$bobot);
                                    echo number_format($norx, 4, '.', ',');
                                    $ranObj->ia = $a1;
                                    $ranObj->ik = $b2;
                                    $ranObj->nn4 = $norx;
                                    $ranObj->normalisasi1();
                                    ?>
                                </td>
                            <?php endwhile; ?>
                        <?php endwhile; ?>
                        <td>
                            <?php
                            $stmthasil = $ranObj->readHasil1($a1);
                            $hasil = $stmthasil->fetch(PDO::FETCH_ASSOC);
                            echo number_format($hasil['bbn'], 4, '.', ',');
                            $ranObj->ia = $a1;
                            $ranObj->has1 = $hasil['bbn'];
                            $ranObj->hasil1();
                            ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
                <!-- <tr>
					<th>Jumlah</th>
					<?php //while ($rowx2 = $stmtx2y->fetch(PDO::FETCH_ASSOC)): 
                    ?>
	          <td>
							<?php
                            // $stmtx3y = $ranObj->readMax($rowx2['id_kriteria']);
                            // $rowx3 = $stmtx3y->fetch(PDO::FETCH_ASSOC);
                            // echo number_format($rowx3['mnr1'], 5, '.', ',');
                            ?>
						</td>
		      <?php //endwhile; 
                ?>
					<td>
						<?php
                        // $stmtx4y = $ranObj->readMax2();
                        // $rowx4 = $stmtx4y->fetch(PDO::FETCH_ASSOC);
                        // echo number_format($rowx4['mnr2'], 5, '.', ',');
                        ?>
					</td>
				</tr> -->
            </tbody>
        </table>


        <?php include '../includes/footer.inc.php'; ?>