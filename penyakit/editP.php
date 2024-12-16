<?php
if (!@$_SESSION) {
    session_start();
}

include("../partial/headerA.php");
require("../modules/encrypt.php");

if (isset($_GET['id'])) {
    $id_penyakit = $_GET['id'];

    // Ambil data penyakit berdasarkan ID
    $stmt = $koneksi->prepare('SELECT * FROM penyakit WHERE id_penyakit = :id');
    $stmt->execute(['id' => $id_penyakit]);
    $penyakit = $stmt->fetch(PDO::FETCH_OBJ);

    // Jika data tidak ditemukan, kembali ke halaman daftar penyakit
    if (!$penyakit) {
        header("Location: ../penyakit/penyakit.php?alert=notfound");
        exit();
    }

    if (isset($_POST['submit'])) {
        $data = [
            'id' => $id_penyakit,
            'kode' => $_POST['kode'],
            'nama' => $_POST['nama'],
            'deskripsi' => $_POST['deskripsi'],
            'solusi' => $_POST['solusi'],
        ];

        // Query update data penyakit
        $stmt = $koneksi->prepare('UPDATE penyakit SET kode_penyakit = :kode, nama_penyakit = :nama, deskripsi = :deskripsi, solusi = :solusi WHERE id_penyakit = :id');
        $stmt->execute($data);

        if ($stmt->rowCount() > 0) {
            $_SESSION['message'] = 'Berhasil melakukan perubahan data penyakit';
            header('Location: ../penyakit/penyakit.php?alert=success');
            exit();
        } else {
            $_SESSION['message'] = 'Gagal melakukan perubahan data penyakit atau tidak ada perubahan';
            header('Location: ../penyakit/penyakit.php?alert=error');
            exit();
        }
    }
} else {
    // Jika ID tidak diberikan, kembali ke halaman daftar penyakit
    header("Location: ../penyakit/penyakit.php");
    exit();
}
?>
<!-- Form Edit penyakit -->
<section id="login" class="section-padding">
  <?php include("../partial/navAdmin.php");?>
  <div class="container">
  <?php include('../partial/alert.php') ?>
  <h2 class="ser-title" style="margin-top: 99px;">Form Edit Penyakit</h2>
        <hr class="botm-line">
        <form method="post">
            <div class="form-group">
                <label for="nama">Nama Penyakit</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?= htmlspecialchars($penyakit->nama_penyakit); ?>" required>
            </div>
            <div class="form-group">
                <label for="kode">Kode Penyakit</label>
                <input type="text" class="form-control" id="kode" name="kode" value="<?= htmlspecialchars($penyakit->kode_penyakit); ?>" required>
            </div>
            <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea class="form-control" name="deskripsi" id="deskripsi" rows="5" cols="40" required><?= htmlspecialchars($penyakit->deskripsi); ?></textarea>
            </div>
            <div class="form-group">
                <label for="solusi">Solusi</label>
                <textarea class="form-control" name="solusi" id="solusi" rows="5" cols="40" required><?= htmlspecialchars($penyakit->solusi); ?></textarea>
            </div>
            <div class="form-action">
                <button type="submit" name="submit" class="btn btn-success">Ubah Penyakit</button>
                <a href="../penyakit/penyakit.php" class="btn btn-danger">Batal</a>
            </div>
        </form>
        <hr class="botm-line">
    </div>
  </section>
  <!--/ login-->
  <?php include("../partial/footerA.php");?>