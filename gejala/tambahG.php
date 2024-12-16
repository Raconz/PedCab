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
          'belief' => $_POST['belief'],
        ];
  
        $stmt= $koneksi->prepare('INSERT INTO gejala (kode_gejala, nama_gejala, belief) VALUES (:kode, :nama, :belief)');
        $stmt->execute($data);
        if($stmt->rowCount() > 0) {
          header('Location: ../gejala/gejala.php?alert=success');
          $_SESSION['message'] = 'Berhasil melakukan penambahan gejala';
        } else {
          header('Location: ../gejala/gejala.php?alert=error');
          $_SESSION['message'] = 'Gagal melakukan penambahan gejala';
        }
      }
?>
  <!--Form Tambah Gejala-->
  <section id="login" class="section-padding">
  <?php include("../partial/navAdmin.php");?>
  <div class="container">
  <?php include('../partial/alert.php') ?>
  <h2 class="ser-title" style="margin-top: 99px;">Form Tambah Gejala</h2>
        <hr class="botm-line">
        <form method="post">
            <div class="form-group">
                <label for="nama">Nama Gejala</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
            </div>
            <div class="form-group">
                <label for="kode">Kode Gejala</label>
                <input type="text" class="form-control" id="kode" name="kode" required>
            </div>
            <div class="form-group">
                <label for="belief">Nilai Bobot</label>
                <input type="text" class="form-control" id="belief" name="belief" required>
            </div>
            <div class="form-action">
                <button type="submit" name="submit" class="btn btn-success">Simpan Gejala</button>
                <a href="../gejala/gejala.php" class="btn btn-danger">Batal</a>
            </div>
        </form>
        <hr class="botm-line">
    </div>
  </section>
  <!--/ login-->
  <?php include("../partial/footerA.php");?>