<?php

include '../include/requestReset.php'

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Rumah Kucing</title>
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
    <p class="lead text-center text-white">To reset your password, enter the registered email address and we will send you the instructions on your email</p>
    <form method="POST">
      <div class="textbox">
        <i class="fas fa-envelope"></i>
          <input type="email" name="email" class="form-control" placeholder="Enter Your Email" required>
      </div>

      <input type="submit" name="reset" class="btn btn-primary"></input>
      <a href="../customer/userLogin.php" style="color: white;">Back</a>
    </form>
  </div>

</body>
</html>
