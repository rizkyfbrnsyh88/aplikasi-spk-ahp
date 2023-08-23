<?php
include '../includes/sidebar.inc.php';

include '../includes/penilaian-awal-alternatif.inc.php';
$pro = new NilaiAwal($db);
$stmt = $pro->readAll();

include '../includes/kriteria.inc.php';
$kriteriaObj = new Kriteria($db);
$kriteria = $kriteriaObj->readAll();


include '../includes/detail-penilaian-awal.inc.php';
$nilAwDeObj = new DetailPenilaian($db);
// $nilAwDe = $nilAwDeObj->readAllByNik();


if (isset($_POST['hapus-contengan'])) {
    $imp = "('" . implode("','", array_values($_POST['checkbox'])) . "')";
    $result = $pro->hapusell($imp);
    if ($result) { ?>
        <script type="text/javascript">
            window.onload = function() {
                showSuccessToast();
                setTimeout(function() {
                    window.location.reload(1);
                    history.go(0)
                    location.href = location.href
                }, 5000);
            };
        </script> <?php
                } else { ?>
        <script type="text/javascript">
            window.onload = function() {
                showErrorToast();
                setTimeout(function() {
                    window.location.reload(1);
                    history.go(0)
                    location.href = location.href
                }, 5000);
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
            <span>Nilai Awal Alternatif</span>
        </div>
        <form method="post">
            <div class="judul-content">
                <div class="text-judul">
                    <i class="fa-solid fa-book icon"></i>
                    <h2>Data Nilai Awal Alternatif</h2>
                </div>
                <div class="btn-judul">
                    <div class="btn-hapus">
                        <button type="submit" name="hapus-contengan">
                            <i class="fa-solid fa-eraser"></i><span>Hapus Banyak</span>
                        </button>
                    </div>
                    <div class="btn-tambah">
                        <button type="button" name="hapus-contengan" onclick="location.href='tambah-penilaian-alternatif.php'">
                            <i class="fa-solid fa-clone"></i><span>Tambah Data</span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="tabel">
                <table>
                    <thead>
                        <tr>
                            <th width="10px"><input type="checkbox" name="select-all" id="select-all" /></th>
                            <th>ID Alternatif</th>
                            <th>Nilai</th>
                            <th>Keterangan</th>
                            <th>Periode</th>
                            <th width="100px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
                            <tr>
                                <td><input type="checkbox" value="<?= $row['id_nilai_awal'] ?>" name="checkbox[]" /></td>
                                <td><?= $row['id_alternatif'] ?></td>
                                <td><?= $row['nilai'] ?></td>
                                <td><?php
                                    if ($row['keterangan'] == "B") {
                                        echo "Baik";
                                    } elseif ($row['keterangan'] == "C") {
                                        echo "Cukup";
                                    } else {
                                        echo "Kurang";
                                    }
                                    ?></td>
                                <td><?= $row['periode'] ?></td>
                                <td>
                                    <div class="btn-aksi">
                                        <div class="btn-aksi-detail">
                                            <a href="detail-penilaian-alternatif.php?id=<?= $row['id_alternatif'] ?>">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>
                                        </div>
                                        <div class="btn-aksi-hapus">
                                            <a href="hapus-penilaian-alternatif.php?id=<?= $row['id_penilaian'] ?>" onclick="return confirm('Yakin ingin menghapus data')">
                                                <i class="fa-solid fa-trash"></i>
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </form>


        <?php
        include '../includes/footer.inc.php';
        ?>