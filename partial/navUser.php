<nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
          <div class="col-md-12">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
				      </button>
              <a class="navbar-brand" href="/<?= explode('/', $_SERVER['REQUEST_URI'])[1]?>/index.php" class="me-2 <?php echo ($path == 'index.php' ? 'active' : '') ?>"><h2 class="title">PEDULI CABAI</h2></a>
            </div>
            <div class="collapse navbar-collapse navbar-right" id="myNavbar">
              <ul class="nav navbar-nav">
                <li ><a href="/<?= explode('/', $_SERVER['REQUEST_URI'])[1]?>/index.php" class="me-2 <?php echo ($path == 'index.php' ? 'active' : '') ?>">Menu</a></li>
                <li ><a href="/<?= explode('/', $_SERVER['REQUEST_URI'])[1]?>/diagnosa.php" class="me-2 <?php echo ($path == 'diagnosa.php' ? 'active' : '') ?>">Diagnosa</a></li>
                <li ><a href="/<?= explode('/', $_SERVER['REQUEST_URI'])[1]?>/login.php" class="me-2 <?php echo ($path == 'login.php' ? 'active' : '') ?>">Login</a></li>
              </ul>
            </div>
          </div>
        </div>
      </nav>