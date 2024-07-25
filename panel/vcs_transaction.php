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
                $s = "SELECT evoucher_code, used_status, order_code, date_format(used_date, '%M %d, %Y') as used_date, date_format(used_date, '%H:%i') as used_time FROM tbl_evoucher_list WHERE shop_id = '".$_SESSION['shop_id']."' order by used_status DESC";
                $h = mysqli_query($conn, $s);
                ?>
                <div class="block">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">VCS Transaction</h3>
                        </div>
                        <div class="block-content block-content-full">
                            <!-- DataTables functionality is initialized with .js-dataTable-full-pagination class in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                            <table class="table table-bordered table-striped table-vcenter js-dataTable-full-pagination">
                                <thead>
                                    <tr>
                                        <th>Order No</th>
                                        <th>Voucher Code</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    while($r=mysqli_fetch_assoc($h)) {

                                        $s2 = "SELECT * FROM tbl_order_detail WHERE order_code = '".$r['order_code']."' LIMIT 1";
                                        $h2 = mysqli_query($conn, $s2);
                                        $r2 = mysqli_fetch_assoc($h2);
                                    ?>
                                    <tr>
                                        <td class="font-w600"><?php echo @$r2['order_code'] ?></td>
                                        <td><?php echo $r['evoucher_code'] ?></td>
                                        <td><?php if($r['used_status'] == 0) { echo 'active'; }else{ echo 'used'; } ?></td>
                                        <td><?php echo $r['used_date'] ?></td>
                                        <td><?php echo $r['used_time'] ?></td>
                                    </td>
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
