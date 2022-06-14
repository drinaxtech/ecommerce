<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title><?php echo $this->siteTitle(); ?></title>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Bootstrap core CSS -->
  <link href="<?php echo BASE_URL; ?>assets/css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="<?php echo BASE_URL; ?>assets/css/mdb.min.css" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="<?php echo BASE_URL; ?>assets/css/style.min.css" rel="stylesheet">

  <link href="<?php echo BASE_URL; ?>assets/css/alertify_default.min.css" rel="stylesheet">
  <link href="<?php echo BASE_URL; ?>assets/css/alertify.min.css" rel="stylesheet">

  <script>
        const BASE_URL = "<?php echo BASE_URL; ?>";
  </script>

  <?php echo $this->content('head'); ?>


  <style type="text/css">
    html,
    body,
    header,
    .carousel {
      height: 60vh;
    }

    @media (max-width: 740px) {
      html,
      body,
      header,
      .carousel {
        height: 100vh;
      }
    }

    @media (min-width: 800px) and (max-width: 850px) {
      html,
      body,
      header,
      .carousel {
        height: 100vh;
      }
    }
  </style>
</head>

<body>

  <!-- Navbar -->
  <nav class="navbar fixed-top navbar-expand-lg navbar-light white scrolling-navbar">
    <div class="container">

      <!-- Brand -->
      <a class="navbar-brand waves-effect mr-2" href="<?php echo BASE_URL; ?>">
        <img class="img-fluid" src="<?php echo BASE_URL; ?>assets/images/logo.png">
      </a>

      <!-- Collapse -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Links -->
      <div class="collapse navbar-collapse" id="navbarSupportedContent">

        <!-- Left -->
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link waves-effect" href="#">Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
        </ul>

        <?php 
              $products = isset($_SESSION['products']) ? $_SESSION['products'] : []; 
              $total = 0;
              
              if(count($products) > 0){
                
                foreach($products as $product){
                  $total += intval($product['productQuantity']);
                }
              }
        ?>

        <!-- Right -->
        <ul class="navbar-nav nav-flex-icons">
          <li class="nav-item">
            <a <?php if($total > 0){ ?> href="<?php echo BASE_URL; ?>cart" <?php } else{ ?> href="javascript:;" <?php } ?> class="nav-link waves-effect">
              <span id="items-to-card" class="badge red z-depth-1 mr-1">
              <?php echo $total; ?> 
            </span>
              <i class="fa fa-shopping-cart"></i>
              <span class="clearfix d-none d-sm-inline-block"> Cart </span>
            </a>
          </li>
          <?php 
              $logText = (isset($_SESSION['isLoggedIn'])) ? 'Dashboard' : 'login'; 
              $logUrl = (isset($_SESSION['isLoggedIn'])) ? BASE_URL . 'dashboard' : BASE_URL . 'auth/login'; 
              ?>
          <li class="nav-item">
            <a href="<?php echo $logUrl; ?>" class="nav-link border border-light rounded waves-effect" target="_blank">
              <i class="fa <?php echo ($logText == 'login') ? 'fa-sign-in' : 'fa-user'; ?>  mr-2"></i><?php echo ucfirst($logText); ?>
            </a>
          </li>

        </ul>

      </div>

    </div>
  </nav>
  <!-- Navbar -->


  <?php echo $this->content('body'); ?>



  <!--Footer-->
  <footer style="visibility: visible !important;" class="page-footer text-center font-small mt-4 wow fadeIn">
    <!--Copyright-->
    <div class="footer-copyright py-3">
      © 2018 Copyright:
      <a href="https://mdbootstrap.com/education/bootstrap/" target="_blank"> MDBootstrap.com </a>
    </div>
    <!--/.Copyright-->

  </footer>
  <!--/.Footer-->

  <!-- SCRIPTS -->
  <!-- JQuery -->
  <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/jquery-3.3.1.min.js"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/bootstrap.min.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/mdb.min.js"></script>


  <?php echo $this->content('footer'); ?>


  <!-- Initializations -->
  <script type="text/javascript">
    // Animations initialization
    new WOW().init();
  </script>
</body>

</html>