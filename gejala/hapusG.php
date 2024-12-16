<?php
include('../modules/koneksi.php');
require('../modules/encrypt.php');

if(!@$_SESSION) {
  session_start();
}

if (isset($_GET['id'])) {
    $id_gejala = $_GET['id'];

    // Hapus data dari database
    $stmt = $koneksi->prepare("DELETE FROM gejala WHERE id_gejala = ?");
    $stmt->execute([$id_gejala]);

    // Redirect kembali ke halaman daftar gejala
    header("Location: ../gejala/gejala.php");
    exit();
} else {
    // Jika ID tidak diberikan, kembali ke halaman daftar gejala
    header("Location: ../gejala/gejala.php");
    exit();
}
?>
