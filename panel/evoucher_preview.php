<?php
require_once 'header.php';
$evoucher_id        = Encryption::decode($param[1]);
$sql   = "SELECT *, a.location FROM tbl_evoucher a INNER JOIN tbl_product b USING (product_id) INNER JOIN tbl_shop c  USING (shop_id) WHERE evoucher_id = '".$evoucher_id."' LIMIT 1";
$h = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($h);

if($row['shop_icon']<>'') {
    $shop_icon = 'https://demo.trinaxmind.com/link/assisi/2021/icon/'.$row['shop_icon'];
    $icon = '<img width="100%" src='.$shop_icon.' />';
}else{
    $icon = '';
}

?>

<!-- Main Container -->
<main id="main-container">
    <!-- Page Content -->
    <div class="content">

        <table width="90%" border="0" cellpadding=10>
            <tbody style="background: #E8FBFD;">
                <tr><td colspan=3>&nbsp;</td></tr>
                <tr>
                    <td width="20%" valign="top" align="center"><?php echo $icon ?></td>
                    <td width=60% style="color:#226C85">
                        <h5 style="color:#226C85"><?php echo $row['product_name'] ?></h5>
                        <?php
                        if(strlen($row['title'] > 2)) {
                          echo '<br/><br/>'.$row['title'].', ';
                        }
                        if(strlen($row['location']>2)) {
                          echo $row['location'].', ';
                        }
                        if(strlen($row['datetime']>2)) {
                          echo $row['datetime'];
                        }
                        ?>
                        <?php echo htmlspecialchars_decode($row['voucher_info']) ?>
                    </td>
                    <td valign="top" align="center">
                        <img src="<?php echo $domain_url ?>src/img/logo.png" width="100" /><br/><br/><br/>
                        <img src="../assets/img/sampleqr2.jpg" width="100" /><br/><br/>
                        <b style="color:#226C85; font-size:10pt">{Evoucher code}</b><br/>
                    </td>
                </tr>
            </tbody>
        </table>

    </div>
    <!-- END Page Content -->
</main>
<!-- END Main Container -->
<?php require_once 'footer.php' ?>
