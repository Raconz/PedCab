<?php 
if(!@$_SESSION) {
    session_start();
  }

include("../partial/headerA.php");
require("../modules/encrypt.php");
$stmD = $koneksi->query('SELECT * FROM penyakit');
$data = $stmD->fetchAll(PDO::FETCH_OBJ); 
?>
<!--service-->
<section id="service" class="section-padding">
    <?php include("../partial/navAdmin.php"); ?>
    <div class="container" style="margin-top: 50px;">
        <h2 class="ser-title">Daftar Penyakit</h2>
        <a class="btn btn-success" href="../penyakit/tambahP.php" style="margin-top: 20px; margin-bottom: 20px;">Tambah Penyakit</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama Penyakit</th>
                    <th>Kode</th>
                    <th>Deskripsi</th>
                    <th>Solusi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($data as $d):?>
                <tr>
                    <td><?=$d->nama_penyakit;?></td>
                    <td><?=$d->kode_penyakit;?></td>
                    <td><?=$d->deskripsi;?></td>
                    <td><?=$d->solusi;?></td>
                    <td>
                    <a href="../penyakit/editP.php?id=<?=$d->id_penyakit;?>" class="btn btn-success">Edit</a>
                    <a href="../penyakit/hapusP.php?id=<?=$d->id_penyakit;?>" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
                    </td>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>
</section>
<!--/ service-->
<?php include("../partial/footerA.php"); ?>
