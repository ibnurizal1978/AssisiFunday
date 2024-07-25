<?php
require_once '../config.php';

$date_from = input_data($_POST['date_from']);
$date_to = input_data($_POST['date_to']);
$shop_id = input_data($_POST['shop_id']);
/*
$today = date('Y-m-d');
if($date_from > $today)
{
  echo "<script>";
  echo "alert('Date From cannot larger than today'); window.location.href=history.back()";
  echo "</script>";
  exit();
}

if($date_to < $date_from)
{
  echo "<script>";
  echo "alert('Date To cannot smaller than Date From'); window.location.href=history.back()";
  echo "</script>";
  exit();
}*/

header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=sales-report.xls");
?>
<!-- Main Container -->
<main id="main-container">
    <?php
    $s = "SELECT *, date_format(b.updated_at, '%d-%m-%Y') as buy_date, date_format(b.updated_at, ' %H:%i') as buy_time FROM tbl_order_detail a INNER JOIN tbl_order b USING (order_code) WHERE (date(b.updated_at) BETWEEN '".$date_from."' AND '".$date_to."') AND order_status = 'COMPLETED' AND shop_id = '".$shop_id."'";
    $h = mysqli_query($conn, $s);
    ?>
    <table width=100% border="1" style="font-size:8pt" cellpadding=10>
        <thead>
            <tr>
                <th>Order No</th>
                <th>Date of Purchase</th>
                <th>Time of Purchase</th>
                <th>Order Status</th>
                <th>Delivery Status</th>
                <th>Fulfilment Type</th>
                <th>Date of Delivery/Pickup</th>
                <th>Time Slot for Delivery/Pickup</th>
                <th>Product Name</th>
                <th>Product Total Qty</th>
                <th>Special Instruction</th>
                <th>Customer Name</th>
                <th>Address</th>
                <th>Mobile Number</th>
                <th>Email</th>
                <th>Delivery Remarks</th>
                <th>Pickup Location</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while($row=mysqli_fetch_assoc($h)) {

              $s2 = "SELECT * FROM tbl_order_shop WHERE order_code = '".$row['order_code']."' AND shop_id = '".$shop_id."'";
              $h2 = mysqli_query($conn, $s2);
              $r2 = mysqli_fetch_assoc($h2);
              ?>
            <tr>
                <td><?php echo $row['order_code'] ?></td>
                <td><?php echo $row['buy_date'] ?></td>
                <td><?php echo $row['buy_time'] ?></td>
                <td><?php echo $row['order_status'] ?></td>
                <td><?php echo $r2['delivery_status'] ?></td>
                <td><?php echo $r2['fufillment_type'] ?></td>
                <td><?php echo $r2['fufillment_date'] ?></td>
                <td><?php echo $r2['fufillment_time'] ?></td>
                <td><?php echo $row['product_name'] ?></td>
                <td><?php echo $row['qty'] ?></td>
                <td><?php echo htmlentities($r2['fufillment_remarks'])?></td>
                <td><?php echo $row['full_name'] ?></td>
                <td><?php echo $row['address'].' '.$row['zip_code'] ?></td>
                <td><?php echo $row['phone'] ?></td>
                <td><?php echo $row['email'] ?></td>
                <td><?php echo $r2['fufillment_remarks'] ?></td>
                <td>
                    <?php
                    if($r2['pickup_location']=='' && $r2['fufillment_type'] == 'pick up') {
                        $spl = "SELECT location FROM tbl_shop WHERE shop_id = '".$shop_id."' LIMIT 1";
                        $hpl = mysqli_query($conn, $spl);
                        $rpl = mysqli_fetch_assoc($hpl);
                        echo $rpl['location'];
                    }else{
                        echo $r2['pickup_location'];
                    }
                    ?>
                </td>
                <!--<td>$<?php //echo $row['delivery_fee'] ?></td>-->
                <!--<td>$<?php //echo $row['voucher_amount'] ?></td>-->
            </tr>
            <?php } ?>
        </tbody>
    </table>
</main>
<!-- END Main Container -->
<?php //require_once 'footer.php' ?>
