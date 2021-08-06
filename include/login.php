<?php

require_once "../connection.php";

if (isset($_POST["Login"])) {
  $email = $_POST['email'];
  $password = $_POST['password'];

  require_once "../include/functions.php";

  if (emptyInputLogin($email, $password) !== false) {
    header("location: ../customer/userLogin.php?error=emptyinput");
    exit();
  }

  $query = "SELECT * FROM customer WHERE Cust_Email = '$email'";
  $query2 = "SELECT * FROM admin WHERE Admin_username = '$email' AND Admin_password = '$password'";

  $result = mysqli_query($conn,$query);
  $result2 = mysqli_query($conn,$query2);

  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_array($result);
    if (password_verify($password, $row['Cust_Password'])) {
      setcookie('email', $row["Cust_Email"], time() + (86400 * 1), "/");
      session_start();
      $_SESSION['LoginUser'] = $row["Cust_Fname"];
      $_SESSION['Cust_ID'] = $row["Cust_ID"];
      header('Location: ../index.php?Id='.$row["Cust_ID"].'&User='.$row["Cust_Fname"].' '.$row["Cust_Lname"].'');
    }else {
      header('Location: ../customer/userLogin.php?error=incorrectlogin');
    }
  }else if (mysqli_num_rows($result2) > 0) {
    while ($row2 = mysqli_fetch_assoc($result2)) {
      $_SESSION['LoginAdmin'] = $row2["Admin_username"];
      header('Location: ../admin/index.php');
    }
  }else {
    header('Location: ../customer/userLogin.php?error=incorrectlogin');
  }
}

?>
