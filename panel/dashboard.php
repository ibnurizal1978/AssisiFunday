<?php 
require_once 'header.php';

$s = "SELECT count(*),date_format(a.created_at, '%d-%m-%Y') as date, sum(a.qty) as total FROM tbl_order_detail a INNER JOIN tbl_order b ON a.order_code=b.order_code WHERE a.shop_id = '".$_SESSION['shop_id']."' AND b.order_status = 'COMPLETED' GROUP BY date(a.created_at)";
$h = mysqli_query($conn, $s);
$total = 0 ;
$date = date("d-m-Y ");
$source = '';
while($r = mysqli_fetch_assoc($h)) {
    $source .= "['".$r['date']."',".$r['total'].", ".$r['count(*)']."],";
}
$date = substr($date,0,-1);
$total = substr($total,0,-1); 
// echo $total;
 $source =  substr($source,0,-1);
?>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        <?php if($source != null) {?>
            var data = google.visualization.arrayToDataTable([
                ['Date', 'Sales Amount', 'Sales Count'],
                <?php echo $source ?>
            ]);
        <?php }else {?>
            var data = new google.visualization.DataTable();
            data.addColumn({ type: 'string', label: 'Date'});
            data.addColumn({ type: 'number', label: 'Sales Amount', role: 'annotation'});
            data.addRows([
            <?php echo "['".$date."',0]" ?>
        ]);
        <?php }?>

        var options = {
          title: 'Break Down of Sale Transaction (Group by Date)',
          curveType: 'function',
          legend: { position: 'bottom' },
          interpolateNulls : true
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
    </script>


<!-- Main Container -->
<main id="main-container">
    <!-- Page Content -->
    <div class="content">
    
        <div class="block table-responsive">
            <div class="block-content">
                <div class="block">
                    <div class="block-content block-content-full">
                        <div class="row">
                            <div class="col-lg-12">
                                <div id="curve_chart" style="width: 100%; height: 500px"></div>
                                <?php if($source == null) {?>
                                    <h5 style="text-align:center;color:red;">There is no sales transaction yet.</h5>
                                <?php }?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <table width="100%" cellpadding=10 border=1>
                                    <tr style="background:#bec9b9">
                                        <td colspan="2" align=center><h3>Top Transaction Count By Shop</h3></td>
                                    </tr>
                                    <tr style="background:#bec9b9">
                                        <td width="70%"><b>Shop Name</b></td><td><b>Transaction Count</b></td>
                                    </tr>
                                    <?php
                                    // $s1 = "SELECT shop_name, sum(qty) as total FROM tbl_salestransaction a INNER JOIN tbl_shop b ON a.shopID = b.shopID WHERE cart_status = 'COMPLETED' AND a.shopID =  '".$_SESSION['companyID']."' GROUP BY a.shopID ORDER BY shop_name";
                                    $s1 = "SELECT b.shop_name, sum(a.qty) as total FROM tbl_order_detail a INNER JOIN tbl_shop b ON a.shop_id = b.shop_id INNER JOIN tbl_order c ON a.order_code=c.order_code WHERE c.order_status = 'COMPLETED' AND a.shop_id =  '".$_SESSION['shop_id']."' GROUP BY a.shop_id ORDER BY b.shop_name";
                                    $h1 = mysqli_query($conn, $s1);
                                    while($r1 = mysqli_fetch_assoc($h1)) {
                                    ?>
                                    <tr>
                                        <td><?php echo $r1['shop_name'] ?></td><td><?php echo $r1['total'] ?></td>
                                    </tr>
                                    <?php } ?>
                                </table>
                            </div>
                            <div class="col-lg-6">
                                <table width="100%" cellpadding=10 border=1>
                                    <tr style="background:#d4c3db">
                                        <td colspan="2" align=center><h3>Top Transaction Count By Product</h3></td>
                                    </tr>
                                    <tr style="background:#d4c3db">
                                        <td width="70%"><b>Product Name</b></td><td><b>Qty Sold</b></td>
                                    </tr>
                                    <?php
                                    // $s1 = "SELECT product_name, sum(qty) as total FROM tbl_salestransaction  WHERE cart_status = 'COMPLETED'  AND shopID = '".$_SESSION['companyID']."' GROUP BY product_id ORDER BY product_name";
                                    $s1 = "SELECT a.product_name, sum(a.qty) as total FROM tbl_order_detail a INNER JOIN tbl_order b ON a.order_code=b.order_code WHERE b.order_status = 'COMPLETED' AND a.shop_id =  '".$_SESSION['shop_id']."' GROUP BY a.product_id ORDER BY a.product_name";
                                    $h1 = mysqli_query($conn, $s1);
                                    while($r1 = mysqli_fetch_assoc($h1)) {
                                    ?>
                                    <tr>
                                        <td><?php echo $r1['product_name'] ?></td><td><?php echo $r1['total'] ?></td>
                                    </tr>
                                    <?php } ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Page Content -->
</main>
<!-- END Main Container -->
<?php require_once 'footer.php' ?>