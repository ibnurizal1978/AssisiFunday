<style>
  @media (max-width: 600px) {
  nav, article {
    width: 100%;
    height: auto;
  }
}

body {
color:#226C85;
font-family:arial;
}

hr {
    color: #abb6b8;
    height: 1px solid;
}

.yellow-highlight {
    background: #FFFFCC; /* Default color, all browsers */
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    border-radius: 5px;
    padding-left: 3px;
}
</style>

<?php
ini_set('display_errors',1);  error_reporting(E_ALL);
include_once '../config.php';
include '../assets/plugins/phpqrcode/qrlib.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require '../assets/plugins/PHPMailer/src/Exception.php';
require '../assets/plugins/PHPMailer/src/PHPMailer.php';
require '../assets/plugins/PHPMailer/src/SMTP.php';
require_once '../assets/plugins/dompdf/autoload.inc.php';
use Dompdf\Dompdf;

$db_server        = '127.0.0.1';
$db_user          = 'root';
$db_password      = 'password';
$db_name          = 'assisifunday';
$conn 			  = new mysqli($db_server,$db_user,$db_password,$db_name) or die (mysqli_error($conn));

//$sqlx = "SELECT user_id, cartID, cart_address, cart_postalcode, cart_name, cart_contact, cart_email, voucher_amount, donation, credit_used, delivery_fee FROM tbl_salescart WHERE cart_status = 'COMPLETED' AND user_id = '527202108101255312682279012808816900104fd66c-996e-4c2a-b737-6825ebdd5c53'"; //AND email_order_flag = 0";
$sqlx = "SELECT user_id, cartID, cart_address, cart_postalcode, cart_name, cart_contact, cart_email, voucher_amount, donation, credit_used, delivery_fee FROM tbl_salescart WHERE cart_status = 'COMPLETED' AND email_order_flag = 0";
echo $sqlx;
$hx = mysqli_query($conn, $sqlx);
while($rowx = mysqli_fetch_assoc($hx)) {
    $email_header = $base_url."assets/img/email_header.png";
    $email_footer = $base_url."assets/img/email_footer.png";
    $content = "<table width=600><tr><td align=center><img src=". $email_header."></td></tr><tr><td><h3 style='color:#3fb55f; text-align:center'>ORDER CONFIRMATION</h3><p style='color:#226C85'>Hello ".$rowx['cart_name'].",<br/><br/>Thank you for shopping for a good cause!<br/>Your order has been processed. Kindly find your purchase below.<br/><hr/><h3 style='color:#3fb55f;'>ORDER SUMMARY</h3>";

    $sql2 = "SELECT *, a.pickup_location, date_format(a.fulfilment_date, '%d-%m-%Y') as fulfilment_date, fulfilment_time FROM tbl_saleshop a INNER JOIN tbl_shop b USING (shopID) WHERE cartID = '".$rowx['cartID']."'";
    $h2 = mysqli_query($conn, $sql2);
    while($row2 = mysqli_fetch_assoc($h2)) {

        $ff_type = $row2['fulfilment_type'];
        if($row2['fulfilment_type']=='delivery') { 
            $lokasi = "<tr><td valign=top><b>Location:</b></td><td>".$rowx['cart_address'].' '.$rowx['cart_postalcode']."</td></tr>"; 
        }elseif($row2['fulfilment_type']=='dine in') { 
            $lokasi = "<tr><td valign=top><b>Location:</b></td><td>".$row2['location']."</td></tr>"; 
        }elseif($row2['fulfilment_type']=='pick up') {
            if($row2['pickup_location']=='')  {
                $lokasi = "<tr><td valign=top><b>Location:</b></td><td>".$row2['location']."</td></tr>";
            }else{
                $lokasi = "<tr><td valign=top><b>Location:</b></td><td>".$row2['pickup_location']."</td></tr>";
            }
        }else{
            $lokasi = '';
        }

        if($row2['fulfilment_remarks']=='') {
            $ff_remarks = "";
        }else{
            $ff_remarks = "<tr><td><b>Remarks:</b></td><td>".$row2['fulfilment_remarks']."</td></tr>";
        }

        if($row2['fulfilment_date'] <>'' || $row2['fulfilment_time'] <> '') {
            $ff_date =  "<tr><td><b>Date/Time:</b></td><td>".$row2['fulfilment_date'].' / '.$row2['fulfilment_time']."</td></tr>";
        }else{
            $ff_date = '';
        }

        $content .= "<h3>".$row2['shop_name']." (".$row2['fulfilment_type'].")</h3>";
        $content .= "<table style='color:#636363'>";
        $content .= $ff_date;
        $content .= $lokasi;
        $content .= $ff_remarks;
        $content .= "</table>";
        $content .= "<br>";

        //======================================== TABLE SHOW  THE ITEMS ======================================//
        $content .= "<table width=60% style='color:#636363; padding:30px; border-collapse: collapse;'>";
        $content .= "<tr><td width=10% style='border: 1px solid #abb6b8; padding:10px'><b>ORDER NO.</b></td><td width=30% style='border: 1px solid #abb6b8; padding:10px'><b>PRODUCTS</b></td><td width=5% style='border: 1px solid #abb6b8; padding:10px'><b>PRICE</b></td></tr>";
        
        $sql_products = "SELECT trans_id, cart_payment_token, qty, subtotal, product_name, price FROM tbl_salestransaction WHERE cartID = '".$rowx['cartID']."' AND shopID = '".$row2['shopID']."'";
        $h_products = mysqli_query($conn, $sql_products);
        while($row_products = mysqli_fetch_assoc($h_products)) {

            //update tbl_salestransaction
            // $sql2 = "UPDATE tbl_salestransaction SET email_order_flag = 1 WHERE trans_id = '".$row_products['trans_id']."'";
            // mysqli_query($conn, $sql2);

            $content .= "<tr><td style='border: 1px solid #abb6b8; padding:10px'>".$row_products['cart_payment_token']."</td><td style='border: 1px solid #abb6b8; padding:10px'>".$row_products['qty'].'x '.$row_products['product_name']."</td><td style='border: 1px solid #abb6b8; padding:10px'>$".$row_products['subtotal']."</td></tr>";
        }
        $content .= "</table>";
        //======================================== END TABLE SHOW  THE ITEMS ======================================//     

    }
    
    //======================================== TABLE SHOW  THE ORDER ======================================//
    $s1 = "SELECT sum(subtotal) as subtotal FROM tbl_salestransaction WHERE cartID = '".$rowx['cartID']."'";
    $h1 = mysqli_query($conn, $s1);
    $r1 = mysqli_fetch_assoc($h1);
    $total_price = ($r1['subtotal']+$rowx['donation']+$rowx['delivery_fee'])-($rowx['voucher_amount']+$rowx['credit_used']);
    $content .= "<br/><hr/>";
    $content .= "<h3 style='color:#3fb55f;'>ORDER TOTAL</h3>";
    $content .= "Subtotal price - $".$r1['subtotal']."<br/>";
    $content .= "Discount - ($".$rowx['voucher_amount'].")<br/>";
    $content .= "Donation - $".$rowx['donation']."<br/>";
    $content .= "Credit - $".$rowx['credit_used']."<br/>";
    $content .= "Delivery Service - $".$rowx['delivery_fee'];
    $content .= "<br/><br/>";
    $content .= "<b>Total Price - $".$total_price."</b><br/>";
    $content .= "<hr/>";

    $content .= "<h3 style='color:#3fb55f;'>CONTACT DETAILS</h3>";
    $content .= "<table width=100% style='color:#636363;'>";
    $content .= "<tr><td width=5%><b>Name</b></td><td width=90%>".$rowx['cart_name']."</td></tr>";
    $content .= "<tr><td><b>Contact</b></td><td>".$rowx['cart_contact']."</td></tr>";
    $content .= "<tr><td><b>Email</b></td><td>".$rowx['cart_email']."</td></tr>";
    $content .= "</table>";
    $content .= "<br/>";
    $content .= "<hr/>";

    $content .= "<h3 style='color:#3fb55f;'>DELIVERY DETAILS</h3>";
    $content .= "<table width=100% style='color:#636363;'>";
    $content .= "<tr><td width=5%><b>Name</b></td><td width=60%>".$rowx['cart_name']."</td></tr>";
    $content .= "<tr><td><b>Address</b></td><td>".$rowx['cart_address'].' '.$rowx['cart_postalcode']."</td></tr>";
    $content .= "<tr><td><b>Email</b></td><td>".$rowx['cart_email']."</td></tr>";
    $content .= "</table>";
    $content .= "<br/><br/>Cheers,<br/>Team Assisi<br/><br/></td></tr><tr><td align='center'><img src=".$email_footer."></td></tr></table>";
    //======================================== END TABLE SHOW  THE ORDER ======================================//

    /*================= E VOUCHER TAGGING ===============================*/
    //get info is this productID deserve to get evoucher?
    $sql_v  = "SELECT evoucherID, user_id, foodpanda, product_id, fufilment_type_option, fufilment_cash_option, shopID, productID, shop_icon, product_name, voucher_info, trans_id, qty FROM tbl_salestransaction s INNER JOIN tbl_evoucher a ON s.product_id = a.productID INNER JOIN tbl_shop c  USING (shopID) WHERE cartID = '".$rowx['cartID']."'";
    $h_v = mysqli_query($conn, $sql_v);
    if(mysqli_num_rows($h_v)>0) {
        $ada = 1;
        //$evoucher_layout = array();
        while($row_v = mysqli_fetch_assoc($h_v)) {
        for ($i=0; $i<$row_v['qty']; $i++) {

            //=============== CHECK AREA FOR FULFILMENT TYPE, ONLY NOT DELIVERY WILL CREATE EVOUCHER =================//
            if($ff_type<>'delivery') {

                $ecc = 'H';
                $pixel_size = 5;
                $frame_size = 2;

                if($row_v['foodpanda']<>1) { //if this is not foodpanda, create evoucher code
                    $evoucher_code = substr(str_shuffle("ABCDEFGHJKLMNPQRSTUVWXYZ23456789"), 0, 8);
                }else{
                    $sfp = "SELECT * FROM tbl_foodpanda WHERE used_status = 0 LIMIT 1 FOR UPDATE";
                    $hfp = mysqli_query($conn, $sfp);
                    $rfp = mysqli_fetch_assoc($hfp);
                    $evoucher_code = $rfp['evoucher_code'];
                }
                $file_name = "Assisi_Voucher_Code_".substr(str_shuffle("ABCDEFGHJKLMNPQRSTUVWXYZ23456789"), 0, 10);  
                $file_image = "../file/".$file_name.$evoucher_code.".png";
                QRcode::png($evoucher_code, $file_image, $ecc, $pixel_size, $frame_size); 
                if($row_v['shop_icon']<>'') {
                $shop_icon = 'https://www.assisifunday.sg/link/assisi/2021/icon/'.$row_v['shop_icon'];
                $icon = '<img width="100%" src='.$shop_icon.' />';  
                }else{
                $icon = '';
                }      
                $assisi_logo = $base_url."assets/img/assisi_logo.png";
                $qrcode_file = $base_url."file/".$file_name.$evoucher_code.".png";

                //insert into tbl_evoucher_detail
                if($row_v['foodpanda']<>1) { //if this is not foodpanda, create evoucher code
                    $sql1 = "INSERT INTO tbl_evoucher_detail SET evoucherID = '".$row_v['evoucherID']."', shopID = '".$row_v['shopID']."', productID = '".$row_v['product_id']."', evoucher_code = '".$evoucher_code."', userID = '".$rowx['user_id']."', cartID = '".$rowx['cartID']."'";
                    mysqli_query($conn, $sql1);
                }else{
                    $sqlfp = "UPDATE tbl_foodpanda SET used_status = 1, used_date = now(), userID = '".$row_v['user_id']."', productID = '".$row_v['productID']."' WHERE evoucher_code = '".$rfp['evoucher_code']."' LIMIT 1";
                    mysqli_query($conn, $sqlfp);
                    //echo '<hr/>update foodpanda:<br/>'.$sqlfp.'<hr/>';
                    $sql1 = "INSERT INTO tbl_evoucher_detail SET evoucherID = '".$rfp['id']."', shopID = '', productID = '".$row_v['product_id']."', evoucher_code = '".$rfp['evoucher_code']."', userID = '".$rowx['user_id']."', cartID = '".$rowx['cartID']."', foodpanda = 1";
                    mysqli_query($conn, $sql1);
                }
                
                //=============== CHECK AREA FOR FULFILMENT TYPE, ONLY NOT DELIVERY WILL CREATE EVOUCHER =================//

                //update tbl_salestransaction, input evoucher code
                $sql2 = "UPDATE tbl_salestransaction SET evoucher_code = '".$evoucher_code."' WHERE trans_id = '".$row_v['trans_id']."'";
                echo '<hr/>'.$sql2.'<hr/>';
                mysqli_query($conn, $sql2);

                $evoucher_layout = '<table cellpadding=20 width=100% style="background:#E8FBFD">
                <tr>
                <td width=15% valign="top" align="center"><br/><br/><br/>'.$icon.'</td>
                <td width=70% style="color:#226C85;" valign="top">
                <b style="color:#226C85; font-size:14pt"><span class=yellow>'.$evoucher_code.'</span></b><br/>
                <h3 style="color:#226C85">'.$row_v['product_name'].'</h3>'.htmlspecialchars_decode($row_v['voucher_info']).'</td>
                <td valign="top" align="center">
                    <img src='.$assisi_logo.' width="100" /><br/><br/><br/>
                    <img src="'.$qrcode_file.'" width="100" /><br/><br/>
                </td>
                </tr>
                </table><br/><br/>';
                $content .=  '<br/><br/>'.$evoucher_layout;
            }
        }
    }

        $dompdf = new Dompdf(array('enable_remote' => true));      
        $dompdf->loadHtml($evoucher_layout);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $pdf = $dompdf->output();
        file_put_contents('../file/'.$file_name.".pdf", $pdf);
        $file = "../file/".$file_name.".pdf";
    }else{
        $ada = 0;
    }

/*
    $to = 'myself@localhost'; 
    $from = 'noreply@localhost'; 
    $fromName = 'Assisi'; 
    $subject = 'PHP Email with Attachment by CodexWorld';  
    if($ada == 1) { $file = "../file/".$file_name.".pdf"; }
    $htmlContent = $content;
    $headers = "From: $fromName"." <".$from.">"; 
    $semi_rand = md5(time());  
    $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";  
    $headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\"";  
    $message = "--{$mime_boundary}\n" . "Content-Type: text/html; charset=\"UTF-8\"\n" . 
    "Content-Transfer-Encoding: 7bit\n\n" . $htmlContent . "\n\n";  

    // Preparing attachment 
    if(!empty($file) > 0){ 
        if(is_file($file)){ 
            $message .= "--{$mime_boundary}\n"; 
            $fp =    @fopen($file,"rb"); 
            $data =  @fread($fp,filesize($file)); 
    
            @fclose($fp); 
            $data = chunk_split(base64_encode($data)); 
            $message .= "Content-Type: application/octet-stream; name=\"".basename($file)."\"\n" .  
            "Content-Description: ".basename($file)."\n" . 
            "Content-Disposition: attachment;\n" . " filename=\"".basename($file)."\"; size=".filesize($file).";\n" .  
            "Content-Transfer-Encoding: base64\n\n" . $data . "\n\n"; 
        } 
    }
    $message .= "--{$mime_boundary}--"; 
    $returnpath = "-f" . $from; 
    $mail = @mail($to, $subject, $message, $headers, $returnpath);  
    echo $mail?"<h1>Email Sent Successfully!</h1>":"<h1>Email sending failed.</h1>"; 
*/

    echo $content;
    //echo '<h1>'.$ada.'</h1>';// if($ada == 1) { echo "<h1>ADDAAAAAA</H1>"; }
    
    $mail = new PHPMailer(true);
    $mail->isSMTP();    
    $mail->Mailer     = "smtp";   
    $mail->Host       = 'smtp.office365.com';                      //'smtp.office365.com'
    $mail->SMTPAuth   = true;       
    $mail->Username   = 'afd@assisihospice.org.sg';                     //afd@assisihospice.org.sg
    $mail->Password   = 'Muc36340';                               //Muc36340
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;  
    $mail->Port       = 587;            
    $mail->SMTPSecure = 'tls';
    $mail->SMTPAutoTLS = false;
    $mail->SMTPKeepAlive = true;
    $mail->setFrom('afd@assisihospice.org.sg', 'Assisi Funday (no reply)'); //'afd@assisihospice.org.sg', 'Assisi Funday (no reply)'
    $mail->addAddress($rowx['cart_email'], $rowx['cart_name']);
   // if($ada == 1) { $mail->addAttachment($file); }
    $mail->isHTML(true); 
    $mail->Subject = 'Your Assisi Order';
    $mail->Body    = $content;

    if(!$mail->send()) {
        echo 'Message was not sent.';
        echo 'Mailer error: ' . $mail->ErrorInfo;
        $email_msg = 'Message was not sent.'.$mail->ErrorInfo;;
    } else {
        echo 'Message has been sent: '.$rowx['cart_email'];
        $email_msg = 'Message has been sent to '.$rowx['cart_email'];
    }

    //update tbl_salestransaction, input evoucher code
    $sql2 = "UPDATE tbl_salescart SET email_order_flag = 1, email_msg = '".$email_msg."' WHERE cartID = '".$rowx['cartID']."'";
    //echo "<br/><br/> ".$sql2.'<br/>';
    mysqli_query($conn, $sql2);
    
} 
?>