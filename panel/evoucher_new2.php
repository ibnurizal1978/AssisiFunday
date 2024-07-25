<?php
require_once 'header.php';
?>

<script src="https://cdn.tiny.cloud/1/ut4vvakp46lgqitx677n89tmbc8aass9rt0bxmn3hei2mgnb/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
  <script>
    tinymce.init({
      selector: 'textarea',
      menubar: false,
      plugins: ' autolink lists',
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
        <h3 class="block-title">New E-Voucher</h3>
      </div>
      <div class="block-content">

        <div class="card-body">
          <form action="evoucher_add" method=POST>
            <div class="row">
              <div class="col-md-12">
                  <div class="form-group">
                  <label class="bmd-label-floating">Product</label>
                  <select class="form-control" name="product_id">
                      <?php
                      $sql = "SELECT product_id, product_name FROM tbl_product a INNER JOIN tbl_shop b USING (shop_id) WHERE (fufilment_type_option IN ('By Appointment e-Voucher', 'Dine in/Takeaway e-Voucher') OR fufilment_cash_option IN ('Cash e-Voucher'))  AND (delete_status IS NULL OR delete_status = 0) ORDER BY product_name";
                      $h = mysqli_query($conn, $sql);
                      while($row = mysqli_fetch_assoc($h)) {
                      ?>
                      <option value="<?php echo $row['product_id'] ?>"><?php echo $row['product_name'] ?></option>
                      <?php } ?>
                  </select>
                  </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                  <div class="form-group">
                  <label class="bmd-label-floating">Food Panda Voucher?</label>
                  <select class="form-control" name="foodpanda">
                      <option value="0">No</option>
                      <option value="1">Yes</option>
                  </select>
                  </div>
              </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                    <label class="bmd-label-floating">Title (max character 50)</label>
                    <input type="text" class="form-control" name="title" maxlength="50" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                    <label class="bmd-label-floating">Location (max character 60)</label>
                    <input type="text" class="form-control" name="location" maxlength="60" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                    <label class="bmd-label-floating">Date Time (max character 60)</label>
                    <input type="text" class="form-control" name="datetime" maxlength="60" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                    <label class="bmd-label-floating">Voucher Info</label>
                    <textarea rows="5" class="form-control" name="voucher_info"></textarea>
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
