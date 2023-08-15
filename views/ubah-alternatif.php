<?php
include '../includes/sidebar.inc.php';

$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');

include '../includes/alternatif.inc.php';

$altObj = new Alternatif($db);
$altObj->id = $id;
$altObj->readOne();

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

    if ($altObj->update()) {
        echo "<script>location.href='data-alternatif.php'</script>";
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
            <a href="data-alternatif.php">Alternatif</a>
            <span>/</span>
            <span>Ubah Data</span>
        </div>
        <form method="post">
            <div class="judul-content">
                <div class="text-judul">
                    <i class="fa-solid fa-user icon"></i>
                    <h2>Ubah Data Alternatif</h2>
                </div>
            </div>
            <div class="box-input">
                <div class="input">
                    <label for="idAlternatif">ID Alternatif</label>
                    <input type="text" id="idAlternatif" name="idAlternatif" required readonly="on" value="<?php echo $altObj->id; ?>">
                </div>
                <div class="input">
                    <label for="nip">Nomor Induk Guru</label>
                    <input type="text" id="nip" name="nip" required value="<?php echo $altObj->nip; ?>">
                </div>
                <div class="input">
                    <label for="namaLengkap">Nama Lengkap</label>
                    <input type="text" id="namaLengkap" name="namaLengkap" required value="<?php echo $altObj->nama; ?>">
                </div>
                <div class="input">
                    <label for="tempatLahir">Tempat Lahir</label>
                    <input type="text" id="tempatLahir" name="tempatLahir" required value="<?php echo $altObj->tempat_lahir; ?>">
                </div>
                <div class="input">
                    <label for="tglLahir">Tanggal Lahir</label>
                    <input type="text" id="tglLahir" name="tglLahir" required value="<?php echo $altObj->tanggal_lahir; ?>">
                </div>
                <div class="input">
                    <label for="jk">Jenis Kelamin</label>
                    <select name="jk" id="jk" required>
                        <option value="">-----</option>
                        <option value="Pria" <?= ($altObj->kelamin == "Pria") ? 'selected' : "" ?>>Pria</option>
                        <option value="Wanita" <?= ($altObj->kelamin == "Wanita") ? 'selected' : "" ?>>Wanita</option>
                    </select>
                </div>
                <div class="input">
                    <label for="alamat">Alamat</label>
                    <input type="text" id="alamat" name="alamat" required value="<?php echo $altObj->alamat; ?>">
                </div>
                <div class="input">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required value="<?php echo $altObj->email; ?>">
                </div>
                <div class="input">
                    <label for="pend">Pendidikan</label>
                    <input type="text" id="pend" name="pend" required value="<?php echo $altObj->pendidikan; ?>">
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