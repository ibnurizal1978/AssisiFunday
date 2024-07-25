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
                if($shopID == 'all') {
                   // $sql  = "SELECT c.shop_name, a.voucher_amount, d.cart_payment_token, date_format(d.created_date, '%d-%m-%Y') as purchased_date, date_format(d.created_date, '%H:%i') as purchased_time, d.cart_status, b.fulfilment_type, d.product_name, d.price, d.qty, d.subtotal, a.cart_name, a.cart_address, a.cart_postalcode, a.cart_contact, a.cart_email, d.fulfilment_remarks, a.delivery_fee, d.special_instruction, date_format(b.fulfilment_date, '%d-%m-%Y') as fulfilment_date, b.fulfilment_time, a.donation FROM  tbl_salescart a INNER JOIN tbl_saleshop b USING (CartID) INNER JOIN tbl_shop c USING (shopID) INNER JOIN tbl_salestransaction d USING (shopID) WHERE (date(d.created_date) BETWEEN '".$date_from."' AND '".$date_to."') AND d.cart_status = 'COMPLETED'";

                    $sql = "SELECT d.trans_id, d.shopID, d.cartID, c.shop_name, a.voucher_amount, d.cart_payment_token as order_no, date_format(d.created_date, '%d-%m-%Y') as purchased_date, date_format(d.created_date, '%H:%i') as purchased_time, d.cart_status, d.product_name, d.price, d.qty, d.subtotal, a.cart_name, a.cart_address, a.cart_postalcode, a.cart_contact, a.cart_email, d.fulfilment_remarks, a.delivery_fee, d.special_instruction, a.donation, d.merchant_notes, a.credit_used, a.total_amount_payable FROM tbl_salescart a INNER JOIN tbl_salestransaction d USING (cartID) INNER JOIN tbl_shop c USING (shopID) WHERE (date(d.created_date) BETWEEN '".$date_from."' AND '".$date_to."') AND d.cart_status = 'COMPLETED' ORDER BY purchased_date DESC, purchased_time DESC";

                }else{
                    $sql = "SELECT d.trans_id, d.shopID, d.cartID, c.shop_name, a.voucher_amount, d.cart_payment_token as order_no, date_format(d.created_date, '%d-%m-%Y') as purchased_date, date_format(d.created_date, '%H:%i') as purchased_time, d.cart_status, d.product_name, d.price, d.qty, d.subtotal, a.cart_name, a.cart_address, a.cart_postalcode, a.cart_contact, a.cart_email, d.fulfilment_remarks, a.delivery_fee, d.special_instruction, a.donation, d.merchant_notes, a.credit_used, a.total_amount_payable FROM tbl_salescart a INNER JOIN tbl_salestransaction d USING (cartID) INNER JOIN tbl_shop c USING (shopID) WHERE (date(d.created_date) BETWEEN '".$date_from."' AND '".$date_to."') AND d.cart_status = 'COMPLETED' AND shopID = '".$shopID."'  ORDER BY purchased_date DESC, purchased_time DESC";

                   // $sql  = "SELECT d.trans_id, d.shopID, d.cartID, c.shop_name, a.voucher_amount, d.cart_payment_token as order_no, date_format(d.created_date, '%d-%m-%Y') as purchased_date, date_format(d.created_date, '%H:%i') as purchased_time, d.cart_status, b.fulfilment_type, d.product_name, d.price, d.qty, d.subtotal, a.cart_name, a.cart_address, a.cart_postalcode, a.cart_contact, a.cart_email, d.fulfilment_remarks, a.delivery_fee, d.special_instruction, date_format(b.fulfilment_date, '%d-%m-%Y') as fulfilment_date, b.fulfilment_time, a.donation FROM  tbl_salescart a INNER JOIN tbl_saleshop b USING (CartID) INNER JOIN tbl_shop c USING (shopID) INNER JOIN tbl_salestransaction d USING (shopID) WHERE (date(d.created_date) BETWEEN '".$date_from."' AND '".$date_to."') AND shopID = '".$shopID."' AND d.cart_status = 'COMPLETED' ORDER BY purchased_date DESC, purchased_time DESC";

                    //$sql  = "SELECT c.shop_name, a.voucher_amount, d.cart_payment_token, date_format(d.created_date, '%d-%m-%Y') as purchased_date, date_format(d.created_date, '%H:%i') as purchased_time, d.cart_status, b.fulfilment_type, d.product_name, d.price, d.qty, d.subtotal, a.cart_name, a.cart_address, a.cart_postalcode, a.cart_contact, a.cart_email, d.fulfilment_remarks, a.delivery_fee, d.special_instruction, date_format(b.fulfilment_date, '%d-%m-%Y') as fulfilment_date, b.fulfilment_time FROM  tbl_salescart a INNER JOIN tbl_saleshop b USING (CartID) INNER JOIN tbl_shop c USING (shopID) INNER JOIN tbl_salestransaction d USING (shopID) WHERE (date(d.created_date) BETWEEN '".$date_from."' AND '".$date_to."') AND shopID = '".$shopID."' AND d.cart_status = 'COMPLETED'";    
                }
                echo $sql;
                $h = mysqli_query($conn, $sql);
                ?>
                            <!-- DataTables functionality is initialized with .js-dataTable-full-pagination class in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                            <table width=100% border="1" style="font-size:8pt" cellpadding=10>
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
                                        <?php if($shopID == 'all') { ?><th>Donation</th><?php } ?>
                                        <th>Delivery Fee</th>
                                        <?php if($shopID == 'all') { ?><th>Discount</th><?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    while($row=mysqli_fetch_assoc($h)) { 
                                    $s2 = "SELECT *, date_format(fulfilment_date, '%d-%m-%Y') as fulfilment_date, fulfilment_date FROM tbl_saleshop WHERE cartID = '".$row['cartID']."' LIMIT 1";
                                    $h2 = mysqli_query($conn, $s2);
                                    $r2 = mysqli_fetch_assoc($h2);    
                                    ?>
                                    <tr>
                                        <td><?php echo $row['cartID'] ?></td>
                                        <td><?php echo $row['order_no'] ?></td>
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
                                        <td>$<?php echo $row['qty']*$row['price']; //$row['price'] ?></td>
                                        <td><?php echo $row['cart_name'] ?></td>
                                        <td><?php echo $row['cart_address'].' '.$row['cart_postalcode'] ?></td>
                                        <td><?php echo $row['cart_contact'] ?></td>
                                        <td><?php echo $row['cart_email'] ?></td>
                                        <td><?php echo $r2['fulfilment_remarks'] ?></td>
                                        <td><?php echo $r2['pickup_location'] ?></td>
                                        <td>$<?php echo number_format((float)$row['credit_used'],2, '.', '') ?></td>
                                        <td>$<?php echo number_format((float)$row['total_amount_payable'],2, '.', '') ?></td>
                                        <?php if($shopID == 'all') { ?><td>$<?php echo $row['donation'] ?></td><?php } ?>
                                        <td>$<?php echo $row['delivery_fee'] ?></td>
                                        <?php if($shopID == 'all') { ?><td>$<?php echo $row['voucher_amount'] ?></td><?php } ?>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>


</main>
<!-- END Main Container -->
<?php require_once 'footer.php' ?>