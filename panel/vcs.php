<?php 
require_once 'header.php';
?>

<style>
    .btn-xlarge {
    padding: 14px;
    height: 60px;
    font-size: 22px;
    width: 100%;
    line-height: normal;
    -webkit-border-radius: 8px;
       -moz-border-radius: 8px;
            border-radius: 8px;
}
</style>
<!-- Main Container -->
<main id="main-container">
  <!-- Page Content -->
  <div class="content">
    <!--table-->   
    <div class="block table-responsive">
      <div class="block-content">
                
        <div class="card-body text-center">
            <div class="row jumbotron">
                <div class="col-md-12">
                    <div class="form-group">
                        <!--<a href="https://demo.trinaxmind.com/Assisi_funday2/vcs_scan.jsp?q=<?php echo $_SESSION['companyID'] ?>" class="btn btn-primary btn-lg btn-xlarge">Scan Voucher</a>-->
                        <!--<a href="https://assisifunday.sg/Assisi_funday2/vcs_scan.jsp?q=<?php echo $_SESSION['companyID'] ?>" class="btn btn-primary btn-lg btn-xlarge">Scan Voucher</a>-->
                        <a href="vcs_scan" class="btn btn-primary btn-lg btn-xlarge">Scan Voucher</a>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <a href="vcs_input" class="btn btn-warning btn-lg btn-xlarge">Manual Entry</a>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <a href="vcs_transaction" class="btn btn-info btn-lg btn-xlarge">Check Transaction</a>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
    <!-- END Small Table -->

    <!-- END Page Content -->
  </div>
</main>
<!-- END Main Container -->
<?php require_once 'footer.php' ?>