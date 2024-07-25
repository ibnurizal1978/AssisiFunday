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
                $sql  = "SELECT * FROM tbl_news_ticker";
                $h = mysqli_query($conn, $sql);
                ?>
                <div class="block">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">News Ticker Data</h3>
                    </div>
                    <div class="block-content block-content-full">
                        <!-- DataTables functionality is initialized with .js-dataTable-full-pagination class in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                        <table class="table table-bordered table-striped table-vcenter js-dataTable-full-pagination">
                            <thead>
                                <tr>
                                    <th>Content</th>
                                    <th class="d-sm-table-cell" style="width: 15%;">Date</th>
                                    <th class="d-sm-table-cell" style="width: 15%;">Live Date</th>
                                    <th class="d-sm-table-cell" style="width: 10%;">Status</th>
                                    <th class="text-center" style="width: 15%;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while($row=mysqli_fetch_assoc($h)) { ?>
                                <tr>
                                    <td class="font-w600"><?php echo $row['content'] ?></td>
                                    <td class="d-sm-table-cell"><?php echo $row['created_at'] ?></td>
                                    <td class="d-sm-table-cell"><?php echo $row['live_date'] ?></td>
                                    <td class="d-sm-table-cell"><?php if($row['active_status']==1) { ?><span class="badge badge-success">Active</span><?php }else{ ?><span class="badge badge-danger">Disabled</span><?php } ?></td>
                                    <td class="text-center"><a href="ticker_detail?<?php echo Encryption::encode($row["news_ticker_id"]) ?>">Update</a> | 
                                                        <?php if($row['active_status']==1) { ?>
                                                            <a href="ticker_disable?<?php echo Encryption::encode($row["news_ticker_id"]) ?>">Disabled</a>
                                                        <?php }else{ ?>
                                                            <a href="ticker_enable?<?php echo Encryption::encode($row["news_ticker_id"]) ?>">Enable</a>
                                                        <?php } ?>
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