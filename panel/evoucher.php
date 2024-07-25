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
                $sql  = "SELECT * FROM tbl_evoucher a INNER JOIN tbl_product b USING (product_id)";
                $h = mysqli_query($conn, $sql);
                ?>
                <div class="block">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">Evoucher Data</h3>
                        </div>
                        <div class="block-content block-content-full">
                            <!-- DataTables functionality is initialized with .js-dataTable-full-pagination class in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                            <table class="table table-bordered table-striped table-vcenter js-dataTable-full-pagination">
                                <thead>
                                    <tr>
                                        <th>Product Name</th>
                                        <th class="d-none d-sm-table-cell">Shop Name</th>
                                        <th>Created Count</th>
                                        <th class="d-none d-sm-table-cell" style="width: 15%;">Claimed Count</th>
                                        <th class="d-none d-sm-table-cell" style="width: 15%;">Max qty</th>
                                        <th class="text-center" style="width: 15%;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while($row=mysqli_fetch_assoc($h)) { ?>
                                    <tr>
                                        <td class="font-w600"><?php echo $row['product_name'] ?></td>
                                        <td class="d-none d-sm-table-cell"><?php echo $row['shop_name'] ?></td>
                                        <td>
                                            <?php
                                            $sql1 = "SELECT count(evoucher_list_id) as total FROM tbl_evoucher_list WHERE evoucher_id = '".$row['evoucher_id']."' LIMIT 1";
                                            $h1 = mysqli_query($conn, $sql1);
                                            $row1 = mysqli_fetch_assoc($h1);
                                            echo $row1['total'];
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            $sql1 = "SELECT count(evoucher_list_id) as total FROM tbl_evoucher_list WHERE evoucher_id = '".$row['evoucher_id']."' AND user_id <> '' AND used_status = 1 LIMIT 1";
                                            $h1 = mysqli_query($conn, $sql1);
                                            $row1 = mysqli_fetch_assoc($h1);
                                            echo $row1['total'];
                                            ?>
                                        </td>
                                        <td class="d-none d-sm-table-cell"><?php echo $row['total_quantity'] ?></td>
                                        <td class="text-center"><a href="evoucher_detail?<?php echo Encryption::encode($row["evoucher_id"]) ?>">Update</a> | <a href="evoucher_list?<?php echo Encryption::encode($row["evoucher_id"]) ?>">List</a> | <a href="evoucher_preview?<?php echo Encryption::encode($row["evoucher_id"]) ?>">Preview</a>
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
