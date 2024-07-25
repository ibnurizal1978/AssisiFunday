<?php
require_once 'header.php';

$id  = Encryption::decode($param[1]);
$sql = "SELECT * FROM tbl_evoucher WHERE evoucher_id = '".$id."' LIMIT 1";
$h = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($h);
?>
<script src="https://cdn.tiny.cloud/1/ut4vvakp46lgqitx677n89tmbc8aass9rt0bxmn3hei2mgnb/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
  <script>
    tinymce.init({
      selector: 'textarea',
      menubar: false,
      plugins: '   autolink lists  ',
      toolbar: 'undo redo |  formatselect | fontsizeselect | bold italic underline forecolor  | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | table | removeformat',
      toolbar_mode: 'floating',
   });
  </script>
<!-- Main Container -->
<main id="main-container">
  <!-- Page Content -->
  <div class="content">
    <!--table-->
    <div class="block table-responsive">
      <div class="block-header block-header-default">
        <h3 class="block-title">Update E-Voucher</h3>
      </div>
      <div class="block-content">

        <div class="card-body">
          <form action="evoucher_update" method=POST>
          <input type="hidden" name="id" value="<?php echo Encryption::encode($row["evoucher_id"]) ?>" />
            <div class="row">
              <div class="col-md-12">
                  <div class="form-group">
                  <label class="bmd-label-floating">Product</label>
                  <select class="form-control" name="product_id">
                      <?php
                      $sql1 = "SELECT product_id, product_name FROM tbl_product a INNER JOIN tbl_shop b USING (shop_id) WHERE fufilment_type_option IN ('By Appointment e-Voucher', 'Dine in/Takeaway e-Voucher') OR fufilment_cash_option IN ('Cash e-Voucher')  AND (delete_status IS NULL OR delete_status = 0) ORDER BY product_name";
                      $h1 = mysqli_query($conn, $sql1);
                      while($row1 = mysqli_fetch_assoc($h1)) {
                      ?>
                      <option value="<?php echo $row1['product_id'] ?>" <?php if(@$row['product_id']==$row1['product_id']) { echo 'selected'; } ?>><?php echo $row1['product_name'] ?></option>
                      <?php } ?>
                  </select>
                  </div>
              </div>
            </div>
            <!--<div class="row">
              <div class="col-md-12">
                  <div class="form-group">
                  <label class="bmd-label-floating">Food Panda Voucher?</label>
                  <select class="form-control" name="foodpanda">
                      <option value="0" <?php if(@$row['foodpanda']=='0') { echo 'selected'; } ?>>No</option>
                      <option value="1" <?php if(@$row['foodpanda']=='1') { echo 'selected'; } ?>>Yes</option>
                  </select>
                  </div>
              </div>
            </div>-->
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                    <label class="bmd-label-floating">Title (max character 50)</label>
                    <input type="text" class="form-control" name="title" maxlength="50" value="<?php echo $row['title'] ?>" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                    <label class="bmd-label-floating">Location (max character 60)</label>
                    <input type="text" class="form-control" name="location" maxlength="60" value="<?php echo $row['location'] ?>" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                    <label class="bmd-label-floating">Date Time (max character 60)</label>
                    <input type="text" class="form-control" name="datetime" maxlength="60" value="<?php echo $row['datetime'] ?>" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                    <label class="bmd-label-floating">Voucher Info</label>
                    <textarea rows="5" class="form-control" name="voucher_info"><?php echo $row['voucher_info'] ?></textarea>
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
