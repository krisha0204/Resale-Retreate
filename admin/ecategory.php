<?php
session_start();
error_reporting(0);
include('conn.php');
if (strlen($_SESSION['agmsaid'] == 0)) {
    header('location:logout.php');
} else {
    if (isset($_POST['submit'])) {
        $name = $_POST['cname'];
        $cid = $_GET['editid']; // Assign the value to $cid here

        // Use prepared statements to prevent SQL injection
        $stmt = $conn->prepare("UPDATE category SET c_name=? WHERE c_id=?"); // Correct the column name here
        $stmt->bind_param("si", $name, $cid);
        $result = $stmt->execute();

        if ($result) {
            echo "<script>alert('Category has been updated.');</script>";
			echo "<script>window.location.href ='mcategory.php'</script>";

        } else {
            echo "<script>alert('Something went wrong. Please try again.');</script>";
        }
        
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Update Category | Resale Retreat</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-theme.css" rel="stylesheet">
    <link href="css/elegant-icons-style.css" rel="stylesheet" />
    <link href="css/font-awesome.min.css" rel="stylesheet" />
    <link href="css/daterangepicker.css" rel="stylesheet" />
    <link href="css/bootstrap-datepicker.css" rel="stylesheet" />
    <link href="css/bootstrap-colorpicker.css" rel="stylesheet" />
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet" />
</head>

<body>
    <section id="container" class="">
	    <?php include_once('includes/header.php'); ?>
        <?php include_once('includes/sidebar.php'); ?>
        <section id="main-content">
            <section class="wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="page-header"><i class="fa fa-file-text-o"></i>Update Category</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <section class="panel">
                            <header class="panel-heading">
                                Update Category
                            </header>
                            <div class="panel-body">
                                <form class="form-horizontal" method="post" action="">
                                    <?php
                                    $cid = $_GET['editid'];
                                    $ret = mysqli_query($conn, "SELECT * FROM category WHERE c_id='$cid'");
                                    while ($row = mysqli_fetch_array($ret)) {
                                    ?>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Name</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" id="cname" name="cname" type="text" required="true" value="<?php echo $row['c_name']; ?>">
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <p style="text-align: center;">
                                        <button type="submit" name='submit' class="btn btn-primary">Update</button>
                                    </p>
                                </form>
                            </div>
                        </section>
                    </div>
                </div>
            </section>
        </section>
    </section>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.scrollTo.min.js"></script>
    <script src="js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="js/jquery-ui-1.9.2.custom.min.js"></script>
    <script src="js/bootstrap-switch.js"></script>
    <script src="js/jquery.tagsinput.js"></script>
    <script src="js/jquery.hotkeys.js"></script>
    <script src="js/bootstrap-wysiwyg.js"></script>
    <script src="js/bootstrap-wysiwyg-custom.js"></script>
    <script src="js/moment.js"></script>
    <script src="js/bootstrap-colorpicker.js"></script>
    <script src="js/daterangepicker.js"></script>
    <script src="js/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="assets/ckeditor/ckeditor.js"></script>
    <script src="js/form-component.js"></script>
    <script src="js/scripts.js"></script>
</body>

</html>
