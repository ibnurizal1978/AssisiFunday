<?php 
require_once 'header.php';
//require_once 'components.php';
?>


<!-- Main Container -->
<main id="main-container">
    <!-- Page Content -->
    <div class="content text-center">
    <?php if($param[1] == 1) { ?>
        <h1>Invalid Voucher Code</h1>
    <?php } ?>

    <?php if($param[1] == 2) { ?>
        <h1>Invalid Merchant Code</h1>
    <?php } ?>

    <?php if($param[1] == 3) { ?>
        <h1>Used Voucher Code</h1>
    <?php } ?>

    <a href="vcs" class="btn btn-warning btn-lg btn-xlarge">Back to Menu</a>
    </div>
    <!-- END Page Content -->
</main>
<!-- END Main Container -->
<?php require_once 'footer.php' ?>
