<?php include("../partial/headerA.php");?>
  <!--login-->
  <section id="login" class="section-padding">
  <?php include("../partial/navAdmin.php");?>
  <div class="container">
  <h2 class="ser-title" style="margin-top: 99px;">Form Tambah Penyakit</h2> <!-- Menambahkan margin-top -->
        <hr class="botm-line">
        
        <form id="tambahGejalaForm" method="post" action="proses_tambah_gejala.php">
            <div class="form-group">
                <label for="namaGejala">Nama Penyakit</label>
                <input type="text" class="form-control" id="namaGejala" name="namaGejala" required>
            </div>
            <div class="form-group">
                <label for="kodeGejala">Kode Penyakit</label>
                <input type="text" class="form-control" id="kodeGejala" name="kodeGejala" required>
            </div>
            <div class="form-group">
                <label for="kodeGejala">Deskripsi </label>
                <input type="text" class="form-control" id="kodeGejala" name="kodeGejala" required>
            </div>
            <div class="form-group">
                <label for="kodeGejala">Solusi</label>
                <input type="text" class="form-control" id="kodeGejala" name="kodeGejala" required>
            </div>
            <div class="form-action">
                <button type="submit" class="btn btn-success">Simpan Penyakit</button>
            </div>
        </form>
        <hr class="botm-line">
    </div>
  </section>
  <!--/ login-->
  <?php include("../partial/footerA.php");?>