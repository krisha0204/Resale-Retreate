<?php include("includes/header.php");?>
<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <style>
        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }
        body, html {
            font-family: Arial, sans-serif;
            background-color: #F5DAD5;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
			position:absolute;
        }
        .back-button {
            position: absolute;
            top: 20px;
            left: 20px;
            display: flex;
            align-items: center;
        }
        .back-button a {
            text-decoration: none;
            color: #602825; /* Indigo color */
            font-size: 40px;
            font-weight: bold;
        }
        .back-button a:hover {
            color: #844356; /* Slightly darker indigo for hover effect */
        }
        .form-container {
			background-color: #fff;
			padding: 40px 50px;
			border-radius: 10px;
			box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
			width: 500px; /* Reduced width from 600px to 400px */
			text-align: center;
			margin-top: 60px; /* Ensure space from the top */
		}
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 15px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #602825;
            color: white;
            border: none;
            padding: 15px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
        }
        input[type="submit"]:hover {
            background-color:#844356 ;
        }
        h2 {
            margin-bottom: 20px;
            color: #333;
        }
        .link {
            margin-top: 20px;
        }
        .link a {
            color: #602825;
        }
        .link a:hover {
            text-decoration: underline;
        }
        header {
            width: 100%;
            position: fixed; /* Ensure header stays at the top */
            top: 0;
            left: 0;
			margin:0;
        }
    </style>
</head>
<body>
<center>
    <div class="form-container clearfix">
        <h2>Register</h2>
        <form action="register.php" method="post">
            <input type="text" name="username" placeholder="username" required><br>
            <input type="password" name="password" placeholder="password" required><br>
            <input type="submit" name="submit" value="Register">
        </form>
        <div class="link">
            <p>Already have an account? <a href="login.php">Login here</a></p>
        </div>
    </div>
	<br><br>
</body>
</html>
<?php
session_start();
error_reporting(E_ALL);

include("conn.php");

if (isset($_POST['submit'])) {
    echo "Form submitted"; // Debugging output

    $uname = $_POST['username'];
    $pwd = $_POST['password'];

    if ($conn) {
        $query = "INSERT INTO login (uname, password) VALUES ('$uname', '$pwd')";
        if (mysqli_query($conn, $query)) {
            echo '<script>alert("Your Account Created successfully.")</script>';
            echo "<script>window.location.href='login.php'</script>";
        } else {
            echo "<script>alert('Something went wrong: " . mysqli_error($conn) . "');</script>";
        }
    } else {
        echo "Connection failed: " . mysqli_connect_error();
    }
}
?>
