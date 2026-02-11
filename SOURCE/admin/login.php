<?php
session_start();
error_reporting(0);

// Include database connection file
include('conn.php');

if(isset($_POST['login'])) {
  $adminuser=$_POST['username'];
  $password=($_POST['password']);
  
  // Execute the query
  $query = mysqli_query($conn, "SELECT ID FROM admin WHERE username='$adminuser' AND password='$password'");
	
  // Fetch the result
  $ret = mysqli_fetch_array($query);

  // Check if the user exists
  if($ret > 0) {
    $_SESSION['agmsaid'] = $ret['ID'];
    echo "<script type='text/javascript'> document.location ='dashboard.php'; </script>";
  } else {
    echo "<script>alert('Invalid Details');</script>";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Login | Resale Retreate </title>

  <!-- Bootstrap CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap theme -->
  <link href="css/bootstrap-theme.css" rel="stylesheet">
  <!-- External CSS -->
  <!-- Font icon -->
  <link href="css/elegant-icons-style.css" rel="stylesheet" />
  <link href="css/font-awesome.css" rel="stylesheet" />
  <!-- Custom styles -->
  <link href="css/style.css" rel="stylesheet">
  <link href="css/style-responsive.css" rel="stylesheet" />
</head>

<body class="login-img3-body" bgcolor="red">
  <div class="container">
    <form class="login-form" action="" method="post">
      <div class="login-wrap">
        <p class="login-img"><i class="icon_lock_alt"></i></p>
        <div class="input-group">
          <span class="input-group-addon"><i class="icon_profile"></i></span>
          <input type="text" class="form-control" name="username" placeholder="Username" autofocus required="true">
        </div>
        <div class="input-group">
          <span class="input-group-addon"><i class="icon_key_alt"></i></span>
          <input type="password" class="form-control" name="password" placeholder="Password" required="true">
        </div>
        <button class="btn btn-primary btn-lg btn-block" type="submit" name="login">Login</button>
      </div>
    </form>
  </div>
</body>
</html>
