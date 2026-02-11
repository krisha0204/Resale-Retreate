<?php
ob_start();
include("includes/header.php");
include("conn.php");

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // Redirect to the full login page if the user is not logged in
    header("Location: login.php");
    exit;
}

// Fetch all items in the cart for the logged-in user
$username = $_SESSION['username'];
$query = "SELECT * FROM cart WHERE username = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$cart_items = [];
while ($row = $result->fetch_assoc()) {
    $cart_items[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Shopping Cart</title>
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
      <!--Shoping cart-->
      <link rel="stylesheet" href="css/shop.css" type="text/css" />
      <!--//Shoping cart-->
      <!--stylesheets-->
      <link href="css/style.css" rel='stylesheet' type='text/css' media="all">
      <!--//stylesheets-->
      <link href="//fonts.googleapis.com/css?family=Sunflower:500,700" rel="stylesheet">
      <link href="//fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet">
      
    <style>
        .body {
            background-color: #F5DAD5;
            color: #333;
            margin: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
            height: auto;
            background-size: cover;
        }
        .back-button {
            position: absolute;
            top: 20px;
            left: 20px;
        }
        .back-button a {
            text-decoration: none;
            color: #844356;
            font-size: 40px;
            font-weight: bold;
        }
        .back-button a:hover {
            color: #602825;
        }
        .main-content {
            background-color: #F5DAD5;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            width: 100%;
            height: auto;
            padding: 40px 20px 20px;
            box-sizing: border-box;
        }
        .product-content {
            flex: 0 1 60%;
            overflow-y: auto;
            padding: 60px 20px 20px;
            transition: width 0.5s;
            box-sizing: border-box;
        }
        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }
        .form-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
        }
        .slider {
            position: relative;
            width: 40%;
            margin-right: 20px;
        }
        .slides {
            display: flex;
            transition: transform 0.5s ease-in-out;
        }
        .slides img {
            width: 100%;
            max-height: 300px;
            cursor: pointer;
            border-radius: 8px;
            display: none;
        }
        .slides img.active {
            display: block;
        }
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            padding-top: 100px;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0, 0, 0);
            background-color: rgba(0, 0, 0, 0.9);
        }
        .modal-content {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 700px;
        }
        .modal-content img {
            width: 100%;
        }
        .close {
            position: absolute;
            top: 15px;
            right: 35px;
            color: #f1f1f1;
            font-size: 40px;
            font-weight: bold;
            transition: 0.3s;
            cursor: pointer;
        }
        .close:hover,
        .close:focus {
            color: #bbb;
            text-decoration: none;
            cursor: pointer;
        }
        .prev,
        .next {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
            border-radius: 50%;
        }
        .prev {
            left: 10px;
        }
        .next {
            right: 10px;
        }
        .product-details {
            padding: 20px;
            width: 60%;
        }
        .product-details h2 {
            margin-top: 0;
        }
        .product-details p {
            margin: 10px 0;
        }
        .btn-container {
            display: flex;
            justify-content: flex-start;
            margin-top: 20px;
        }
        .btn {
            background-color: #602825;
            color: white;
            padding: 10px 20px;
            text-align: center;
            border-radius: 5px;
            text-decoration: none;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }
        .btn + .btn {
            margin-left: 10px;
        }
        .btn:hover {
            background-color: #3A0068;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <!-- code to display images of products -->
	<script>
        $(document).ready(function () {
            $('.slider').each(function () {
                let currentIndex = 0;
                const slides = $(this).find('.slides img');
                const totalSlides = slides.length;

                function showSlide(index) {
                    slides.removeClass('active');
                    if (index >= totalSlides) {
                        currentIndex = 0;
                    } else if (index < 0) {
                        currentIndex = totalSlides - 1;
                    } else {
                        currentIndex = index;
                    }
                    slides.eq(currentIndex).addClass('active');
                }

                $(this).find('.prev').click(function () {
                    showSlide(currentIndex - 1);
                });
                $(this).find('.next').click(function () {
                    showSlide(currentIndex + 1);
                });
                showSlide(currentIndex);
            });
        });

        function openModal(imageSrc) {
            $(".modal-content img").attr("src", imageSrc);
            $(".modal").css("display", "block");
        }

        function closeModal() {
            $(".modal").css("display", "none");
        }
    </script>
</head>
<body>
<div class="main-content clearfix">
    <div class="product-content">
        <?php if (count($cart_items) > 0) { ?>
            <?php foreach ($cart_items as $item) { ?>
                <div class="form-container">
                    <div class="slider">
                        <div class="slides">
                            <?php // get and seperate images from db
                            $photos = explode(',', $item['photo']);
                            foreach ($photos as $index => $photo) {
                                $photo = trim($photo);
                                $activeClass = ($index === 0) ? 'active' : '';
                                echo "<img src='$photo' alt='Product Image' class='$activeClass' onclick='openModal(this.src)'>";
                            }
                            ?>
                        </div>
                    </div>
                   
                    <div class="product-details">
                        <h2>Item Details</h2>
                        <p><strong>Product:</strong> <?php echo $item['pname']; ?></p>
                        <p><strong>Cost:</strong> ₹<?php echo $item['cost']; ?></p>
                        <form action="delete_from_cart.php" method="post">
                            <input type="hidden" name="product_id" value="<?php echo $item['product_id']; ?>">
                            <button type="submit" class="btn">Delete</button>
                        </form>
                    </div>
                </div>
            <?php } ?>
            <form action="checkout.php" method="post">
                    <button type="submit" class="btn">Checkout</button>
            </form>
            </div>
			
        <?php } else { ?>
            <p><center>No items in the cart :(</p><br><br><br><br><br><br><br><br><br><br><br>
        <?php } ?>
    </div>
</div>
</body>
</html>
