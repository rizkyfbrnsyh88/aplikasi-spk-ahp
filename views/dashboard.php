<?php
include '../includes/sidebar.inc.php';

include '../includes/nilai-preferensi.inc.php';
$pro3 = new NilaiPreferensi($db);
$stmt3 = $pro3->readAll();

include '../includes/alternatif.inc.php';
$pro1 = new Alternatif($db);
$stmt1 = $pro1->readAll();
$stmt4 = $pro1->readByFilter();

include '../includes/kriteria.inc.php';
$pro2 = new Kriteria($db);
$stmt2 = $pro2->readAll();

include '../includes/bobot.inc.php';
$pro5 = new Bobot($db);
$stmt5 = $pro5->readAll();
?>

<div class="main-content">
    <div class="content">
        <div class="header">
            <h1>Selamat Datang, <?php if ($_SESSION["level"] == "Kepsek") {
                                    echo "Kepala Sekolah";
                                } else {
                                    echo $_SESSION["level"];
                                }  ?>!</h1>
            <p>Sistem Pendukung Keputusan Pemilihan Guru Terbaik di SMP Segar Depok</p>
        </div>
        <div id="container2" style="min-width: 100%; height: 400px; margin: 0 auto"></div>
        <div class="box-info">
            <div class="box-kategori">
                <div class="kategori-judul">
                    <h3>Nilai Preferensi</h3>
                </div>
                <div class="kategori-konten">
                    <ol>
                        <?php while ($row3 = $stmt3->fetch(PDO::FETCH_ASSOC)) : ?>
                            <li><?php echo $row3['ket_nilai'] ?> (<?php echo $row3['jum_nilai'] ?>)</li>
                        <?php endwhile; ?>
                    </ol>
                </div>
            </div>
            <div class="box-kategori">
                <div class="kategori-judul">
                    <h3>Kriteria dan Bobot</h3>
                </div>
                <div class="kategori-konten">
                    <ol>
                        <?php while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) : ?>
                            <li><?php echo $row2['nama_kriteria'] ?></li>
                        <?php endwhile; ?>
                    </ol>
                </div>
            </div>
            <div class="box-kategori">
                <div class="kategori-judul">
                    <h3>Hasil Perangkingan</h3>
                </div>
                <div class="kategori-konten">
                    <ol>
                        <?php while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)) : ?>
                            <li><?php echo $row1['nama'] ?></li>
                        <?php endwhile; ?>
                    </ol>
                </div>
            </div>
        </div>

    </div>
    <div class="footer">
        <p>Copyright &copy; 2023 <strong>Rizki Febriansah</strong></p>
    </div>
</div>



<script src="../assets/js/jquery-1.11.3.min.js"></script>
<script src="../assets/js/highcharts.js"></script>
<script src="../assets/js/exporting.js"></script>
<script>
    var chart1; // globally available
    $(document).ready(function() {
        chart1 = new Highcharts.Chart({
            chart: {
                renderTo: 'container2',
                type: 'column'
            },
            title: {
                text: 'Grafik Usulan'
            },
            xAxis: {
                categories: ['Alternatif']
            },
            yAxis: {
                title: {
                    text: 'Jumlah Nilai'
                }
            },
            series: [
                <?php while ($row4 = $stmt4->fetch(PDO::FETCH_ASSOC)) : ?>
                    //data yang diambil dari database dimasukan ke variable nama dan data
                    {
                        name: '<?php echo $row4['nama'] ?>',
                        data: [<?php echo $row4['hasil_akhir'] ?>]
                    },
                <?php endwhile; ?>
            ]
        });
    });
</script>
</body>

</html>