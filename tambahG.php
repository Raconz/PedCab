<?php include("partial/header.php");?>
  <!--login-->
  <section id="login" class="section-padding">
  <?php include("partial/navAdmin.php");?>
  <div class="container">
  <h2 class="ser-title" style="margin-top: 99px;">Form Tambah Gejala</h2> <!-- Menambahkan margin-top -->
        <hr class="botm-line">
        
        <form id="tambahGejalaForm" method="post" action="proses_tambah_gejala.php">
            <div class="form-group">
                <label for="namaGejala">Nama Gejala</label>
                <input type="text" class="form-control" id="namaGejala" name="namaGejala" required>
            </div>
            <div class="form-group">
                <label for="kodeGejala">Kode Gejala</label>
                <input type="text" class="form-control" id="kodeGejala" name="kodeGejala" required>
            </div>
            <div class="form-group">
                <label for="kodeGejala">Nilai Bobot</label>
                <input type="text" class="form-control" id="kodeGejala" name="kodeGejala" required>
            </div>
            <div class="form-action">
                <button type="submit" class="btn btn-success">Simpan Gejala</button>
            </div>
        </form>
    </div>
  </section>
  <!--/ login-->
  <?php include("partial/footerA.php");?>