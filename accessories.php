<?php
ob_start();
error_reporting(E_ALL);
include("includes/header.php");
include("conn.php");

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // Redirect to the full login page if the user is not logged in
    header("Location: login.php");
    exit;
}

// Fetch all items with ID = 1 (assuming it represents a specific category)
$item_id = 3;
$query = "SELECT * FROM item WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $item_id);
$stmt->execute();
$result = $stmt->get_result();
$items = [];
while ($item = $result->fetch_assoc()) {
    $items[] = $item;
}

// Handle adding items to the cart
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];
    $username = $_SESSION['username']; // Assuming username is stored in the session

    // Check if the item is already in the cart
    $check_query = "SELECT * FROM cart WHERE product_id = ? AND username = ?";
    $stmt = $conn->prepare($check_query);
    $stmt->bind_param("is", $product_id, $username);
    $stmt->execute();
    $check_result = $stmt->get_result();
    
    if ($check_result->num_rows === 0) {
        // Fetch item details from the item table
        $query = "SELECT * FROM item WHERE product_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $item = $result->fetch_assoc();

        if (!$item) {
            $message = 'Item not found in the item table.';
        } else {
            // Insert item details into the cart table
            $query = "INSERT INTO cart (username, product_id, pname, photo, cost, type, id) 
                      VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("sissssi", $username, $item['product_id'], $item['pname'], $item['photo'], $item['cost'], 
                              $item['type'], $item['id']);
            if ($stmt->execute()) {
                $message = 'Item added to cart successfully.';
            } else {
                $message = 'Error inserting item into the cart: ' . $stmt->error;
            }
        }
    } else {
        $message = 'Item already in the cart.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Product Details</title>
    <script>
        addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    <!-- Meta tags, bootstrap, and stylesheets -->
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" media="all">
    <link href="css/fontawesome-all.min.css" rel="stylesheet" type="text/css" media="all">
    <link rel="stylesheet" href="css/shop.css" type="text/css" />
    <link href="css/style.css" rel='stylesheet' type='text/css' media="all">
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
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0,0.9);
        }
        .modal-content {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 700px;
        }
        .close {
            position: absolute;
            top: 15px;
            right: 35px;
            color: #f1f1f1;
            font-size: 40px;
            font-weight: bold;
            transition: 0.3s;
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
            background-color: rgba(0,0,0,0.5);
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
            document.getElementById("modalImage").src = imageSrc;
            document.getElementById("imageModal").style.display = "block";
        }

        
        function closeModal() {
            $(".modal").css("display", "none");
        }
    </script>
</head>
<body>
<div class="main-content clearfix">
    <div class="product-content">
        <?php if ($message) { ?>
            <div class="alert alert-info"><?php echo $message; ?></div>
        <?php } ?>
        <?php foreach ($items as $item) { ?>
        <div class="form-container">
            <div class="slider">
                <div class="slides">
                    <?php
                    $photos = explode(',', $item['photo']);
                    foreach ($photos as $index => $photo) {
                        $photo = trim($photo);
                        $activeClass = ($index === 0) ? 'active' : '';
                        echo "<img src='$photo' alt='Product Image' class='$activeClass' onclick='openModal(this.src)'>";
                    }
                    ?>
                </div>
                <button class="prev" onclick="moveSlide(this, -1)">&#10094;</button>
                <button class="next" onclick="moveSlide(this, 1)">&#10095;</button>
            </div>
            <div class="product-details">
                <h2>Item Details</h2>
                <p><strong>Product:</strong> <?php echo $item['pname']; ?></p>
                <?php if (!empty($item['height'])) { ?>
                    <p><strong>Height:</strong> <?php echo $item['height']; ?> inches</p>
                <?php } ?>
                <?php if (!empty($item['width'])) { ?>
                    <p><strong>Width:</strong> <?php echo $item['width']; ?> inches</p>
                <?php } ?>
                <?php if (!empty($item['length'])) { ?>
                    <p><strong>Length:</strong> <?php echo $item['length']; ?> inches</p>
                <?php } ?>
                <p><strong>Purchase Date:</strong> <?php echo $item['pdate']; ?></p>
                <?php if ($item['edate'] !== '0000-00-00') { ?>
                    <p><strong>Expiry Date:</strong> <?php echo $item['edate']; ?></p>
                <?php } ?>
                <p><strong>Cost:</strong> ₹<?php echo $item['cost']; ?></p>
                <p><strong>Description:</strong> <?php echo $item['info']; ?></p>
                
                <div class="btn-container">
                    <form action="buynow.php" method="get">
                        <input type="hidden" name="product_id" value="<?php echo $item['product_id']; ?>">
                        <button type="submit" class="btn">Buy Now</button>
                    </form>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <form action="" method="post">
                    <input type="hidden" name="product_id" value="<?php echo $item['product_id']; ?>">
                    <button type="submit" class="btn">Add to Cart</button>
                    </form>
                    
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>
<div id="imageModal" class="modal">
    <span class="close" onclick="closeModal()">&times;</span>
    <img class="modal-content" id="modalImage">
</div>
</body>
</html>
    
   
   