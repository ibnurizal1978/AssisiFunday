<?php
require_once 'header.php';
ini_set('display_errors',0);  error_reporting(E_ALL);
$id  = Encryption::decode($param[1]);
$sql = "SELECT * FROM tbl_staff WHERE staff_id = '".$id."' LIMIT 1";
$h = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($h);
?>

<!-- Main Container -->
<main id="main-container">
  <!-- Page Content -->
  <div class="content">
    <!--table-->
    <div class="block table-responsive">
      <div class="block-header block-header-default">
        <h3 class="block-title">Update Merchant</h3>
      </div>
      <div class="block-content">

        <div class="card-body">
          <form action="merchant_update" method=POST enctype="multipart/form-data">
          <input type="hidden" name="id" value="<?php echo Encryption::encode($row["staff_id"]) ?>" />
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                    <label class="bmd-label-floating">Name</label>
                    <input type="text" class="form-control" name="staffName" value="<?php echo $row['staffName'] ?>" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                    <label class="bmd-label-floating">User Name/Email</label>
                    <input type="email" class="form-control" name="email" disabled value="<?php echo $row['email'] ?>" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                    <label class="bmd-label-floating">Password</label>
                    <input type="text" class="form-control" name="password" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                    <label class="bmd-label-floating">Phone</label>
                    <input type="text" class="form-control" name="contact" value="<?php echo $row['contact'] ?>" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                    <label class="bmd-label-floating">Shop</label>
                    <select class="form-control" required name="shop_id">
                        <option value="all" <?php if(@$row['shop_id']=='all' || @$row['shop_id']=='') { echo 'selected'; } ?>>All</option>
                        <?php
                        $sql1 = "SELECT shop_id, shop_name FROM tbl_shop ORDER BY shop_name";
                        $h1 = mysqli_query($conn, $sql1);
                        while($row1 = mysqli_fetch_assoc($h1)) {
                        ?>
                        <option value="<?php echo $row1['shop_id'] ?>" <?php if(@$row['shop_id']==$row1['shop_id']) { echo 'selected'; } ?>><?php echo $row1['shop_name'] ?></option>
                        <?php } ?>
                    </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                    <label class="bmd-label-floating">Role</label>
                    <select class="form-control" required name="roleID">
                        <option value="1" <?php if(@$row['roleID']==1) { echo 'selected'; } ?>>admin</option>
                        <option value="2" <?php if(@$row['roleID']==2) { echo 'selected'; } ?>>merchants</option>
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
<script>
$(document).ready(function(){
  $("#button").html('<button type="submit" class="btn btn-success mr-5 mb-5" id="submit_data"><i class="fa fa-check mr-5"></i>Save</button>');
  $('#submit_data').click(function(){
    $('#form_simpan').submit();
    $("#results").html('<i class="fa fa-4x fa-cog fa-spin text-success"></i>');
  });
  $('#form_simpan').on('submit', function(event){
    $("#results").html('<i class="fa fa-4x fa-cog fa-spin text-success"></i>');
    event.preventDefault();
    $.ajax({
      url:"product_add",
      method:"POST",
      data:new FormData(this),
      contentType:false,
      processData:false,
      success:function(data){
        $('#results').html(data);
        $('#submit_data').val('');
       //    $("#button").html('<button type="submit" class="btn btn-success mr-5 mb-5" id="submit_data"><i class="fa fa-check mr-5"></i>Save</button>');
      }
    });
  });
});
</script>
