<?php
include '../includes/sidebar.inc.php';

include '../includes/alternatif.inc.php';
$altObj = new Alternatif($db);

if ($_POST) {
    $altObj->id = $_POST["idAlternatif"];
    $altObj->nip = $_POST["nip"];
    $altObj->nama = $_POST["namaLengkap"];
    $altObj->tempat_lahir = $_POST["tempatLahir"];
    $altObj->tanggal_lahir = $_POST["tglLahir"];
    $altObj->kelamin = $_POST["jk"];
    $altObj->alamat = $_POST["alamat"];
    $altObj->email = $_POST["email"];
    $altObj->pendidikan = $_POST["pend"];

    if ($altObj->insert()) { ?>
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
            }
                    ?>
?>

<div class="main-content">
    <div class="content">
        <div class="navigasi">
            <a href="dashboard.php">Dashboard</a>
            <span>/</span>
            <a href="data-alternatif.php">Alternatif</a>
            <span>/</span>
            <span>Tambah Data</span>
        </div>
        <form method="post">
            <div class="judul-content">
                <div class="text-judul">
                    <i class="fa-solid fa-user icon"></i>
                    <h2>Tambah Data Alternatif</h2>
                </div>
            </div>
            <div class="box-input">
                <div class="input">
                    <label for="idAlternatif">ID Alternatif</label>
                    <input type="text" style="outline: none;" id="idAlternatif" name="idAlternatif" required readonly="on" value="<?php echo $altObj->getNewID(); ?>">
                </div>
                <div class="input">
                    <label for="nip">Nomor Induk Guru</label>
                    <input type="text" id="nip" name="nip" required autofocus>
                </div>
                <div class="input">
                    <label for="namaLengkap">Nama Lengkap</label>
                    <input type="text" id="namaLengkap" name="namaLengkap" required>
                </div>
                <div class="input">
                    <label for="tempatLahir">Tempat Lahir</label>
                    <input type="text" id="tempatLahir" name="tempatLahir" required>
                </div>
                <div class="input">
                    <label for="tglLahir">Tanggal Lahir</label>
                    <input type="text" id="tglLahir" name="tglLahir" placeholder="yyyy-mm-dd" required>
                </div>
                <div class="input">
                    <label for="jk">Jenis Kelamin</label>
                    <select name="jk" id="jk" required>
                        <option value="">-----</option>
                        <option value="Pria">Pria</option>
                        <option value="Wanita">Wanita</option>
                    </select>
                </div>
                <div class="input">
                    <label for="alamat">Alamat</label>
                    <input type="text" id="alamat" name="alamat" required>
                </div>
                <div class="input">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="example@gmail.com" required>
                </div>
                <div class="input">
                    <label for="pend">Pendidikan</label>
                    <input type="text" id="pend" name="pend" required>
                </div>
                <div class="btn-input">
                    <div class="btn-simpan">
                        <button type="submit">
                            <i class="fa-solid fa-floppy-disk"></i><span>Simpan</span>
                        </button>
                    </div>
                    <div class="btn-kembali">
                        <button type="button" name="kembali" onclick="location.href='data-alternatif.php'">
                            <i class="fa-solid fa-backward"></i><span>Kembali</span>
                        </button>
                    </div>
                </div>
            </div>
        </form>


        <?php
        include '../includes/footer.inc.php';
        ?>