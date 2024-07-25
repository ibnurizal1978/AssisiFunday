<?php
require_once 'header.php';
?>
<link rel="stylesheet" href="../assets/js/plugins/datatables/dataTables.bootstrap4.css">
<link rel="stylesheet" href="../assets/css/jquery.multiselect.css" />
<script src="../assets/js/multiselect-dropdown.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
<script>
$.noConflict();
jQuery(document).ready(function ($) {
  $('#datepicker').datepicker({
      startDate: new Date(),
      multidate: true,
      format: "yyyy-mm-dd",
      datesDisabled: ['31/08/2017'],
      language: 'en'
  }).on('changeDate', function(e) {
      // `e` here contains the extra attributes
      $(this).find('.input-group-addon .count').text(' ' + e.dates.length);
  });

  $('#datepicker2').datepicker({
      startDate: new Date(),
      multidate: true,
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

        <div class="block table-responsive">
            <div class="block-content">
                <?php
                $id  = Encryption::decode($param[1]);
                $sql = "SELECT * FROM tbl_shop_outlet WHERE shop_outlet_id = '".$id."'";
                $h = mysqli_query($conn, $sql);
                if(mysqli_num_rows($h)==0)
                {
                  echo "no data yet";
                }else{
                  $r = mysqli_fetch_assoc($h);
                  $pic_time = explode(',',$r['pickup_time']);
                  $pic_date = str_replace("[","", $r['pickup_date']); $pic_date = str_replace("]","", $pic_date);
                }
                ?>
                <div class="block" style="height:100vh">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">Shop Outlet <?php echo $r['shop_outlet_name'] ?> [ <a href="shop_outlet?<?php echo Encryption::encode($r["shop_id"]) ?>">back to Pickup List</a>]</h3>
                        </div>
                        <div class="block-content block-content-full">

                          <form action="shop_outlet_time_update" method="POST">
                            <input type="hidden" name="shop_outlet_id" value="<?php echo Encryption::encode($r["shop_outlet_id"]) ?>" />
                            <b>Time</b><br/>
                            <select name="pickup_time[]" multiple="multiple" class="pickuptimes form-control">
                              <option value="7am - 8am" <?php if(@$pic_time[0]=='7am - 8am' || @$pic_time[1]=='7am - 8am' || @$pic_time[2]=='7am - 8am' || @$pic_time[3]=='7am - 8am' || @$pic_time[4]=='7am - 8am' || @$pic_time[5]=='7am - 8am' || @$pic_time[6]=='7am - 8am' || @$pic_time[7]=='7am - 8am' || @$pic_time[8]=='7am - 8am' || @$pic_time[9]=='7am - 8am' || @$pic_time[10]=='7am - 8am' || @$pic_time[11]=='7am - 8am' || @$pic_time[12]=='7am - 8am' || @$pic_time[13]=='7am - 8am' || @$pic_time[14]=='7am - 8am') { echo 'selected'; } ?>>7am - 8am</option>
                              <option value="8am - 9am" <?php if(@$pic_time[0]=='8am - 9am' || @$pic_time[1]=='8am - 9am' || @$pic_time[2]=='8am - 9am' || @$pic_time[3]=='8am - 9am' || @$pic_time[4]=='8am - 9am' || @$pic_time[5]=='8am - 9am' || @$pic_time[6]=='8am - 9am' || @$pic_time[7]=='8am - 9am' || @$pic_time[8]=='8am - 9am' || @$pic_time[9]=='8am - 9am' || @$pic_time[10]=='8am - 9am' || @$pic_time[11]=='8am - 9am' || @$pic_time[12]=='8am - 9am' || @$pic_time[13]=='8am - 9am' || @$pic_time[14]=='8am - 9am') { echo 'selected'; } ?>>8am - 9am</option>
                              <option value="9am - 10am" <?php if(@$pic_time[0]=='9am - 10am' || @$pic_time[1]=='9am - 10am' || @$pic_time[2]=='9am - 10am' || @$pic_time[3]=='9am - 10am' || @$pic_time[4]=='9am - 10am' || @$pic_time[5]=='9am - 10am' || @$pic_time[6]=='9am - 10am' || @$pic_time[7]=='9am - 10am' || @$pic_time[8]=='9am - 10am' || @$pic_time[9]=='9am - 10am' || @$pic_time[10]=='9am - 10am' || @$pic_time[11]=='9am - 10am' || @$pic_time[12]=='9am - 10am' || @$pic_time[13]=='9am - 10am' || @$pic_time[14]=='9am - 10am') { echo 'selected'; } ?>>9am - 10am</option>
                              <option value="10am - 11am" <?php if(@$pic_time[0]=='10am - 11am' || @$pic_time[1]=='10am - 11am' || @$pic_time[2]=='10am - 11am' || @$pic_time[3]=='10am - 11am' || @$pic_time[4]=='10am - 11am' || @$pic_time[5]=='10am - 11am' || @$pic_time[6]=='10am - 11am' || @$pic_time[7]=='10am - 11am' || @$pic_time[8]=='10am - 11am' || @$pic_time[9]=='10am - 11am' || @$pic_time[10]=='10am - 11am' || @$pic_time[11]=='10am - 11am' || @$pic_time[12]=='10am - 11am' || @$pic_time[13]=='10am - 11am' || @$pic_time[14]=='10am - 11am') { echo 'selected'; } ?>>10am - 11am</option>
                              <option value="11am - 12pm" <?php if(@$pic_time[0]=='11am - 12pm' || @$pic_time[1]=='11am - 12pm' || @$pic_time[2]=='11am - 12pm' || @$pic_time[3]=='11am - 12pm' || @$pic_time[4]=='11am - 12pm' || @$pic_time[5]=='11am - 12pm' || @$pic_time[6]=='11am - 12pm' || @$pic_time[7]=='11am - 12pm' || @$pic_time[8]=='11am - 12pm' || @$pic_time[9]=='11am - 12pm' || @$pic_time[10]=='11am - 12pm' || @$pic_time[11]=='11am - 12pm' || @$pic_time[12]=='11am - 12pm' || @$pic_time[13]=='11am - 12pm' || @$pic_time[14]=='11am - 12pm') { echo 'selected'; } ?>>11am - 12pm</option>
                              <option value="12pm - 1pm" <?php if(@$pic_time[0]=='12pm - 1pm' || @$pic_time[1]=='12pm - 1pm' || @$pic_time[2]=='12pm - 1pm' || @$pic_time[3]=='12pm - 1pm' || @$pic_time[4]=='12pm - 1pm' || @$pic_time[5]=='12pm - 1pm' || @$pic_time[6]=='12pm - 1pm' || @$pic_time[7]=='12pm - 1pm' || @$pic_time[8]=='12pm - 1pm' || @$pic_time[9]=='12pm - 1pm' || @$pic_time[10]=='12pm - 1pm' || @$pic_time[11]=='12pm - 1pm' || @$pic_time[12]=='12pm - 1pm' || @$pic_time[13]=='12pm - 1pm' || @$pic_time[14]=='12pm - 1pm') { echo 'selected'; } ?>>12pm - 1pm</option>
                              <option value="1pm - 2pm" <?php if(@$pic_time[0]=='1pm - 2pm' || @$pic_time[1]=='1pm - 2pm' || @$pic_time[2]=='1pm - 2pm' || @$pic_time[3]=='1pm - 2pm' || @$pic_time[4]=='1pm - 2pm' || @$pic_time[5]=='1pm - 2pm' || @$pic_time[6]=='1pm - 2pm' || @$pic_time[7]=='1pm - 2pm' || @$pic_time[8]=='1pm - 2pm' || @$pic_time[9]=='1pm - 2pm' || @$pic_time[10]=='1pm - 2pm' || @$pic_time[11]=='1pm - 2pm' || @$pic_time[12]=='1pm - 2pm' || @$pic_time[13]=='1pm - 2pm' || @$pic_time[14]=='1pm - 2pm') { echo 'selected'; } ?>>1pm - 2pm</option>
                              <option value="2pm - 3pm" <?php if(@$pic_time[0]=='2pm - 3pm' || @$pic_time[1]=='2pm - 3pm' || @$pic_time[2]=='2pm - 3pm' || @$pic_time[3]=='2pm - 3pm' || @$pic_time[4]=='2pm - 3pm' || @$pic_time[5]=='2pm - 3pm' || @$pic_time[6]=='2pm - 3pm' || @$pic_time[7]=='2pm - 3pm' || @$pic_time[8]=='2pm - 3pm' || @$pic_time[9]=='2pm - 3pm' || @$pic_time[10]=='2pm - 3pm' || @$pic_time[11]=='2pm - 3pm' || @$pic_time[12]=='2pm - 3pm' || @$pic_time[13]=='2pm - 3pm' || @$pic_time[14]=='2pm - 3pm') { echo 'selected'; } ?>>2pm - 3pm</option>
                              <option value="3pm - 4pm" <?php if(@$pic_time[0]=='3pm - 4pm' || @$pic_time[1]=='3pm - 4pm' || @$pic_time[2]=='3pm - 4pm' || @$pic_time[3]=='3pm - 4pm' || @$pic_time[4]=='3pm - 4pm' || @$pic_time[5]=='3pm - 4pm' || @$pic_time[6]=='3pm - 4pm' || @$pic_time[7]=='3pm - 4pm' || @$pic_time[8]=='3pm - 4pm' || @$pic_time[9]=='3pm - 4pm' || @$pic_time[10]=='3pm - 4pm' || @$pic_time[11]=='3pm - 4pm' || @$pic_time[12]=='3pm - 4pm' || @$pic_time[13]=='3pm - 4pm' || @$pic_time[14]=='3pm - 4pm') { echo 'selected'; } ?>>3pm - 4pm</option>
                              <option value="4pm - 5pm" <?php if(@$pic_time[0]=='4pm - 5pm' || @$pic_time[1]=='4pm - 5pm' || @$pic_time[2]=='4pm - 5pm' || @$pic_time[3]=='4pm - 5pm' || @$pic_time[4]=='4pm - 5pm' || @$pic_time[5]=='4pm - 5pm' || @$pic_time[6]=='4pm - 5pm' || @$pic_time[7]=='4pm - 5pm' || @$pic_time[8]=='4pm - 5pm' || @$pic_time[9]=='4pm - 5pm' || @$pic_time[10]=='4pm - 5pm' || @$pic_time[11]=='4pm - 5pm' || @$pic_time[12]=='4pm - 5pm' || @$pic_time[13]=='4pm - 5pm' || @$pic_time[14]=='4pm - 5pm') { echo 'selected'; } ?>>4pm - 5pm</option>
                              <option value="5pm - 6pm" <?php if(@$pic_time[0]=='5pm - 6pm' || @$pic_time[1]=='5pm - 6pm' || @$pic_time[2]=='5pm - 6pm' || @$pic_time[3]=='5pm - 6pm' || @$pic_time[4]=='5pm - 6pm' || @$pic_time[5]=='5pm - 6pm' || @$pic_time[6]=='5pm - 6pm' || @$pic_time[7]=='5pm - 6pm' || @$pic_time[8]=='5pm - 6pm' || @$pic_time[9]=='5pm - 6pm' || @$pic_time[10]=='5pm - 6pm' || @$pic_time[11]=='5pm - 6pm' || @$pic_time[12]=='5pm - 6pm' || @$pic_time[13]=='5pm - 6pm' || @$pic_time[14]=='5pm - 6pm') { echo 'selected'; } ?>>5pm - 6pm</option>
                              <option value="6pm - 7pm" <?php if(@$pic_time[0]=='6pm - 7pm' || @$pic_time[1]=='6pm - 7pm' || @$pic_time[2]=='6pm - 7pm' || @$pic_time[3]=='6pm - 7pm' || @$pic_time[4]=='6pm - 7pm' || @$pic_time[5]=='6pm - 7pm' || @$pic_time[6]=='6pm - 7pm' || @$pic_time[7]=='6pm - 7pm' || @$pic_time[8]=='6pm - 7pm' || @$pic_time[9]=='6pm - 7pm' || @$pic_time[10]=='6pm - 7pm' || @$pic_time[11]=='6pm - 7pm' || @$pic_time[12]=='6pm - 7pm' || @$pic_time[13]=='6pm - 7pm' || @$pic_time[14]=='6pm - 7pm') { echo 'selected'; } ?>>6pm - 7pm</option>
                              <option value="7pm - 8pm" <?php if(@$pic_time[0]=='7pm - 8pm' || @$pic_time[1]=='7pm - 8pm' || @$pic_time[2]=='7pm - 8pm' || @$pic_time[3]=='7pm - 8pm' || @$pic_time[4]=='7pm - 8pm' || @$pic_time[5]=='7pm - 8pm' || @$pic_time[6]=='7pm - 8pm' || @$pic_time[7]=='7pm - 8pm' || @$pic_time[8]=='7pm - 8pm' || @$pic_time[9]=='7pm - 8pm' || @$pic_time[10]=='7pm - 8pm' || @$pic_time[11]=='7pm - 8pm' || @$pic_time[12]=='7pm - 8pm' || @$pic_time[13]=='7pm - 8pm' || @$pic_time[14]=='7pm - 8pm') { echo 'selected'; } ?>>7pm - 8pm</option>
                              <option value="8pm - 9pm" <?php if(@$pic_time[0]=='8pm - 9pm' || @$pic_time[1]=='8pm - 9pm' || @$pic_time[2]=='8pm - 9pm' || @$pic_time[3]=='8pm - 9pm' || @$pic_time[4]=='8pm - 9pm' || @$pic_time[5]=='8pm - 9pm' || @$pic_time[6]=='8pm - 9pm' || @$pic_time[7]=='8pm - 9pm' || @$pic_time[8]=='8pm - 9pm' || @$pic_time[9]=='8pm - 9pm' || @$pic_time[10]=='8pm - 9pm' || @$pic_time[11]=='8pm - 9pm' || @$pic_time[12]=='8pm - 9pm' || @$pic_time[13]=='8pm - 9pm' || @$pic_time[14]=='8pm - 9pm') { echo 'selected'; } ?>>8pm - 9pm</option>
                              <option value="9pm - 10pm" <?php if(@$pic_time[0]=='9pm - 10pm' || @$pic_time[1]=='9pm - 10pm' || @$pic_time[2]=='9pm - 10pm' || @$pic_time[3]=='9pm - 10pm' || @$pic_time[4]=='9pm - 10pm' || @$pic_time[5]=='9pm - 10pm' || @$pic_time[6]=='9pm - 10pm' || @$pic_time[7]=='9pm - 10pm' || @$pic_time[8]=='9pm - 10pm' || @$pic_time[9]=='9pm - 10pm' || @$pic_time[10]=='9pm - 10pm' || @$pic_time[11]=='9pm - 10pm' || @$pic_time[12]=='9pm - 10pm' || @$pic_time[13]=='9pm - 10pm' || @$pic_time[14]=='9pm - 10pm') { echo 'selected'; } ?>>9pm - 10pm</option>
                            </select>
                            <br/><br/>
                            <b>Date</b><br/>
                            <input type="text" class="form-control" id="datepicker2" name="pickup_date" value="<?php echo @$pic_date ?>">
                            <br/>
                            <input type="submit" class="btn btn-success" value="Submit" />
                          </form>
                        </div>
                    </div>




    </div>
    <!-- END Page Content -->
</main>
<!-- END Main Container -->
<?php require_once 'footer.php' ?>
