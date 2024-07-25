<?php
require_once 'header.php';
?>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">New Outlet</h4>
      </div>
      <div class="modal-body">
        <form action="shop_outlet_add" method="POST">
          <input type="hidden" name="shop_id" value="<?php echo $param[1] ?>" />
          <input type="text" name="shop_outlet_name" class="form-control" /><br/>
          <input type="submit" class="btn btn-success" value="Submit" />
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
                $id  = Encryption::decode($param[1]);
                $sql = "SELECT * FROM tbl_shop_outlet WHERE shop_id = '".$id."'";
                $h = mysqli_query($conn, $sql);
                ?>
                <div class="block">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">Shop Outlet [<a href="#" data-toggle="modal" data-target="#myModal">add new outlet</a>]</h3>
                        </div>
                        <div class="block-content block-content-full">
                            <!-- DataTables functionality is initialized with .js-dataTable-full-pagination class in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                            <table class="table table-bordered table-striped table-vcenter js-dataTable-full-pagination">
                                <thead>
                                    <tr>
                                        <th width="30%">Outlet Name</th>
                                        <th class="d-none d-sm-table-cell">Pickup Time</th>
                                        <th class="d-none d-sm-table-cell">Pickup Date</th>
                                        <th class="text-center" style="width: 20%;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while($r=mysqli_fetch_assoc($h)) { ?>
                                    <tr>
                                        <td class="font-w600"><?php echo $r['shop_outlet_name'] ?></td>
                                        <td class="font-w600"><?php echo $r['pickup_time'] ?></td>
                                        <td class="font-w600"><?php echo $r['pickup_date'] ?></td>
                                        <td class="text-center"><a href="shop_outlet_time?<?php echo Encryption::encode($r["shop_outlet_id"]) ?>">Pickup Time</a> | <a href="#" data-toggle="modal" data-target="#myModal-<?php echo $r["shop_outlet_id"] ?>">Update</a>
                                        </td>
                                    </tr>


                                    <!-- Modal shop outlet name update -->
                                    <div id="myModal-<?php echo $r["shop_outlet_id"] ?>" class="modal fade" role="dialog">
                                      <div class="modal-dialog">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h4 class="modal-title">Update Outlet Name</h4>
                                          </div>
                                          <div class="modal-body">
                                            <form action="shop_outlet_update" method="POST">
                                              <input type="hidden" name="shop_outlet_id" value="<?php echo Encryption::encode($r["shop_outlet_id"]) ?>" />
                                              <input type="text" name="shop_outlet_name" value="<?php echo $r["shop_outlet_name"] ?>" class="form-control" /><br/>
                                              <input type="submit" class="btn btn-success" value="Submit" />
                                            </form>
                                          </div>
                                          <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <!-- end modal shop outlet name update -->




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
