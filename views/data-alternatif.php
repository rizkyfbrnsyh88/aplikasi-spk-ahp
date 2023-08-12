<?php
include '../includes/sidebar.inc.php';
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
                        <button type="submit" name="hapus-contengan">
                            <i class="fa-solid fa-eraser"></i><span>Hapus</span>
                        </button>
                    </div>
                    <div class="btn-tambah">
                        <button type="button" name="hapus-contengan" onclick="location.href='tambah-user.php'">
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
                            <th>Nik</th>
                            <th>Nama</th>
                            <th>Tempat, Tanggal Lahir</th>
                            <th>Kelamin</th>
                            <th>Jabatan</th>
                            <th>Tanggal Masuk</th>
                            <th>Pendidikan</th>
                            <th>Nilai</th>
                            <th width="100px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="checkbox" name="select-all" id="select-all" /></td>
                            <td>A0001</td>
                            <td>NIK0001</td>
                            <td>Rizki Febriansah</td>
                            <td>Kelutan, 1999-06-07</td>
                            <td>Pria</td>
                            <td>Guru</td>
                            <td>2020-02-20</td>
                            <td>S3</td>
                            <td>90 (B)</td>
                            <td>AKSI</td>
                        </tr>
                        <tr>
                            <td><input type="checkbox" name="select-all" id="select-all" /></td>
                            <td>A0002</td>
                            <td>NIK0002</td>
                            <td>Aliyudin</td>
                            <td>Kelutan, 1999-06-07</td>
                            <td>Pria</td>
                            <td>Guru</td>
                            <td>2020-02-20</td>
                            <td>S3</td>
                            <td>90 (B)</td>
                            <td>AKSI</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </form>


        <?php
        include '../includes/footer.inc.php';
        ?>