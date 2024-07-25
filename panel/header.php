<?php
//session_write_close();
session_start();
ini_set('display_errors',1);  error_reporting(E_ALL);
//session_start(['cookie_secure' => true,'cookie_httponly' => true]);
//header("X-XSS-Protection: 1; mode=block");
//require_once '../check-session.php';
//require_once 'components.php';
include "../ccconfig.php";
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.js"></script>
<style type="text/css">
.no-js #loader { display: none;  }
.js #loader { display: block; position: absolute; left: 100px; top: 0; }
.se-pre-con {
    position: fixed;
    left: 0px;
    top: 0px;
    width: 100%;
    height: 100%;
    z-index: 9999;
    background: url(https://smallenvelop.com/wp-content/uploads/2014/08/Preloader_11.gif) center no-repeat #fff;
}
</style>
<script type="text/javascript">
    // Wait for window load
    $(window).load(function() {
        // Animate loader off screen
        $(".se-pre-con").fadeOut("slow");;
    });
</script>

    <body>

        <div class="se-pre-con" onLoad="Codebase.loader('show', 'bg-gd-sun'); setTimeout(function () { Codebase.loader('hide'); }, 3000);"></div>

        <div id="page-container" class="sidebar-o side-scroll page-header-modern main-content-boxed">

            <nav id="sidebar">
                <!-- Sidebar Scroll Container -->
                <div id="sidebar-scroll">
                    <!-- Sidebar Content -->
                    <div class="sidebar-content">
                        <!-- Side Header -->
                        <div class="content-header content-header-fullrow px-15">
                            <!-- Mini Mode -->
                            <div class="content-header-section sidebar-mini-visible-b">
                                <!-- Logo -->
                                <span class="content-header-item font-w700 font-size-xl float-left animated fadeIn">
                                    <span class="text-dual-primary-dark">c</span><span class="text-info">b</span>
                                </span>
                                <!-- END Logo -->
                            </div>
                            <!-- END Mini Mode -->

                            <!-- Normal Mode -->
                            <div class="content-header-section text-center align-parent sidebar-mini-hidden">
                                <button type="button" class="btn btn-circle btn-dual-secondary d-lg-none align-v-r" data-toggle="layout" data-action="sidebar_close">
                                    <i class="fa fa-times text-danger"></i>
                                </button>
                                <!-- END Close Sidebar -->

                                <!-- Logo -->
                                <div class="content-header-item">
                                    <a class="link-effect font-w700" href="#">
                                      <?php //echo $_COOKIE["PHPSESSID"].' -> '.$_SESSION['staffID'] ?>
                                        <i class="si si-fire text-primary"></i>
                                        <span class="font-size-xl text-dual-primary-dark">ASSISI</span><span class="font-size-xl text-info"></span>
                                    </a>
                                </div>
                                <!-- END Logo -->
                            </div>
                            <!-- END Normal Mode -->
                        </div>
                        <!-- END Side Header -->

                        <!-- Side User -->
                        <div class="content-side content-side-full content-side-user px-10 align-parent">
                            <!-- Visible only in mini mode -->
                            <div class="sidebar-mini-visible-b align-v animated fadeIn">
                                <img src="../assets/img/logo.png" alt="">
                            </div>
                            <!-- END Visible only in mini mode -->

                            <!-- Visible only in normal mode -->
                            <div class="sidebar-mini-hidden-b text-center">
                                <a class="img-link" href="#">
                                    <img width="70" src="../assets/img/logo.png" alt="">
                                </a>
                                <ul class="list-inline mt-10">
                                    <li class="list-inline-item">
                                        <a class="link-effect text-dual-primary-dark font-size-xs font-w600 text-uppercase" href="#">
                                            <?php
                                            $nama = explode(' ', $_SESSION['staffName']);
                                            echo $nama[0];
                                            ?>
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a class="link-effect text-dual-primary-dark" href="../logout<?php echo $ext ?>">
                                            <i class="si si-power"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <!-- END Visible only in normal mode -->
                        </div>
                        <!-- END Side User -->

                        <!-- Side Navigation -->
                        <div class="content-side content-side-full">
                            <ul class="nav-main">
                                <li>
                                    <a class="active nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-cup"></i><span class="sidebar-mini-hide">FRONT PAGE</span></a>
                                    <ul>
                                        <li><?php if($_SESSION['roleID']==2) { ?><a href="dashboard">Home</a><?php }else{ ?><a href="index">Home</a><?php } ?></li>
                                    </ul>
                                </li>
                                <?php if($_SESSION['userName'] == 'godeg') { ?>
                                  <li>
                                      <a class="active nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-cup"></i><span class="sidebar-mini-hide">GOD MENU</span></a>
                                      <ul>
                                          <li><a href="token">Token</a></li>
                                          <li><a href="payment">Payment</a></li>
                                          <li><a href="fb_live">FB Live</a></li>
                                      </ul>
                                  </li>
                                <?php } ?>
                                <?php if($_SESSION['roleID']==1) { ?>
                                <li>
                                    <a class="active nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-cup"></i><span class="sidebar-mini-hide">MERCHANT</span></a>
                                    <ul>
                                        <li><a href="merchant">View</a></li>
                                        <li><a href="merchant_new">Add</a></li>
                                        <li><a href="fb_live">FB Live</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a class="active nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-cup"></i><span class="sidebar-mini-hide">News Ticker</span></a>
                                    <ul>
                                        <li><a href="ticker">View</a></li>
                                        <li><a href="ticker_new">Add</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a class="active nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-cup"></i><span class="sidebar-mini-hide">SHOP</span></a>
                                    <ul>
                                        <li><a href="shop">View</a></li>
                                        <li><a href="shop_new">Add</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a class="active nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-cup"></i><span class="sidebar-mini-hide">PRODUCT</span></a>
                                    <ul>
                                        <li><a href="product">View</a></li>
                                        <li><a href="product_new">Add</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a class="active nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-cup"></i><span class="sidebar-mini-hide">DAILY SPECIAL</span></a>
                                    <ul>
                                        <li><a href="daily_special">View</a></li>
                                        <li><a href="daily_special_new">Add</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a class="active nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-cup"></i><span class="sidebar-mini-hide">EVOUCHER</span></a>
                                    <ul>
                                        <li><a href="evoucher">View</a></li>
                                        <li><a href="evoucher_new">Add</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a class="active nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-cup"></i><span class="sidebar-mini-hide">DISCOUNT VOUCHER</span></a>
                                    <ul>
                                        <li><a href="discount_voucher">View</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a class="active nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-cup"></i><span class="sidebar-mini-hide">BENEFICIARY</span></a>
                                    <ul>
                                        <li><a href="beneficiary">View</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a class="active nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-cup"></i><span class="sidebar-mini-hide">LUCKY DRAW</span></a>
                                    <ul>
                                        <li><a href="lucky_draw">Lucky Draw</a></li>
                                    </ul>
                                </li>
                                <?php } ?>
                                <?php if($_SESSION['roleID']==1 || $_SESSION['roleID']==2) { ?>
                                <li>
                                    <a class="active nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-cup"></i><span class="sidebar-mini-hide">REPORT</span></a>
                                    <ul>
                                        <li><a href="report">View</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a class="active nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-cup"></i><span class="sidebar-mini-hide">SALES</span></a>
                                    <ul>
                                        <li><a href="sales_transaction">View</a></li>
                                    </ul>
                                </li>
                                <?php } ?>
                                <?php if($_SESSION['roleID']==2 || $_SESSION['userName'] == 'godeg') { ?>
                                <li>
                                    <a class="active nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-cup"></i><span class="sidebar-mini-hide">VCS</span></a>
                                    <ul>
                                        <li><a href="vcs">vcs</a></li>
                                    </ul>
                                </li>
                                <?php } ?>
                            </ul>
                        </div>
                        <!-- END Side Navigation -->
                    </div>
                    <!-- Sidebar Content -->
                </div>
                <!-- END Sidebar Scroll Container -->
            </nav>
            <!-- END Sidebar -->

            <!-- Header -->
            <header id="page-header">
                <!-- Header Content -->
                <div class="content-header">
                    <!-- Left Section -->
                    <div class="content-header-section">
                        <!-- Toggle Sidebar -->
                        <!-- Layout API, functionality initialized in Codebase() -> uiApiLayout() -->
                        <button type="button" class="btn btn-circle btn-dual-secondary" data-toggle="layout" data-action="sidebar_toggle">
                            <i class="fa fa-navicon"></i>
                        </button>
                        <!-- END Toggle Sidebar -->
                    </div>
                    <!-- END Left Section -->
                </div>
                <!-- END Header Content -->
            </header>
            <!-- END Header -->
