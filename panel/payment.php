<?php
require_once 'header.php';
?>
<link rel="stylesheet" href="../assets/js/plugins/datatables/dataTables.bootstrap4.css">

<!-- Main Container -->
<main id="main-container">
    <!-- Page Content -->
    <div class="content">
        <div class="block table-responsive">
            <div class="block-content">
            <?php
                $sql  = "SELECT a.order_code, a.order_status, a.delivery_fee, a.donation, sum(sub_total) as total FROM tbl_order a INNER JOIN tbl_order_detail b USING (order_code) GROUP BY a.order_code ORDER BY a.updated_at DESC";
                $h = mysqli_query($conn, $sql);
                ?>
                <div class="block">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Purchase Payment Data</h3>
                    </div>
                    <div class="block-content block-content-full">
                        <!-- DataTables functionality is initialized with .js-dataTable-full-pagination class in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                        <table class="table table-bordered table-striped table-vcenter js-dataTable-full-pagination">
                            <thead>
                                <tr>
                                    <th class="d-sm-table-cell" style="width: 8%;">Order Code</th>
                                    <th class="d-sm-table-cell" style="width: 8%;">Order Status</th>
                                    <th class="d-sm-table-cell" style="width: 15%;">RDP Status</th>
                                    <th class="d-sm-table-cell" style="width: 15%;">Deposit Status</th>
                                    <th class="d-sm-table-cell" style="width: 15%;">Individual DV</th>
                                    <th class="d-sm-table-cell" style="width: 15%;">Mass DV</th>
                                    <th class="text-center" style="width: 15%;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while($row=mysqli_fetch_assoc($h)) { ?>
                                <tr>
                                    <td class="font-w300"><?php echo '<b>'.$row['order_code'].'</b><br/><small>Sub total: $'.$row['total'].'</small><br/><small>Delivery: $'.$row['delivery_fee'].'</small><br/><small>Donation: $'.$row['donation'].'</small>' ?></td>
                                    <td class="d-sm-table-cell"><?php echo $row['order_status'] ?></td>
                                    <td class="d-sm-table-cell">
                                      <?php
                                      $s2 = "SELECT response_code, response_msg FROM tbl_log_payment_result WHERE order_code = '".$row['order_code']."' LIMIT 1";
                                      $h2 = mysqli_query($conn, $s2);
                                      if(mysqli_num_rows($h2) >0) {
                                        $r2 = mysqli_fetch_assoc($h2);
                                        echo 'RC: '.$r2['response_code'].'<br/>Msg: '.$r2['response_msg'];
                                      }else{
                                        echo '<font color=silver>no payment log from RDP</font>';
                                      }
                                      ?>
                                    </td>
                                    <td class="d-sm-table-cell">
                                      <?php
                                      $s3 = "SELECT trx_status, totalAmount FROM tbl_ledger WHERE order_code = '".$row['order_code']."' LIMIT 1";
                                      $h3 = mysqli_query($conn, $s3);
                                      if(mysqli_num_rows($h3) >0) {
                                        $r3 = mysqli_fetch_assoc($h3);
                                        echo 'Status: '.$r3['trx_status'].'<br/>Amount: '.$r3['totalAmount'];
                                      }else{
                                        echo '<font color=silver>no payment using deposit</font>';
                                      }
                                      ?>
                                    </td>
                                    <td class="d-sm-table-cell">
                                      <?php
                                      $s4 = "SELECT code, order_code FROM tbl_discount_voucher WHERE order_code = '".$row['order_code']."' LIMIT 1";
                                      $h4 = mysqli_query($conn, $s4);
                                      if(mysqli_num_rows($h4) >0) {
                                        $r4 = mysqli_fetch_assoc($h4);
                                        echo 'DV Code: '.$r4['code'];
                                      }else{
                                        echo '<font color=silver>no individual DV used</font>';
                                      }
                                      ?>
                                    </td>
                                    <td class="d-sm-table-cell">
                                      <?php
                                      $s5 = "SELECT code, order_code FROM tbl_discount_voucher_log WHERE order_code = '".$row['order_code']."' LIMIT 1";
                                      $h5 = mysqli_query($conn, $s5);
                                      if(mysqli_num_rows($h5) >0) {
                                        $r5 = mysqli_fetch_assoc($h5);
                                        echo 'DV Code: '.$r5['code'];
                                      }else{
                                        echo '<font color=silver>no mass DV used</font>';
                                      }
                                      ?>
                                    </td>
                                    <td class="text-center">s
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
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
