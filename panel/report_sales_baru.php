<?php 
require_once '../config.php';
//header("Content-type: application/octet-stream"); 
//header("Content-Disposition: attachment; filename=sales-report.xls"); 

$date_from = input_data($_POST['date_from']);
$date_to = input_data($_POST['date_to']);
$shopID = input_data($_POST['shopID']);
?>
<!-- Main Container -->
<main id="main-container">
                <?php
                if(@$shopID == 'all') {

                  // $s = "SELECT *, a.cart_payment_token, b.credit_used, b.donation, date_format(a.created_date, '%d-%m-%Y') as purchased_date, date_format(a.created_date, '%H:%i') as purchased_time FROM tbl_salestransaction a INNER JOIN tbl_salescart b USING (cartID) WHERE (date(a.created_date) BETWEEN '".$date_from."' AND '".$date_to."') AND a.cart_status = 'COMPLETED' AND a.cartID = 'CRTMBUZ9QPHZJYTKBKXGTYU' ";
                  $s = "SELECT *, a.cart_payment_token, b.credit_used, b.donation, date_format(a.created_date, '%d-%m-%Y') as purchased_date, date_format(a.created_date, '%H:%i') as purchased_time FROM tbl_salestransaction a INNER JOIN tbl_salescart b USING (cartID) WHERE (date(a.created_date) BETWEEN '".$date_from."' AND '".$date_to."') AND a.cart_status = 'COMPLETED' ";
                }else{
                   $s = "SELECT *, a.cart_payment_token, b.credit_used, b.donation, date_format(a.created_date, '%d-%m-%Y') as purchased_date, date_format(a.created_date, '%H:%i') as purchased_time FROM tbl_salestransaction a INNER JOIN tbl_salescart b USING (cartID) WHERE (date(a.created_date) BETWEEN '".$date_from."' AND '".$date_to."') AND a.cart_status = 'COMPLETED' AND shopID = '".$shopID."'";
                }
                $h = mysqli_query($conn, $s);
                ?>
                            <table width=50% border="1" style="font-size:8pt" cellpadding=10>
                                <thead>
                                    <tr>
                                        <th>Shop Name</th>
                                        <th>Order No</th>
                                        <th>Date of Purchase</th>
                                        <th>Time of Purchase</th>
                                        <th>Order Status</th>
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
                                        <?php if(@$shopID == 'all') { ?><th>Donation</th><?php } ?>
                                        <th>Delivery Fee</th>
                                        <?php if(@$shopID == 'all') { ?><th>Discount</th><?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    while($row=mysqli_fetch_assoc($h)) {
                                        $s2 = "SELECT *, date_format(fulfilment_date, '%d-%m-%Y') as fulfilment_date, fulfilment_date FROM tbl_saleshop a INNER JOIN tbl_shop b USING (shopID) WHERE cartID = '".$row['cartID']."' AND  shopID = '".$row['shopID']."'";
                                        
                                        $h2 = mysqli_query($conn, $s2);
                                        $r2 = mysqli_fetch_assoc($h2);    
                                    ?>
                                    <tr>
                                        <td><?php echo $r2['shop_name'] ?></td>
                                        <td><?php echo $row['cart_payment_token'] ?></td>
                                        <td><?php echo $row['purchased_date'] ?></td>
                                        <td><?php echo $row['purchased_time'] ?></td>
                                        <td><?php echo $row['cart_status'] ?></td>
                                        <td><?php echo $r2['fulfilment_type'] ?></td>
                                        <td><?php echo $r2['fulfilment_date'] ?></td>
                                        <td><?php echo $r2['fulfilment_time'] ?></td>
                                        <td><?php echo $row['product_name'] ?></td>
                                        <td><?php echo $row['qty'] ?></td>
                                        <td>$<?php echo $row['price'] ?></td>
                                        <td><?php echo htmlentities($row['merchant_notes']) ?></td>
                                        <td>$<?php echo number_format((float)$row['qty']*$row['price'],2, '.', '') ?></td>
                                        <td><?php echo $row['cart_name'] ?></td>
                                        <td><?php echo $row ['cart_address'].' '.$row['cart_postalcode'] ?></td>
                                        <td><?php echo $row['cart_contact'] ?></td>
                                        <td><?php echo $row['cart_email'] ?></td>
                                        <td><?php echo $r2['fulfilment_remarks'] ?></td>
                                        <td><?php echo $r2['pickup_location'] ?></td>
                                        <td>$<?php echo number_format((float)$row['credit_used'],2, '.', '') ?></td>
                                        <td>$<?php echo number_format((float)$row['total_amount_payable'],2, '.', '') ?></td>
                                        <?php if(@$shopID == 'all') { ?><td>$<?php echo $row['donation'] ?></td><?php } ?>
                                        <td>$<?php echo $row['delivery_fee'] ?></td>
                                        <?php if(@$shopID == 'all') { ?><td>$<?php echo $row['voucher_amount'] ?></td><?php } ?>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>


</main>
<!-- END Main Container -->
<?php require_once 'footer.php' ?>