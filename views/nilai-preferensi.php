<?php
include '../includes/sidebar.inc.php';
include '../includes/nilai-preferensi.inc.php';

$pro = new NilaiPreferensi($db);
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
            <span>Nilai Preferensi</span>
        </div>
        <form method="post">
            <div class="judul-content">
                <div class="text-judul">
                    <i class="fa-solid fa-book icon"></i>
                    <h2>Data Nilai Preferensi</h2>
                </div>
                <div class="btn-judul">
                    <div class="btn-hapus">
                        <button type="submit" name="hapus-contengan">
                            <i class="fa-solid fa-eraser"></i><span>Hapus Banyak</span>
                        </button>
                    </div>
                    <div class="btn-tambah">
                        <button type="button" onclick="location.href='tambah-nilai-preferensi.php'">
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
                            <th>Nilai</th>
                            <th>Keterangan</th>
                            <th width="100px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
                            <tr>
                                <td style="vertical-align:middle;"><input type="checkbox" value="<?php echo $row['id_nilai'] ?>" name="checkbox[]" /></td>
                                <td style="vertical-align:middle;"><?php echo $row['jum_nilai'] ?></td>
                                <td style="vertical-align:middle;"><?php echo $row['ket_nilai'] ?></td>
                                <td>
                                    <div class="btn-aksi">
                                        <div class="btn-aksi-edit">
                                            <a href="ubah-nilai-preferensi.php?id=<?= $row['id_nilai'] ?>">
                                                <i class="fa-solid fa-pencil"></i>
                                            </a>
                                        </div>
                                        <div class="btn-aksi-hapus">
                                            <a href="hapus-nilai-preferensi.php?id=<?= $row['id_nilai'] ?>" onclick="return confirm('Yakin ingin menghapus data')">
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