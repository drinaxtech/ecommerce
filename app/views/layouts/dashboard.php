<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $this->siteTitle(); ?></title>

    <link href="<?php echo BASE_URL; ?>assets/dashboard/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo BASE_URL; ?>assets/dashboard/css/master.css" rel="stylesheet">
    <link href="<?php echo BASE_URL; ?>assets/dashboard/css/Chart.min.css" rel="stylesheet">
    <link href="<?php echo BASE_URL; ?>assets/dashboard/css/flag-icon.min.css" rel="stylesheet">
    <link href="<?php echo BASE_URL; ?>assets/dashboard/css/datatables.min.css" rel="stylesheet">
    <link href="<?php echo BASE_URL; ?>assets/css/alertify_default.min.css" rel="stylesheet">
    <link href="<?php echo BASE_URL; ?>assets/css/alertify.min.css" rel="stylesheet">
    <?php echo $this->content('head'); ?>
</head>

<body>
    <div class="wrapper">
        <nav id="sidebar" class="">
            <div class="sidebar-header">
                <img src="<?php echo BASE_URL; ?>assets/images/logo.png"  alt="logo" class="app-logo">
            </div>
            <ul class="list-unstyled components">
                <li>
                    <a 
                    <?php if(isset($currentUrl) && $currentUrl == "dashboard") { ?> class="active" <?php } ?>
                    href="<?php echo BASE_URL; ?>dashboard"><i class="fas fa-home"></i> Dashboard</a>
                </li>
                <li>
                    <a 
                    <?php if(isset($currentUrl) && $currentUrl == "categories") { ?> class="active" <?php } ?>
                    href="<?php echo BASE_URL; ?>dashboard/categories"><i class="fas fa-table"></i> Categories</a>
                </li>
                <li>
                    <a 
                    <?php if(isset($currentUrl) && $currentUrl == "products") { ?> class="active" <?php } ?>
                    href="<?php echo BASE_URL; ?>dashboard/products"><i class="fas fa-list-alt"></i> Products</a>
                </li>
                <li>
                    <a 
                    <?php if(isset($currentUrl) && $currentUrl == "orders") { ?> class="active" <?php } ?>
                    href="<?php echo BASE_URL; ?>dashboard/orders"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Orders</a>
                </li>
                <li>
                    <a href="<?php echo BASE_URL; ?>auth/logout"><i class="fas fa-sign-out-alt"></i>Logout</a>
                </li>
            </ul>
        </nav>

        <div id="body" class="">
            <nav class="navbar navbar-expand-lg navbar-primary bg-primary">
                <button type="button" id="sidebarCollapse" class="btn btn-outline-light default-light-menu"><i class="fas fa-bars"></i><span></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="nav navbar-nav ml-auto">

                        <li class="nav-item dropdown">
                            <div class="nav-dropdown">
                                <a href="" class="nav-item nav-link dropdown-toggle" data-toggle="dropdown"><i class="fas fa-user"></i> <span><?php echo $_SESSION['username']; ?></span> <i style="font-size: .8em;" class="fas fa-caret-down"></i></a>
                                <div class="dropdown-menu dropdown-menu-right nav-link-menu">
                                    <ul class="nav-list">
                                        <li><a href="<?php echo BASE_URL; ?>" class="dropdown-item"><i class="fas fa-shopping-cart"></i> Shop</a></li>
                                        <div class="dropdown-divider"></div>
                                        <li><a href="<?php echo BASE_URL; ?>auth/logout" class="dropdown-item"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>

            <?php echo $this->content('body'); ?>


        </div>
    </div>

    <script src="<?php echo BASE_URL; ?>assets/dashboard/js/jquery-3.4.1.min.js"></script>
    <script src="<?php echo BASE_URL; ?>assets/dashboard/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo BASE_URL; ?>assets/dashboard/js/solid.min.js"></script>
    <script src="<?php echo BASE_URL; ?>assets/dashboard/js/fontawesome.min.js"></script>
    <script src="<?php echo BASE_URL; ?>assets/dashboard/js/Chart.min.js"></script>
    <script src="<?php echo BASE_URL; ?>assets/dashboard/js/dashboard-charts.js"></script>
    <script src="<?php echo BASE_URL; ?>assets/dashboard/js/script.js"></script>
    <script src="<?php echo BASE_URL; ?>assets/js/jquery.validate.min.js"></script>
    <script src="http://cdn.jsdelivr.net/jquery.validation/1.15.0/additional-methods.min.js"></script>
    <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/alertify.min.js"></script>
    <?php echo $this->content('footer'); ?>
   

</body>

</html>