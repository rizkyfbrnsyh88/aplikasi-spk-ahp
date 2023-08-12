<?php
include '../includes/sidebar.inc.php';
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
                            <th>ID Kriteria</th>
                            <th>Nama Kriteria</th>
                            <th>Bobot Kriteria</th>
                            <th width="100px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="checkbox" name="select-all" id="select-all" /></td>
                            <td>C1</td>
                            <td>Tanggung Jawab</td>
                            <td>1</td>
                            <td>AKSI</td>
                        </tr>
                        <tr>
                            <td><input type="checkbox" name="select-all" id="select-all" /></td>
                            <td>C2</td>
                            <td>Kedisiplinan</td>
                            <td>1</td>
                            <td>AKSI</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </form>


        <?php
        include '../includes/footer.inc.php';
        ?>