<?php 
if(!@$_SESSION) {
    session_start();
  }

include("../partial/headerA.php");
require("../modules/encrypt.php");
$stmRelasi = $koneksi->query("
    SELECT r.id_relasi,r.id_penyakit, p.kode_penyakit, p.nama_penyakit, r.id_gejala, g.kode_gejala, g.nama_gejala 
    FROM relasi r
    JOIN penyakit p ON r.id_penyakit = p.id_penyakit
    JOIN gejala g ON r.id_gejala = g.id_gejala
");
$dataRelasi = $stmRelasi->fetchAll(PDO::FETCH_OBJ); ?>
<!--service-->
<section id="service" class="section-padding">
    <?php include("../partial/navAdmin.php"); ?>
    
    <div class="container" style="margin-top: 50px;">
        <h2 class="ser-title">Daftar Relasi</h2>
        <a class="btn btn-success" href="../relasi/tambahR.php" style="margin-top: 20px; margin-bottom: 20px;">Tambah Relasi</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Kode Penyakit</th>
                    <th>Nama Penyakit</th>
                    <th>Kode Gejala</th>
                    <th>Nama Gejala</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($dataRelasi as $d):?>
                <tr>
                    <td><?=$d->kode_penyakit;?></td>
                    <td><?=$d->nama_penyakit;?></td>
                    <td><?=$d->kode_gejala;?></td>
                    <td><?=$d->nama_gejala;?></td> 
                    <td>
                    <a href="../relasi/editR.php?id=<?=$d->id_relasi;?>" class="btn btn-success">Edit</a>
                    <a href="../relasi/hapusR.php?id=<?=$d->id_relasi;?>" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
                    </td>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>
</section>
<?php include("../partial/footerA.php"); ?>