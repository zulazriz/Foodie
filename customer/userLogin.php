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
    <h1>Login</h1>
    <form method="POST" action="../include/login.php">
      <div class="textbox">
        <i class="fas fa-user"></i>
          <input type="text" name="email" class="form-control" placeholder="Enter Your Username">
      </div>

      <div class="textbox">
        <i class="fas fa-lock"></i>
          <input type="password" name="password" class="form-control" placeholder="Enter Your Password">
      </div>

      <div class="custom-control custom-checkbox float-left">
        <input type="checkbox" name="rem" class="custom-control-input" id="customCheck" <?php if (isset($_COOKIE['email'])) { ?> checked <?php } ?>>
        <label for="customCheck" class="custom-control-label">Remember me</label>
      </div>

      <div class="forgot float-right">
        <a href="forgotPassword.php">Forgot password?</a>
      </div>

      <?php
        if (isset($_GET["error"])) {
          if ($_GET["error"] == "emptyinput") {
            echo "<p style='font-weight: bold; font-size: 20px; text-align: center;'>Fill in all fields!</p>";
          }elseif ($_GET["error"] == "incorrectlogin") {
            echo "<p style='font-weight: bold; font-size: 20px; text-align: center;'>Incorrect email or password</p>";
          }
        }
      ?>

      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <button type="submit" class="btn btn-primary" name="Login">Login</button>
          </div>
          <div class="col-md-6">
            <a href="../index.php" class="btn btn-danger" role="button">Back</a>
          </div>
        </div>
      </div>
      Not a member yet? <a href="../customer/userRegister.php">Create an account</a>
    </form>
  </div>

</body>
</html>
