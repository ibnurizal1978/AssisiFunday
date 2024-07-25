<?php
require_once '../config.php';

$date_from = input_data($_POST['date_from']);
$date_to = input_data($_POST['date_to']);
$shop_id = input_data($_POST['shop_id']);

$from_Y 	= substr($date_from,0,4);
$from_M 	= substr($date_from,5,2);
$from_D 	= substr($date_from,8,2);
$from_tampil = $from_D.'-'.$from_M.'-'.$from_Y;

$to_Y 		= substr($date_to,0,4);
$to_M 		= substr($date_to,5,2);
$to_D 		= substr($date_to,8,2);
$to_tampil 	= $to_D.'-'.$to_M.'-'.$to_Y;

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
}
*/
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=sales-report.xls");

?>
<!-- Main Container -->
<main id="main-container">
                <?php
                if(@$shop_id == 'all') {

                  // $s = "SELECT *, a.cart_payment_token, b.credit_used, b.donation, date_format(a.created_date, '%d-%m-%Y') as purchased_date, date_format(a.created_date, '%H:%i') as purchased_time FROM tbl_salestransaction a INNER JOIN tbl_salescart b USING (cartID) WHERE (date(a.created_date) BETWEEN '".$date_from."' AND '".$date_to."') AND a.cart_status = 'COMPLETED' AND a.cartID = 'CRTMBUZ9QPHZJYTKBKXGTYU' ";
                  $s = "SELECT *, date_format(b.payment_at, '%d-%m-%Y') as buy_date, date_format(b.payment_at, ' %H:%i') as buy_time FROM tbl_order_detail a INNER JOIN tbl_order b USING (order_code) WHERE (date(b.updated_at) BETWEEN '".$date_from."' AND '".$date_to."') AND order_status = 'COMPLETED'";
                }else{
                   $s = "SELECT *, date_format(b.payment_at, '%d-%m-%Y') as buy_date, date_format(b.payment_at, ' %H:%i') as buy_time FROM tbl_order_detail a INNER JOIN tbl_order b USING (order_code) INNER JOIN tbl_product USING (product_id) WHERE (date(b.updated_at) BETWEEN '".$date_from."' AND '".$date_to."') AND order_status = 'COMPLETED' AND a.shop_id = '".$shop_id."'";
                }
                //  echo $s;
                $h = mysqli_query($conn, $s);
                echo 'Date: '.$from_tampil.' to '.$to_tampil;
                ?>
                            <table width=50% border="1" style="font-size:8pt" cellpadding=10>
                                <thead>
                                    <tr>
                                        <th>Shop Name</th>
                                        <th>Order No</th>
                                        <th>Date of Purchase</th>
                                        <th>Time of Purchase</th>
                                        <th>Payment Status</th>
                                        <th>Delivery Status</th>
                                        <th>Fulfilment Type</th>
                                        <th>Date of Delivery/Pickup</th>
                                        <th>Time Slot for Delivery/Pickup</th>
                                        <th>Product Name</th>
                                        <th>Product Total Qty</th>
                                        <th>Product Price</th>
                                        <th>Special Instruction</th>
                                        <th>Total Price</th>
                                        <th>Customer Name</th>
                                        <th>Address</th>
                                        <th>Mobile Number</th>
                                        <th>Email</th>
                                        <th>Delivery Remarks</th>
                                        <th>Pickup Location</th>
                                        <th>Credit Used</th>
                                        <th>Total Amount Payable</th>
                                        <?php if(@$shop_id == 'all') { ?><th>Donation</th><?php } ?>
                                        <th>Delivery Fee</th>
                                        <?php if(@$shop_id == 'all') { ?><th>Discount</th><?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    while($row=mysqli_fetch_assoc($h)) {

                                        $s2 = "SELECT *, date_format(fufillment_date, '%d-%m-%Y') as fufillment_date, fufillment_date FROM tbl_order_shop a INNER JOIN tbl_shop b USING (shop_id) WHERE order_code = '".$row['order_code']."' AND  shop_id = '".$row['shop_id']."'";
                                        $h2 = mysqli_query($conn, $s2);
                                        $r2 = mysqli_fetch_assoc($h2);

                                        $total_amount_payable = ($row['sub_total']+$row['donation']+$row['delivery_fee'])-($row['voucher_amount']+$row['credit_used']);

                                    ?>
                                    <tr>
                                        <td><?php echo $r2['shop_name'] ?></td>
                                        <td><?php echo $row['order_code'] ?></td>
                                        <td><?php echo $row['buy_date'] //$row['purchased_date'] ?></td>
                                        <td><?php echo $row['buy_time'] //$row['purchased_time'] ?></td>
                                        <td><?php echo $row['order_status'] ?></td>
                                        <td><?php echo $r2['delivery_status'] ?></td>
                                        <td><?php echo $r2['fufillment_type'] ?></td>
                                        <td><?php echo $r2['fufillment_date'] ?></td>
                                        <td><?php echo $r2['fufillment_time'] ?></td>
                                        <td><?php echo $row['product_name'] ?></td>
                                        <td><?php echo $row['qty'] ?></td>
                                        <td>$<?php echo $row['price'] ?></td>
                                        <td><?php echo htmlentities($row['shop_notes']) ?></td>
                                        <td>$<?php echo number_format((float)$row['qty']*$row['price'],2, '.', '') ?></td>
                                        <td><?php echo $row['full_name'] ?></td>
                                        <td><?php echo $row ['address'].' '.$row['zip_code'] ?></td>
                                        <td><?php echo $row['phone'] ?></td>
                                        <td><?php echo $row['email'] ?></td>
                                        <td><?php echo $r2['fufillment_remarks'] ?></td>
                                        <td><?php echo $r2['pickup_location'] ?></td>
                                        <td>$<?php echo number_format((float)$row['credit_used'],2, '.', '') ?></td>
                                        <td>$<?php echo number_format((float)$total_amount_payable,2, '.', '') ?></td>
                                        <?php if(@$shop_id == 'all') { ?>
                                          <td>$<?php if($row['donation']=='')
                                          {
                                            $donation = 0;
                                          }else{
                                            $donation = $row['donation'];
                                          }
                                          echo $donation ?></td>
                                        <?php } ?>
                                        <td>$<?php if($row['delivery_fee']=='') { $delivery_fee = 0; }else{ $delivery_fee = $row['delivery_fee']; } echo $delivery_fee ?></td>
                                        <?php if(@$shop_id == 'all') { ?>
                                          <td>$<?php if($row['voucher_amount']=='') { $voucher_amount = 0; }else{ $voucher_amount = $row['voucher_amount']; } echo $voucher_amount ?></td>
                                        <?php } ?>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>


</main>
<!-- END Main Container -->
<?php //require_once 'footer.php' ?>
