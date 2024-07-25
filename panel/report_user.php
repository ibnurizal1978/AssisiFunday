<?php
require_once '../config.php';
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=user-report.xls");

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

?>

<!-- Main Container -->
<main id="main-container">
    <?php
    $sql  = "SELECT *, date_format(created_at, '%d-%m-%Y') as date FROM tbl_user WHERE created_at between '".$date_from."' and '".$date_to."' ORDER BY created_at DESC";
    $h = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    //echo 'Date: '.$from_tampil.' to '.$to_tampil;
    ?>
    <table width=50% border="1" style="font-size:8pt" cellpadding=10>
        <thead>
            <tr>
                <th colspan="10">
                    <H3>User List from <?php echo $date_from ?> till <?php echo $date_to ?></h3>
                </th>
            </tr>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Contact</th>
                <th>Gender</th>
                <th>Age</th>
                <th>Created at</th>
                <th>Address 1</th>
                <th>Address 2</th>
                <th>Zip Code</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row=mysqli_fetch_assoc($h)) { ?>
            <tr style="font-size: 8pt;">
                <td><?php echo $row['first_name'] ?></td>
                <td><?php echo $row['last_name'] ?></td>
                <td><?php echo $row['email'] ?></td>
                <td><?php echo $row['phone'] ?></td>
                <td><?php echo $row['gender'] ?></td>
                <td><?php echo $row['age'] ?></td>
                <td><?php echo $row['date'] ?></td>
                <td><?php echo $row['address1'] ?></td>
                <td><?php echo $row['address2'] ?></td>
                <td><?php echo $row['zip_code'] ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</main>
<!-- END Main Container -->
<?php //require_once 'footer.php' ?>
