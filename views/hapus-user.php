<?php
include '../includes/koneksi.php';
$database = new Koneksi();
$db = $database->getConnection();

include '../includes/user.inc.php';
$pro = new User($db);
$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');
$pro->id = $id;

if ($pro->delete()) {
    echo "<script>location.href='user.php';</script>";
} else {
    echo "<script>alert('Gagal Hapus Data');location.href='user.php';</script>";
}
