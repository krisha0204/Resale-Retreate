<?php
session_start();
error_reporting(0);
include("conn.php");

// Fetch submenu items from the database
$submenu_items = [];
$sql = "SELECT c_name FROM category";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $submenu_items[] = $row['c_name'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website</title>
    <style>
        /* Your existing styles */
        .dropdown-menu a:hover {
            background-color: #F5DAD5;
        }
		
    </style>
</head>
 <script>
         addEventListener("load", function () {
         	setTimeout(hideURLbar, 0);
         }, false);
         
         function hideURLbar() {
         	window.scrollTo(0, 1);
         }
      </script>
      <!--//meta tags ends here-->
      <!--booststrap-->
      <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" media="all">
      <!--//booststrap end-->
      <!-- font-awesome icons -->
      <link href="css/fontawesome-all.min.css" rel="stylesheet" type="text/css" media="all">
      <!-- //font-awesome icons -->
      <!-- For Clients slider -->
      <link rel="stylesheet" href="css/flexslider.css" type="text/css" media="all" />
      <!--flexs slider-->
      <link href="css/JiSlider.css" rel="stylesheet">
      <!--Shoping cart-->
      <link rel="stylesheet" href="css/shop.css" type="text/css" />
      <!--//Shoping cart-->
      <!--stylesheets-->
      <link href="css/style.css" rel='stylesheet' type='text/css' media="all">
      <!--//stylesheets-->
      <link href="//fonts.googleapis.com/css?family=Sunflower:500,700" rel="stylesheet">
      <link href="//fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet">
   <link rel="stylesheet" type="text/css" href="engine1/style.css" />
	<script type="text/javascript" src="engine1/jquery.js"></script>
<body>
<div class="header-bar">
    <!-- <div class="info-top-grid">
        <img src="img1.jpg" width="100%" height="200">-->
    <!-- <div class="info-contact-agile">-->
</div>

<div class="container-fluid">
    <div class="hedder-up row">
        <table width="100%" bgcolor="#602825">
            <tr>
                <td width="20%">&nbsp;</td>
                <td><img src="includes/logo.jpg"></td>
            </tr>
        </table>
    </div>
</div>

<nav class="navbar navbar-expand-lg navbar-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a href="upload.php" class="nav-link">Upload</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle"  id="navbarDropdown1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Shop
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown1">
                    <?php
                    foreach ($submenu_items as $item) {
                        echo '<a class="dropdown-item" href="' . strtolower($item) . '.php">' . $item . '</a>';
                    }
                    ?>
                </div>
            </li>
            <li class="nav-item">
                <a href="about.php" class="nav-link">About Us</a>
            </li>
            <li class="nav-item">
                <a href="contactus.php" class="nav-link">Contact Us</a>
            </li>
            <?php if (isset($_SESSION['username'])) { ?>
                <li class="nav-item">
                    <a href="logout.php" class="nav-link">Logout</a>
                </li>
            <?php } else { ?>
                <li class="nav-item">
                    <a href="login.php" class="nav-link">Login</a>
                </li>
            <?php } ?>
			<li class="nav-item">
			<a href="addtocart.php" class="nav-link">
				<img src="includes/cart.png" alt="Cart" style="width: 24px; height: 24px;"/>
			</a>
		</li>
        </ul>
    </div>
</nav>
</body>
</html>
