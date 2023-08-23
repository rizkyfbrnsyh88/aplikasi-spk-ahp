<?php
include '../includes/koneksi.php';
include '../includes/alternatif.inc.php';
include '../includes/kriteria.inc.php';
include '../includes/ranking.inc.php';

$config = new Koneksi();
$db = $config->getConnection();

$altObj = new Alternatif($db);

$kriObj = new Kriteria($db);

$ranObj = new Ranking($db);
$stmt = $ranObj->readKhusus();
$stmty = $ranObj->readKhusus();
$count = $ranObj->countAll();
$stmtx1y = $ranObj->readBob();
$stmtx2y = $ranObj->readBob();

$bulan = array(
    1 => 'Januari',
    2 => 'Februari',
    3 => 'Maret',
    4 => 'April',
    5 => 'Mei',
    6 => 'Juni',
    7 => 'Juli',
    8 => 'Agustus',
    9 => 'September',
    10 => 'Oktober',
    11 => 'November',
    12 => 'Desember'
);

$bulanSekarang = date('n');
$tanggalSekarang = date('d');
$tahunSekarang = date('Y');

$formatTanggal = $tanggalSekarang . ' ' . $bulan[$bulanSekarang] . ' ' . $tahunSekarang;


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Data Alternatif</title>
    <link rel="stylesheet" href="../assets/css/main-content.css">
    <link rel="stylesheet" href="../assets/css/cetak.css">
</head>

<body onload="window.print()">
    <img src="../assets/images/logo-kop.png" alt="Logo-Kop-Surat">
    <div class="kop-surat">
        <div class="text-kop">
            <div class="yayasan">
                <p>Yayasan Semangat Genta Rohani</p>
                <p>Sekolah Menengah Pertama</p>
            </div>
            <div class="sekolah">
                <p>SMP Segar Depok</p>
            </div>
            <div class="alamat-sekolah">
                <p>Jl. Jakarta Bogor Km 37.7 RT 003/001, Kel. Sukamaju, Kec. Cilodong</p>
                <p>Kota Depok Prov. Jawa Barat. Email: smpsegar@gmail.com, No.Telp: 021-8752573</p>
            </div>
        </div>
    </div>
    <hr>
    <div class="isi-laporan">
        <div class="judul-laporan">
            <h1>Laporan Hasil Perangkingan</h1>
        </div>
        <div class="konten-laporan">
            <?php for ($i = 2020; $i <= 2020; $i++) : ?>
                <table>
                    <thead>
                        <tr>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Hasil Akhir</th>
                            <th>Ranking</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $altObj->periode = $i;
                        $rank = 1;
                        $alt1c = $altObj->readByRank();
                        while ($row = $alt1c->fetch(PDO::FETCH_ASSOC)) : ?>
                            <tr>
                                <td><?= $row["nip"] ?></td>
                                <td><?= $row["nama"] ?></td>
                                <td><?= number_format($row["hasil_akhir"], 4, '.', ',') ?></td>
                                <td><?= $rank++ ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php endfor; ?>
        </div>
        <div class="keterangan">
            <div class="ket-tgl">
                <p>Depok, <?= $formatTanggal ?> </p>
                <p>Mengetahui</p>
                <p>Kepala Sekolah</p>
                <p class="nama">( Aas Hasanah )</p>
            </div>
        </div>
    </div>
</body>

</html>