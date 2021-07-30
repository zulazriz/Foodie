<?php

session_start();
include '../connection.php';

$custid = $_SESSION['Cust_ID'];

$catname = $_POST['catname'];
$catcolor = $_POST['catcolor'];
$catsex = $_POST['sex'];
$catbreed = $_POST['breed'];

$query = "INSERT INTO pet (Cust_ID, Pet_Name, Pet_Colour, Pet_Sex, Breed_ID)
          VALUES ('$custid', '$catname', '$catcolor', '$catsex', '$catbreed')";
$result = mysqli_query($conn, $query);

if ($result) {
  echo '<script type="text/javascript">alert("Your cat has been added!");location="../customer/profile.php";</script>';
}else {
  echo '<script type="text/javascript">alert("Something went wrong!");location="../customer/profile.php";</script>';
}


?>
