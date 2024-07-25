<link rel="stylesheet" href="../assets/css/jquery.multiselect.css" />
<script src="../assets/js/multiselect-dropdown.js" ></script>
<?php
require_once '../config.php';
require_once 'components.php';
$Date = date('Y-m-d');

$hari     = @$_POST['t'];
//$hari     = 5;
//$id         = Encryption::decode('eufnSPPq3xOqUgBENFFp_Od8EeQSAMlURafWGYto2ZI');
$id       = @$_POST['id'];

$sql        = "SELECT * FROM tbl_shop WHERE shop_id = '".$id."' LIMIT 1";
$h          = mysqli_query($conn, $sql);
$row        = mysqli_fetch_assoc($h);
$del_date   = str_replace("[","", $row['delivery_date']); $del_date = str_replace("]","", $del_date);
$data_date  = explode(',',$del_date);

echo '<select name="delivery_leadtime[]" multiple="multiple" class="form-control">';
for($i=1;$i<11;$i++)
{
    if($i==1)
    {
      $result = date('Y-m-d', strtotime($Date. ' + '.$hari.' days'));
    }else{
      $result = date('Y-m-d', strtotime($result. ' + '.$hari.' days'));
    }

    if( in_array( $result ,$data_date ) )
    {
        echo '<option value='.$result.' selected> '.$result.'</option>';
    }else{
        echo '<option value='.$result.'> '.$result.'</option>';
    }

}
echo '</select>';
?>
