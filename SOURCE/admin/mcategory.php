<?php
session_start();
error_reporting(0);
include('conn.php');
if (strlen($_SESSION['agmsaid']==0)) {
  header('location:logout.php');
  } else{

if(isset($_GET['delid']))
{
$rid=intval($_GET['delid']);
$sql=mysqli_query($conn,"delete from category where c_id ='$rid'");
 echo "<script>alert('Data deleted');</script>"; 
  echo "<script>window.location.href = 'mcategory.php'</script>";     


}

  ?>
<!DOCTYPE html>
<html lang="en">

<head>

  <title>Manage Artist | Resale Retreate</title>

  <!-- Bootstrap CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- bootstrap theme -->
  <link href="css/bootstrap-theme.css" rel="stylesheet">
  <!--external css-->
  <!-- font icon -->
  <link href="css/elegant-icons-style.css" rel="stylesheet" />
  <link href="css/font-awesome.min.css" rel="stylesheet" />
  <!-- Custom styles -->
  <link href="css/style.css" rel="stylesheet">
  <link href="css/style-responsive.css" rel="stylesheet" />

</head>

<body>
  <!-- container section start -->
  <section id="container" class="">
    <!--header start-->
    <?php include_once('includes/header.php');?>
    <!--header end-->

    <!--sidebar start-->
    <?php include_once('includes/sidebar.php');?>

    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-table"></i> Manage categories</h3>
            
          </div>
        </div>
        <!-- page start-->
        <div class="row">
          <div class="col-sm-12">
            <section class="panel">
              <header class="panel-heading">
                Manage categories
              </header>
              <table class="table">
                <thead>
                                        
                  <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Action</th>
                  </tr>
                                        
                </thead>
               <?php
$ret=mysqli_query($conn,"select * from  category");
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {

?>
              
                <tr>
                <td><?php  echo $row['c_id'];?></td>
                <td><?php  echo $row['c_name'];?></td> 
                <td><a href="ecategory.php?editid=<?php echo $row['c_id'];?>" class="btn btn-success">Edit</a> ||
   				  <a href="mcategory.php?delid=<?php echo $row['c_id'];?>" class="btn btn-danger">Delete</a></td>
                </tr>
<?php  } ?>
              </table>
            </section>
          </div>
       
        </div>
       
        <!-- page end-->
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