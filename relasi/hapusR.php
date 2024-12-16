<?php
include('../modules/koneksi.php');
require('../modules/encrypt.php');

if(!@$_SESSION) {
  session_start();
}

if (isset($_GET['id'])) {
    $id_relasi = $_GET['id'];

    // Hapus data dari database
    $stmt = $koneksi->prepare("DELETE FROM relasi WHERE id_relasi = ?");
    $stmt->execute([$id_relasi]);

    // Redirect kembali ke halaman daftar relasi
    header("Location: ../relasi/relasi.php");
    exit();
} else {
    // Jika ID tidak diberikan, kembali ke halaman daftar relasi
    header("Location: ../relasi/relasi.php");
    exit();
}
?>
