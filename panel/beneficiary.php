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
                $sql  = "SELECT * FROM tbl_user WHERE beneficiary = 1 ORDER BY first_name";
                $h = mysqli_query($conn, $sql);
                ?>
                <div class="block">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">Beneficiary</h3>
                        </div>
                        <div class="block-content block-content-full">
                        <?php
                            $sql2 = "SELECT sum(credit) as total FROM tbl_ledger WHERE ledger_type = 'CREDIT' AND description = 'BENEFICIARY'";
                            $h2 = mysqli_query($conn, $sql2);
                            $row2 = mysqli_fetch_assoc($h2);
                            if($row2['total']==0) { $total = 0; }else{ $total = $row2['total']; }
                            echo "<b>TOTAL DISTRIBUTED:</b> $".$total;

                            $sql2 = "SELECT sum(credit) as total FROM tbl_ledger WHERE ledger_type = 'DEBET' AND description = 'BENEFICIARY'";
                            $h2 = mysqli_query($conn, $sql2);
                            $row2 = mysqli_fetch_assoc($h2);
                            if($row2['total']==0) { $total = 0; }else{ $total = $row2['total']; }
                            echo "<br/><b>TOTAL USED:</b> $".$total;
                            ?><br/><br/>
                            <!-- DataTables functionality is initialized with .js-dataTable-full-pagination class in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                            <table class="table table-bordered table-striped table-vcenter js-dataTable-full-pagination">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th class="d-none d-sm-table-cell">Email</th>
                                        <th>Amount Credited</th>
                                        <th class="d-none d-sm-table-cell text-center" style="width: 15%;">Status</th>
                                        <th class="text-center" style="width: 15%;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while($row=mysqli_fetch_assoc($h)) { ?>
                                    <tr>
                                        <td class="font-w600"><?php echo $row['first_name'].' '.$row['last_name'] ?></td>
                                        <td class="d-none d-sm-table-cell"><?php echo $row['email'] ?></td>
                                        <td>
                                            <?php
                                            $sql1 = "SELECT sum(credit) as total FROM tbl_ledger WHERE ledger_type = 'CREDIT' AND user_id = '".$row['user_id']."' LIMIT 1";
                                            $h1 = mysqli_query($conn, $sql1);
                                            $row1 = mysqli_fetch_assoc($h1);
                                            if($row1['total']==0) { $total = 0; }else{ $total = $row1['total']; }
                                            echo '$'.$total;
                                            ?>
                                        </td>
                                        <td class="d-none d-sm-table-cell text-center"><?php if($row['active_status']==1) { ?><span class="badge badge-success">Active</span><?php }else{ ?><span class="badge badge-danger">Disabled</span><?php } ?></td>
                                        <td class="text-center"><a href="beneficiary_detail?<?php echo Encryption::encode($row["user_id"]) ?>">Update</a> | <a href="beneficiary_disable?<?php echo Encryption::encode($row["user_id"]) ?>"><?php if($row['active_status']==1) { ?>Disabled<?php }else{ ?>Enable<?php } ?></a>
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
