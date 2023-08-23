<?php
include '../includes/sidebar.inc.php';
include '../includes/kriteria.inc.php';

$pro = new Kriteria($db);
$stmt = $pro->readAll();
$count = $pro->countAll();

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
            <span>Kriteria</span>
        </div>
        <form method="post">
            <div class="judul-content">
                <div class="text-judul">
                    <i class="fa-solid fa-book icon"></i>
                    <h2>Data Kriteria</h2>
                </div>
                <div class="btn-judul">
                    <div class="btn-hapus">
                        <a href="cetak-kriteria.php" name="cetak" onclick="NewWindow(this.href,'name','840','1070','yes')" target="_blank">
                            <i class="fa-solid fa-print"></i><span>Cetak</span>
                        </a>
                    </div>
                    <div class="btn-hapus">
                        <button type="submit" name="hapus-contengan">
                            <i class="fa-solid fa-eraser"></i><span>Hapus Banyak</span>
                        </button>
                    </div>
                    <div class="btn-tambah">
                        <button type="button" name="hapus-contengan" onclick="location.href='tambah-kriteria.php'">
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
                            <th>ID Kriteria</th>
                            <th>Nama Kriteria</th>
                            <th>Bobot Kriteria</th>
                            <th width="100px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) :  ?>
                            <tr>
                                <td><input type="checkbox" value="<?php echo $row['id_kriteria'] ?>" name="checkbox[]" /></td>
                                <td><?php echo $row['id_kriteria'] ?></td>
                                <td><?php echo $row['nama_kriteria'] ?></td>
                                <td><?php echo $row['bobot_kriteria'] ?></td>
                                <td>
                                    <div class="btn-aksi">
                                        <div class="btn-aksi-edit">
                                            <a href="ubah-kriteria.php?id=<?= $row['id_kriteria'] ?>">
                                                <i class="fa-solid fa-pencil"></i>
                                            </a>
                                        </div>
                                        <div class="btn-aksi-hapus">
                                            <a href="hapus-kriteria.php?id=<?= $row['id_kriteria'] ?>" onclick="return confirm('Yakin ingin menghapus data')">
                                                <i class="fa-solid fa-trash"></i>
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                    </tbody>
                </table>
            </div>
        </form>


        <?php
        include '../includes/footer.inc.php';
        ?>