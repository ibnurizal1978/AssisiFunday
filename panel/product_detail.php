<?php
require_once 'header.php';

$id  = Encryption::decode($param[1]);
$sql = "SELECT * FROM tbl_product WHERE product_id= '".$id."' LIMIT 1";
$h = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($h);
?>
<link rel="stylesheet" href="../assets/css/jquery.multiselect.css" />
<script src="../assets/js/plugins/tinymce/tinymce.min.js"></script>
<script src="../assets/js/multiselect-dropdown.js" ></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
  <link rel="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" />
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

<script>
/*$(document).ready(function() {
    var $j = jQuery.noConflict();
    $j('#datepicker').datepicker({
        startDate: new Date(),
        multidate: true,
        format: "dd/mm/yyyy",
        daysOfWeekHighlighted: "5,6",
        datesDisabled: ['31/08/2017'],
        language: 'en'
    }).on('changeDate', function(e) {
        // `e` here contains the extra attributes
        $(this).find('.input-group-addon .count').text(' ' + e.dates.length);
    });
});*/
</script>


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
				if(this.width ==300 && this.height == 300)
				{
					check = true;

				}

				if(check == false)
				{
					$("#icon").val("");
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
      menubar: false,
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
        <h3 class="block-title">Update Product</h3>
      </div>
      <div class="block-content">

        <div class="card-body">
          <form action="product_update" method=POST enctype="multipart/form-data">
            <input type="hidden" name="tc" value="<?php echo $row['total_quantity'] ?>" />
          <input type="hidden" name="id" value="<?php echo Encryption::encode($row["product_id"]) ?>" />
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                    <label class="bmd-label-floating">Product Name</label>
                    <input type="text" class="form-control" name="product_name" value="<?php echo $row['product_name'] ?>" />
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
                    <label class="bmd-label-floating">Shop</label>
                    <select class="form-control" name="shop_id">
                        <?php
                        $sql1 = "SELECT shop_id, shop_name FROM tbl_shop ORDER BY shop_name";
                        $h1 = mysqli_query($conn, $sql1);
                        while($row1 = mysqli_fetch_assoc($h1)) {
                            if($row['shop_id'] == $row1['shop_id']) {
                        ?>
                            <option value="<?php echo $row1['shop_id'] ?>" selected><?php echo $row1['shop_name'] ?></option>
                        <?php }else{ ?>
                            <option value="<?php echo $row1['shop_id'] ?>"><?php echo $row1['shop_name'] ?></option>
                        <?php }} ?>
                    </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="bmd-label-floating">Order Index</label>
                        <input type="text" class="form-control" name="order_index" value="<?php echo $row['order_index'] ?>" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                    <input type="checkbox" name="accept_special_instruction" value=1 <?php if(@$row['accept_special_instruction']=='1') { echo 'checked'; } ?>> Accept Special Instruction
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="checkbox" name="mandatory_pickup_location" value=1 <?php if(@$row['mandatory_pickup_location']=='1') { echo 'checked'; } ?>> Mandatory Pickup Location
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="bmd-label-floating">Price</label>
                        <input type="text" class="form-control" name="price" value="<?php echo $row['price'] ?>" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="bmd-label-floating">Usual Price</label>
                        <input type="text" class="form-control" name="usual_price" value="<?php echo $row['usual_price'] ?>" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="bmd-label-floating">Keyword Search</label>
                        <input type="text" class="form-control" name="product_keyword" value="<?php echo $row['product_keyword'] ?>" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="bmd-label-floating">Quantity</label>
                        <input type="text" class="form-control" name="total_quantity" value="<?php echo $row['total_quantity'] ?>" />
                    </div>
                </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                    <label class="bmd-label-floating">Highlight Status</label>
                    <select class="form-control" required name="highlight_status">
                        <option value="1" <?php if(@$row['highlight_status']=='1') { echo 'selected'; } ?>>Yes</option>
                        <option value="2" <?php if(@$row['highlight_status']=='2') { echo 'selected'; } ?>>No</option>
                    </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                    <label class="bmd-label-floating">Sell for Good?</label>
                    <select class="form-control" required name="sell_for_good">
                        <option value="1" <?php if(@$row['sell_for_good']=='1') { echo 'selected'; } ?>>Yes</option>
                        <option value="0" <?php if(@$row['sell_for_good']=='0') { echo 'selected'; } ?>>No</option>
                    </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                    <label class="bmd-label-floating">Active Status</label>
                    <select class="form-control" required name="active_status">
                        <option value="1" <?php if(@$row['active_status']=='1') { echo 'selected'; } ?>>Active</option>
                        <option value="0" <?php if(@$row['active_status']=='0') { echo 'selected'; } ?>>Disabled</option>
                    </select>
                </div>
              </div>
            </div>

            <br/><br/>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label class="bmd-label-floating">Product Description</label>
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
                  <label class="bmd-label-floating">Similar Products</label>

                  <!--<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
                  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
                  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/css/bootstrap-tokenfield.min.css">
                  <!-- JS Files -->
                  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
                  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
                  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/bootstrap-tokenfield.js"></script>

                <input type="text" class="form-control" name="similar_products" id="tokenfield" value="<?php echo $row['product_similar'] ?>" />

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

            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label class="bmd-label-floating">Upload Cover Image</label>
                  <input type="file" id="fCover" name="fCover" class="form-control" style="padding: 5px 5px 5px 5px;" accept="image/jpeg,image/png" onchange="loadFile(event)" />
                  <br/>Image only accept resolution of 800px (Width) x 500px (Height)
                  <ul id="icon_placeholder" style="list-style: none;"></ul>
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
