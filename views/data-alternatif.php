<?php
include '../includes/sidebar.inc.php';
include_once('../includes/alternatif.inc.php');
include_once('../includes/penilaian-awal-alternatif.inc.php');
$altObj = new Alternatif($db);
$count = $altObj->countAll();

$nilObj = new NilaiAwal($db);

if (isset($_POST['hapus-contengan'])) {
    $imp = "('" . implode("','", array_values($_POST['checkbox'])) . "')";
    $result = $altObj->hapusell($imp);
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
            <span>Alternatif</span>
        </div>
        <form method="post">
            <div class="judul-content">
                <div class="text-judul">
                    <i class="fa-solid fa-book icon"></i>
                    <h2>Data Alternatif</h2>
                </div>
                <div class="btn-judul">
                    <div class="btn-hapus">
                        <button type="button" name="cetak" onclick="location.href='cetak-alternatif.php'">
                            <i class="fa-solid fa-print"></i><span>Cetak</span>
                        </button>
                    </div>
                    <div class="btn-hapus">
                        <button type="submit" name="hapus-contengan">
                            <i class="fa-solid fa-eraser"></i><span>Hapus Banyak</span>
                        </button>
                    </div>
                    <div class="btn-tambah">
                        <button type="button" name="hapus-contengan" onclick="location.href='tambah-alternatif.php'">
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
                            <th>Nip</th>
                            <th>Nama</th>
                            <th>Tempat, Tanggal Lahir</th>
                            <th>Kelamin</th>
                            <th>Alamat</th>
                            <th>Email</th>
                            <th>Pendidikan</th>
                            <th>Hasil Akhir</th>
                            <th width="100px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        $alt1a = $altObj->readAll();
                        while ($row = $alt1a->fetch(PDO::FETCH_ASSOC)) : ?>
                            <tr>
                                <td><input type="checkbox" value="<?= $row['id_alternatif'] ?>" name="checkbox[]" /></td>
                                <td><?= $row['id_alternatif'] ?></td>
                                <td><?= $row['nip'] ?></td>
                                <td><?= $row['nama'] ?></td>
                                <td><?= $row['tempat_lahir'] ?>, <?= $row['tanggal_lahir'] ?></td>
                                <td><?= $row['kelamin'] ?></td>
                                <td><?= $row['alamat'] ?></td>
                                <td><?= $row['email'] ?></td>
                                <td><?= $row['pendidikan'] ?></td>
                                <td>
                                    <?php $nilObj->id_alternatif = $row['id_alternatif'];
                                    $nilObj->readByAlternatif();
                                    if ($nilObj->id) : ?>
                                        <?= $nilObj->nilai ?> (<?= $nilObj->keterangan ?>)
                                    <?php else : ?>
                                        <span>Belum</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="btn-aksi">
                                        <div class="btn-aksi-edit">
                                            <a href="ubah-alternatif.php?id=<?= $row['id_alternatif'] ?>">
                                                <i class="fa-solid fa-pencil"></i>
                                            </a>
                                        </div>
                                        <div class="btn-aksi-hapus">
                                            <a href="hapus-alternatif.php?id=<?= $row['id_alternatif'] ?>" onclick="return confirm('Yakin ingin menghapus data')">
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