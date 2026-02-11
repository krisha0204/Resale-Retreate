<?php
ob_start();
include("includes/header.php");
include("conn.php");
session_start();

if (strlen($_SESSION['agmsaid']==0)) {
    header('location:logout.php');
} else {
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>All Sales | Resale Retreate</title>

    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- bootstrap theme -->
    <link href="css/bootstrap-theme.css" rel="stylesheet">
    <!--external css-->
    <!-- font icons -->
    <link href="css/elegant-icons-style.css" rel="stylesheet" />
    <link href="css/font-awesome.min.css" rel="stylesheet" />
    <!-- Custom styles -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet" />

    <style>
    /* Global reset */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body, html {
        margin: 0;
        padding: 0;
    }

    #header {
        width: 100%;
        position: fixed;
        top: 0;
        left: 0;
        height: 70px; /* Adjust according to your header height */
        background: #ffffff; /* Adjust according to your theme */
        z-index: 1000;
    }

    #sidebar {
        width: 200px;
        position: fixed;
        left: 0;
        height: calc(100% - 70px); /* Subtract the height of the header */
        z-index: 1000;
    }

    #main-content {
        margin-left: 200px; /* Width of the sidebar */
        padding: 20px;
        background: #ffffff; /* Adjust according to your theme */
        min-height: calc(100vh - 70px); /* Ensure it takes up full viewport height minus header */
    }
    </style>
</head>

<body>
    <!-- container section start -->
    <section id="container" class="">
        <!--header start-->
        <?php include_once('includes/header.php'); ?>
        <!--header end-->

        <!--sidebar start-->
        <?php include_once('includes/sidebar.php'); ?>
        <!--sidebar end-->

        <!--main content start-->
        <section id="main-content">
            <section class="wrapper">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <h3 class="page-header"><i class="fa fa-shopping-cart"></i> All Sales</h3>
                            <ol class="breadcrumb">
                                <li><i class="fa fa-home"></i><a href="dashboard.php">Home</a></li>
                                <li><i class="fa fa-shopping-cart"></i>All Sales</li>
                            </ol>
                        </div>
                    </div>
                    <!-- page start-->
                    <div class="row">
                        <div class="col-sm-12">
                            <section class="panel">
                                <header class="panel-heading">
                                    All Sales
                                </header>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Product Name</th>
                                            <th>Price</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Email</th>
                                            <th>Contact</th>
                                            <th>Address</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $ret = mysqli_query($conn, "SELECT * FROM checkout");
                                        $cnt = 1;
                                        while ($row = mysqli_fetch_array($ret)) {
                                        ?>
                                            <tr>
                                                <td><?php echo $cnt; ?></td>
                                                <td><?php echo $row['pname']; ?></td>
                                                <td><?php echo $row['price']; ?></td>
                                                <td><?php echo $row['fname']; ?></td>
                                                <td><?php echo $row['lname']; ?></td>
                                                <td><?php echo $row['email']; ?></td>
                                                <td><?php echo $row['contact']; ?></td>
                                                <td><?php echo $row['address']; ?></td>
                                            </tr>
                                        <?php
                                            $cnt = $cnt + 1;
                                        } ?>
                                    </tbody>
                                </table>
                            </section>
                        </div>
                    </div>
                    <!-- page end-->
                </div>
            </section>
        </section>
        <!--main content end-->
        <?php include_once('includes/footer.php'); ?>
    </section>
    <!-- container section end -->
    <!-- javascripts -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.scrollTo.min.js"></script>
    <script src="js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="js/scripts.js"></script>
</body>

</html>
<?php } ?>
