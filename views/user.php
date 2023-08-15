<?php
include '../includes/sidebar.inc.php';

include_once("../includes/user.inc.php");
$pro = new User($db);
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
            <span>Pengguna</span>
        </div>
        <form method="post">
            <div class="judul-content">
                <div class="text-judul">
                    <i class="fa-solid fa-users icon"></i>
                    <h2>Data Pengguna</h2>
                </div>
                <div class="btn-judul">
                    <div class="btn-hapus">
                        <button type="submit" name="hapus-contengan">
                            <i class="fa-solid fa-eraser"></i><span>Hapus</span>
                        </button>
                    </div>
                    <div class="btn-tambah">
                        <button type="button" name="tambah-data" onclick="location.href='tambah-user.php'">
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
                            <th>Nama Lengkap</th>
                            <th>Role</th>
                            <th>Username</th>
                            <th width="100px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
                            <tr>
                                <td style="vertical-align:middle;"><input type="checkbox" value="<?php echo $row['id_pengguna'] ?>" name="checkbox[]" /></td>
                                <td style="vertical-align:middle;"><?php echo $row['nama_lengkap'] ?></td>
                                <td style="vertical-align:middle;"><?php echo $row['level'] ?></td>
                                <td style="vertical-align:middle;"><?php echo $row['username'] ?></td>
                                <td>
                                    <div class="btn-aksi">
                                        <div class="btn-aksi-edit">
                                            <a href="ubah-user.php?id=<?= $row['id_user'] ?>">
                                                <i class="fa-solid fa-pencil"></i>
                                            </a>
                                        </div>
                                        <div class="btn-aksi-hapus">
                                            <a href="hapus-user.php?id=<?= $row['id_user'] ?>" onclick="return confirm('Yakin ingin menghapus data')">
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