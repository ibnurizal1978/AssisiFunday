<?php 
require_once 'header.php';
?>
<script type="application/javascript">
/*
function resizeIFrameToFitContent( iFrame ) {

    iFrame.width  = iFrame.contentWindow.document.body.scrollWidth;
    iFrame.height = iFrame.contentWindow.document.body.scrollHeight;
}

window.addEventListener('DOMContentLoaded', function(e) {

    var iFrame = document.getElementById( 'iFrame1' );
    resizeIFrameToFitContent( iFrame );

    // or, to resize all iframes:
    var iframes = document.querySelectorAll("iframe");
    for( var i = 0; i < iframes.length; i++) {
        resizeIFrameToFitContent( iframes[i] );
    }
} );
*/
</script>
<!--<iframe src="http://localhost:8080/Assisi_funday/vcs_scan.jsp" style="height: 500px; width:100%; border:0px solid"></iframe>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/html5-qrcode/2.0.3/html5-qrcode.min.js"></script>
    <div id="reader"></div>
    <!--<form action="https://35.186.149.64:444/assisifunday/panel/vcs_add" id="form" method="POST">-->
    <form action="vcs_verification" id="form" method="POST">
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
    console.log('Scan result:'+decodedText, decodedResult);
    var lokasi = decodedText.toString();
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