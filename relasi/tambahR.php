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
if(isset($_POST['submit'])) {
        $data = [
            'penyakit' => $_POST['penyakit'],
            'gejala' => $_POST['gejala'],
        ];
  
        $stmt= $koneksi->prepare('INSERT INTO relasi (id_penyakit, id_gejala) VALUES (:penyakit, :gejala)');
        $stmt->execute($data);
        if($stmt->rowCount() > 0) {
          header('Location: ../relasi/relasi.php?alert=success');
          $_SESSION['message'] = 'Berhasil melakukan penambahan relasi';
        } else {
          header('Location: ../relasi/relasi.php?alert=error');
          $_SESSION['message'] = 'Gagal melakukan penambahan relasi';
        }
      }
?>
 <!--Form Tambah Relasi-->
 <section id="login" class="section-padding">
  <?php include("../partial/navAdmin.php");?>
  <div class="container">
  <?php include('../partial/alert.php') ?>
  <h2 class="ser-title" style="margin-top: 99px;">Form Tambah Relasi</h2>
        <hr class="botm-line">
        <form method="post">
            <div class="form-group">
                <label for="penyakit">Penyakit</label>
                <select class="form-control" name="penyakit" id="penyakit" required>
                    <option value="">--Pilih Penyakit--</option>
                    <?php foreach($dataPenyakit as $p):?>
                    <option value="<?=$p->id_penyakit?>"><?=$p->nama_penyakit?></option>
                    <?php endforeach;?>
                </select>
            </div>
            <div class="form-group">
                <label for="gejala">Gejala</label>
                <select class="form-control" name="gejala" id="gejala" required>
                    <option value="">--Pilih Gejala--</option>
                    <?php foreach($dataGejala as $g):?>
                    <option value="<?=$g->id_gejala?>"><?=$g->nama_gejala?></option>
                    <?php endforeach;?>
                </select>
            </div>
            <div class="form-action">
                <button type="submit" name="submit" class="btn btn-success">Simpan Relasi</button>
                <a href="../relasi/relasi.php" class="btn btn-danger">Batal</a>
            </div>
        </form>
        <hr class="botm-line">
    </div>
  </section>
  <!--/ login-->
  <?php include("../partial/footerA.php");?>