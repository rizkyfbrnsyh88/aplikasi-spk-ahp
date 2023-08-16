<?php
include '../includes/koneksi.php';
$database = new Koneksi();
$db = $database->getConnection();

include '../includes/nilai-preferensi.inc.php';
$pro = new NilaiPreferensi($db);
$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');
$pro->id = $id;

if ($pro->delete()) {
    echo "<script>location.href='nilai-preferensi.php';</script>";
} else {
    echo "<script>alert('Gagal Hapus Data');location.href='nilai-preferensi.php';</script>";
}
