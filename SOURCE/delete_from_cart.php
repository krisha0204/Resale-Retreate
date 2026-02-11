<?php
include("conn.php");

// Check if the product_id is set
if (isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];

    // Prepare the SQL statement to delete the item from the cart
    $query = "DELETE FROM cart WHERE product_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $product_id);

    // Execute the statement
    if ($stmt->execute()) {
        // If successful, redirect back to the cart page
        header("Location: addtocart.php");
        exit;
    } else {
        // If there's an error, display it
        echo "Error deleting item: " . $stmt->error;
    }
} else {
    // If the product_id is not set, redirect back to the cart page
    header("Location: cart.php");
    exit;
}
?>
