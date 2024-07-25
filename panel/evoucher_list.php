<?php
require_once 'header.php';
$evoucher_id         = Encryption::decode($param[1]);
$sql  = "SELECT * FROM tbl_evoucher a INNER JOIN tbl_product b USING (product_id) WHERE evoucher_id = '".$evoucher_id."'";
$h = mysqli_query($conn, $sql);
$r = mysqli_fetch_assoc($h);
?>
<link rel="stylesheet" href="../assets/js/plugins/datatables/dataTables.bootstrap4.css">

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Upload file Excel here</h4>
      </div>
      <div class="modal-body">
        <span class="text-danger text-bold">ATTENTION!</span>
        <br/>
        <ul>
          <li>Make sure evoucher list is for product <b><?php echo $r['product_name'] ?></b></li>
          <li>Only CSV file are allowed to upload</li>
          <li>Duplicate code won't be uploaded to database</li>
          <li>Click "choose file" to select csv file then click "Upload" to start upload</li>
          <li>Uploaded list cannot be undo</li>
        </ul>
        <br/><br/>
        <form action="evoucher_upload_file" enctype="multipart/form-data" method="POST">
          <input type="hidden" name="evoucher_id" value="<?php echo $r['evoucher_id'] ?>" />
          <input type="hidden" name="shop_id" value="<?php echo $r['shop_id'] ?>" />
          <input type="hidden" name="product_id" value="<?php echo $r['product_id'] ?>" />
          <input type="file" name="files" /><br/>
          <input type="submit" class="btn btn-success" value="Upload" />
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      </div>
    </div>

  </div>
</div>

<!-- Main Container -->
<main id="main-container">
    <!-- Page Content -->
    <div class="content">

        <div class="block table-responsive">
            <div class="block-content">
                <?php
                $s = "SELECT * FROM tbl_evoucher_list a INNER JOIN tbl_shop b using (shop_id) WHERE evoucher_id = '".$evoucher_id."'";
                $h = mysqli_query($conn, $s);
                ?>
                <div class="block">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">Evoucher List for product <?php echo $r['product_name'] ?>
                              <?php if($r['self_upload'] == 1) { ?>
                              [<a href="#" data-toggle="modal" data-target="#myModal">add new</a>]</h3>
                              <?php } ?>
                        </div>
                        <div class="block-content block-content-full">
                            <!-- DataTables functionality is initialized with .js-dataTable-full-pagination class in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                            <table class="table table-bordered table-striped table-vcenter js-dataTable-full-pagination">
                                <thead>
                                    <tr>
                                        <th>Code</th>
                                        <th>Used Status</th>
                                        <th>Used Date</th>
                                        <th>Shop</th>
                                        <th class="d-none d-sm-table-cell">Upload Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while($r=mysqli_fetch_assoc($h)) { ?>
                                    <tr>
                                        <td class="font-w600"><?php echo $r['evoucher_code'] ?></td>
                                        <td class="d-none d-sm-table-cell"><?php echo $r['used_status'] ?></td>
                                        <td class="d-none d-sm-table-cell"><?php echo $r['used_date'] ?></td>
                                        <td class="d-none d-sm-table-cell"><?php echo $r['shop_name'] ?></td>
                                        <td class="d-none d-sm-table-cell"><?php echo $r['created_at'] ?></td>
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
