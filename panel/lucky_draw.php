<?php
require_once 'header.php';
?>
<link rel="stylesheet" href="../assets/js/plugins/datatables/dataTables.bootstrap4.css">

<!-- Main Container -->
<main id="main-container">
    <!-- Page Content -->
    <div class="content text-center">

      <?php
      $tgl = date("Y-m-d");
      $s1 = "SELECT first_name, last_name, email, lucky_draw_id FROM tbl_lucky_draw a INNER JOIN tbl_user b USING (user_id) WHERE approval_status = 1 AND date(winner_date) = SUBDATE(CURRENT_DATE, 1) LIMIT 1";
      $h1 = mysqli_query($conn, $s1);
      if(mysqli_num_rows($h1) > 0)
      {
        $r1 = mysqli_fetch_assoc($h1);
        echo "<h1>You already approved winner for ".date('d M Y',strtotime("yesterday")).":<br/>".$r1['first_name'].' '.$r1['last_name']."(".$r1['email'].")</h1>";
      }else{
      ?>

        <h5>Winner for date <?php echo date('d M Y',strtotime("yesterday")); ?>:</h5>
        <?php
        if(@$_GET['go']<>'')
        {
          $s = "SELECT first_name, last_name, email, lucky_draw_id FROM tbl_lucky_draw a INNER JOIN tbl_user b USING (user_id) WHERE approval_status = 0 AND user_id NOT IN (select user_id FROM tbl_lucky_draw WHERE approval_status = 1) ORDER BY RAND() LIMIT 1";
          $h = mysqli_query($conn, $s);
          $r = mysqli_fetch_assoc($h);
          ?>
          <h1><?php echo $r['first_name'].' '.$r['last_name'] ?></h1>
          <h3><?php echo $r['email']?></h3>
          Do you want to approve <b><?php echo $r['first_name'].' '.$r['last_name'] ?></b> as a daily winner?
          <br/><br/>
          <a href="lucky_draw_update?<?php echo Encryption::encode($r["lucky_draw_id"]) ?>?1" class="btn btn-success">Yes, I approve</a>
          <a href="lucky_draw_update?<?php echo Encryption::encode($r["lucky_draw_id"]) ?>?2" class="btn btn-danger">No, I want to generate another name</a>
        <?php }else{ ?>
          <a href="lucky_draw?go=<?php echo Encryption::encode(date("y-m-d")) ?>" class="btn btn-success">START GENERATE WINNER</a>
        <?php } ?>

      <?php } ?>

    </div>
    <!-- END Page Content -->
</main>
<!-- END Main Container -->
<?php require_once 'footer.php' ?>
