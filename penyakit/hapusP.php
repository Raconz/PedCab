<?php
include('../modules/koneksi.php');
require('../modules/encrypt.php');

if(!@$_SESSION) {
  session_start();
}

if (isset($_GET['id'])) {
    $id_penyakit = $_GET['id'];

    // Hapus data dari database
    $stmt = $koneksi->prepare("DELETE FROM penyakit WHERE id_penyakit = ?");
    $stmt->execute([$id_penyakit]);

    // Redirect kembali ke halaman daftar penyakit
    header("Location: ../penyakit/penyakit.php");
    exit();
} else {
    // Jika ID tidak diberikan, kembali ke halaman daftar penyakit
    header("Location: ../penyakit/penyakit.php");
    exit();
}
?>
