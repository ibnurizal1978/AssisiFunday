<?php 
require_once 'header.php';
?>
<!-- Main Container -->
<main id="main-container">
    <!-- Page Content -->
    <div class="content text-center">
        <?php
       // $evoucher_code = substr($param[1],0,8);
       // $shopID = substr(@$param[1],8,200);
        //echo $evoucher_code.'<br/>'.$shopID;

        //$sql = "UPDATE tbl_evoucher_detail SET used_status = 1, used_date = now() WHERE shopID = '".$shopID."' AND evoucher_code = '".$evoucher_code."' LIMIT 1";
       // $sql = "UPDATE tbl_evoucher_detail SET used_status = 1, used_date = now() WHERE evoucher_code = '".$evoucher_code."' LIMIT 1";
        //if(mysqli_query($conn, $sql)) {
            echo '<h1>Success</h1>';
            echo 'Voucher code has been used today<br/><br/><a class="btn btn-success" href=vcs>Back to menu</a>';
        //}else{
            //echo '<h1>Failed</h1>';
            //echo 'Please try using input method.<br/><br/><a class="btn btn-danger" href=vcs>Back to menu</a>';
        //}
        ?>
    </div>
    <!-- END Page Content -->
</main>
<!-- END Main Container -->
<?php require_once 'footer.php' ?>
