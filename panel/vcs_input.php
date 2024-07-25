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
                
        <div class="card-body">
          <!--<form action="https://demo.trinaxmind.com/Assisi_funday2/vcs_add.jsp" method=POST>-->
          
            <form action="vcs_verification" method=POST>
          <input type="hidden" name="q" value="<?php echo $_SESSION['companyID'] ?>" />
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                    <input type="text" style="padding:25px; text-align:center" class="form-control" name="vcs_code" placeholder="Enter redemption code" />
                    </div>
                </div>
            </div>

            <div>
                <!-- <div id="results"></div><div id="button"></div>-->
               <input type="submit" class="btn btn-primary btn-lg btn-xlarge" value="Submit">
                <div class="clearfix"></div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- END Small Table -->

    <!-- END Page Content -->
  </div>
</main>
<!-- END Main Container -->
<?php require_once 'footer.php' ?>