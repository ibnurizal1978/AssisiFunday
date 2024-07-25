<?php
require_once 'header.php';
?>
<link rel="stylesheet" href="../assets/js/plugins/datatables/dataTables.bootstrap4.css">

<!-- Main Container -->
<main id="main-container">
    <!-- Page Content -->
    <div class="content">

        <form action=token method="POST" name="form">

          Choose Action
          <select name="action" class="form-control">
            <optgroup label="User">
              <option value="Registration">Registration</option>
              <option value="Registration_Guest">Registration Guest</option>
              <option value="Forgot_Password">Forgot Password</option>
              <option value="Flag_Donation">Flag Donation</option>
              <option value="Flag_Topup">Flag Topup</option>
              <option value="Login">Login</option>
              <option value="Logout">Logout</option>
              <option value="Update_Password">Update Password</option>
              <option value="Update_Profile">Update Profile</option>
            </optgroup>
            <optgroup label="Product">
              <option value="product_view">View</option>
              <option value="product_highlight">Highlight</option>
              <option value="product_search">Search</option>
              <option value="product_detail">Detail</option>
              <option value="product_similar">Similar</option>
            </optgroup>
            <optgroup label="Daily Special">
              <option value="daily_special_view">View</option>
              <option value="daily_special_search">Search</option>
              <option value="daily_special_detail">Detail</option>
            </optgroup>
            <optgroup label="Shop">
              <option value="shop_view">View</option>
              <option value="shop_search">Search</option>
              <option value="shop_detail">Detail</option>
            </optgroup>
            <optgroup label="Other">
              <option value="time">Time</option>
              <option value="news_ticker">News Ticker</option>
              <option value="lucky_draw">Lucky Draw</option>
              <option value="fb_live">FB Live</option>
              <option value="sell_for_good">Sell for Good</option>
              <option value="lucky_draw_winner">Lucky Draw Winner</option>
            </optgroup>
            <optgroup label="Games">
              <option value="ninja_check">Ninja Check</option>
              <option value="ninja_send_result">Ninja Send Result</option>
              <option value="nun_check">Nun Check</option>
              <option value="nun_send_result">Nun Send Result</option>
              <option value="spin_and_win_check">Spin and Win Check</option>
              <option value="spin_and_win_send_result">Spin and Win Send Result</option>
              <option value="whack_check">Whack Check</option>
              <option value="whack_send_result">Whack Send Result</option>
            </optgroup>
            <optgroup label="Cart">
              <option value="add_cart">Add Cart</option>
              <option value="cart_update_by_shop">Update By Shop</option>
              <option value="view_cart">View Cart</option>
              <option value="cart_history">Cart History</option>
              <option value="delete_by_product">Delete By Product</option>
              <option value="delete_by_shop">Delete By Shop</option>
            </optgroup>
            <optgroup label="Payment">
              <option value="create_payment">Create Payment</option>
              <option value="create_deposit">Create Deposit</option>
            </optgroup>
            <optgroup label="Deposit">
              <option value="view_deposit">View Deposit</option>
            </optgroup>
            <optgroup label="Discount Voucher">
              <option value="check_discount_voucher">Check</option>
              <option value="active_discount_voucher">Active List</option>
              <option value="redeem_discount_voucher">Redeem List</option>
            </optgroup>
          </select>
          <br/>
          Email (or user_id or code) <input class="form-control" type="text" name="email" /><br/>
          <input type="submit" value="Send" class="btn btn-success" /><br/>
        </form>

        <?php
        if (!empty($_POST))
        {

          $date   = date("Ymd");

          /* ======================== USER ======================== */
          if($_POST['action'] == "Registration")
          {
            $app_id     = 'SGP';
            $token      = hash("sha256",$app_id.$_POST['email'].$date);
          }

          if($_POST['action'] == "Registration_Guest")
          {
            $app_id     = 'SGG';
            $token      = hash("sha256",$app_id.$date);
          }

          if($_POST['action'] == "Forgot_Password")
          {
            $app_id     = 'UPW';
            $token      = hash("sha256",$app_id.$_POST['email'].$date);
          }

          if($_POST['action'] == "Flag_Donation")
          {
            $app_id     = 'FLD';
            $token      = hash("sha256",$app_id.$_POST['email'].$date);
          }

          if($_POST['action'] == "Flag_Topup")
          {
            $app_id     = 'FLT';
            $token      = hash("sha256",$app_id.$_POST['email'].$date);
          }

          if($_POST['action'] == "Login")
          {
            $app_id     = 'LGN';
            $token      = hash("sha256",$app_id.$_POST['email'].$date);
          }

          if($_POST['action'] == "Logout")
          {
            $app_id     = 'LGT';
            $token      = hash("sha256",$app_id.$_POST['email'].$date);
          }

          if($_POST['action'] == "Update_Password")
          {
            $app_id     = 'UPW';
            $token      = hash("sha256",$app_id.$_POST['email'].$date);
          }

          if($_POST['action'] == "Update_Profile")
          {
            $app_id     = 'UPR';
            $token      = hash("sha256",$app_id.$_POST['email'].$date);
          }
          /* ======================== USER ======================== */


          /* ======================== PRODUCT ======================== */
          if($_POST['action'] == "product_view")
          {
            $app_id     = 'PRD';
            $token      = hash("sha256",$app_id.$date);
          }

          if($_POST['action'] == "product_highlight")
          {
            $app_id     = 'HGH';
            $token      = hash("sha256",$app_id.$date);
          }

          if($_POST['action'] == "product_search")
          {
            $app_id     = 'SRC';
            $token      = hash("sha256",$app_id.$date);
          }

          if($_POST['action'] == "product_detail")
          {
            $app_id     = 'PID';
            $token      = hash("sha256",$app_id.$date);
          }

          if($_POST['action'] == "product_similar")
          {
            $app_id     = 'PRS';
            $token      = hash("sha256",$app_id.$date);
          }
          /* ======================== PRODUCT ======================== */

          /* ======================== DS ======================== */
          if($_POST['action'] == "daily_special_view")
          {
            $app_id     = 'DSP';
            $token      = hash("sha256",$app_id.$date);
          }

          if($_POST['action'] == "daily_special_search")
          {
            $app_id     = 'SRC';
            $token      = hash("sha256",$app_id.$date);
          }

          if($_POST['action'] == "daily_special_detail")
          {
            $app_id     = 'PID';
            $token      = hash("sha256",$app_id.$date);
          }
          /* ======================== DS ======================== */

          /* ======================== SHOP ======================== */
          if($_POST['action'] == "shop_view")
          {
            $app_id     = 'SHP';
            $token      = hash("sha256",$app_id.$date);
          }

          if($_POST['action'] == "shop_search")
          {
            $app_id     = 'SRC';
            $token      = hash("sha256",$app_id.$date);
          }

          if($_POST['action'] == "shop_detail")
          {
            $app_id     = 'SID';
            $token      = hash("sha256",$app_id.$date);
          }
          /* ======================== SHOP ======================== */

          /* ======================== OTHER ======================== */
          if($_POST['action'] == "time")
          {
            $app_id     = 'TIM';
            $token      = hash("sha256",$app_id);
          }

          if($_POST['action'] == "news_ticker")
          {
            $app_id     = 'NTC';
            $token      = hash("sha256",$app_id.$date);
          }

          if($_POST['action'] == "lucky_draw")
          {
            $app_id     = 'LDC';
            $token      = hash("sha256",$app_id.$_POST['email'].$date);
          }

          if($_POST['action'] == "fb_live")
          {
            $app_id     = 'FBL';
            $token      = hash("sha256",$app_id.$date);
          }

          if($_POST['action'] == "lucky_draw_winner")
          {
            $app_id     = 'LDW';
            $token      = hash("sha256",$app_id.$date);
          }
          /* ======================== OTHER ======================== */

          /* ======================== GAMES ======================== */
          if($_POST['action'] == "ninja_check")
          {
            $app_id     = 'NJC';
            $token      = hash("sha256",$app_id.$_POST['email'].$date);
          }

          if($_POST['action'] == "ninja_send_result")
          {
            $app_id     = 'NJR';
            $token      = hash("sha256",$app_id.$_POST['email'].$date);
          }

          if($_POST['action'] == "nun_check")
          {
            $app_id     = 'SWC';
            $token      = hash("sha256",$app_id.$_POST['email'].$date);
          }

          if($_POST['action'] == "nun_send_result")
          {
            $app_id     = 'NJR';
            $token      = hash("sha256",$app_id.$_POST['email'].$date);
          }

          if($_POST['action'] == "spin_and_win_check")
          {
            $app_id     = 'SWC';
            $token      = hash("sha256",$app_id.$_POST['email'].$date);
          }

          if($_POST['action'] == "spin_and_win_send_result")
          {
            $app_id     = 'SWR';
            $token      = hash("sha256",$app_id.$_POST['email'].$date);
          }

          if($_POST['action'] == "whack_check")
          {
            $app_id     = 'WAMC';
            $token      = hash("sha256",$app_id.$_POST['email'].$date);
          }

          if($_POST['action'] == "whack_send_result")
          {
            $app_id     = 'WAMR';
            $token      = hash("sha256",$app_id.$_POST['email'].$date);
          }
          /* ======================== GAMES ======================== */

          /* ======================== CART ======================== */
          if($_POST['action'] == "add_cart")
          {
            $app_id     = 'CAD';
            $token      = hash("sha256",$app_id.$_POST['email'].$date);
          }

          if($_POST['action'] == "cart_update_by_shop")
          {
            $app_id     = 'UBS';
            $token      = hash("sha256",$app_id.$_POST['email'].$date);
          }

          if($_POST['action'] == "view_cart")
          {
            $app_id     = 'CRV';
            $token      = hash("sha256",$app_id.$_POST['email'].$date);
          }

          if($_POST['action'] == "cart_history")
          {
            $app_id     = 'HIS';
            $token      = hash("sha256",$app_id.$_POST['email'].$date);
          }

          if($_POST['action'] == "delete_by_product")
          {
            $app_id     = 'DBP';
            $token      = hash("sha256",$app_id.$_POST['email'].$date);
          }

          if($_POST['action'] == "delete_by_shop")
          {
            $app_id     = 'DBS';
            $token      = hash("sha256",$app_id.$_POST['email'].$date);
          }
          /* ======================== CART ======================== */

          /* ======================== PAYMENT ======================== */
          if($_POST['action'] == "create_payment")
          {
            $app_id     = 'PGS';
            $token      = hash("sha256",$app_id.$_POST['email'].$date);
          }

          if($_POST['action'] == "create_deposit")
          {
            $app_id     = 'PGS';
            $token      = hash("sha256",$app_id.$_POST['email'].$date);
          }
          /* ======================== PAYMENT ======================== */

          /* ======================== DEPOSIT ======================== */
          if($_POST['action'] == "view_deposit")
          {
            $app_id     = 'DPV';
            $token      = hash("sha256",$app_id.$_POST['email'].$date);
          }
          /* ======================== DEPOSIT ======================== */

          /* ======================== DISCOUNT VOUCHER ======================== */
          if($_POST['action'] == "check_discount_voucher")
          {
            $app_id     = 'CDV';
            $token      = hash("sha256",$app_id.$_POST['email'].$date);
          }

          if($_POST['action'] == "active_discount_voucher")
          {
            $app_id     = 'DVA';
            $token      = hash("sha256",$app_id.$_POST['email'].$date);
          }

          if($_POST['action'] == "redeem_discount_voucher")
          {
            $app_id     = 'DVR';
            $token      = hash("sha256",$app_id.$_POST['email'].$date);
          }
          /* ======================== DISCOUNT VOUCHER ======================== */


          echo '<b>Your action is</b> '.$_POST['action'].'<br/>'.$token;


        }
         ?>
         <h3>Glossary</h3>
         <table border=1>
           <tr><td colspan="2"><b>User</b></td></tr>
           <tr><td>Registration</td><td>app_id + email + date</td></tr>
           <tr><td>Registration Guest</td><td>app_id + date</td></tr>
           <tr><td>Forgot Password</td><td>app_id + email + date</td></tr>
           <tr><td>Flag Donation</td><td>app_id + user_id + date</td></tr>
           <tr><td>Flag Topup</td><td>app_id + user_id + date</td></tr>
           <tr><td>Login</td><td>app_id + email + date</td></tr>
           <tr><td>Logout</td><td>app_id + email + date</td></tr>
           <tr><td>Update Password</td><td>app_id + code + date</td></tr>
           <tr><td>Update Profile</td><td>app_id + email + date</td></tr>

           <tr><td colspan="2"><b>Product</b></td></tr>
           <tr><td>View</td><td>app_id + date</td></tr>
           <tr><td>Highlight</td><td>app_id + date</td></tr>
           <tr><td>Search</td><td>app_id + date</td></tr>
           <tr><td>Detail</td><td>app_id + date</td></tr>
           <tr><td>Similar</td><td>app_id + date</td></tr>

           <tr><td colspan="2"><b>Daily Special</b></td></tr>
           <tr><td>View</td><td>app_id + date</td></tr>
           <tr><td>Search</td><td>app_id + date</td></tr>
           <tr><td>Detail</td><td>app_id + date</td></tr>

           <tr><td colspan="2"><b>Shop</b></td></tr>
           <tr><td>View</td><td>app_id + date</td></tr>
           <tr><td>Search</td><td>app_id + date</td></tr>
           <tr><td>Detail</td><td>app_id + date</td></tr>

           <tr><td colspan="2"><b>Other</b></td></tr>
           <tr><td>Time</td><td>app_id + date</td></tr>
           <tr><td>News Ticker</td><td>app_id + date</td></tr>
           <tr><td>Lucky Draw</td><td>app_id + user_id + date</td></tr>

           <tr><td colspan="2"><b>Games</b></td></tr>
           <tr><td>Ninja Check</td><td>app_id + user_id + date</td></tr>
           <tr><td>Ninja Send Result</td><td>app_id + user_id + date</td></tr>
           <tr><td>Nun Check</td><td>app_id + user_id + date</td></tr>
           <tr><td>Nun Check Result</td><td>app_id + user_id + date</td></tr>
           <tr><td>Spin and Win Check</td><td>app_id + user_id + date</td></tr>
           <tr><td>Spin and Win Result</td><td>app_id + user_id + date</td></tr>
           <tr><td>Whack Check</td><td>app_id + user_id + date</td></tr>
           <tr><td>Whack Result</td><td>app_id + user_id + date</td></tr>

           <tr><td colspan="2"><b>Cart</b></td></tr>
           <tr><td>Add Cart</td><td>app_id + email + date</td></tr>
           <tr><td>Update by Shop</td><td>app_id + email + date</td></tr>
           <tr><td>View Cart</td><td>app_id + email + date</td></tr>
           <tr><td>Cart History</td><td>app_id + email + date</td></tr>
           <tr><td>Delete by Product</td><td>app_id + email + date</td></tr>
           <tr><td>Delete by Shop</td><td>app_id + email + date</td></tr>

           <tr><td colspan="2"><b>Payment</b></td></tr>
           <tr><td>Create Payment</td><td>app_id + user_id + date</td></tr>
           <tr><td>Create Deposit</td><td>app_id + user_id + date</td></tr>

           <tr><td colspan="2"><b>Deposit</b></td></tr>
           <tr><td>View Deposit</td><td>app_id + user_id + date</td></tr>

           <tr><td colspan="2"><b>Discout Voucher</b></td></tr>
           <tr><td>Check</td><td>app_id + user_id + date</td></tr>
           <tr><td>Active List</td><td>app_id + user_id + date</td></tr>
           <tr><td>Redeem List</td><td>app_id + user_id + date</td></tr>
         </table>

    </div>
    <!-- END Page Content -->
</main>
<!-- END Main Container -->
<?php require_once 'footer.php' ?>
