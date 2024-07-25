<?php
require_once 'header.php';
ini_set('display_errors',0);  error_reporting(E_ALL);
?>
<link rel="stylesheet" href="../assets/js/plugins/datatables/dataTables.bootstrap4.css">
<script>
$(document).ready(function() {
    $('#dataTable').DataTable( {
        order: [[ 3, 'desc' ]]
    } );
});
</script>
<!-- Main Container -->
<main id="main-container">
    <!-- Page Content -->
    <div class="content">

        <div class="block table-responsive">
            <div class="block-content">
                <?php
                 if($_SESSION['roleID']==1) {
                   $s = "select order_code, shop_id, shop_name, full_name, date_format(a.updated_at, '%Y-%m-%d %H:%i') as updated_at FROM tbl_order_shop a INNER JOIN tbl_order b USING (order_code) WHERE order_status = 'COMPLETED'";
                    //$s = "SELECT *, a.order_code as order_code, date_format(a.updated_at, '%Y-%m-%d %H:%i') as updated_at FROM tbl_order a INNER JOIN tbl_order_shop b USING (order_code) INNER JOIN tbl_order_detail c ON b.shop_id = c.shop_id WHERE a.order_status = 'COMPLETED' GROUP BY b.shop_id ORDER BY a.updated_at DESC";
                 }else{
                   $s = "SELECT *, a.order_code as order_code, date_format(a.updated_at, '%Y-%m-%d %H:%i') as updated_at FROM tbl_order a INNER JOIN tbl_order_shop b USING (order_code) INNER JOIN tbl_order_detail c ON b.shop_id = c.shop_id WHERE b.shop_id = '".$_SESSION['shop_id']."' AND a.order_status = 'COMPLETED' GROUP BY a.order_code ORDER BY a.updated_at DESC";
                 }
                $h = mysqli_query($conn, $s);
                ?>
                <div class="block">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">Sales Transaction</h3>
                        </div>
                        <div class="block-content block-content-full">
                            <!-- DataTables functionality is initialized with .js-dataTable-full-pagination class in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->

                            <?php if($_SESSION['roleID']==1) { ?>
                            <table class="table table-bordered table-striped table-vcenter js-dataTable-full-pagination" id="dataTable">
                                <thead>
                                    <tr>
                                        <th>OrderNo</th>
                                        <th class="d-none d-sm-table-cell">Shop Name</th>
                                        <th>Customer Name</th>
                                        <th class="sorting_1" style="width: 15%;"><span style="display:none;"><?php echo  $row['sort'] ?></span>Date/time of Purchase</th>
                                        <th class="d-none d-sm-table-cell" style="width: 15%;">Total Price</th>
                                        <th class="text-center" style="width: 15%;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while($row=mysqli_fetch_assoc($h)) { ?>
                                    <tr>
                                        <td class="font-w600"><?php echo $row['order_code'] ?></td>
                                        <td class="d-none d-sm-table-cell"><?php echo $row['shop_name'] ?></td>
                                        <td class="d-none d-sm-table-cell"><?php echo $row['full_name'] ?></td>
                                        <td class="sorting_1"><span style="display:none;"><?php echo  $row['sort'] ?></span><?php echo  $row['updated_at'] ?></td>
                                        <td>$
                                          <?php
                                          $s2 = "SELECT sum(sub_total) as total FROM tbl_order_detail WHERE order_code = '".$row['order_code']."' AND shop_id = '".$row['shop_id']."'";
                                          $h2 = mysqli_query($conn, $s2);
                                          $r2 = mysqli_fetch_assoc($h2);
                                          echo $r2['total'];
                                          ?>
                                        </td>
                                        <td class="text-center"><a href="sales_detail?<?php echo Encryption::encode($row["order_code"]) ?>?<?php echo Encryption::encode($row["shop_id"]) ?>">Details</a></a>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>

                            <?php }else{ ?>

                            <table class="table table-bordered table-striped table-vcenter js-dataTable-full-pagination">
                                <thead>
                                    <tr>
                                        <th>OrderNo</th>
                                        <th class="d-none d-sm-table-cell">Type</th>
                                        <th>Customer Name</th>
                                        <th class="d-none d-sm-table-cell" style="width: 15%;">Date/time of Purchase</th>
                                        <th class="d-none d-sm-table-cell" style="width: 15%;">Remarks</th>
                                        <th class="text-center" style="width: 15%;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while($row=mysqli_fetch_assoc($h)) { ?>
                                    <tr>
                                        <td class="font-w600"><?php echo $row['order_code'] ?></td>
                                        <td class="d-none d-sm-table-cell"><?php echo $row['fufillment_type'] ?></td>
                                        <td class="d-none d-sm-table-cell"><?php echo $row['full_name'] ?></td>
                                        <td><?php echo $row['updated_at'] ?></td>
                                        <td><?php echo $row['fufillment_remarks'] ?></td>
                                        <td class="text-center"><a href="sales_detail?<?php echo Encryption::encode($row["order_code"]) ?>?<?php echo Encryption::encode($row["shop_id"]) ?>">Details</a></a>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>

                            <?php } ?>
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
        <!--<script src="../assets/js/pages/be_tables_datatables.min.js"></script>-->
