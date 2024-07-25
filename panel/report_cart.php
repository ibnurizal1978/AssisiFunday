<?php 
require_once 'header.php';
$date_from = input_data($_POST['date_from']);
$date_to = input_data($_POST['date_to']);
?>

<!-- Main Container -->
<main id="main-container">
    <!-- Page Content -->
    <div class="content">
    
        <div class="block table-responsive">
            <div class="block-content">
                <?php
                $sql  = "SELECT *, date_format(c.created_date, '%d-%m-%Y') as purchase_date FROM tbl_salescart a INNER JOIN tbl_saleshop b USING (cartID) INNER JOIN tbl_salestransaction c USING (shopID) INNER JOIN tbl_shop d ON b.shopID = d.shopID ORDER BY c.created_date DESC";
                $h = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                ?>
                <div class="block">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">Sales Transaction</h3>
                        </div>
                        <div class="block-content block-content-full">
                            <!-- DataTables functionality is initialized with .js-dataTable-full-pagination class in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                            <table class="table table-bordered table-striped table-vcenter js-dataTable-full-pagination">
                                <thead>
                                    <tr style="font-size: 8pt;">
                                        <th>Cart No.</th>
                                        <th>Shop Name</th>
                                        <th>Order No.</th>
                                        <th>Date of Purchase</th>
                                        <th>Fufilment Type</th>
                                        <th>Date of Delivery/Pickup</th>
                                        <th>Time Slot for Delivery/Pickup</th>
                                        <th>Product Name</th>
                                        <th>Unit Price</th>
                                        <th>Product Total Qty</th>
                                        <th>Product Price</th>
                                        <th>Special Instruction</th>
                                        <th>Total Price</th>
                                        <th>Customer Name</th>
                                        <th>Address</th>
                                        <th>Mobile Number</th>
                                        <th>Delivery Remarks</th>
                                        <th>Delivery Fee</th>
                                        <th>Discount</th>
                                        <th>Subtotal</th>
                                        <th>Voucher Used</th>
                                        <th>Credit Used</th>
                                        <th>Total Amount</th>
                                        <th>Round up Donation</th>
                                        <th>Total Amount Paid</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while($row=mysqli_fetch_assoc($h)) { ?>
                                    <tr style="font-size: 8pt;">
                                        <td><?php echo $row['cartID'] ?></td>
                                        <td><?php echo $row['shop_name'] ?></td>
                                        <td><?php echo $row['cart_payment_token'] ?></td>
                                        <td><?php echo $row['purchase_date'] ?></td>
                                        <td><?php echo $row['fulfilment_type'] ?></td>
                                        <td><?php echo $row['fulfilment_date'] ?></td>
                                        <td><?php echo $row['fulfilment_time'] ?></td>
                                        <td><?php echo $row['product_name'] ?></td>
                                        <td>$<?php echo $row['price'] ?></td>
                                        <td><?php echo $row['qty'] ?></td>
                                        <td>$<?php echo $row['price'] ?></td>
                                        <td><?php echo $row['special_instruction'] ?></td>
                                        <td>$<?php echo $row['subtotal'] ?></td>
                                        <td><?php echo $row['cart_name'] ?></td>
                                        <td><?php echo $row['cart_address'] ?></td>
                                        <td><?php echo $row['cart_contact'] ?></td>
                                        <td><?php echo $row['fulfilment_remarks'] ?></td>
                                        <td>$<?php echo $row['delivery_fee'] ?></td>
                                        <td>$<?php echo $row['voucher_amount'] ?></td>
                                        <td>$<?php echo $row['subtotal'] ?></td>
                                        <td>$<?php echo $row['credit_used'] ?></td>
                                        <td>$<?php echo $row['subtotal'] ?></td>
                                        <td>$<?php echo $row['donation'] ?></td>
                                        <td>$<?php echo $row['credit_used'] ?></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>




    </div>
    <!-- END Page Content -->
</main>
<!-- END Main Container -->
<?php require_once 'footer.php' ?>

        <!-- Page JS Plugins -->
        <script src="../assets/js/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="../assets/js/plugins/datatables/dataTables.bootstrap4.min.js"></script>

        <!-- Page JS Code -->
        <script src="../assets/js/pages/be_tables_datatables.min.js"></script>