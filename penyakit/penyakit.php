<?php include("../partial/headerA.php"); ?>
<!--service-->
<section id="service" class="section-padding">
    <?php include("../partial/navAdmin.php"); ?>
    
    <div class="container" style="margin-top: 50px;">
        <h2 class="ser-title">Daftar Penyakit</h2>
        <button class="btn btn-primary mb-5" onclick="tambahGejala()" style="margin-top: 20px;">Tambahkan Penyakit</button>
        
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama Penyakit</th>
                    <th>Kode</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Penyakit 1</td>
                    <td>G001</td>
                    <td>
                        <button class="btn btn-success" onclick="editGejala('G001', 'Gejala 1')">Edit</button>
                        <button class="btn btn-danger" onclick="hapusGejala('G001')">Hapus</button>
                    </td>
                </tr>
                <tr>
                    <td>Penyakit 2</td>
                    <td>G002</td>
                    <td>
                        <button class="btn btn-success" onclick="editGejala('G002', 'Gejala 2')">Edit</button>
                        <button class="btn btn-danger" onclick="hapusGejala('G002')">Hapus</button>
                    </td>
                </tr>
                <!-- Tambahkan baris gejala lainnya di sini -->
            </tbody>
        </table>
    </div>
</section>
<!--/ service-->

<!-- Modal Edit Gejala -->
<div class="modal fade" id="editGejalaModal" tabindex="-1" role="dialog" aria-labelledby="editGejalaModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editGejalaModalLabel">Edit Penyakit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editGejalaForm">
                    <div class="form-group">
                        <label for="gejalaName">Nama Penyakit</label>
                        <input type="text" class="form-control" id="gejalaName" required>
                    </div>
                    <div class="form-group">
                        <label for="gejalaCode">Kode</label>
                        <input type="text" class="form-control" id="gejalaCode" readonly>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" onclick="saveGejala()">Simpan Perubahan</button>
            </div>
        </div>
    </div>
</div>

<?php include("../partial/footerA.php"); ?>
