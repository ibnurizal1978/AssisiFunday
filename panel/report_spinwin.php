  <?php
require_once '../config.php';

$date_from = input_data($_POST['date_from']);
$date_to = input_data($_POST['date_to']);

$from_Y 	= substr($date_from,0,4);
$from_M 	= substr($date_from,5,2);
$from_D 	= substr($date_from,8,2);
$from_tampil = $from_D.'-'.$from_M.'-'.$from_Y;

$to_Y 		= substr($date_to,0,4);
$to_M 		= substr($date_to,5,2);
$to_D 		= substr($date_to,8,2);
$to_tampil 	= $to_D.'-'.$to_M.'-'.$to_Y;
/*
/*
$today = date('Y-m-d');
if($date_from > $today)
{
  echo "<script>";
  echo "alert('Date From cannot larger than today'); window.location.href=history.back()";
  echo "</script>";
  exit();
}

if($date_to < $date_from)
{
  echo "<script>";
  echo "alert('Date To cannot smaller than Date From'); window.location.href=history.back()";
  echo "</script>";
  exit();
}*/

header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=spin-win-report.xls");
?>

<!-- Main Container -->
<main id="main-container">
    <?php
    //$sql  = "SELECT u.first_name,u.last_name,u.email,u.phone,t.win_prize,t.created_at FROM tbl_spinwin t,tbl_user u where u.user_id=t.user_id and t.win_prize is not null and (t.created_at between '".$date_from."' and '".$date_to."')";
    $s = "SELECT a.user_id, b.user_id, first_name, last_name, email, phone, prize, a.created_at, date_format(a.created_at, '%d-%m-%Y') as date FROM tbl_game_spin_and_win a LEFT JOIN tbl_user b USING (user_id) WHERE a.created_at between '".$date_from."' and '".$date_to."'";
    $h = mysqli_query($conn, $s) or die(mysqli_error($conn));
    echo 'Date: '.$from_tampil.' to '.$to_tampil;
    ?>
    <table width=50% border="1" style="font-size:8pt" cellpadding=10>
        <thead>
            <tr>
                <th colspan="6">
                    <h3>Spin & Win List from <?php echo $date_from ?> till <?php echo $date_to ?></h3>
                </th>
            </tr>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Contact</th>
                <th>Win</th>
                <th>Date Time</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row=mysqli_fetch_assoc($h)) { ?>
            <tr style="font-size: 8pt;">
                <td><?php echo $row['first_name'] ?></td>
                <td><?php echo $row['last_name'] ?></td>
                <td><?php echo $row['email'] ?></td>
                <td><?php echo $row['phone'] ?></td>
                <td><?php echo $row['prize'] ?></td>
                <td><?php echo $row['date'] ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</main>
<!-- END Main Container -->
<?php //require_once 'footer.php' ?>
