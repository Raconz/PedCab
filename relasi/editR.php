<?php 
if(!@$_SESSION) {
    session_start();
  }

include("../partial/headerA.php");
require("../modules/encrypt.php");
$gejala = $koneksi->query('SELECT id_gejala, nama_gejala FROM gejala');
$dataGejala = $gejala->fetchAll(PDO::FETCH_OBJ);
$penyakit = $koneksi->query('SELECT id_penyakit, nama_penyakit FROM penyakit');
$dataPenyakit = $penyakit->fetchAll(PDO::FETCH_OBJ);
if (isset($_GET['id'])) {
    $id_relasi = $_GET['id'];

    // Ambil data relasi berdasarkan ID
    $stmt = $koneksi->prepare('SELECT * FROM relasi WHERE id_relasi = :id');
    $stmt->execute(['id' => $id_relasi]);
    $relasi = $stmt->fetch(PDO::FETCH_OBJ);

    // Jika data tidak ditemukan, kembali ke halaman daftar relasi
    if (!$relasi) {
        header("Location: ../relasi/relasi.php?alert=notfound");
        exit();
    }

    if (isset($_POST['submit'])) {
        $data = [
            'id' => $id_relasi,
            'penyakit' => $_POST['penyakit'],
            'gejala' => $_POST['gejala'],
        ];

        // Query update data relasi
        $stmt = $koneksi->prepare('UPDATE relasi SET id_penyakit = :penyakit, id_gejala = :gejala WHERE id_relasi = :id');
        $stmt->execute($data);

        if ($stmt->rowCount() > 0) {
            $_SESSION['message'] = 'Berhasil melakukan perubahan data relasi';
            header('Location: ../relasi/relasi.php?alert=success');
            exit();
        } else {
            $_SESSION['message'] = 'Gagal melakukan perubahan data relasi atau tidak ada perubahan';
            header('Location: ../relasi/relasi.php?alert=error');
            exit();
        }
    }
} else {
    // Jika ID tidak diberikan, kembali ke halaman daftar relasi
    header("Location: ../relasi/relasi.php");
    exit();
}
?>
 <!--Form Tambah Relasi-->
 <section id="login" class="section-padding">
  <?php include("../partial/navAdmin.php");?>
  <div class="container">
  <?php include('../partial/alert.php') ?>
  <h2 class="ser-title" style="margin-top: 99px;">Form Edit Relasi</h2>
        <hr class="botm-line">
        <form method="post">
            <div class="form-group">
                <label for="penyakit">Penyakit</label>
                <select class="form-control" name="penyakit" id="penyakit" required>
                    <option value="">--Pilih Penyakit--</option>
                    <?php foreach($dataPenyakit as $p):?>
                        <option value="<?= $p->id_penyakit ?>" <?= $p->id_penyakit == $relasi->id_penyakit ? 'selected' : '' ?>>
                            <?= $p->nama_penyakit ?>
                        </option>
                    <?php endforeach;?>
                </select>
            </div>
            <div class="form-group">
                <label for="gejala">Gejala</label>
                <select class="form-control" name="gejala" id="gejala" required>
                    <option value="">--Pilih Gejala--</option>
                    <?php foreach($dataGejala as $g):?>
                        <option value="<?= $g->id_gejala ?>" <?= $g->id_gejala == $relasi->id_gejala ? 'selected' : '' ?>>
                            <?= $g->nama_gejala ?>
                        </option>
                    <?php endforeach;?>
                </select>
            </div>
            <div class="form-action">
                <button type="submit" name="submit" class="btn btn-success">Ubah Relasi</button>
                <a href="../relasi/relasi.php" class="btn btn-danger">Batal</a>
            </div>
        </form>
        <hr class="botm-line">
    </div>
  </section>
  <!--/ login-->
  <?php include("../partial/footerA.php");?>