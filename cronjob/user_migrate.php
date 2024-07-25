<?php
ini_set('display_errors',1);  error_reporting(E_ALL);
include_once '../config.php';

$s1 = "SELECT * FROM tbl_user_aslinya";
$h1 = mysqli_query($conn, $s1);
while($r1 = mysqli_fetch_assoc($h1))
{

    $s2 = "SELECT email FROM tbl_user WHERE email = '".$r1['email']."'";
    $h2 = mysqli_query($conn, $s2);
    if(mysqli_num_rows($h2) == 0)
    {
      //while($r2 = mysqli_fetch_assoc($h2))
      //{
        //echo '<br/>dodol';
        $s3 = "INSERT INTO tbl_user SET first_name = '".$r1['firstName']."', last_name = '".$r1['lastName']."', email = '".$r1['email']."', phone = '".$r1['mobile']."', gender = '".$r1['gender']."', password = '".$r1['password']."', age = '".$r1['age']."', created_at = '".$r1['createdDateTime']."', address1 = '".$r1['addressLine1']."', address2 = '".$r1['addressLine2']."', zip_code = '".$r1['postalCode']."', active_status = '".$r1['status']."', beneficiary = '".$r1['beneficiary']."'";
        echo $s3.'<hr/>';
        mysqli_query($conn, $s3);
      //}
    }

}
?>
