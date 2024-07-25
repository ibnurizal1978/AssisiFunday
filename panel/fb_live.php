<?php
require_once 'header.php';

$s = "SELECT * FROM tbl_fb_live";
$h = mysqli_query($conn, $s);
$r = mysqli_fetch_assoc($h);
?>

<!-- Main Container -->
<main id="main-container">
  <!-- Page Content -->
  <div class="content">
    <!--table-->
    <div class="block table-responsive">
      <div class="block-header block-header-default">
        <h3 class="block-title">FB Live URL</h3>
      </div>
      <div class="block-content">

        <div class="card-body">
          <form action="fb_live_update" method=POST>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                    <label class="bmd-label-floating">URL</label>
                    <input type="text" class="form-control" name="url" value="<?php echo $r['url'] ?>" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                    <label class="bmd-label-floating">Is live?</label>
                    <select class="form-control" name="is_live">
                      <option value="1" <?php if(@$r['is_live']==1) { echo 'selected'; } ?>>Yes</option>
                      <option value="0" <?php if(@$r['is_live']==0) { echo 'selected'; } ?>>No</option>
                    </select>
                    </div>
                </div>
            </div>

            <div class="pull-right">
                <!-- <div id="results"></div><div id="button"></div>-->
               <input type="submit" class="btn btn-success mr-5 mb-5" value="Submit">
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
