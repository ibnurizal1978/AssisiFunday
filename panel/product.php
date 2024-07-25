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
                $sql  = "SELECT *, a.order_index, a.active_status FROM tbl_product a INNER JOIN tbl_shop b USING (shop_id) WHERE shop_type <> 'DS' AND (delete_status IS NULL OR delete_status = 0)";
                $h = mysqli_query($conn, $sql);
                ?>
                <div class="block">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">Product Data</h3>
                        </div>
                        <div class="block-content block-content-full">
                            <!-- DataTables functionality is initialized with .js-dataTable-full-pagination class in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                            <table class="table table-bordered table-striped table-vcenter js-dataTable-full-pagination">
                                <thead>
                                    <tr>
                                        <th>Product Name</th>
                                        <th class="d-none d-sm-table-cell">Type</th>
                                        <th class="text-center" width="15%">Shop Name</th>
                                        <th class="text-center">Price</th>
                                        <th class="text-center">Quantity/Available</th>
                                        <th class="text-center" width="10%">Order Index</th>
                                        <th class="text-center" width="10%">Highlight</th>
                                        <th class="text-center d-none d-sm-table-cell" style="width: 8%;">Status</th>
                                        <th class="text-center" style="width: 18%;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    while($row=mysqli_fetch_assoc($h)) {

                                        $sql_qty = "SELECT sum(qty) as total FROM tbl_order_detail a INNER JOIN tbl_order b USING (order_code) WHERE product_id = '".$row['product_id']."' AND order_status = 'COMPLETED' LIMIT 1";
                                        $h_qty = mysqli_query($conn, $sql_qty);
                                        $row_qty = mysqli_fetch_assoc($h_qty);
                                        $avaiable = $row['total_quantity']-$row_qty['total'];
                                        //if($row_qty['total']==0) { $total =0; }else{ $total = $row_qty['total']; }
                                        if($row['total_quantity']==0) { $total_quantity =0; }else{ $total_quantity = $row['total_quantity']; }
                                    ?>
                                    <tr>
                                        <td class="font-w600"><?php echo $row['product_name'] ?></td>
                                        <td class="d-none d-sm-table-cell"><?php echo $row['product_type'] ?></td>
                                        <td class="text-center"><?php echo $row['shop_name'] ?></td>
                                        <td class="text-center"><?php echo $row['price'] ?></td>
                                        <td class="text-center"><?php echo $total_quantity ?>/<?php echo $avaiable ?></td>
                                        <td class="text-center"><?php echo $row['order_index'] ?></td>
                                        <td class="text-center"><?php if($row['highlight_status']==1) { ?><span class="badge badge-success">Yes</span><?php }else{ ?><span class="badge badge-danger">No</span><?php } ?></td>
                                        <td class="text-center d-none d-sm-table-cell"><?php if($row['active_status']==1) { ?><span class="badge badge-success">Active</span><?php }else{ ?><span class="badge badge-danger">Disabled</span><?php } ?></td>
                                        <td class="text-center"><a href="product_detail?<?php echo Encryption::encode($row["product_id"]) ?>">Update</a> | <a href="product_disable?<?php echo Encryption::encode($row["product_id"]) ?>"><?php if($row['active_status']==1) { ?>Disabled<?php }else{ ?>Enable<?php } ?></a> | <a href="product_delete?<?php echo Encryption::encode($row["product_id"]) ?>">Delete</a>
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
