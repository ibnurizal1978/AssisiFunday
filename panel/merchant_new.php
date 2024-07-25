<?php
require_once 'header.php';
?>

<!-- Main Container -->
<main id="main-container">
  <!-- Page Content -->
  <div class="content">
    <!--table-->
    <div class="block table-responsive">
      <div class="block-header block-header-default">
        <h3 class="block-title">New Merchant</h3>
      </div>
      <div class="block-content">

        <div class="card-body">
          <form action="merchant_add" method=POST>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                    <label class="bmd-label-floating">Name</label>
                    <input type="text" class="form-control" name="staffName" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                    <label class="bmd-label-floating">User Name/Email</label>
                    <input type="text" class="form-control" name="email" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                    <label class="bmd-label-floating">Password (Password should contain 8 alphanumeric, 1 uppercase and 1 special)</label>
                    <input type="text" class="form-control" name="password" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                    <label class="bmd-label-floating">Phone</label>
                    <input type="text" class="form-control" name="contact" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                    <label class="bmd-label-floating">Shop (Admin role can access all shop by default)</label>
                    <select class="form-control" name="shop_id">
                        <option value="">All</option>
                        <?php
                        $sql = "SELECT shop_id, shop_name FROM tbl_shop ORDER BY shop_name";
                        $h = mysqli_query($conn, $sql);
                        while($row = mysqli_fetch_assoc($h)) {
                        ?>
                        <option value="<?php echo $row['shop_id'] ?>"><?php echo $row['shop_name'] ?></option>
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
                        <option value="1">Admin</option>
                        <option value="2">Merchants</option>
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
