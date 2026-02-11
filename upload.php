<?php 
ob_start();
error_reporting(E_ALL);
//include('includes/header.php');
include_once('includes/header.php');

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // Redirect to the full login page if the user is not logged in
    header("Location: login.php");
    exit;
}


// Fetch submenu items from the database
$query = "SELECT c_id, c_name FROM category";
$result = mysqli_query($conn, $query);
$submenu_items = [];
while ($row = mysqli_fetch_assoc($result)) {
    $submenu_items[] = $row;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Product Form</title>
    <script>
        addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }

        function showFormSection() {
            var productType = document.getElementById('productType').value;
            var formSection = document.getElementById('formSection');
            if (productType) {
                formSection.style.display = 'block';
            } else {
                formSection.style.display = 'none';
            }
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
    <!--Shopping cart-->
    <link rel="stylesheet" href="css/shop.css" type="text/css" />
    <!--//Shopping cart-->
    <!--stylesheets-->
    <link href="css/style.css" rel='stylesheet' type='text/css' media="all">
    <!--//stylesheets-->
    <link href="//fonts.googleapis.com/css?family=Sunflower:500,700" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="engine1/style.css" />
    <script type="text/javascript" src="engine1/jquery.js"></script>
    <style>
        body, html {
            background-color: #F5DAD5;
            padding: 0;
            margin: 0;
            justify-content: center;
            align-items: center;
            box-sizing: border-box;
			Height:100vh;
			margin-right:0;
			margin-left:0;
			width: 100%;
			height: 100%;
        }


        header {
            width: 100%;
            margin: 0;
            padding: 0;
        }

        .container {
            padding: 20px;
			background-color: #F5DAD5;
			 box-sizing: border-box;
        }
		

        form {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: auto;
            padding: 20px;
            margin-top: 20px;
			box-sizing: border-box;
        }

        .back-button {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .back-button a {
            text-decoration: none;
            color: #602825;
            font-size: 40px;
            font-weight: bold;
        }

        .back-button a:hover {
            color: #844356;
        }

        .form-section {
            display: none;
            margin-top: 20px;
			
        }

        .form-group {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
			 box-sizing: border-box;
        }

        .form-group label {
            flex: 1;
            font-weight: bold;
            margin-right: 0;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            flex: 2;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        button {
            background-color: #602825;
            color: white;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 10px;
        }

        button:hover {
            background-color: #844356;
        }
        
        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }
    </style>
</head>
<body>
   
    <div class="container clearfix">
        <form id="productForm" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="productType">Category:</label>
                <select id="productType" name="productType" onchange="showFormSection()" required>
                    <option value="">Select a category</option>
                    <?php
                        foreach ($submenu_items as $item) {
                            echo '<option value="' . $item['c_id'] . '">' . $item['c_name'] . '</option>';
                        }
                    ?>
                </select>
            </div>
            <div id="formSection" class="form-section">
                <div class="form-group">
                    <label for="productname">Product Name:</label>
                    <input type="text" id="productname" name="productname" required>
                </div>
                <div class="form-group">
                    <label for="productHeight">Product Height (in inches):</label>
                    <input type="text" id="productHeight" name="productHeight" placeholder="inches">
                </div>
                <div class="form-group">
                    <label for="productWidth">Product Width (in inches):</label>
                    <input type="text" id="productWidth" name="productWidth" placeholder="inches">
                </div>
                <div class="form-group">
                    <label for="productLength">Product Length (in inches):</label>
                    <input type="text" id="productLength" name="productLength" placeholder="inches">
                </div>
                <div class="form-group">
                    <label for="purchaseDate">Purchase Date:</label>
                    <input type="date" id="purchaseDate" name="purchaseDate" required>
                </div>
                <div class="form-group">
                    <label for="expiryDate">Expiry Date (Optional):</label>
                    <input type="date" id="expiryDate" name="expiryDate">
                </div>
                <div class="form-group">
                    <label for="cost">Cost:</label>
                    <input type="number" id="cost" name="cost" placeholder="in rupees" required>
                </div>
                <div class="form-group">
                    <label for="Description">Description:</label>
                    <textarea id="Description" name="Description"></textarea>
                </div>
                <div class="form-group">
                    <label for="photos">Upload 4 Photographs of Product:</label>
                    <input type="file" id="photos" name="photos[]" accept="image/*" multiple required>
                </div>
                <div class="form-group">
                    <label for="owner_name">Owner Name:</label>
                    <input type="text" id="owner_name" name="owner_name" required>
                </div>
                <div class="form-group">
                    <label for="address">Address Info:</label>
                    <textarea id="address" name="address" required></textarea>
                </div>
                <div class="form-group">
                    <label for="pincode">Pincode:</label>
                    <input type="text" id="pincode" name="pincode" required>
                </div>
                <div class="form-group">
                    <label for="contact">Contact:</label>
                    <input type="text" id="contact" name="contact" required>
                </div>
                <button type="submit" name="submit" class="button">Submit</button>
            </div>
        </form>
    </div>
</body>
</html>

<?php
if (session_status() == PHP_SESSION_NONE) { 
    session_start();
}
error_reporting(E_ALL);

include("conn.php");

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
        $file_path = "upload/" . $file_name;
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
			 echo "<script>window.location.href = 'index.php';</script>";

        } else {
            echo "<script>alert('Something went wrong: " . mysqli_error($conn) . "');</script>";
        }
    } else {
        echo "Connection failed: " . mysqli_connect_error();
    }
}
?>

</body>
</html>
