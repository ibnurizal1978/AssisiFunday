<?php
require_once 'header.php';
//require_once 'components.php';

$s = "SELECT count(*),date_format(a.created_at, '%d-%m-%Y') as date, sum(a.qty) as total FROM tbl_order_detail a INNER JOIN tbl_order b ON a.order_code=b.order_code AND (b.order_status = 'COMPLETED' or b.order_status='COMFIRM') GROUP BY date(a.created_at)";
//echo '<font color=#fff>'.$s.'</font>';
$h = mysqli_query($conn, $s);
$total = 0;
$date = date("d-m-Y ");
$source = "";
while($r = mysqli_fetch_assoc($h)) {
    $source .= "['".$r['date']."',".$r['total'].", ".$r['count(*)']."],";
   // $date .= $r['date'].',';
   // $total .= $r['total'].',';
}
$date = substr($date,0,-1);
$total = substr($total,0,-1);
//echo $total;
$source =  substr($source,0,-1);

//get the total sales
$sqlTotalSales = "SELECT sum(a.sub_total) as total FROM tbl_order_detail a INNER JOIN tbl_order b ON a.order_code=b.order_code WHERE b.order_status='COMPLETED'";
$query = mysqli_query($conn, $sqlTotalSales);

$totalSales = mysqli_fetch_assoc($query);
$sqlTotalCount = "SELECT count(*) as total FROM tbl_order_detail a INNER JOIN tbl_order b ON a.order_code=b.order_code and b.order_status='COMPLETED'";
$query2 = mysqli_query($conn, $sqlTotalCount);
$totalCount = mysqli_fetch_assoc($query2);

$sqlRegisteredCount = "SELECT count(*) as total FROM tbl_user";
$query3 = mysqli_query($conn, $sqlRegisteredCount);
$registeredCount = mysqli_fetch_assoc($query3);

mysqli_free_result($h);
mysqli_free_result($query);
mysqli_free_result($query2);
mysqli_free_result($query3);

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
          legend: { position: 'bottom' }
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
                            </div>
                            <?php if($source == null) {?>
                                <h5 style="text-align:center;color:red;">There is no sales transaction yet.</h5>
                            <?php }?>
                        </div>
                        <div class="row" style="text-align:center; margin-bottom:20px;">
                            <div class="col-lg-3"></div>
                            <div class="col-lg-6">
                                <table width="100%" cellpadding=10 border=1>
                                    <tr style="background:#f0f7c9">
                                        <td width="30%">
                                            <b>Total Sales&nbsp;&nbsp;<i class="fa fa-money"></i>&nbsp;</b>
                                        </td>
                                        <td>
                                            <b>Total Transaction Count&nbsp;&nbsp;<i class="fa fa-laptop"></i>&nbsp;</b>
                                        </td>
                                        <td>
                                            <b>Register Users&nbsp;&nbsp;<i class="fa fa-user"></i>&nbsp;</b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><?php echo $totalSales['total']; ?></td><td><?php echo $totalCount['total']; ?></td><td><?php echo $registeredCount['total']; ?></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-lg-3"></div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <table width="100%" cellpadding=10 border=1>
                                    <tr style="background:#bec9b9">
                                        <td colspan="3" align=center><h3>Top Transaction Count By Shop</h3></td>
                                    </tr>
                                    <tr style="background:#bec9b9">
                                        <td width="70%"><b>Shop Name</b></td><td><b>Transaction Count</b></td><td><b>Sales Amount</b></td>
                                    </tr>
                                    <?php
                                    //$s1 = "SELECT count(*),b.shop_name,sum(a.sub_total) FROM tbl_order_detail a INNER JOIN tbl_order_shop b ON a.order_code = b.order_code INNER JOIN tbl_order c ON b.order_code = c.order_code WHERE (c.order_status = 'COMPLETED' or c.order_status='COMFIRM')  group by a.shop_id order by count(*) desc limit 10";
                                    //$s1 = "SELECT count(*),a.shop_name,sum(b.sub_total) FROM tbl_order_shop a INNER JOIN tbl_order_detail b ON a.order_code = b.order_code INNER JOIN tbl_order c ON a.order_code = c.order_code WHERE (c.order_status = 'COMPLETED' or c.order_status='COMFIRM') group by a.shop_id order by count(*) desc limit 10";
                                    $s1 = "SELECT shop_id,count(*),sum(detail.sub_total) FROM `tbl_order_detail` detail WHERE detail.shop_id IN (SELECT b.shop_id FROM tbl_order a INNER JOIN tbl_order_detail b ON a.order_code = b.order_code WHERE a.order_status = 'COMPLETED') AND detail.order_code IN (SELECT a.order_code FROM tbl_order a INNER JOIN tbl_order_detail b ON a.order_code = b.order_code WHERE a.order_status = 'COMPLETED') group by detail.shop_id order by count(*) desc ,sum(detail.sub_total) desc limit 10";
                                    // $s1 = "SELECT count(*),s.shop_name,sum(sales.subtotal) FROM tbl_salestransaction sales, tbl_shop s where s.shopID=sales.shopID and (sales.cart_status='COMPLETED' or sales.cart_status='COMFIRM') group by sales.shopID order by count(*) desc limit 10";
                                    $h1 = mysqli_query($conn, $s1);
                                    while($r1 = mysqli_fetch_assoc($h1)) {
                                    ?>
                                    <tr>
                                        <td><?php $shop = mysqli_fetch_assoc(mysqli_query($conn,"SELECT shop_name FROM tbl_order_shop WHERE shop_id=" . $r1['shop_id']));
                                        echo $shop['shop_name']; ?></td><td><?php echo $r1['count(*)']; ?></td><td><?php echo $r1['sum(detail.sub_total)']; ?></td>
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
                                    $s = "SELECT product_name, count(qty) as total FROM tbl_order_detail a INNER JOIN tbl_order b USING (order_code) GROUP BY product_id ORDER BY total DESC LIMIT 10";
                                    $h = mysqli_query($conn, $s);
                                    while($r = mysqli_fetch_assoc($h)) {
                                    ?>
                                    <tr>
                                        <td><?php echo $r['product_name'] ?></td><td><?php echo $r['total'] ?></td>
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
<?php mysqli_free_result($h1); mysqli_free_result($h); require_once 'footer.php' ?>
