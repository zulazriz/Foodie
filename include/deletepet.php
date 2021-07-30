<?php

session_start();
include '../connection.php';

$petid = $_GET['Id'];
$custid = $_SESSION['Cust_ID'];

if ($petid) {
  $query = "DELETE FROM pet WHERE Pet_ID = $petid AND Cust_ID = $custid";
  $result = mysqli_query($conn, $query);

  echo '<script type="text/javascript">alert("Successfully delete!");location="../customer/profile.php";</script>';
}else {
  echo '<script type="text/javascript">alert("Oopss! Something wrong.");location="../customer/profile.php";</script>';
}

?>
