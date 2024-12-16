<?php
if (!@$_SESSION) {
    session_start();
}

include("../partial/headerA.php");
require("../modules/encrypt.php");

if (isset($_GET['id'])) {
    $id_gejala = $_GET['id'];

    // Ambil data gejala berdasarkan ID
    $stmt = $koneksi->prepare('SELECT * FROM gejala WHERE id_gejala = :id');
    $stmt->execute(['id' => $id_gejala]);
    $gejala = $stmt->fetch(PDO::FETCH_OBJ);

    // Jika data tidak ditemukan, kembali ke halaman daftar gejala
    if (!$gejala) {
        header("Location: ../gejala/gejala.php?alert=notfound");
        exit();
    }

    if (isset($_POST['submit'])) {
        $data = [
            'id' => $id_gejala,
            'kode' => $_POST['kode'],
            'nama' => $_POST['nama'],
            'belief' => $_POST['belief'],
        ];

        // Query update data gejala
        $stmt = $koneksi->prepare('UPDATE gejala SET kode_gejala = :kode, nama_gejala = :nama, belief = :belief WHERE id_gejala = :id');
        $stmt->execute($data);

        if ($stmt->rowCount() > 0) {
            $_SESSION['message'] = 'Berhasil melakukan perubahan data gejala';
            header('Location: ../gejala/gejala.php?alert=success');
            exit();
        } else {
            $_SESSION['message'] = 'Gagal melakukan perubahan data gejala atau tidak ada perubahan';
            header('Location: ../gejala/gejala.php?alert=error');
            exit();
        }
    }
} else {
    // Jika ID tidak diberikan, kembali ke halaman daftar gejala
    header("Location: ../gejala/gejala.php");
    exit();
}
?>
<!-- Form Edit Gejala -->
<section id="login" class="section-padding">
    <?php include("../partial/navAdmin.php"); ?>
    <div class="container">
        <?php include('../partial/alert.php'); ?>
        <h2 class="ser-title" style="margin-top: 99px;">Form Edit Gejala</h2>
        <hr class="botm-line">
        <form method="post">
            <div class="form-group">
                <label for="nama">Nama Gejala</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?= htmlspecialchars($gejala->nama_gejala); ?>" required>
            </div>
            <div class="form-group">
                <label for="kode">Kode Gejala</label>
                <input type="text" class="form-control" id="kode" name="kode" value="<?= htmlspecialchars($gejala->kode_gejala); ?>" required>
            </div>
            <div class="form-group">
                <label for="belief">Nilai Bobot</label>
                <input type="text" class="form-control" id="belief" name="belief" value="<?= htmlspecialchars($gejala->belief); ?>" required>
            </div>
            <div class="form-action">
                <button type="submit" name="submit" class="btn btn-success">Ubah Gejala</button>
                <a href="../gejala/gejala.php" class="btn btn-danger">Batal</a>
            </div>
        </form>
        <hr class="botm-line">
    </div>
</section>
<?php include("../partial/footerA.php"); ?>
