<?php

include '../../connection.php';

if (isset($_POST['registerstaff'])) {
  $name = $_POST['sname'];
  $email = $_POST['semail'];
  $pnum = $_POST['spnum'];
  $address = $_POST['saddress'];
  $gender = $_POST['sgender'];

  // echo "$name | $email | $pnum | $address | $gender";

  $query = "INSERT INTO staff (Staff_Name, Staff_PhoneNo, Staff_Address, Staff_Email, Staff_Gender, Staff_Images)
            VALUES ('$name', '$pnum', '$address', '$email', '$gender', '../images/user profile picture/default_profile.png')";
  $result = mysqli_query($conn, $query);

  if ($result) {
    echo '<script type="text/javascript">alert("Successfully register new staff");location="../staff.php";</script>';
  }else {
    echo '<script type="text/javascript">alert("Something went wrong!");location="../staff.php";</script>';
  }
}






?>
