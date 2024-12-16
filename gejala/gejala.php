<?php
if(!@$_SESSION) {
    session_start();
  }

include("../partial/headerA.php");
require("../modules/encrypt.php");
$stmD = $koneksi->query('SELECT * FROM gejala');
$data = $stmD->fetchAll(PDO::FETCH_OBJ);
?>
<!--service-->
<section id="service" class="section-padding">
    <?php include("../partial/navAdmin.php"); ?>
    <div class="container" style="margin-top: 50px;">
        <h2 class="ser-title">Daftar Gejala</h2>
        <a class="btn btn-success" href="../gejala/tambahG.php" style="margin-top: 20px; margin-bottom: 20px;">Tambah Gejala</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama Gejala</th>
                    <th>Kode</th>
                    <th>Bobot</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($data as $d):?>
                <tr>
                    <td><?=$d->nama_gejala;?></td>
                    <td><?=$d->kode_gejala;?></td>
                    <td><?=$d->belief;?></td>
                    <td>
                    <a href="../gejala/editG.php?id=<?=$d->id_gejala;?>" class="btn btn-success">Edit</a>
                    <a href="../gejala/hapusG.php?id=<?=$d->id_gejala;?>" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
                    </td>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>
        <hr class="botm-line">
    </div>
</section>
<!--/ service-->
<?php include("../partial/footerA.php"); ?>
