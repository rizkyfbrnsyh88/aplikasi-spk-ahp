<?php
include '../includes/sidebar.inc.php';
?>

<div class="main-content">
    <div class="content">
        <div class="navigasi">
            <a href="dashboard.php">Dashboard</a>
            <span>/</span>
            <span>Nilai Preferensi</span>
        </div>
        <div class="judul-content">
            <div class="text-judul">
                <i class="fa-solid fa-book icon"></i>
                <h2>Data Nilai Preferensi</h2>
            </div>
            <div class="btn-judul">
                <div class="btn-hapus">
                    <button type="submit" name="hapus-contengan">
                        <i class="fa-solid fa-eraser"></i><span>Hapus</span>
                    </button>
                </div>
                <div class="btn-tambah">
                    <button type="submit" name="hapus-contengan">
                        <i class="fa-solid fa-clone"></i><span>Tambah Data</span>
                    </button>
                </div>
            </div>
        </div>
        <div class="tabel">
            <table>
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Usia</th>
                        <th>Kota</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>John Doe</td>
                        <td>25</td>
                        <td>Jakarta</td>
                    </tr>
                    <tr>
                        <td>Jane Smith</td>
                        <td>30</td>
                        <td>Bandung</td>
                    </tr>
                    <tr>
                        <td>Michael Johnson</td>
                        <td>22</td>
                        <td>Surabaya</td>
                    </tr>
                    <tr>
                        <td>Sarah Williams</td>
                        <td>28</td>
                        <td>Medan</td>
                    </tr>
                </tbody>
            </table>
        </div>


        <?php
        include '../includes/footer.inc.php';
        ?>