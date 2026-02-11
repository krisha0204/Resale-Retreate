<?php
ob_start();
include("includes/header.php");
include("conn.php");
session_start();

if (strlen($_SESSION['agmsaid']==0)) {
    header('location:logout.php');
} else {

    if (isset($_GET['delid'])) {
        $rid = intval($_GET['delid']);
        $sql = mysqli_query($conn, "DELETE FROM item WHERE product_id='$rid'");
        echo "<script>alert('Data deleted');</script>";
        echo "<script>window.location.href = 'mitem.php'</script>";
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Manage Items | Resale Retreate</title>

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

html, body {
    margin: 0;
    padding: 0;
    height: 100%;
}

#header {
    width: 100%;
    position: fixed;
    top: 0;
    left: 0;
    height: 70px; /* Adjust header height */
    background: #ffffff; /* Adjust according to theme */
    z-index: 1000;
}

#sidebar {
    width: 200px;
    position: fixed;
    left: 0;
    height: 100%; /* Subtract header height */
    overflow-y: auto; /* Enable scrolling if needed */
    z-index: 1000;
    
}

#main-content {
    margin-left: 200px; /* Sidebar width */
    padding: 20px;
    background: #ffffff; /* Adjust according to theme */
    min-height: 100vh; /* Ensure full viewport height */
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
                            <h3 class="page-header"><i class="fa fa-table"></i> Manage Items</h3>
                            <ol class="breadcrumb">
                                <li><i class="fa fa-home"></i><a href="dashboard.php">Home</a></li>
                                <li><i class="fa fa-table"></i>Manage Items</li>
                                <li><i class="fa fa-th-list"></i>Manage Items</li>
                            </ol>
                        </div>
                    </div>
                    <!-- page start-->
                    <div class="row">
                        <div class="col-sm-12">
                            <section class="panel">
                                <header class="panel-heading">
                                    Manage Items
                                </header>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Product ID</th>
                                            <th>Name</th>
                                            <th>Product Type</th>
                                            <th>Cost</th>
                                            <th>Owner Name</th>
                                            <th>Address</th>
                                            <th>Contact</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $ret = mysqli_query($conn, "SELECT * FROM item");
                                        $cnt = 1;
                                        while ($row = mysqli_fetch_array($ret)) {
                                        ?>
                                            <tr>
                                                <td><?php echo $cnt; ?></td>
                                                <td><?php echo $row['id']; ?></td>
                                                <td><?php echo $row['pname']; ?></td>
                                                <td><?php echo $row['type']; ?></td>
                                                <td><?php echo $row['cost']; ?></td>
                                                <td><?php echo $row['name']; ?></td>
                                                <td><?php echo $row['address']; ?></td>
                                                <td><?php echo $row['contact']; ?></td>
                                                <td>
                                                    <a href="mitem.php?delid=<?php echo $row['product_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a>
                                                </td>
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
