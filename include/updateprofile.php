<?php

session_start();
include '../connection.php';

if (isset($_POST['updateProfile'])) {
  $custid = $_SESSION['Cust_ID'];

  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $phonenum = $_POST['phonenum'];
  $email = $_POST['email'];
  $address = $_POST['address'];

  // echo "$custid | $fname | $lname | $phonenum | $email | $address";

  $query = "UPDATE customer
            SET Cust_Fname = '$fname', Cust_Lname = '$lname', Cust_PhoneNo = '$phonenum', Cust_Email = '$email', Cust_Address = '$address'
            WHERE Cust_ID = '$custid';";
  $result = mysqli_query($conn, $query);

  if ($result) {
    echo '<script type="text/javascript">alert("Profile updated successfully!");location="../customer/profile.php";</script>';
  }else {
    echo '<script type="text/javascript">alert("Something went wrong!");location="../customer/profile.php";</script>';
  }
}

?>
