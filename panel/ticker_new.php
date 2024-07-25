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
        multidate: false,
        format: "yyyy-mm-dd",
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
    <div class="block table-responsive">
      <div class="block-header block-header-default">
        <h3 class="block-title">New Event</h3>
      </div>
      <div class="block-content">
                
        <div class="card-body">
          <form action="ticker_add" method=POST>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                    <label class="bmd-label-floating">Content</label>
                    <input type="text" class="form-control" name="content" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                    <label class="bmd-label-floating">URL</label>
                    <input type="text" class="form-control" name="url" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                    <label class="bmd-label-floating">Event Date</label>
                    <input type="text" class="form-control" id="datepicker" name="live_date" />
                    </div>
                </div>
            </div>

            <div class="pull-right">
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


