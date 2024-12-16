<?php 
// Mulai output buffering
ob_start();

// Inklusi file header
include("partial/header.php");

// Pastikan session aktif
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Cek apakah user sudah login
if (isset($_SESSION['loggedIn'])) {
    header('Location: admin/gejala.php');
    exit();
}

// Periksa apakah form disubmit
if (isset($_POST['submit'])) {
    // Ambil input dan validasi
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (empty($username) || empty($password)) {
        $_SESSION['message'] = 'Username dan password harus diisi';
        header('Location: login.php?alert=error');
        exit();
    }

    // Coba koneksi dan jalankan query
    try {
        // Siapkan query
        $stmt = $koneksi->prepare('SELECT id_admin, password FROM admin WHERE username = :username');
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();
        $fetch = $stmt->fetch(PDO::FETCH_OBJ);

        // Periksa hasil
        if ($stmt->rowCount() > 0 && password_verify($password, $fetch->password)) {
            session_regenerate_id(true);
            $_SESSION['loggedIn'] = true;
            $_SESSION['username'] = $username;
            $_SESSION['id'] = $fetch->id_admin;
            header('Location: admin/gejala.php');
            exit();
        } else {
            $_SESSION['message'] = 'Username atau password salah';
            header('Location: login.php?alert=error');
            exit();
        }
    } catch (PDOException $e) {
        die('Database error: ' . $e->getMessage());
    }
}
?>

  <!--login-->
  <section id="login" class="section-padding">
  <?php include("partial/navUser.php")?>
    <div class="container" style="margin-top: 50px;">
    <?php include('partial/alert.php') ?>
      <div class="row">
        <div class="col-md-12">
          <h2 class="ser-title">Login</h2>
          <hr class="botm-line">
        </div>
        <div class="col-md-12 col-sm-12 marb20">
          <div class="contact-info">
            <div class="space"></div>
            <form method="POST" role="form" class="form-login">
              <div class="form-group">
                <input type="text" name="username" class="form-control br-radius-zero" id="username" placeholder="Username" data-rule="minlen:4" data-msg="Tolong masukan username anda!" />
                <div class="validation"></div>
              </div>
              <div class="form-group">
                <input type="password" class="form-control br-radius-zero" name="password" id="password" placeholder="Password" data-rule="minlen:4" data-msg="Tolong masukan password anda!" />
                <div class="validation"></div>
              </div>
              <div class="form-action">
                <button type="submit" name="submit" class="btn btn-form">Login</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--/ login-->
  <?php include("partial/footer.php");?>