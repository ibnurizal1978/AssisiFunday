<?php
require_once 'header.php';
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
  <link rel="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" />
  <script>
$.noConflict();
jQuery(document).ready(function ($) {
    $('#datepicker, #datepicker2, #datepicker3, #datepicker4, #datepicker5, #datepicker6, #datepicker7, #datepicker8').datepicker({
        maxDate: '+1d',
        multidate: false,
        format: "yyyy-mm-dd",
        datesDisabled: ['31/08/2017'],
        language: 'en'
    }).on('changeDate', function(e) {
        // `e` here contains the extra attributes
        $(this).find('.input-group-addon .count').text(' ' + e.dates.length);
    });


});

  </script>

<!-- Main Container -->
<main id="main-container">
  <!-- Page Content -->
  <div class="content">
    <!--table-->
    <?php
    /*if(date("Y-m-d") < date("2022-10-06"))
    {
      echo '<h3>Coming Soon</h3>';
    }else{*/
    ?>
    <div class="block table-responsive">
      <div class="block-header block-header-default">
        <h3 class="block-title">Generate Sales Report</h3>
      </div>
      <div class="block-content">

        <div class="card-body">
        <?php if($_SESSION['roleID']==1) { ?>
          <form action="report_sales" method=POST>
        <?php }else{ ?>
          <form action="report_sales_m" method=POST>
        <?php } ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                    <label class="bmd-label-floating">Start Date</label>
                    <input type="text" class="form-control" name="date_from" id="datepicker" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                    <label class="bmd-label-floating">End Date</label>
                    <input type="text" class="form-control" name="date_to" id="datepicker2" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                    <label class="bmd-label-floating">Shop</label>
                    <select class="form-control" name="shop_id">
                        <?php if($_SESSION['roleID']==1) { ?>
                        <option value="all">All</option>
                        <?php
                          $sql = "SELECT shop_id, shop_name FROM tbl_shop WHERE active_status = 1  ORDER BY shop_name";
                        }else{
                          $sql = "SELECT shop_id, shop_name FROM tbl_shop WHERE active_status = 1 AND shop_id = '".$_SESSION['shop_id']."' ORDER BY shop_name";
                        }
                        $h = mysqli_query($conn, $sql);
                        while($row = mysqli_fetch_assoc($h)) {
                        ?>
                        <option value="<?php echo $row['shop_id'] ?>"><?php echo $row['shop_name'] ?></option>
                        <?php } ?>
                    </select>
                    </div>
                </div>
            </div>

            <div class="pull-right">
                <!-- <div id="results"></div><div id="button"></div>-->
               <input type="submit" class="btn btn-success mr-5 mb-5" value="Generate">
                <div class="clearfix"></div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- END Small Table -->

    <?php if($_SESSION['roleID']==1) { ?>
    <div class="block table-responsive">
      <div class="block-header block-header-default">
        <h3 class="block-title">Generate Sales Report - Sell For Good</h3>
      </div>
      <div class="block-content">

        <div class="card-body">
          <form action="report_sales_for_good" method=POST>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                    <label class="bmd-label-floating">Start Date</label>
                    <input type="text" class="form-control" name="date_from" id="datepicker" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                    <label class="bmd-label-floating">End Date</label>
                    <input type="text" class="form-control" name="date_to" id="datepicker2" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                    <label class="bmd-label-floating">Shop</label>
                    <select class="form-control" name="shop_id">
                        <?php if($_SESSION['roleID']==1) { ?>
                        <option value="all">All</option>
                        <?php
                          $sql = "SELECT shop_id, shop_name FROM tbl_shop WHERE active_status = 1  ORDER BY shop_name";
                        }else{
                          $sql = "SELECT shop_id, shop_name FROM tbl_shop WHERE active_status = 1 AND shop_id = '".$_SESSION['shop_id']."' ORDER BY shop_name";
                        }
                        $h = mysqli_query($conn, $sql);
                        while($row = mysqli_fetch_assoc($h)) {
                        ?>
                        <option value="<?php echo $row['shop_id'] ?>"><?php echo $row['shop_name'] ?></option>
                        <?php } ?>
                    </select>
                    </div>
                </div>
            </div>

            <div class="pull-right">
                <!-- <div id="results"></div><div id="button"></div>-->
               <input type="submit" class="btn btn-success mr-5 mb-5" value="Generate">
                <div class="clearfix"></div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <?php } ?>
    <!-- END Small Table -->

    <?php if($_SESSION['roleID']==1) { ?>
    <div class="block table-responsive">
      <div class="block-header block-header-default">
        <h3 class="block-title">Generate Cart Report</h3>
      </div>
      <div class="block-content">

        <div class="card-body">
          <form action="report_cart" method=POST>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                    <label class="bmd-label-floating">Start Date</label>
                    <input type="text" class="form-control" name="date_from" id="datepicker3" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                    <label class="bmd-label-floating">End Date</label>
                    <input type="text" class="form-control" name="date_to" id="datepicker4" />
                    </div>
                </div>
            </div>

            <div class="pull-right">
                <!-- <div id="results"></div><div id="button"></div>-->
               <input type="submit" class="btn btn-success mr-5 mb-5" value="Generate">
                <div class="clearfix"></div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <?php //} ?>
    <!-- END Small Table -->

    <?php if($_SESSION['roleID']==1) { ?>
    <div class="block table-responsive">
      <div class="block-header block-header-default">
        <h3 class="block-title">Generate User Report</h3>
      </div>
      <div class="block-content">

        <div class="card-body">
          <form action="report_user" method="POST">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                    <label class="bmd-label-floating">Start Date</label>
                    <input type="text" class="form-control" name="date_from" id="datepicker5" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                    <label class="bmd-label-floating">End Date</label>
                    <input type="text" class="form-control" name="date_to" id="datepicker6" />
                    </div>
                </div>
            </div>

            <div class="pull-right">
                <!-- <div id="results"></div><div id="button"></div>-->
               <input type="submit" class="btn btn-success mr-5 mb-5" value="Generate">
                <div class="clearfix"></div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <?php } ?>
    <!-- END Small Table -->

    <?php if($_SESSION['roleID']==1) { ?>
    <div class="block table-responsive">
      <div class="block-header block-header-default">
        <h3 class="block-title">Generate Lucky Draw Chances Report</h3>
      </div>
      <div class="block-content">

        <div class="card-body">
          <form action="report_lucky_draw" method="POST">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                    <label class="bmd-label-floating">Start Date</label>
                    <input type="text" class="form-control" name="date_from" id="datepicker5" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                    <label class="bmd-label-floating">End Date</label>
                    <input type="text" class="form-control" name="date_to" id="datepicker6" />
                    </div>
                </div>
            </div>

            <div class="pull-right">
                <!-- <div id="results"></div><div id="button"></div>-->
               <input type="submit" class="btn btn-success mr-5 mb-5" value="Generate">
                <div class="clearfix"></div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <?php } ?>
    <!-- END Small Table -->

    <?php if($_SESSION['roleID']==1) { ?>
    <div class="block table-responsive">
      <div class="block-header block-header-default">
        <h3 class="block-title">Generate Spin Win Report</h3>
      </div>
      <div class="block-content">

        <div class="card-body">
          <form action="report_spinwin" method=POST>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                    <label class="bmd-label-floating">Start Date</label>
                    <input type="text" class="form-control" name="date_from" id="datepicker7" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                    <label class="bmd-label-floating">End Date</label>
                    <input type="text" class="form-control" name="date_to" id="datepicker8" />
                    </div>
                </div>
            </div>

            <div class="pull-right">
                <!-- <div id="results"></div><div id="button"></div>-->
               <input type="submit" class="btn btn-success mr-5 mb-5" value="Generate">
                <div class="clearfix"></div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <?php } ?>
    <!-- END Small Table -->

    <!-- END Page Content -->
  <?php } ?>
  </div>
</main>
<!-- END Main Container -->
<?php require_once 'footer.php' ?>
