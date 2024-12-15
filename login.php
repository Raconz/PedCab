<?php include("partial/header.php");?>
  <!--login-->
  <section id="login" class="section-padding">
  <?php include("partial/navUser.php");?>
    <div class="container" style="margin-top: 50px;">
      <div class="row">
        <div class="col-md-12">
          <h2 class="ser-title">Login</h2>
          <hr class="botm-line">
        </div>
        <div class="col-md-12 col-sm-12 marb20">
          <div class="contact-info">
            <div class="space"></div>
            <div id="sendmessage">Your message has been sent. Thank you!</div>
            <div id="errormessage"></div>
            <form action="" method="post" role="form" class="contactForm">
              <div class="form-group">
                <input type="text" name="username" class="form-control br-radius-zero" id="username" placeholder="Username" data-rule="minlen:4" data-msg="Tolong masukan username anda!" />
                <div class="validation"></div>
              </div>
              <div class="form-group">
                <input type="password" class="form-control br-radius-zero" name="password" id="password" placeholder="Password" data-rule="minlen:4" data-msg="Tolong masukan password anda!" />
                <div class="validation"></div>
              </div>
              <div class="form-action">
                <button type="submit" class="btn btn-form">Login</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--/ login-->
  <?php include("partial/footer.php");?>