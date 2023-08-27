<?php
include '../includes/sidebar.inc.php';

if ($_POST) {
    include_once('../includes/user.inc.php');
    $eks = new User($db);
    $eks->nl = $_POST['namaLengkap'];
    $eks->lvl = $_POST['level'];
    $eks->un = $_POST['username'];
    $eks->pw = md5($_POST['password']);

    if ($eks->pw == md5($_POST['cekPassword'])) {
        if ($eks->insert()) { ?>
            <script type="text/javascript">
                window.onload = function() {
                    showStickySuccessToast();
                    setTimeout(function() {
                        location.href = location.href
                    }, 2000);
                };
            </script> <?php
                    } else { ?>
            <script type="text/javascript">
                window.onload = function() {
                    showStickyErrorToast();
                    setTimeout(function() {
                        location.href = location.href
                    }, 2000);
                };
            </script> <?php
                    }
                } else { ?>
        <script type="text/javascript">
            window.onload = function() {
                showStickyWarningToast();
                setTimeout(function() {
                    location.href = location.href
                }, 2000);
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
            <span>Tambah Data</span>
        </div>
        <form method="post">
            <div class="judul-content">
                <div class="text-judul">
                    <i class="fa-solid fa-user icon"></i>
                    <h2>Tambah Data Pengguna</h2>
                </div>
            </div>
            <div class="box-input">
                <div class="input">
                    <label for="namaLengkap">Nama Lengkap</label>
                    <input type="text" id="namaLengkap" name="namaLengkap" required autofocus>
                </div>
                <div class="input">
                    <label for="level">Level</label>
                    <select name="level" id="level" required>
                        <option value="">-----</option>
                        <option value="Penilai">Penilai</option>
                        <option value="Admin">Tata Usaha</option>
                        <option value="Kepsek">Kepala Sekolah</option>
                    </select>
                </div>
                <div class="input">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="input">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="input">
                    <label for="cekPassword">Ulangi Password</label>
                    <input type="password" id="cekPassword" name="cekPassword" required>
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