<?php

include '../connection.php';

if($_POST['status'] == "Available"){
  $query = "UPDATE product SET Prod_Status = 'Not available' WHERE Prod_ID = ".$_POST['id']."";
  $result = mysqli_query($conn, $query);
}else{
  $query = "UPDATE product SET Prod_Status = 'Available' WHERE Prod_ID = ".$_POST['id']."";
  $result = mysqli_query($conn, $query);
}




?>
