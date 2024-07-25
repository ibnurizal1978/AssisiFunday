<!DOCTYPE HTML>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
  <link rel="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" />
  <script>
    var bootstrapDP = $.fn.datepicker;
  </script>

  <style>
    .disabled.day {
      color: #aaa;
    }
  </style>
<?php
require_once 'header.php';
$id  = Encryption::decode($param[1]);
$sql = "SELECT * FROM tbl_product INNER JOIN tbl_shop USING (shop_id) WHERE shop_id = '".$id."' AND shop_type = 'DS' LIMIT 1";
$h = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($h);

$cat_id   = explode(',',$row['category_id']);
$del_time = explode(',',$row['delivery_time']);
$pic_time = explode(',',$row['pickup_time']);
$del_date = str_replace("[","", $row['delivery_date']); $del_date = str_replace("]","", $del_date);
$pic_date = str_replace("[","", $row['pickup_date']); $pic_date = str_replace("]","", $pic_date);
?>
<link rel="stylesheet" href="../assets/css/jquery.multiselect.css" />
<script src="../assets/js/plugins/tinymce/tinymce.min.js"></script>
<script src="../assets/js/multiselect-dropdown.js" ></script>


<script type="text/javascript">

var loadFile = function(event)
{
	$("#image_placeholder").html("");

	var files = event.target.files;

	for(var i = 0, file; file = files[i]; i++)
	{
		if(event.target.files[i].name.indexOf(".png") > -1 || event.target.files[i].name.indexOf(".jpg") > -1 || event.target.files[i].name.indexOf(".JPG") > -1
				|| event.target.files[i].name.indexOf(".jpeg") > -1)
		{
			var imageElement = new Image();
			imageElement.onload = function()
			{
				// li Element
				var check = false;
				if(this.width == 800 && this.height == 500)
				{
					check = true;

				}
				console.log(check);
				if(check == false)
				{
					$("#fCover").val("");
					alert("Image only accept image resolution of 800px (Width) x 500px (Height)");
				}
				else
				{
				var liElement = document.createElement("LI");
				liElement.style.display = "inline-block";
				liElement.style.width = "600px";
				liElement.style.height = "auto";

				this.style.width = "600px";
				this.style.height = "auto";

				liElement.appendChild(this);
				liElement.appendChild(this);

				$(liElement).html($(liElement).html());

				document.getElementById("image_placeholder").appendChild(liElement);
				}
			};
			imageElement.src = URL.createObjectURL(event.target.files[i]);
			imageElement.id = i + "_" + event.target.files[i].name;
		}
	}
};

var loadIconImage = function(event)
{
	$("#icon_placeholder").html("");

	var files = event.target.files;

	for(var i = 0, file; file = files[i]; i++)
	{
		if(event.target.files[i].name.indexOf(".png") > -1 || event.target.files[i].name.indexOf(".jpg") > -1 || event.target.files[i].name.indexOf(".JPG") > -1
				|| event.target.files[i].name.indexOf(".jpeg") > -1)
		{
			var imageElement = new Image();
			imageElement.onload = function()
			{
				// li Element
				var check = false;
				console.log(this.width+""+this.height);
				//if(this.width ==300 && this.height == 300)
                if(this.height < 301)
				{
					check = true;

				}

				if(check == false)
				{
					$("#icon").val("");
					alert("Image only accept image resolution of max 300px (Height)");
				}
				else
				{
				var liElement = document.createElement("LI");
				liElement.style.display = "inline-block";
				//liElement.style.width = "300px";
				//liElement.style.height = "auto";
                liElement.style.height = "auto";

				//this.style.width = "300px";
				//this.style.height = "auto";
				this.style.height = "auto";

				liElement.appendChild(this);
				liElement.appendChild(this);

				$(liElement).html($(liElement).html());

				document.getElementById("icon_placeholder").appendChild(liElement);
				}
			};
			imageElement.src = URL.createObjectURL(event.target.files[i]);
			imageElement.id = i + "_" + event.target.files[i].name;
		}
	}
};

var loadIconImage2 = function(event)
{
	$("#icon_placeholder2").html("");

	var files = event.target.files;

	for(var i = 0, file; file = files[i]; i++)
	{
		if(event.target.files[i].name.indexOf(".png") > -1 || event.target.files[i].name.indexOf(".jpg") > -1 || event.target.files[i].name.indexOf(".JPG") > -1
				|| event.target.files[i].name.indexOf(".jpeg") > -1)
		{
			var imageElement = new Image();
			imageElement.onload = function()
			{
				// li Element
				var check = false;
				console.log(this.width+""+this.height);
				if(this.width ==300 && this.height == 300)
				{
					check = true;

				}

				if(check == false)
				{
					$("#icon2").val("");
					alert("Image only accept image resolution of 300px (Width) x 300px (Height)");
				}
				else
				{
				var liElement = document.createElement("LI");
				liElement.style.display = "inline-block";
				liElement.style.width = "300px";
				liElement.style.height = "auto";

				this.style.width = "300px";
				this.style.height = "auto";

				liElement.appendChild(this);
				liElement.appendChild(this);

				$(liElement).html($(liElement).html());

				document.getElementById("icon_placeholder2").appendChild(liElement);
				}
			};
			imageElement.src = URL.createObjectURL(event.target.files[i]);
			imageElement.id = i + "_" + event.target.files[i].name;
		}
	}
};
</script>

<script src="https://cdn.tiny.cloud/1/ut4vvakp46lgqitx677n89tmbc8aass9rt0bxmn3hei2mgnb/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
  <script>
    tinymce.init({
      selector: 'textarea',
      plugins: 'autolink lists',
      toolbar: 'undo redo |  formatselect | fontsizeselect | bold italic underline forecolor  | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | table | removeformat',
      toolbar_mode: 'floating',
   });
  </script>


  <!-- Main Container -->
  <main id="main-container">
    <!-- Page Content -->
    <div class="content">
      <!--table-->
      <div class="block table-responsive">
        <div class="block-header block-header-default">
          <h3 class="block-title">Update Daily Special</h3>
        </div>
        <div class="block-content">

          <div class="card-body">
            <form action="daily_special_update" method="POST" enctype="multipart/form-data">
              <input type="hidden" name="tc" value="<?php echo $row['total_quantity'] ?>" />
            <input type="hidden" name="id" value="<?php echo Encryption::encode($row["shop_id"]) ?>" />
            <input type="hidden" name="id2" value="<?php echo Encryption::encode($row["product_id"]) ?>" />
              <div class="row">
                  <div class="col-md-12">
                      <div class="form-group">
                      <label class="bmd-label-floating">Store Name</label>
                      <input type="text" class="form-control" name="shop_name" value="<?php echo $row['shop_name'] ?>" />
                      </div>
                  </div>
              </div>
              <div class="row">
                  <div class="col-md-12">
                      <div class="form-group">
                      <label class="bmd-label-floating">Product Name</label>
                      <input type="text" class="form-control" name="product_name" value="<?php echo $row['product_name'] ?>"  />
                      </div>
                  </div>
              </div>
              <div class="row">
                  <div class="col-md-12">
                      <div class="form-group">
                      <label class="bmd-label-floating">Product Type</label>
                      <select class="form-control" required name="product_type">
                          <option value="Product" <?php if(@$row['product_type']=='Product') { echo 'selected'; } ?>>Product</option>
                          <option value="Cash Voucher" <?php if(@$row['product_type']=='Cash Voucher') { echo 'selected'; } ?>>Cash Voucher</option>
                      </select>
                      </div>
                  </div>
              </div>
              <div class="row">
                  <div class="col-md-12">
                      <div class="form-group">
                          <label class="bmd-label-floating">Order Index</label>
                          <input type="text" class="form-control" name="order_index"  value="<?php echo $row['order_index'] ?>"  />
                      </div>
                  </div>
              </div>
              <div class="row">
                  <div class="col-md-12">
                      <div class="form-group">
                      <input type="checkbox" name="accept_special_instruction" value=1 <?php if(@$row['accept_special_instruction']=='1') { echo 'checked'; } ?>> Accept Special Instruction
                      </div>
                  </div>
              </div>
              <div class="row">
                  <div class="col-md-12">
                      <div class="form-group">
                          <label class="bmd-label-floating">Price</label>
                          <input type="text" class="form-control" name="price"  value="<?php echo $row['price'] ?>"  />
                      </div>
                  </div>
              </div>
              <div class="row">
                  <div class="col-md-12">
                      <div class="form-group">
                          <label class="bmd-label-floating">Usual Price</label>
                          <input type="text" class="form-control" name="usual_price"  value="<?php echo $row['usual_price'] ?>"  />
                      </div>
                  </div>
              </div>
              <div class="row">
                  <div class="col-md-12">
                      <div class="form-group">
                          <label class="bmd-label-floating">Keyword Search</label>
                          <input type="text" class="form-control" name="product_keyword" value="<?php echo $row['product_keyword'] ?>"  />
                      </div>
                  </div>
              </div>
              <div class="row">
                  <div class="col-md-12">
                      <div class="form-group">
                          <label class="bmd-label-floating">Quantity</label>
                          <input type="number" class="form-control" name="total_quantity" value="<?php echo $row['total_quantity'] ?>" />
                      </div>
                  </div>
              </div>
              <div class="row">
                  <div class="col-md-3">
                      <div class="form-group">
                          <h5>Fulfilment Option</h5>
                          <input type="checkbox" name="fufilment_delivery" value=1 <?php if(@$row['fufilment_delivery']=='1') { echo 'checked'; } ?>> Delivery<br/>
                          <input type="checkbox" name="fufilment_pickup" value=1 <?php if(@$row['fufilment_pickup']=='1') { echo 'checked'; } ?>> Pickup<br/>
                          <input type="checkbox" name="fufilment_postage" value=1 <?php if(@$row['fufilment_postage']=='1') { echo 'checked'; } ?>> Postage<br/>
                      </div>
                  </div>
                  <div class="col-md-3">
                      <div class="form-group">
                          <br/><br/>
                          <select class="form-control" name="fufilment_type_option">
                          <option value="" <?php if(@$row['fufilment_type_option']=='') { echo 'selected'; } ?>>None</option>
                              <option value="By Appointment e-Voucher" <?php if(@$row['fufilment_type_option']=='By Appointment e-Voucher') { echo 'selected'; } ?>>By Appointment e-Voucher</option>
                              <option value="Dine in/Takeaway e-Voucher" <?php if(@$row['fufilment_type_option']=='Dine in/Takeaway e-Voucher') { echo 'selected'; } ?>>Dine in/Takeaway e-Voucher</option>
                              <option value="By Appointment Coupon" <?php if(@$row['fufilment_type_option']=='By Appointment Coupon') { echo 'selected'; } ?>>By Appointment Coupon</option>
                              <option value="Dine in/Takeaway Coupon" <?php if(@$row['fufilment_type_option']=='Dine in/Takeaway Coupon') { echo 'selected'; } ?>>Dine in/Takeaway Coupon</option>
                          </select>
                      </div>
                  </div>
                  <div class="col-md-3">
                      <br/><br/>
                      <div class="form-group">
                          <select class="form-control" name="fufilment_cash_option">
                          <option value="" <?php if(@$row['fufilment_cash_option']=='') { echo 'selected'; } ?>>None</option>
                              <option value="Cash Coupon" <?php if(@$row['fufilment_cash_option']=='Cash Coupon') { echo 'selected'; } ?>>Cash Coupon</option>
                              <option value="Cash e-Voucher" <?php if(@$row['fufilment_cash_option']=='Cash e-Voucher') { echo 'selected'; } ?>>Cash e-Voucher</option>
                          </select>
                      </div>
                  </div>
              </div>
              <div class="row">
                  <div class="col-md-12">
                      <h5>Fulfilment displayed on Store front</h5>
                  </div>
              </div>
              <div class="row">
                  <div class="col-md-3">
                      <div class="form-group">
                          <input type="checkbox" name="display_fufilment_delivery" value=1 <?php if(@$row['display_fufilment_delivery']=='1') { echo 'checked'; } ?>> Delivery<br/>
                          <input type="checkbox" name="display_fufilment_pickup" value=1 <?php if(@$row['display_fufilment_pickup']=='1') { echo 'checked'; } ?>> Pickup<br/>
                          <input type="checkbox" name="display_fufilment_postage" value=1 <?php if(@$row['display_fufilment_postage']=='1') { echo 'checked'; } ?>> Postage<br/>
                      </div>
                  </div>
                  <div class="col-md-3">
                      <div class="form-group">
                      <input type="checkbox" name="display_fufilment_dinein" value=1 <?php if(@$row['display_fufilment_dinein']=='1') { echo 'checked'; } ?>> Dine in<br/>
                          <input type="checkbox" name="display_fufilment_takeaway" value=1 <?php if(@$row['display_fufilment_takeaway']=='1') { echo 'checked'; } ?>> Takeaway<br/>
                          <input type="checkbox" name="display_fufilment_appointment" value=1 <?php if(@$row['display_fufilment_appointment']=='1') { echo 'checked'; } ?>> By Appointment<br/>
                      </div>
                  </div>
              </div>
              <br/><br/>
              <div class="row">
                  <div class="col-md-6">
                      <div class="form-group">
                          <b>Delivery Times</b><br/>
                          <select name="delivery_time[]" multiple="multiple" class="deliverytimes form-control">
                              <option value="11.30am - 1.30pm" <?php if(@$del_time[0]=='11.30am - 1.30pm' || @$del_time[1]=='11.30am - 1.30pm' || @$del_time[2]=='11.30am - 1.30pm') { echo 'selected'; } ?>>11.30am - 1.30pm</option>
    							<option value="3pm - 8pm" <?php if(@$del_time[0]=='3pm - 8pm' || @$del_time[1]=='3pm - 8pm' || @$del_time[2]=='3pm - 8pm') { echo 'selected'; } ?>>3pm - 8pm</option>
   							<option value="5.30pm - 7.30pm" <?php if(@$del_time[0]=='5.30pm - 7.30pm' || @$del_time[1]=='5.30pm - 7.30pm' || @$del_time[2]=='5.30pm - 7.30pm') { echo 'selected'; } ?>>5.30pm - 7.30pm</option>
                      </select>
                      </div>
                  </div>
                  <div class="col-md-6">
                      <div class="form-group">
                      <b>Pickup Times</b><br/>
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
                      </div>
                  </div>
              </div>

              <div class="row">
                  <div class="col-md-6">
                      <div class="form-group">
                          <b>Lead Times</b>
                          <select class="form-control" name="delivery_leadtime" id="delivery_leadtime">
                              <option value="">Select options</option>
                              <option value="1" <?php if(@$row['delivery_leadtime']=='1') { echo 'selected'; } ?>>1 day</option>
                              <option value="2" <?php if(@$row['delivery_leadtime']=='2') { echo 'selected'; } ?>>2 days</option>
                              <option value="3" <?php if(@$row['delivery_leadtime']=='3') { echo 'selected'; } ?>>3 days</option>
                              <option value="4" <?php if(@$row['delivery_leadtime']=='4') { echo 'selected'; } ?>>4 days</option>
                          </select>
                      </div>
                  </div>
                  <div class="col-md-6">
                      <div class="form-group">
                      <b>Lead Times</b>
                          <select class="form-control" name="pickup_leadtime" id="pickup_leadtime">
                              <option value="">Select options</option>
                              <option value="1" <?php if(@$row['pickup_leadtime']=='1') { echo 'selected'; } ?>>1 day</option>
                              <option value="2" <?php if(@$row['pickup_leadtime']=='2') { echo 'selected'; } ?>>2 days</option>
                              <option value="3" <?php if(@$row['pickup_leadtime']=='3') { echo 'selected'; } ?>>3 days</option>
                              <option value="4" <?php if(@$row['pickup_leadtime']=='4') { echo 'selected'; } ?>>4 days</option>
                          </select>
                      </div>
                  </div>
              </div>
              <div class="row">
                  <div class="col-md-6">
                      <div class="form-group">
                          <b>Select Delivery Date</b>
                          <input type="text" class="form-control" id="datepicker" name="delivery_date" value="<?php echo $del_date ?>" />
                      </div>
                  </div>
                  <div class="col-md-6">
                      <div class="form-group">
                      <b>Select Dates</b>
                      <input type="text" class="form-control" id="datepicker2" name="pickup_date" value="<?php echo $pic_date ?>"></p>
                      </div>
                  </div>
              </div>

              <!--<div class="row">
                  <div class="col-md-6">
                  </div>
                  <div class="col-md-6">
                      <div class="form-group">
                      <b>Pickup Location (separated by comma)</b>
                      <input type="text" class="form-control" name="pickup_location" value="<?php echo $row['pickup_location'] ?>"></p>
                      </div>
                  </div>
              </div>-->

              <div class="row">
                  <div class="col-md-12">
                      <div class="form-group">
                      <b>Go Live Date</b>
                      <input type="text" class="form-control" id="datepicker3" name="golive" value="<?php echo $row['golive'] ?>"></p>
                      </div>
                  </div>
              </div>

              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="bmd-label-floating">Similar Products</label>

                    <!--<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
                    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
                    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/css/bootstrap-tokenfield.min.css">
                    <!-- JS Files -->
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/bootstrap-tokenfield.js"></script>

                  <input type="text" class="form-control" name="similar_products" id="tokenfield"  value="<?php echo $row['product_similar'] ?>" />

                  <script type="text/javascript">
                    $('#tokenfield').tokenfield({
                      autocomplete: {
                        source: function (request, response) {
                            jQuery.get("similar_products", {
                                query: request.term
                            }, function (data) {
                                data = $.parseJSON(data);
                                response(data);
                            });
                        },
                        delay: 100
                      },
                      showAutocompleteOnFocus: true
                    });
                  </script>
                  </div>
                </div>
              </div>

              <br/><br/>
              <div class="row">
              <div class="col-md-12">
                  <div class="form-group">
                      <label class="bmd-label-floating">Active Status</label>
                      <select class="form-control" required name="active_status">
                          <option value="1" <?php if(@$row['active_status']=='1') { echo 'selected'; } ?>>Active</option>
                          <option value="2" <?php if(@$row['active_status']=='2') { echo 'selected'; } ?>>Disabled</option>
                      </select>
                  </div>
              </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="bmd-label-floating">Description</label>
                    <textarea rows="10" id="shopLocation" name="product_description"><?php echo $row['product_description'] ?></textarea>
                  </div>
                </div>
              </div>
              <br/><br/>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="bmd-label-floating">Product Terms and Condition</label>
                    <textarea rows="10" id="shopLocation" name="product_tc"><?php echo $row['product_tc'] ?></textarea>
                  </div>
                </div>
              </div>

              <br/><br/>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="bmd-label-floating">Upload Cover Image (Image only accept image resolution of 800px Width x 500px Height)</label>
                    <input type="file" id="fCover" name="fCover" class="form-control" style="padding: 5px 5px 5px 5px;" accept="image/jpeg,image/png" onchange="loadFile(event)" />
                    <ul id="image_placeholder" style="list-style: none;"></ul>
                    <input type="hidden" name="product_image" value="<?php echo $row['product_image'] ?>" />
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
  $.fn.datepicker = bootstrapDP;
  $("#delivery_leadtime").on("change", function(e) {
    $('#datepicker').datepicker("setStartDate", `+${e.target.value}d`)
  })
  $("#pickup_leadtime").on("change", function(e) {
    $('#datepicker2').datepicker("setStartDate", `+${e.target.value}d`)
  })

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


  $("#button").html('<button type="submit" class="btn btn-success mr-5 mb-5" id="submit_data"><i class="fa fa-check mr-5"></i>Save</button> <a class="btn btn-info mr-5 mb-5" href="product.php"><i class="si si-arrow-left mr-5"></i>Back</a>');
  $('#submit_data').click(function(){
    $('#form_simpan').submit();
    $("#results").html('<i class="fa fa-4x fa-cog fa-spin text-success"></i>');
  });
  $('#form_simpan').on('submit', function(event){
    $("#results").html('<i class="fa fa-4x fa-cog fa-spin text-success"></i>');
    event.preventDefault();
    $.ajax({
      url:"shop_update",
      method:"POST",
      data:new FormData(this),
      contentType:false,
      processData:false,
      success:function(data){
        $('#results').html(data);
        $('#submit_data').val('');
        $("#button").html('<button type="submit" class="btn btn-success mr-5 mb-5" id="submit_data"><i class="fa fa-check mr-5"></i>Save</button> <a class="btn btn-info mr-5 mb-5" href="product.php"><i class="si si-arrow-left mr-5"></i>Back</a>');
      }
    });
  });
});
</script>
