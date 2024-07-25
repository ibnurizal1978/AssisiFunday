<?php
require_once 'header.php';
?>
<link rel="stylesheet" href="../assets/js/plugins/datatables/dataTables.bootstrap4.css">

<!-- Side Overlay-->
<aside id="side-overlay">
    <!-- Side Overlay Scroll Container -->
    <div id="side-overlay-scroll">
        <!-- Side Header -->
        <div class="content-header content-header-fullrow">
            <div class="content-header-section align-parent">
                <button type="button" class="btn btn-circle btn-dual-secondary align-v-r" data-toggle="layout" data-action="side_overlay_close">
                    <i class="fa fa-times text-danger"></i>
                </button>

                <div class="content-header-item">
                    <a class="align-middle link-effect text-primary-dark font-w600" href="#">Filter</a>
                </div>
                <!-- END User Info -->
            </div>
        </div>
        <!-- END Side filter -->

        <!-- side kanan -->
        <div class="content-side">
            <!-- Search -->
            <div class="block pull-t pull-r-l">
                <div class="block-content block-content-full block-content-sm bg-body-light">
                    <form action="<?php echo $file.$ext ?>" method="GET">
                        <input type="hidden" name="s" value="1091vdf8ame151">
                        <input type="hidden" name="partner_key" value="<?php echo $partner_key ?>">
                        <div class="input-group">
                            <input type="text" class="form-control" id="side-overlay-search" name="txt_search" placeholder="Search..">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-secondary px-10">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- END Search -->

            <!-- Display ledger type -->
            <div class="block pull-r-l">
                <div class="block-header bg-body-light">
                    <h3 class="block-title">
                        <i class="fa fa-fw fa-pencil font-size-default mr-5"></i>View by Date
                    </h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"></button>
                    </div>
                </div>
                <div class="block-content">
                    <form action="<?php echo $file.$ext ?>" method="post">
                        <input type="hidden" name="s" value="1">
                        <input type="hidden" name="partner_key" value="<?php echo $partner_key ?>" />
                        <div class="form-group mb-15">
                            <div class="form-material floating">
                                <input type="text" class="form-control" id="created_date" name="created_date" />
                                <label for="material-select2">Input date (dd/mm/yyyy)</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-6">
                                <button type="submit" class="btn btn-block btn-alt-primary">
                                    <i class="fa fa-refresh mr-5"></i> View
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- END Display ledger type -->


        </div>
        <!-- END Side filter -->
    </div>
    <!-- END Side Overlay Scroll Container -->
</aside>
<!-- END Side Overlay -->

<!-- Main Container -->
<main id="main-container">
    <!-- Page Content -->
    <div class="content">

        <div class="block table-responsive">
            <div class="block-content">
                <?php
                $sql  = "SELECT * FROM tbl_product a INNER JOIN tbl_shop b USING (shop_id) WHERE shop_type = 'DS' AND (delete_status IS NULL OR delete_status = 0)";
                $h = mysqli_query($conn, $sql);
                ?>
                <div class="block">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">Daily Special Data</h3>
                        </div>
                        <div class="block-content block-content-full">
                            <!-- DataTables functionality is initialized with .js-dataTable-full-pagination class in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                            <table class="table table-bordered table-striped table-vcenter js-dataTable-full-pagination">
                                <thead>
                                    <tr>
                                        <th>Product Name</th>
                                        <th class="d-none d-sm-table-cell">Type</th>
                                        <th class="text-center">Shop Name</th>
                                        <th class="text-center">Price</th>
                                        <th class="text-center">Quantity/Available</th>
                                        <th class="text-center">Order Index</th>
                                        <th class="d-none d-sm-table-cell" style="width: 10%;">Status</th>
                                        <th class="text-center" style="width: 18%;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    while($row=mysqli_fetch_assoc($h)) {

                                        $sql_qty = "SELECT sum(qty) as total FROM tbl_order_detail WHERE product_id = '".$row['product_id']."' LIMIT 1";
                                        $h_qty = mysqli_query($conn, $sql_qty);
                                        $row_qty = mysqli_fetch_assoc($h_qty);
                                        $avaiable = $row['total_quantity']-$row_qty['total'];
                                        //if($row_qty['total']==0) { $total =0; }else{ $total = $row_qty['total']; }
                                        if($row['total_quantity']==0) { $total_quantity =0; }else{ $total_quantity = $row['total_quantity']; }

                                        /*if($row['evoucherID'] <> 'EVCH2110070249091093576284615E6025E4BDD') {
                                            $sql1 = "SELECT count(evoucherID) as total FROM tbl_evoucher_detail WHERE evoucherID = '".$row['evoucherID']."' AND used_status = 0 LIMIT 1";
                                        }else{
                                            $sql1 = "SELECT count(evoucher_code) as total FROM tbl_foodpanda WHERE used_status = 1 LIMIT 1";
                                        }
                                        $h1 = mysqli_query($conn, $sql1);
                                        $row1 = mysqli_fetch_assoc($h1);
                                        echo $row1['total'];*/
                                    ?>
                                    <tr>
                                        <td class="font-w600"><?php echo $row['product_name'] ?></td>
                                        <td class="d-none d-sm-table-cell"><?php echo $row['product_type'] ?></td>
                                        <td class="text-center"><?php echo $row['shop_name'] ?></td>
                                        <td class="text-center"><?php echo $row['price'] ?></td>
                                        <td class="text-center"><?php echo $total_quantity ?>/<?php echo $avaiable ?></td>
                                        <td class="text-center"><?php echo $row['order_index'] ?></td>
                                        <td class="d-none d-sm-table-cell"><?php if($row['active_status']==1) { ?><span class="badge badge-success">Active</span><?php }else{ ?><span class="badge badge-danger">Disabled</span><?php } ?></td>
                                        <td class="text-center"><a href="daily_special_detail?<?php echo Encryption::encode($row["shop_id"]) ?>">Update</a> | <a href="shop_disable?<?php echo Encryption::encode($row["shop_id"]) ?>"><?php if($row['active_status']==1) { ?>Disabled<?php }else{ ?>Enable<?php } ?></a> | <a href="product_delete?<?php echo Encryption::encode($row["product_id"]) ?>">Delete</a> | <a href="shop_outlet?<?php echo Encryption::encode($row["shop_id"]) ?>">Outlet</a>
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
