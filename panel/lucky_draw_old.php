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
                $sql  = "SELECT *, date_format(a.created_at, '%d-%m-%Y') as created_at, date_format(approval_date, '%d-%m-%Y') as approval_date FROM tbl_lucky_draw a INNER JOIN tbl_user b USING (user_id) ORDER BY a.created_at DESC";
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
                                        <th>Name</th>
                                        <th class="d-none d-sm-table-cell">Win Via</th>
                                        <th class="text-center">Win Date</th>
                                        <th class="text-center">Approval Status</th>
                                        <th class="text-center">Approval Date</th>
                                        <th class="text-center" style="width: 18%;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    while($row=mysqli_fetch_assoc($h)) {
                                    ?>
                                    <tr>
                                        <td class="font-w600"><?php echo $row['first_name'].' '.$row['last_name'] ?></td>
                                        <td class="d-none d-sm-table-cell"><?php echo $row['via'] ?></td>
                                        <td class="text-center"><?php echo $row['created_at'] ?></td>
                                        <td class="text-center"><?php if($row['approval_status']==1) { ?><span class="badge badge-success">Approved</span><?php }else{ ?><span class="badge badge-danger">Not Yet</span><?php } ?></td>
                                        <td class="text-center"><?php echo $row['approval_date'] ?></td>
                                        <td class="text-center"><a href="daily_special_detail?<?php echo Encryption::encode($row["lucky_draw_id"]) ?>">Update</a></a>
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
