<?php
require_once 'header.php';

$id  = Encryption::decode($param[1]);
$sql = "SELECT * FROM tbl_discount_voucher WHERE discount_voucher_id = '".$id."' LIMIT 1";
$h = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($h);
?>

<!-- Main Container -->
<main id="main-container">
  <!-- Page Content -->
  <div class="content">
    <!--table-->
    <div class="block table-responsive">
      <div class="block-header block-header-default">
        <h3 class="block-title">Update Discount Voucher</h3>
      </div>
      <div class="block-content">

        <div class="card-body">
          <form action="discount_voucher_update" method=POST>
          <input type="hidden" name="id" value="<?php echo Encryption::encode($row["discount_voucher_id"]) ?>" />
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                    <label class="bmd-label-floating">Voucher Code</label>
                    <input type="text" class="form-control" value="<?php echo $row['code'] ?>" readonly />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                    <label class="bmd-label-floating">Discount Amount</label>
                    <input type="text" class="form-control" value="$<?php echo $row['value'] ?>" readonly />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                    <label class="bmd-label-floating">Max Quantity</label>
                    <input type="text" class="form-control" name="max_qty" value="<?php echo $row['max_qty'] ?>" />
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
