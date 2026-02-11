<?php
ob_start();
include("includes/header.php");
include("conn.php");
session_start();

if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit();
}

if (!isset($_GET['product_id'])) {
    die('Product ID is not specified.');
}

$product_id = $_GET['product_id'];

// Query to get product details
$query = "SELECT * FROM item WHERE product_id = ?";
$stmt = $conn->prepare($query);

if (!$stmt) {
    die('Query preparation failed: ' . $conn->error);
}

$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();
$item = $result->fetch_assoc();

if (!$item) {
    die('Product not found.');
}
$photos = explode(',', $item['photo']); // Photo array
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buy Now</title>
    <!-- Razorpay Script -->
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <!-- Stylesheets -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/fontawesome-all.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <style>
        html, body {
            height: 100%;
            padding: 0;
            margin: 0;
            background-color: #F5DAD5;
            font-family: 'Open Sans', sans-serif;
        }
        .buynow {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 50%;
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
        }
        .details {
            display: flex;
            align-items: flex-start; /* Align items to the top of the row */
        }
        .slider {
            width: 40%; /* Adjust photo section width */
            margin-right: 20px;
        }
        .slider img {
            width: 80px; /* Reduced photo size further */
            height: auto;
            margin-bottom: 10px;
            border-radius: 8px;
            border: 1px solid #ccc;
        }
        .info {
           
        }
        .info p {
            
            font-size: 18px;
            color: #333;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .form-group button {
            background-color: #602825;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            width: 100%;
        }
        .form-group button:hover {
            background-color: #844356;
        }
    </style>
</head>
<body>
<div class="buynow">
    <h5>Product Details</h5><br>
    <div class="details">
        <div class="slider">
            <?php foreach ($photos as $photo): ?>
                <img src="<?php echo trim($photo); ?>" alt="Product Image">
            <?php endforeach; ?>
        </div>
        <div class="info">
            <p><strong>Item:</strong> <?php echo $item['pname']; ?></p>
            <p><strong>Price:</strong> ₹<?php echo $item['cost']; ?></p>
        </div>
    </div><br>
    <h5>Shipping Details</h5><br>
    <form id="checkoutForm" method="POST" action="">
        <div class="form-group">
            <label>First Name:</label>
            <input type="text" name="first_name" required>
        </div>
        <div class="form-group">
            <label>Last Name:</label>
            <input type="text" name="last_name" required>
        </div>
        <div class="form-group">
            <label>Email:</label>
            <input type="email" name="email" required>
        </div>
        <div class="form-group">
            <label>Contact:</label>
            <input type="tel" name="contact" required>
        </div>
        <div class="form-group">
            <label>Shipping Address:</label>
            <textarea name="address" required></textarea>
        </div>
        <input type="hidden" name="item_name" value="<?php echo $item['pname']; ?>">
        <input type="hidden" name="item_price" value="<?php echo $item['cost']; ?>">
        <div class="form-group">
            <button type="button" onclick="initiateRazorpay()">Pay with Razorpay</button>
        </div>
    </form>
</div>
<script>
    function initiateRazorpay() {
        const options = {
            key: "rzp_test_Wi972bG7df7ltY", // Replace with your Razorpay API Key
            amount: <?php echo $item['cost'] * 100; ?>, // Amount in paise
            currency: "INR",
            name: "Resale Retreate",
            description: "Product Purchase",
            handler: function (response) {
                // On successful payment
                alert("Payment successful! Payment ID: " + response.razorpay_payment_id);
                // Submit the form after payment success
                document.getElementById("checkoutForm").submit();
            },
            prefill: {
                name: "<?php echo $_SESSION['loggedin'] ? $_SESSION['loggedin'] : ''; ?>",
                email: "<?php echo $_SESSION['email'] ?? ''; ?>",
                contact: "<?php echo $_SESSION['contact'] ?? ''; ?>"
            },
            theme: {
                color: "#602825"
            }
        };
		
        const rzp = new Razorpay(options);
        rzp.open();
    }
</script>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $itemName = $_POST['item_name'];
    $itemPrice = $_POST['item_price'];
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];

    // Insert query for checkout
    $sql = "INSERT INTO checkout (pname, price, fname, lname, email, contact, address) 
            VALUES ('$itemName', '$itemPrice', '$firstName', '$lastName', '$email', '$contact', '$address')";
    
    if (mysqli_query($conn, $sql)) {
        // Deletion queries
        $deleteItemQuery = "DELETE FROM item WHERE pname='$itemName'";
        $deleteCartQuery = "DELETE FROM cart WHERE pname='$itemName'";
        mysqli_query($conn, $deleteItemQuery);
        mysqli_query($conn, $deleteCartQuery);
        echo '<script>alert("Checkout successful and payment recorded!");</script>';
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
	
    mysqli_close($conn);
	    echo '<script>window.location.href = "index.php";</script>';

}

?>
</body>
</html>
