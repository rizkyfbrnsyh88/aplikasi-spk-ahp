<?php
include '../includes/koneksi.php';
$database = new Koneksi();
$db = $database->getConnection();

include '../includes/penilaian-awal-alternatif.inc.php';
$pro = new NilaiAwal($db);
$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');
$pro->id = $id;

if ($pro->delete()) {
    echo "<script>location.href='penilaian-alternatif.php';</script>";
} else {
    echo "<script>alert('Gagal Hapus Data');location.href='penilaian-alternatif.php';</script>";
}
