<?php
require_once 'header.php';

$id  = Encryption::decode($param[1]);
$sql = "SELECT * FROM tbl_user WHERE user_id = '".$id."' LIMIT 1";
$h = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($h);

$sql2 = "SELECT sum(debet) as total FROM tbl_ledger WHERE user_id = '".$id."' LIMIT 1";
$h2 = mysqli_query($conn, $sql2);
$row2 = mysqli_fetch_assoc($h2);
if($row2['total']==0) { $total = 0; }else{ $total = $row2['total']; }
?>

<!-- Main Container -->
<main id="main-container">
  <!-- Page Content -->
  <div class="content">
    <!--table-->
    <div class="block table-responsive">
      <div class="block-header block-header-default">
        <h3 class="block-title">Update Beneficiary</h3>
      </div>
      <div class="block-content">

        <div class="card-body">
          <form action="beneficiary_update" method=POST>
          <input type="hidden" name="id" value="<?php echo Encryption::encode($row["user_id"]) ?>" />
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                    <label class="bmd-label-floating">User Name</label>
                    <input type="text" class="form-control" disabled value="<?php echo $row['email'] ?>" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                    <label class="bmd-label-floating">Name</label>
                    <input type="email" class="form-control" disabled value="<?php echo $row['first_name'].' '.$row['last_name'] ?>" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                    <label class="bmd-label-floating">Mobile</label>
                    <input type="email" class="form-control" disabled value="<?php echo $row['phone'] ?>" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                    <label class="bmd-label-floating">Password</label>
                    <input type="text" class="form-control" disabled value="<?php echo $row['password'] ?>" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                    <label class="bmd-label-floating">Add Amount</label>
                    <input type="text" class="form-control" name="amount" /> <a data-toggle="modal" data-target="#modal-extra-large" href=#>view history</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                    <label class="bmd-label-floating">Amount Used</label>
                    <input type="text" class="form-control" disabled value="$<?php echo $total ?>" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                    <label class="bmd-label-floating">Status</label>
                    <select class="form-control" name="active_status">
                        <option value="1" <?php if(@$row['active_status']==1) { echo 'selected'; } ?>>Active</option>
                        <option value="0" <?php if(@$row['active_status']==0) { echo 'selected'; } ?>>Disabled</option>
                    </select>
                    </div>
                </div>
            </div>

            <div class="pull-right">
                <!-- <div id="results"></div><div id="button"></div>-->
               <input type="submit" class="btn btn-success mr-5 mb-5" value="Submit">
                <div class="clearfix"></div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- END Small Table -->

    <!-- END Page Content -->
  </div>
</main>
<!-- END Main Container -->
<?php require_once 'footer.php' ?>

 <!-- Fade In Modal -->
 <div class="modal" id="modal-extra-large" tabindex="-1" role="dialog" aria-labelledby="modal-extra-large" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="block block-themed block-transparent mb-0">
                        <div class="block-header bg-primary-dark">
                            <h3 class="block-title">Beneficiary History</h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                    <i class="si si-close"></i>
                                </button>
                            </div>
                        </div>
                        <div class="block-content">
                            <?php
                            $sql = "SELECT *, date_format(created_at, '%M %d, %Y') as created_date FROM tbl_ledger a INNER JOIN tbl_staff b ON a.staff_id = b.staff_id WHERE user_id = '".$id."'";
                            $h = mysqli_query($conn, $sql);
                            ?>
                           <table width=100% border=1 cellpadding=10>
                                <tr style="background:#f6f6f6; font-weight:bold;">
                                   <td>Date</td>
                                   <td>Amount</td>
                                   <td>Transaction ID</td>
                                   <td>By</td>
                                </tr>
                                <?php while($row = mysqli_fetch_assoc($h)) { ?>
                                <tr>
                                    <td><?php echo $row['created_date'] ?></td>
                                    <td>$<?php echo $row['totalAmount'] ?></td>
                                    <td><?php echo $row['tranId'] ?></td>
                                    <td><?php echo $row['staffName'] ?></td>
                                </tr>
                                <?php } ?>
                           </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-alt-success" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Fade In Modal -->
