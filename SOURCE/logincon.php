<?php
include("conn.php");
session_start();

if (isset($_POST['username']) && isset($_POST['password'])) {
    $uname = $_POST['username'];
    $pass = $_POST['password'];

    $query = "SELECT * FROM login WHERE uname='$uname' AND password='$pass'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);

        if ($row['uname'] === $uname && $row['password'] === $pass) {
            echo '<script>alert("login successful"); window.location.href="index.php";</script>';
            $_SESSION['username'] = $row['uname'];
            $_SESSION['loggedin'] = true;
            exit();
        } else {
            echo '<script>alert("Failed")</script>';
        }
    } else {
        echo '<script>alert("No matching records found")</script>';
    }
} else {
    echo '<script>alert("Username and password required")</script>';
}
?>
