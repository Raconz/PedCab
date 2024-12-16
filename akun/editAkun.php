<?php
if(!@$_SESSION) {
    session_start();
  }
include("../partial/headerA.php");
$id = $_SESSION['id'];
$stmt = $koneksi->prepare('SELECT * FROM admin WHERE id_admin = :id');
$stmt->bindParam(':id', $id);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_OBJ);
if(isset($_POST['submit'])) {
  if(!$_POST['username']) {
    header('Location: ../akun/editAkun.php?alert=error');
    $_SESSION['message'] = 'Username harus ada';
  } else {
    $ada = false;
    if ($row->username != $_POST['username']){
      $stmtc = $koneksi->prepare('SELECT * FROM admin WHERE username = :username');
      $stmtc->bindParam(':username', $_POST['username']);
      $stmtc->execute();
      if($stmtc->rowCount() > 0) {
        header('Location: ../akun/editAkun.php?alert=error');
        $_SESSION['message'] = 'Username sama!';
        $ada = true;
      }
    }

    if (!$ada) {
      if (!$_POST['password_new']) {
        $data = [
          'id_admin' => $id,
          'username' => $_POST['username']
        ];

        $stmt1 = $koneksi->prepare('UPDATE admin SET username=:username WHERE id_admin =:id_admin');
        $stmt1->execute($data);
        header('Location: ../akun/editAkun.php?alert=success');
        $_SESSION['message'] = 'Berhasil melakukan edit akun';
      } else {
        if ($_POST['password_old']) {
          if (password_verify($_POST['password_old'], $row->password)) {
            $data = [
              'id_admin' => $id,
              'username' => $_POST['username'],
              'password' => password_hash($_POST['password_new'], PASSWORD_BCRYPT)
            ];

            $stmt1 = $koneksi->prepare('UPDATE admin SET username=:username, password=:password WHERE id_admin=:id_admin');
            $stmt1->execute($data);
            header('Location: ../akun/editAkun.php?alert=success');
            $_SESSION['message'] = 'Berhasil melakukan edit akun';
          } else {
            header('Location: ../akun/editAkun.php?alert=error');
            $_SESSION['message'] = 'Pasword lama salah';
          }
        } else {
          header('Location: ../akun/editAkun.php?alert=error');
          $_SESSION['message'] = 'Password lama harus diisi';
        }
      }
    }
  }
}
?>
<section id="service" class="section-padding">
    <?php include("../partial/navAdmin.php"); ?>
    <div class="container" style="margin-top: 50px;">
      <h2 class="ser-title">Akun</h2>
      <hr class="botm-line">
      <form method="POST" role="form" class="form-login">
        <div class="form-group">
          <label for="username" class="form-label">Username <span class="text-danger text-sm">*</span></label>
          <input type="text" name="username" class="form-control br-radius-zero" id="username" value="<?= $row->username ?>"/>
          <div class="validation"></div>
          </div>
          <div class="form-group">
          <label for="password_old" class="form-label">Password lama <br><span class="text-danger text-sm">* Jika tidak diganti maka kosongi</span></label>
            <input type="password" name="password_old" class="form-control" id="password_old">
          </div>
          <div>
            <label for="password_new" class="form-label">Password baru <br><span class="text-danger text-sm">* Jika tidak diganti maka kosongi</span></label>
            <input type="password" name="password_new" class="form-control" id="password_new">
          </div>
          <div class="form-action">
          <hr class="botm-line">
          <button type="submit" name="submit" class="btn btn-success">Ubah</button>
          </div>
        </form>
    </div>
</section>
<?php include("../partial/footerA.php"); ?>