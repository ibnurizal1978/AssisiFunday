<?php
session_start();
ini_set('display_errors',1);  error_reporting(E_ALL);
require_once "../config.php";
require_once "../check-session.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require '../assets/plugins/PHPMailer/src/Exception.php';
require '../assets/plugins/PHPMailer/src/PHPMailer.php';
require '../assets/plugins/PHPMailer/src/SMTP.php';
?>
<link rel="stylesheet" href="../../backend/public/css/edm.css" />
<?php
//require_once "access.php";

$lucky_draw_id  = Encryption::decode($param[1]);
$trigger        = $param[2];
$m              = date("m");
$de             = date("d");
$y              = date("Y");
$yesterday      = date('Y-m-d', mktime(0,0,0,$m,($de-1),$y));
//$yesterday      = "2022-10-07";

if($lucky_draw_id == "") {
    echo "<script>";
    echo "alert('ID is empty'); window.location.href=history.back()";
    echo "</script>";
    exit();
}

$s = "SELECT user_id, lucky_draw_id FROM tbl_lucky_draw WHERE lucky_draw_id = '".$lucky_draw_id."' LIMIT 1";
$h = mysqli_query($conn, $s);
$r = mysqli_fetch_assoc($h);

$s1 = "SELECT first_name, last_name, email FROM tbl_user WHERE user_id = '".$r['user_id']."' LIMIT 1";
$h1 = mysqli_query($conn, $s1);
$r1 = mysqli_fetch_assoc($h1);
$full_name = $r1['first_name'].' '.$r1['last_name'];
$email = $r1['email'];

if($trigger == 1) // approved
{
  $s2       = "UPDATE tbl_lucky_draw SET approval_status = 1, approval_by = '".$_SESSION['staff_id']."', approval_date = now(), winner_date = '".$yesterday."' WHERE lucky_draw_id = '".$lucky_draw_id."' LIMIT 1";

  $s3 = "SELECT * FROM tbl_lucky_draw_prize WHERE date(date) = '".$yesterday."' LIMIT 1";
  $h3 = mysqli_query($conn, $s3);
  $r3 = mysqli_fetch_assoc($h3);
  $prize = $r3['prize'];

  //create email view
  $content = "<table border=0 cellpadding=0 cellspacing=0 width=70% style='background: #fff'>
    <tr><td colspan=3><img src=$domain_url/backend/public/images/edm/2022-header.png /></td></tr>
    <tr>
      <td width=20%>&nbsp;</td>
      <td width=60% style='color:#6C7E5C'>
        <img src=$domain_url/backend/public/images/edm/2022-icon-luckydraw.png width='60' /><br/>
        <h2>Hi $full_name</h2><br/>
        Congratulations! You have won $prize in the lucky draw!<br/>
        <br/>
        <b>You may redeem your prize at:</b><br/>
        Address: <font style='color: #2FD4E1;'>Assisi Hospice, 832 Thomson Road, Singapore 574627</font><br/>
        Collection Dates: <font style='color: #2FD4E1;'>10 Oct to 21 Oct 2022</font>
        Collection Hours: <font style='color: #2FD4E1;'>Monday to Friday, 10am - 8pm</font>
        <hr/>
        <br/>
        <b>Terms and Conditions:</b><br>
        <ul>
          <li>This email must be presented during prize collection.</li>
          <li>Prize collection is strictly during the collection hours stated above.</li>
          <li>Any uncollected prize will be forfeited after the stated date of collection.</li>
          <li>This email has no cash value and cannot be exchanged or sold for cash or other items.</li>
        </ul>
        <br/>
          Please contact 9837 4060 between 9am - 5pm from Monday to Friday for enquiries.
        <br/><br/><br/>
        Cheers,
        <br/>Team Assisi
        <br/>
      </td>
      <td width=20%>&nbsp;</td>
  </tr>
    <tr style='height:120px; background:url($domain_url/backend/public/images/edm/2022-footer.png)'>
      <td width=10%>&nbsp;</td>
      <td width=80% align=center valign=bottom>
        <a href=https://www.assisihospice.org.sg/about-us/>Disclaimer and Intellectual Rights</a> | <a href=https://www.assisihospice.org.sg/about-us/privacy-policy/>Privacy Notice</a> | &copy;2022 Assisi Hospice. All Rights Reserved.
      </td>
      <td width=10%>&nbsp;</td>
    </tr>
  </table>";

echo $content;
  //send email
  $mail = new PHPMailer(true);
  $mail->isSMTP();
  $mail->Mailer     = "smtp";
  $mail->Host       = 'smtp.office365.com';
  $mail->SMTPAuth   = true;
  $mail->Username   = 'afd@assisihospice.org.sg';
  $mail->Password   = 'Muc36340';
  $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
  $mail->Port       = 587;
  $mail->SMTPSecure = 'tls';
  $mail->SMTPAutoTLS = false;
  $mail->SMTPKeepAlive = true;
  $mail->setFrom('afd@assisihospice.org.sg', 'Assisi Funday (no reply)');
  $mail->addAddress($email, $full_name);
  $mail->isHTML(true);
  $mail->Subject = 'Prize Collection for Assisi Fun Day Lucky Draw';
  $mail->Body    = $content;

  if(!$mail->send()) {
      //echo 'Mailer error: ' . $mail->ErrorInfo;
      $sent_status = $mail->ErrorInfo;
  } else {
      //echo 'Message has been sent: '.$email;
      $sent_status = 'Message has been sent to '.$email;
  }

  mysqli_query($conn, "UPDATE tbl_lucky_draw SET email_sent_date = now(), email_sent_status = '".$sent_status."' WHERE lucky_draw_id = '".$r['lucky_draw_id']."' LIMIT 1");

}else{
  $s2       = "UPDATE tbl_lucky_draw SET approval_status = 2 WHERE user_id = '".$r['user_id']."'";
}
mysqli_query($conn,$s2);

/* === LOG === */
$sql_log = "INSERT INTO tbl_log(user_id, action, notes, cms, created_at) VALUES ('".$_SESSION['staff_id']."', 'UPDATE LUCKY DRAW', 'Update Lucky Draw Winner lucky_draw_id $lucky_draw_id',1,now())";
mysqli_query($conn, $sql_log);
/* === LOG === */

echo "<script>";
echo "alert('Success'); window.location=\"lucky_draw\"";
echo "</script>";
?>
