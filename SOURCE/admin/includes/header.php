   <?php
session_start();
error_reporting(0);
include('conn.php');
?>
   <header class="header dark-bg">
      <div class="toggle-nav">
        <div class="icon-reorder tooltips" data-original-title="Toggle Navigation" data-placement="bottom"><i class="icon_menu"></i></div>
      </div>
<?php
$adid=$_SESSION['agmsaid'];
$ret=mysqli_query($conn,"select username from admin where ID='$adid'");
$row=mysqli_fetch_array($ret);
$name=$row['username'];

?>
      <!--logo start-->
      <a href="dashboard.php" class="logo"><span class="lite"><strong> Resale Retreate | Admin</strong></span></a>
      <!--logo end-->

      

      <div class="top-nav notification-row">
        <!-- notificatoin dropdown start-->
        <ul class="nav pull-right top-menu">

          
        
 
            
             
              
            </ul>
          </li>
          <!-- alert notification end-->
          <!-- user login dropdown start-->
          <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="profile-ava">
                                <img alt="" src="images/av1.jpg" width="40" height="30">
                            </span>
                            
                            <span class="username"><?php echo $name; ?></span>
                            <b class="caret"></b>
                        </a>
            <ul class="dropdown-menu extended logout">
              <div class="log-arrow-up"></div>
             
              <li>
                <a href="logout.php"><i class="icon_key_alt"></i> Log Out</a>
              </li>
             
            </ul>
          </li>
          <!-- user login dropdown end -->
        </ul>
        <!-- notificatoin dropdown end-->
      </div>
    </header>