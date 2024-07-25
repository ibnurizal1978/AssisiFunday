<?php
ini_set('display_errors',1);  error_reporting(E_ALL);
include_once '../config.php';

header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=weekly_evoucher_report.xls");
$s = "SELECT date_format(a.created_at, '%d-%m-%Y') as tgl, first_name, last_name, email, credit, totalAmount, bonus1, bonus2 FROM tbl_ledger a INNER JOIN tbl_user b USING (user_id) where a.description = 'DEPOSIT' AND credit > 0 AND a.created_at >= DATE(NOW()) - INTERVAL 7 DAY";

$h = mysqli_query($conn, $s);
echo '<table width=100% border=1><tr><td>Date</td><td>Name</td><td>Email</td><td>Topup to PG</td><td>Bonus 10%</td><td>Bonus > $100</td><td>Total</td></tr>';
while($r = mysqli_fetch_assoc($h))
{
  echo '<tr>';
  echo '<td>'.$r['tgl'].'</td>';
  echo '<td>'.$r['first_name'].' '.$r['last_name'].'</td>';
  echo '<td>'.$r['email'].'</td>';
  echo '<td>'.$r['credit'].'</td>';
  echo '<td>'.$r['bonus1'].'</td>';
  echo '<td>'.$r['bonus2'].'</td>';
  echo '<td>'.$r['totalAmount'].'</td>';
  echo '</tr>';
}
echo '</table>';


?>
