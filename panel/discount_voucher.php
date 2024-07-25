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
                $sql  = "SELECT * FROM tbl_discount_voucher";
                $h = mysqli_query($conn, $sql);
                //INSERT INTO tbl_discountvoucher SET voucherID = 'VCR6785203967699984581598024122', voucherCode = '5RTZW3N8', voucherValue = 2, voucherName = '$2 Voucher', max_qty=50, createdDateTime = now(), status = 1, modifiedDateTime = now()
                ?>
                <div class="block">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">Discount Voucher Data</h3>
                        </div>
                        <div class="block-content block-content-full">
                            <!-- DataTables functionality is initialized with .js-dataTable-full-pagination class in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                            <table class="table table-bordered table-striped table-vcenter js-dataTable-full-pagination">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th class="d-none d-sm-table-cell">Voucher Code</th>
                                        <th>Discount Amount</th>
                                        <th class="d-none d-sm-table-cell" style="width: 15%;">Max Quantity</th>
                                        <th class="d-none d-sm-table-cell" style="width: 15%;">Used Quantity</th>
                                        <th class="text-center" style="width: 15%;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while($row=mysqli_fetch_assoc($h)) { ?>
                                    <tr>
                                        <td class="font-w600"><?php echo $row['discount_voucher_id'] ?></td>
                                        <td class="d-none d-sm-table-cell"><?php echo $row['code'] ?></td>
                                        <td class="d-none d-sm-table-cell">$<?php echo $row['value'] ?></td>
                                        <td class="d-none d-sm-table-cell"><?php echo $row['max_qty'] ?></td>
                                        <td class="d-none d-sm-table-cell"><?php echo $row['used_qty'] ?></td>
                                        <td class="text-center">
                                          <?php if($row['max_qty']>1) { ?>
                                            <a href="discount_voucher_detail?<?php echo Encryption::encode($row["discount_voucher_id"]) ?>">Update</a>
                                          <?php } ?>
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
