<?php 
if(!@$_SESSION) {
    session_start();
  }

include("../partial/headerA.php");
require("../modules/encrypt.php");
if(isset($_POST['submit'])) {
        $data = [
          'kode' => $_POST['kode'],
          'nama' => $_POST['nama'],
          'deskripsi' => $_POST['deskripsi'],
          'solusi' => $_POST['solusi'],
        ];
  
        $stmt= $koneksi->prepare('INSERT INTO penyakit (kode_penyakit, nama_penyakit, deskripsi, solusi) VALUES (:kode, :nama, :deskripsi, :solusi)');
        $stmt->execute($data);
        if($stmt->rowCount() > 0) {
          header('Location: ../penyakit/penyakit.php?alert=success');
          $_SESSION['message'] = 'Berhasil melakukan penambahan penyakit';
        } else {
          header('Location: ../penyakit/penyakit.php?alert=error');
          $_SESSION['message'] = 'Gagal melakukan penambahan penyakit';
        }
      }
?>
 <!--Form Tambah Gejala-->
 <section id="login" class="section-padding">
  <?php include("../partial/navAdmin.php");?>
  <div class="container">
  <?php include('../partial/alert.php') ?>
  <h2 class="ser-title" style="margin-top: 99px;">Form Tambah Penyakit</h2>
        <hr class="botm-line">
        <form method="post">
            <div class="form-group">
                <label for="nama">Nama Penyakit</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
            </div>
            <div class="form-group">
                <label for="kode">Kode Penyakit</label>
                <input type="text" class="form-control" id="kode" name="kode" required>
            </div>
            <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea class="form-control" name="deskripsi" id="deskripsi" rows="5" cols="40" required></textarea>
            </div>
            <div class="form-group">
                <label for="solusi">Solusi</label>
                <textarea class="form-control" name="solusi" id="solusi" rows="5" cols="40" required></textarea>
            </div>
            <div class="form-action">
                <button type="submit" name="submit" class="btn btn-success">Simpan Penyakit</button>
                <a href="../penyakit/penyakit.php" class="btn btn-danger">Batal</a>
            </div>
        </form>
        <hr class="botm-line">
    </div>
  </section>
  <!--/ login-->
  <?php include("../partial/footerA.php");?>