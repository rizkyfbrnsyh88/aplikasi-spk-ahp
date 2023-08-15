<?php
include '../includes/sidebar.inc.php';

$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');

include '../includes/user.inc.php';
$eks = new User($db);
$eks->id = $id;
$eks->readOne();

if ($_POST) {
    $eks->nl = $_POST['namaLengkap'];
    $eks->lvl = $_POST['level'];
    $eks->un = $_POST['username'];
    $eks->pw = md5($_POST['password']);
    if ($eks->update()) {
        echo "<script>location.href='user.php'</script>";
    } else { ?>
        <script type="text/javascript">
            window.onload = function() {
                showStickyErrorToast();
            };
        </script> <?php
                }
            }
                    ?>
?>

<div class="main-content">
    <div class="content">
        <div class="navigasi">
            <a href="dashboard.php">Dashboard</a>
            <span>/</span>
            <a href="user.php">Pengguna</a>
            <span>/</span>
            <span>Ubah Data</span>
        </div>
        <form method="post">
            <div class="judul-content">
                <div class="text-judul">
                    <i class="fa-solid fa-user icon"></i>
                    <h2>Ubah Data Pengguna</h2>
                </div>
            </div>
            <div class="box-input">
                <div class="input">
                    <label for="namaLengkap">Nama Lengkap</label>
                    <input type="text" id="namaLengkap" name="namaLengkap" required value="<?php echo $eks->nl; ?>">
                </div>
                <div class="input">
                    <label for="level">Level</label>
                    <select name="level" id="level" required>
                        <option value="">-----</option>
                        <option value="Penilai" <?= ($eks->lvl == "Penilai") ? 'selected' : "" ?>>Penilai</option>
                        <option value="TU" <?= ($eks->lvl == "TU") ? 'selected' : "" ?>>Tata Usaha</option>
                        <option value="Kepsek" <?= ($eks->lvl == "Kepsek") ? 'selected' : "" ?>>Kepala Sekolah</option>
                    </select>
                </div>
                <div class="input">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required value="<?php echo $eks->un; ?>">
                </div>
                <div class="input">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required value="<?php echo $eks->pw; ?>">
                </div>
                <div class="btn-input">
                    <div class="btn-simpan">
                        <button type="submit">
                            <i class="fa-solid fa-floppy-disk"></i><span>Simpan</span>
                        </button>
                    </div>
                    <div class="btn-kembali">
                        <button type="button" name="kembali" onclick="location.href='user.php'">
                            <i class="fa-solid fa-backward"></i><span>Kembali</span>
                        </button>
                    </div>
                </div>
            </div>
        </form>


        <?php
        include '../includes/footer.inc.php';
        ?>