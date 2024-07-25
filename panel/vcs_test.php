<?php 
require_once 'header.php';
?>
<!-- Main Container -->
<main id="main-container">
  <!-- Page Content -->
  <div class="content">
    <script src="../assets/js/html5-qrcode.min.js"></script>
    <div id="reader"></div>
    <form action="vcs_add" id="form" method="POST">
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <video id="preview" style="width: 100%;"></video>
            <input type="text" class="form-control" name="vcs_code" id="vcs_code" readonly />
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
<script>
/* function onScanSuccess(decodedText, decodedResult) {
    // Handle on success condition with the decoded text or result.
    console.log(`Scan result: ${decodedText}`, decodedResult);
}*/

var html5QrcodeScanner = new Html5QrcodeScanner(
	"reader", { fps: 10, qrbox: 250 });
html5QrcodeScanner.render(onScanSuccess);

var html5QrcodeScanner = new Html5QrcodeScanner(
    "reader", { fps: 10, qrbox: 250 });
        
function onScanSuccess(decodedText, decodedResult) {
    // Handle on success condition with the decoded text or result.
    console.log(`Scan result: ${decodedText}`, decodedResult);
    var lokasi = `${decodedText}`.toString();
    document.getElementById('vcs_code').value = lokasi;
    document.getElementById("vcs_code").focus();
    // ...
    html5QrcodeScanner.clear();
    // ^ this will stop the scanner (video feed) and clear the scan area.
}

/*
html5QrcodeScanner.render(onScanSuccess);

function onScanSuccess(decodedText, decodedResult) {
    // Handle on success condition with the decoded text or result.
    console.log(`Scan result: ${decodedText}`, decodedResult);
}
*/

function onScanError(errorMessage) {
    // handle on error condition, with error message
}
/*
var html5QrcodeScanner = new Html5QrcodeScanner(
    "reader", { fps: 10, qrbox: 250 });
html5QrcodeScanner.render(onScanSuccess, onScanError);
*/
</script>

<script>
  $(document).ready(function() {
  document.getElementById("vcs_code").onfocus = function() {
    document.getElementById("form").submit();
};
});
</script>