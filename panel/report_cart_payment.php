<?php 
require_once 'header.php';
?>
<!-- Main Container -->
                <?php
                $sql  = "SELECT * FROM tbl_salespayment a INNER JOIN tbl_users b ON a.user_id = b.userID ORDER BY created_date DESC";
                $h = mysqli_query($conn, $sql);
                ?>
                            <!-- DataTables functionality is initialized with .js-dataTable-full-pagination class in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                            <table width=100% border="1" style="font-size:8pt" cellpadding=10>
                                <thead>
                                    <tr>
                                        <th>Description</th>
                                        <th>UserID</th>
                                        <th>Name</th>
                                        <th>Credit</th>
                                        <th>Debet</th>
                                        <th>Amount</th>
                                        <th>Trx Status</th>
                                        <th>Card Holder</th>
                                        <th>RC</th>
                                        <th>Ref No</th>
                                        <th>Receipt No</th>
                                        <th>Response Msg</th>
                                        <th>Total Amount</th>
                                        <th>Trx id</th>
                                        <th>TranID</th>
                                        <th>Created date</th>
                                        <th>CartID</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while($row=mysqli_fetch_assoc($h)) { ?>
                                    <tr>
                                        <td><?php echo $row['description'] ?></td>
                                        <td><?php echo $row['user_id'] ?></td>
                                        <td><?php echo $row['firstName'].' '.$row['lastName'] ?></td>
                                        <td><?php echo $row['credit'] ?></td>
                                        <td><?php echo $row['debet'] ?></td>
                                        <td><?php echo $row['amount'] ?></td>
                                        <td><?php echo $row['trx_status'] ?></td>
                                        <td><?php echo $row['cardHolderName'] ?></td>
                                        <td><?php echo $row['responseCode'] ?></td>
                                        <td><?php echo $row['referenceNo'] ?></td>
                                        <td><?php echo $row['receiptNumber'] ?></td>
                                        <td><?php echo $row['responseMsg'] ?></td>
                                        <td><?php echo $row['totalAmount'] ?></td>
                                        <td><?php echo $row['transactionId'] ?></td>
                                        <td><?php echo $row['tranId'] ?></td>
                                        <td><?php echo $row['created_date'] ?></td>
                                        <td><?php echo $row['cartID'] ?></td>
                                        <td></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>


<!-- END Main Container -->
<?php require_once 'footer.php' ?>