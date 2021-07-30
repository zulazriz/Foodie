<?php

include("../connection.php");

if (!isset($_GET["code"])) {
  header("location: 404.php");
}

$token = $_GET["code"];

$getEmailQuery = mysqli_query($conn, "SELECT Cust_Email FROM customer WHERE Token='$token'");
if (mysqli_num_rows($getEmailQuery) == 0) {
  header("location: 404.php");
}

if (isset($_POST["password"])) {
  $pw = $_POST["password"];
  $pw = password_hash($pw, PASSWORD_DEFAULT);

  $row = mysqli_fetch_array($getEmailQuery);
  $email = $row["Cust_Email"];

  $query = mysqli_query($conn, "UPDATE customer SET Cust_Password='$pw' WHERE Cust_Email='$email'");

  if ($query) {
    $query = mysqli_query($conn, "UPDATE customer SET Token='" . NULL . "' WHERE Cust_Email='$email'");
    header("location: passwordUpdated.php");
  } else {
    header("location: somethingWrong.php");
  }
}

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>The Four Paws Hotel</title>
  <link rel="icon" href="../images/paw.ico" />
  <link rel="stylesheet" href="../assets/css/loginstyle.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
</head>
<body>
  <style>
    body {
      background-image: url('../images/cats.jpg');
      background-repeat: no-repeat;
      background-attachment: fixed;
      background-size: cover;
    }
  </style>

  <div class="login-box">
    <h1>Reset Password</h1>
    <p class="lead text-center text-white">Please enter a new password</p>
    <form method="POST">
      <div class="textbox">
        <input type="password" name="password" placeholder="New password">
      </div>

      <input type="submit" name="submit" value="Reset" class="btn btn-primary"></input>
    </form>
  </div>

</body>
</html>
