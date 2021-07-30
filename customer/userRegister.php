<!DOCTYPE html>
<html>
<head>
    <title>The Four Paws Hotel</title>
    <link rel="icon" href="../images/paw.ico" />
    <link href="../assets/css/loginstyle.css" rel="stylesheet">
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

  <div class="login-box2">
    <h1>Register</h1>
    <form method="POST" action="../include/register.php">
      <div class="textbox2">
        <label>First Name</label>
        <input type="text" name="firstname" class="form-control">
      </div>

      <div class="textbox2">
        <label>Last Name</label>
        <input type="text" name="lastname" class="form-control">
      </div>

      <div class="textbox2">
        <label>Phone Number</label>
        <input type="text" name="pnumber" class="form-control">
      </div>

      <div class="textbox2">
        <label>Email Address</label>
        <input type="email" name="email" class="form-control">
      </div>

      <div class="textbox2">
        <label>Date of Birth</label>
        <input type="date" name="dob" class="form-control bs-white">
      </div>

      <div class="textbox2">
        <label>Home Address</label>
        <input type="address" name="address" class="form-control">
      </div>

      <div style="width: 100%; overflow: hidden; font-size: 20px; padding: 8px 0;">
        <label>Gender</label>
      </div>

        <label class="radio-inline"><input type="radio" name="gender" value="Male">Male</label>
        <label class="radio-inline"><input type="radio" name="gender" value="Female">Female</label>

      <div class="textbox2">
        <label>Password</label>
        <input type="password" name="pwd" class="form-control">
      </div>

      <div class="textbox2">
        <label>Confirm Password</label>
        <input type="password" name="confirmpwd" class="form-control">
      </div>

      <?php
        if (isset($_GET["error"])) {
          if ($_GET["error"] == "emptyinput") {
            echo "<p style='font-weight: bold; font-size: 20px; text-align: center;'>Fill in all fields!</p>";
          }elseif ($_GET["error"] == "passwordsdontmatch") {
            echo "<p style='font-weight: bold; font-size: 20px; text-align: center;'>Password doesn't match!</p>";
          }elseif ($_GET["error"] == "stmtfailed") {
            echo "<p style='font-weight: bold; font-size: 20px; text-align: center;'>Something went wrong, try again!</p>";
          }elseif ($_GET["error"] == "emailtaken") {
            echo "<p style='font-weight: bold; font-size: 20px; text-align: center;'>Email already taken!</p>";
          }elseif ($_GET["error"] == "none") {
            echo "<p style='font-weight: bold; font-size: 20px; text-align: center;'>You have registered!</p>";
          }
        }
      ?>

        <div style='float: left;'>
          <button type="submit" name="register" class="btn btn-primary">Register</button>
        </div>
        <div style='float: right;'>
          <button class="btn btn-primary" role="button"><a href="../customer/userLogin.php" style="color: white;">Back</a></button>
        </div>

      <!-- <button type="submit" name="register" class="btn btn-primary">Register</button> -->
      <!-- <a class="btn btn-primary" href="userLogin.php" role="button">Back</a> -->
      </form>
    </div>
  </body>
</html>
