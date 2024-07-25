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
                $sql  = "SELECT * FROM tbl_shop WHERE shop_type ='SHOP' ORDER BY shop_name";
                $h = mysqli_query($conn, $sql);
                ?>
                <div class="block">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">Shop Data</h3>
                        </div>
                        <div class="block-content block-content-full">
                            <!-- DataTables functionality is initialized with .js-dataTable-full-pagination class in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                            <table class="table table-bordered table-striped table-vcenter js-dataTable-full-pagination">
                                <thead>
                                    <tr>
                                        <th>Shop Name</th>
                                        <!--<th class="d-none d-sm-table-cell">Main Category</th>-->
                                        <th class="text-center">Fufilment</th>
                                        <th class="d-none d-sm-table-cell" style="width: 15%;">Is Halal?</th>
                                        <th class="d-none d-sm-table-cell" style="width: 15%;">Status</th>
                                        <th class="text-center" style="width: 15%;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while($row=mysqli_fetch_assoc($h)) { ?>
                                    <tr>
                                        <td class="font-w600"><?php echo $row['shop_name'] ?></td>
                                        <!--<td class="d-none d-sm-table-cell"><?php echo $row['category_id'] ?></td>-->
                                        <td class="text-center"><?php echo $row['fufilment_type_option'] ?></td>
                                        <td class="d-none d-sm-table-cell"><?php if($row['is_halal']==1) { ?><span class="badge badge-success">Yes</span><?php }else{ ?><span class="badge badge-danger">No</span><?php } ?></td>
                                        <td class="d-none d-sm-table-cell"><?php if($row['active_status']==1) { ?><span class="badge badge-success">Active</span><?php }else{ ?><span class="badge badge-danger">Disabled</span><?php } ?></td>
                                        <td class="text-center"><a href="shop_detail?<?php echo Encryption::encode($row["shop_id"]) ?>">Update</a> | <a href="shop_disable?<?php echo Encryption::encode($row["shop_id"]) ?>"><?php if($row['active_status']==1) { ?>Disabled<?php }else{ ?>Enable<?php } ?></a> | <a href="shop_outlet?<?php echo Encryption::encode($row["shop_id"]) ?>">Outlet</a>
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
