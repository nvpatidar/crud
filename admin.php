<?php
session_start();
include("connect.php");

if(isset($_POST['submit'])){
  $email = $_POST['email'];
  $number = $_POST['number'];

  $sql = "select * from admin where email = '$email'and number = '$number'";

  $result = mysqli_query($con, $sql);

  if(mysqli_num_rows($result)){

    $userdata = mysqli_fetch_assoc($result);

    $_SESSION['userdata'] = $email;
    header('location:registration.php');
  }
   
  else{
    echo "<script>alert('Invalid email and password')</script>";
  }

 }

?>

<!DOCTYPE html>
<html>
<head>

    <title>Login Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body>
<h1 class="text-primary text-uppercase text-center">Login Form</h1>
<form class="w-25 p-3" style="margin-left:600px" method="post">
  <div class="form-group">
    <label>Email address</label>
    <input type="email" class="form-control" name="email" placeholder="Enter email">
  </div>
  <div class="form-group">
    <label>Number</label>
    <input type="text" class="form-control" name="number" placeholder="Enter Number">
  </div>
  <button type="submit" name =" submit" class="btn btn-primary">Submit</button>
</form>
</body>
</html>
