<?php include("partial/header.php");

$gejala = $koneksi->query('SELECT * FROM gejala')->fetchAll(PDO::FETCH_OBJ); 

?>
  <!--service-->
  <section id="service" class="section-padding">
  <?php include("partial/navUser.php");?>
    <div class="container" style="margin-top: 50px;">
      <div class="row">
        <div class="col-md-12 col-sm-12">
          <h2 class="ser-title">Diagnosa</h2>
          <hr class="botm-line">
          <form action="hasil.php" class="" method="POST">
            <div class="">
              <?php $i=1; foreach($gejala as $g): ?>
                <div class="">
                  <label><?= $i++ ?>. </label>
                  <input class="" type="checkbox" name="gejala[]" value="<?= $g->kode_gejala ?>" id="checkbox<?= $g->kode_gejala ?>">
                  <label class="" for="checkbox<?= $g->kode_gejala ?>">
                    <?= $g->nama_gejala ?>
                  </label>
                </div>
              <?php endforeach; ?>
            </div>
            <div class="">
              <hr class="botm-line">
              <button type="submit" name="submit" class="btn btn-form">Diagnosa</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
  <!--/ service-->
<?php include("partial/footer.php");?>