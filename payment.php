<?php
session_start();
include("includes/header.php");
include("conn.php");

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$username = $_SESSION['username'];
$totalAmount = 0;

// Enable error reporting for debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Fetch cart items for the logged-in user
$query = "SELECT * FROM cart WHERE username = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

$cart_items = [];
while ($row = $result->fetch_assoc()) {
    $cart_items[] = $row;
    $totalAmount += $row['cost'];
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['first_name'])) {
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];

    foreach ($cart_items as $item) {
        $sql = "INSERT INTO checkout (pname, price, fname, lname, email, contact, address) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssss", $item['pname'], $item['cost'], $firstName, $lastName, $email, $contact, $address);
        $stmt->execute();

        // Remove item from the cart
        $deleteQuery = "DELETE FROM cart WHERE product_id = ?";
        $stmt = $conn->prepare($deleteQuery);
        $stmt->bind_param("i", $item['product_id']);
        $stmt->execute();
    }

    // Store total amount for Razorpay
    $_SESSION['amount'] = $totalAmount;

    // Trigger Razorpay directly
    echo '<script>initiateRazorpay();</script>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <style>
        html, body {
            height: 100%;
            padding: 0;
            background-color: #F5DAD5;
            justify-content: center;
            align-items: center;
        }
        .checkout {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 600px;
            padding: 20px;
            margin: auto;
        }
        .form-group {
            margin-bottom: 15px;
            padding: 10px;
        }
        .form-group label {
            font-size: 18px;
            display: block;
            margin-bottom: 0px;
        }
        .form-group input,
        .form-group textarea {
            width: 100%;
            font-size: 16px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }
        .form-group textarea {
            resize: horizontal;
            height: 100px;
        }
        .form-group button {
            background-color: #602825;
            color: white;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 10px; /* Adjust this value to position the button lower */
            display: block;
            width: 100%;
        }
        .form-group button:hover {
            background-color: #844356;
        }
    </style>
	
</head>
<body>
<div class="checkout">
    <h5>Shipping Details:</h5>
    <form method="POST" id="checkoutForm">
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
        <div class="form-group">
            <strong>Total Amount: ₹<?php echo $totalAmount; ?></strong>
        </div>
        <div class="form-group">
            <button type="submit">Checkout</button>
        </div>
    </form>
</div>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    function initiateRazorpay() {
        console.log("Initiating Razorpay"); // Debugging
        const options = {
            key: "rzp_test_Wi972bG7df7ltY", // Replace with your API key
            amount: <?php echo $_SESSION['amount'] * 100; ?>, // Amount in paise
            currency: "INR",
            name: "Resale Retreat",
            description: "Purchase",
            handler: function (response) {
                alert("Payment successful! Payment ID: " + response.razorpay_payment_id);
                window.location.href = "index.php"; // Redirect on success
            },
            theme: {
                color: "#3399cc"
            }
        };

        const rzp = new Razorpay(options);
        rzp.open();
    }

    document.getElementById('checkoutForm').addEventListener('submit', function (e) {
        e.preventDefault(); // Prevent form submission
        initiateRazorpay();
    });
</script>
</body>
</html>
