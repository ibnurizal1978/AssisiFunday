<?php
require_once 'header.php';
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

    $('#datepicker3').datepicker({
        startDate: new Date(),
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
      plugins: ' autolink lists',
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
        <h3 class="block-title">New Daily Special</h3>
      </div>
      <div class="block-content">

        <div class="card-body">
          <form action="daily_special_add" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                    <label class="bmd-label-floating">Store Name</label>
                    <input type="text" class="form-control" name="shop_name" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                    <label class="bmd-label-floating">Product Name</label>
                    <input type="text" class="form-control" name="product_name" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                    <label class="bmd-label-floating">Product Type</label>
                    <select class="form-control" required name="product_type">
                        <option value="Product">Product</option>
                        <option value="Cash Voucher">Cash Voucher</option>
                    </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="bmd-label-floating">Order Index</label>
                        <input type="text" class="form-control" name="order_index" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                    <input type="checkbox" name="accept_special_instruction" value=1> Accept Special Instruction
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="bmd-label-floating">Price</label>
                        <input type="text" class="form-control" name="price" value="0.00" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="bmd-label-floating">Usual Price</label>
                        <input type="text" class="form-control" name="usual_price" value="0.00" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="bmd-label-floating">Keyword Search</label>
                        <input type="text" class="form-control" name="product_keyword" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="bmd-label-floating">Quantity</label>
                        <input type="number" class="form-control" name="total_quantity" value="0" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <h5>Fulfilment Option</h5>
                        <input type="checkbox" name="fufilment_delivery" value=1> Delivery<br/>
                        <input type="checkbox" name="fufilment_pickup" value=1> Pickup<br/>
                        <input type="checkbox" name="fufilment_postage" value=1> Postage<br/>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <br/><br/>
                        <select class="form-control" name="fufilment_type_option">
                            <option value="">None</option>
                            <option value="By Appointment e-Voucher">By Appointment e-Voucher</option>
                            <option value="Dine in/Takeaway e-Voucher">Dine in/Takeaway e-Voucher</option>
                            <option value="By Appointment Coupon">By Appointment Coupon</option>
                            <option value="Dine in/Takeaway Coupon">Dine in/Takeaway Coupon</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <br/><br/>
                    <div class="form-group">
                        <select class="form-control" name="fufilment_cash_option">
                            <option value="">None</option>
                            <option value="Cash Coupon">Cash Coupon</option>
                            <option value="Cash e-Voucher">Cash e-Voucher</option>
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
                        <input type="checkbox" name="display_fufilment_delivery" value=1> Delivery<br/>
                        <input type="checkbox" name="display_fufilment_pickup" value=1> Pickup<br/>
                        <input type="checkbox" name="display_fufilment_postage" value=1> Postage<br/>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <input type="checkbox" name="display_fufilment_dinein" value=1> Dine in<br/>
                        <input type="checkbox" name="display_fufilment_takeaway" value=1> Takeaway<br/>
                        <input type="checkbox" name="display_fufilment_appointment" value=1> By Appointment<br/>
                    </div>
                </div>
            </div>
            <br/><br/>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <b>Delivery Times</b><br/>
                        <select name="delivery_time[]" multiple="multiple" class="deliverytimes form-control">
                            <option value="11.30am - 1.30pm">11.30am - 1.30pm</option>
  							<option value="3pm - 8pm">3pm - 8pm</option>
 							<option value="5.30pm - 7.30pm">5.30pm - 7.30pm</option>
                    </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    <b>Pickup Times</b><br/>
                    <select name="pickup_time[]" multiple="multiple" class="pickuptimes form-control">
                        <option value="7am - 8am">7am - 8am</option>
                        <option value="8am - 9am">8am - 9am</option>
                        <option value="9am - 10am">9am - 10am</option>
                        <option value="10am - 11am">10am - 11am</option>
                        <option value="11am - 12pm">11am - 12pm</option>
                        <option value="12pm - 1pm">12pm - 1pm</option>
                        <option value="1pm - 2pm">1pm - 2pm</option>
                        <option value="2pm - 3pm">2pm - 3pm</option>
                        <option value="3pm - 4pm">3pm - 4pm</option>
                        <option value="4pm - 5pm">4pm - 5pm</option>
                        <option value="5pm - 6pm">5pm - 6pm</option>
                        <option value="6pm - 7pm">6pm - 7pm</option>
                        <option value="7pm - 8pm">7pm - 8pm</option>
                        <option value="8pm - 9pm">8pm - 9pm</option>
                        <option value="9pm - 10pm">9pm - 10pm</option>
                    </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <b>Lead Times</b>
                        <select class="form-control" name="delivery_leadtime">
                            <option value="">Select options</option>
                            <option value="1">1 day</option>
                            <option value="2">2 days</option>
                            <option value="3">3 days</option>
                            <option value="4">4 days</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    <b>Lead Times</b>
                        <select class="form-control" name="pickup_leadtime">
                            <option value="">Select options</option>
                            <option value="1">1 day</option>
                            <option value="2">2 days</option>
                            <option value="3">3 days</option>
                            <option value="4">4 days</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <b>Select Delivery Date</b>
                        <input type="text" class="form-control" id="datepicker" name="delivery_date" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    <b>Select Dates</b>
                    <input type="text" class="form-control" id="datepicker2" name="pickup_date"></p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    <b>Pickup Location (separated by comma)</b>
                    <input type="text" class="form-control" name="pickup_location"></p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                    <b>Go Live Date</b>
                    <input type="text" class="form-control" id="datepicker3" name="golive"></p>
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

                <input type="text" class="form-control" name="similar_products" id="tokenfield" />

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
                  <label class="bmd-label-floating">Description</label>
                  <textarea rows="10" id="shopLocation" name="product_description"></textarea>
                </div>
              </div>
            </div>
            <br/><br/>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label class="bmd-label-floating">Product Terms and Condition</label>
                  <textarea rows="10" id="shopLocation" name="product_tc"></textarea>
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
      url:"shop_add",
      method:"POST",
      data:new FormData(this),
      contentType:false,
      processData:false,
      success:function(data){
        $('#results').html(data);
        $('#submit_data').val('');
       // $("#button").html('<button type="submit" class="btn btn-success mr-5 mb-5" id="submit_data"><i class="fa fa-check mr-5"></i>Save</button>');
      }
    });
  });
});
</script>
