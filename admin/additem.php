<?php
session_start();
error_reporting(0);
include('conn.php');
if (strlen($_SESSION['agmsaid']==0)) {
  header('location:logout.php');
  }
  else{

if (isset($_POST['submit'])) {
  

    // Fetch category name based on the selected productType
    $ptype_id = $_POST['productType'];
    $ptype_query = "SELECT c_name FROM category WHERE c_id='$ptype_id'";
    $ptype_result = mysqli_query($conn, $ptype_query);
    $ptype_row = mysqli_fetch_assoc($ptype_result);
    $ptype = $ptype_row['c_name'];
    
    $id = $_POST['productType'];
    $name = $_POST['productname'];
    $pheight = $_POST['productHeight'];
    $pwidth = $_POST['productWidth'];
    $plength = $_POST['productLength'];
    $prdate = $_POST['purchaseDate'];
    $exdate = $_POST['expiryDate'];
    $pcost = $_POST['cost'];
    $des = $_POST['Description'];
    $oname = $_POST['owner_name'];
    $add = $_POST['address'];
    $pinc = $_POST['pincode'];
    $cont = $_POST['contact'];

    // Handle file uploads
    $images = [];
    foreach ($_FILES['photos']['tmp_name'] as $key => $tmp_name) {
        $file_name = $_FILES['photos']['name'][$key];
        $file_tmp = $tmp_name;
        $file_path = "..\upload" . $file_name;
        if (move_uploaded_file($file_tmp, $file_path)) {
            $images[] = $file_path;
        } else {
            echo "<script>alert('Failed to upload image: " . $file_name . "');</script>";
        }
    }
    $img = implode(',', $images);

    if ($conn) {
        $query = "INSERT INTO item (type, id, pname, height, width, length, pdate, edate, cost, info, photo, name, address, pincode, contact) VALUES ('$ptype','$id','$name','$pheight','$pwidth','$plength','$prdate','$exdate','$pcost','$des','$img','$oname','$add','$pinc','$cont')";
        if (mysqli_query($conn, $query)) {
            echo '<script>alert("Product info uploaded successfully.")</script>';
        } else {
            echo "<script>alert('Something went wrong: " . mysqli_error($conn) . "');</script>";
        }
    } else {
        echo "Connection failed: " . mysqli_connect_error();
    }
}

$query = "SELECT c_id, c_name FROM category";
$result = mysqli_query($conn, $query);
$submenu_items = [];
while ($row = mysqli_fetch_assoc($result)) {
    $submenu_items[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Add item | Resale Retreate</title>

  <!-- Bootstrap CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- bootstrap theme -->
  <link href="css/bootstrap-theme.css" rel="stylesheet">
  <!--external css-->
  <!-- font icon -->
  <link href="css/elegant-icons-style.css" rel="stylesheet" />
  <link href="css/font-awesome.min.css" rel="stylesheet" />
  <link href="css/daterangepicker.css" rel="stylesheet" />
  <link href="css/bootstrap-datepicker.css" rel="stylesheet" />
  <link href="css/bootstrap-colorpicker.css" rel="stylesheet" />
  <!-- date picker -->

  <!-- color picker -->

  <!-- Custom styles -->
  <link href="css/style.css" rel="stylesheet">
  <link href="css/style-responsive.css" rel="stylesheet" />
  
  <style>
			  /* Add this CSS to your stylesheet */
			.form-control {
				display: block;
				width: 100%;
				padding: 0.375rem 0.75rem;
				font-size: 1rem;
				line-height: 1.5;
				color: #495057;
				background-color: #fff;
				background-clip: padding-box;
				border: 1px solid #ced4da;
				border-radius: 0.25rem;
				transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
			}

			/* Ensure textarea and select elements have the same height and appearance */
			textarea.form-control, select.form-control {
				height: auto;
				min-height: 38px; /* Adjust as needed */
			}

			/* Adjust the styles for select element specifically if needed */
			select.form-control {
				/* Additional styles for select */
				-webkit-appearance: none;
				-moz-appearance: none;
				appearance: none;
				background-image: url('data:image/svg+xml,%3Csvg viewBox="0 0 4 5" xmlns="http://www.w3.org/2000/svg"%3E%3Cpath fill="none" stroke="%23343a40" stroke-width=".8" d="M2 0L0 2h4zm0 5L0 3h4z"/%3E%3C/svg%3E');
				background-repeat: no-repeat;
				background-position: right 0.75rem center;
				background-size: 8px 10px;
			}
			</style>

</head>

<body>

  <!-- container section start -->
  <section id="container" class="">
    <!--header start-->
    <?php include_once('includes/header.php');?>
    <!--header end-->

    <!--sidebar start-->
   <?php include_once('includes/sidebar.php');?>
    <!--sidebar end-->

    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-file-text-o"></i>Add item</h3>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <section class="panel">
              <header class="panel-heading">
             Add item
              </header>
              <div class="panel-body">
                <form class="form-horizontal " method="post" action="" enctype="multipart/form-data">
               <div class="form-group">
					<label class="col-sm-2 control-label">Category:</label>
								<div class="col-sm-10">
									<select class="form-control" id="productType" name="productType" onchange="showFormSection()" required>
									<option value="">Select a category</option>
										<?php
												foreach ($submenu_items as $item) {
												echo '<option value="' . $item['c_id'] . '">' . $item['c_name'] . '</option>';
										}
										?>
									</select>
								</div>
								<br><br><br>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Product Name</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" id="productname" name="productname" type="text" required="true">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Product Height (in inches)</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" id="productHeight" name="productHeight" type="text" placeholder="inches">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Product Width (in inches)</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" id="productWidth" name="productWidth" type="text" placeholder="inches">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Product Length (in inches)</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" id="productLength" name="productLength" type="text" placeholder="inches">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Purchase Date</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" id="purchaseDate" name="purchaseDate" type="date" required="true">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Expiry Date (Optional)</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" id="expiryDate" name="expiryDate" type="date">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Cost</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" id="cost" name="cost" type="number" placeholder="in rupees" required="true">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Description</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control" id="Description" name="Description"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Upload 4 Photographs of Product</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" id="photos" name="photos[]" type="file" accept="image/*" multiple required="true">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Owner Name</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" id="owner_name" name="owner_name" type="text" required="true">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Address Info</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control" id="address" name="address" required="true"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Pincode</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" id="pincode" name="pincode" type="text" required="true">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Contact</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" id="contact" name="contact" type="text" required="true">
                                        </div>
                                    </div>
                 <p style="text-align: center;"> <button type="submit" name='submit' class="btn btn-primary">Submit</button></p>
                </form>
              </div>
            </section>
            
          </div>
        </div>
        <!-- Basic Forms & Horizontal Forms-->

        
         
      
        <!-- page end-->
      </section>
    </section>
 <?php include_once('includes/footer.php');?>
  </section>
  <!-- container section end -->
  <!-- javascripts -->
  <script src="js/jquery.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <!-- nice scroll -->
  <script src="js/jquery.scrollTo.min.js"></script>
  <script src="js/jquery.nicescroll.js" type="text/javascript"></script>

  <!-- jquery ui -->
  <script src="js/jquery-ui-1.9.2.custom.min.js"></script>

  <!--custom checkbox & radio-->
  <script type="text/javascript" src="js/ga.js"></script>
  <!--custom switch-->
  <script src="js/bootstrap-switch.js"></script>
  <!--custom tagsinput-->
  <script src="js/jquery.tagsinput.js"></script>

  <!-- colorpicker -->

  <!-- bootstrap-wysiwyg -->
  <script src="js/jquery.hotkeys.js"></script>
  <script src="js/bootstrap-wysiwyg.js"></script>
  <script src="js/bootstrap-wysiwyg-custom.js"></script>
  <script src="js/moment.js"></script>
  <script src="js/bootstrap-colorpicker.js"></script>
  <script src="js/daterangepicker.js"></script>
  <script src="js/bootstrap-datepicker.js"></script>
  <!-- ck editor -->
  <script type="text/javascript" src="assets/ckeditor/ckeditor.js"></script>
  <!-- custom form component script for this page-->
  <script src="js/form-component.js"></script>
  <!-- custome script for all page -->
  <script src="js/scripts.js"></script>


</body>

</html>
<?php  } ?>