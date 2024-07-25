<?php
require_once 'header.php';
ini_set('display_errors',0);  error_reporting(E_ALL);

$order_code  = Encryption::decode($param[1]);
$shop_id  = Encryption::decode($param[2]);
//$sql = "SELECT *, a.order_code as order_code, date_format(b.fufillment_date, '%d-%m-%Y') as fufillment_date FROM tbl_order a INNER JOIN tbl_order_shop b USING (order_code) INNER JOIN tbl_order_detail c USING (shop_id) WHERE c.order_code = '".$order_code."' AND c.shop_id = '".$shop_id."' LIMIT 1";
$s = "SELECT * FROM tbl_order WHERE order_code = '".$order_code."' LIMIT 1";
$h = mysqli_query($conn, $s) or die(mysqli_error($conn));

$s2 = "SELECT *, date_format(fufillment_date, '%d-%m-%Y') as fufillment_date FROM tbl_order_shop WHERE order_code = '".$order_code."' AND shop_id = '".$shop_id."' LIMIT 1";
$h2 = mysqli_query($conn, $s2) or die(mysqli_error($conn));
$r2 = mysqli_fetch_assoc($h2);

if(mysqli_num_rows($h)== 0) {
    echo "<div align=center><h5>Data empty</h5><a href=sales_transaction class=btn btn success>Click here to go back</a></div>";
}else{
$row = mysqli_fetch_assoc($h);
?>
<!-- Main Container -->
<main id="main-container">
    <!-- Page Content -->
    <div class="content">

        <div class="block table-responsive">
            <div class="block-content">
                <div class="block">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">General Information</h3>
                        </div>
                        <div class="block-content block-content-full">
                            <!-- DataTables functionality is initialized with .js-dataTable-full-pagination class in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                            <table class="table table-bordered" style="font-size: 8pt;">
                                <thead style="background: #f5f5f5">
                                    <tr>
                                        <th colspan="8" style="text-align: center;"><b>Customer Details</b></th>
                                    </tr>
                                    <tr>
                                        <th width="15%">Customer Name</th>
                                        <th width="5%">Email</th>
                                        <th width="10%">Contact No.</th>
                                        <th width="10%">Service Type</th>
                                        <th width="15%">Date of Delivery/Pickup</th>
                                        <th width="10%">Time Slot for Delivery/Pickup</th>
                                        <th width="10%">Delivery Address</th>
                                        <th width="10%">Delivery Remarks</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><?php echo $row['full_name'] ?></td>
                                        <td><?php echo $row['email'] ?></td>
                                        <td><?php echo $row['phone'] ?></td>
                                        <td><?php echo $r2['fufillment_type'] ?></td>
                                        <td><?php echo $r2['fufillment_date'] ?></td>
                                        <td><?php echo $r2['fufillment_time'] ?></td>
                                        <td><?php echo $row['address'].' '.$row['zip_code'] ?></td>
                                        <td><?php echo $r2['fufillment_remarks'] ?></td>
                                    </tr>
                                </tbody>
                            </table>

                            <br/><br/>

                            <table class="table-bordered" style="font-size: 8pt;" cellpadding="5" width="50%">
                                <thead style="background: #f5f5f5">
                                    <tr>
                                        <th colspan="4" style="text-align: center;">Order Summary</th>
                                    </tr>
                                    <tr>
                                        <th width="15%">Product Name</th>
                                        <th width="10%">Qty</th>
                                        <th width="10%">Total Price</th>
                                        <th width="10%">Special Instruction</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql1 = "SELECT * FROM tbl_order_detail  WHERE shop_id = '".$r2['shop_id']."' AND order_code = '".$row['order_code']."'";
                                    $h1 = mysqli_query($conn, $sql1);
                                    while($row1 = mysqli_fetch_assoc($h1)) {
                                    ?>
                                    <tr>
                                        <td><?php echo $row1['product_name'] ?></td>
                                        <td><?php echo $row1['qty'] ?></td>
                                        <td>$<?php echo $row1['sub_total'] ?></td>
                                        <td><?php echo $row1['special_instruction'] ?></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

        <?php if($_SESSION['roleID'] == 2) { ?>
        <form action="sales_update" method=POST>
        <input type="hidden" name="order_code" value="<?php echo Encryption::encode($row["order_code"]) ?>" />
        <input type="hidden" name="shop_id" value="<?php echo Encryption::encode($r2["shop_id"]) ?>" />
            <div class="row">
              <div class="col-md-12">
                  <div class="form-group">
                  <label class="bmd-label-floating">Change Order Status</label>
                  <select class="form-control" name="delivery_status">
                      <option value="PENDING" <?php if(@$r2['delivery_status']=='PENDING') { echo 'selected'; } ?>>PENDING</option>
                      <option value="DELIVERED" <?php if(@$r2['delivery_status']=='DELIVERED') { echo 'selected'; } ?>>DELIVERED</option>
                  </select>
                  </div>
              </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                    <label class="bmd-label-floating">Order Status Remark by Merchant</label>
                    <textarea rows="5" class="form-control" name="shop_notes"><?php echo $r2['shop_notes'] ?></textarea>
                    </div>
                </div>
            </div>

            <div class="pull-right">
                <!-- <div id="results"></div><div id="button"></div>-->
               <input type="submit" class="btn btn-success mr-5 mb-5" value="Submit">
                <div class="clearfix"></div>
            </div>
          </form>
          <?php } ?>


    </div>
    <!-- END Page Content -->
</main>
<!-- END Main Container -->
<?php require_once 'footer.php' ?>
        <?php } ?>
