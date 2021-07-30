<?php

session_start();
include '../connection.php';

if (isset($_POST['updateproduct'])) {

  $proquan = $_POST['quantityproduct'];
  $cartid = $_POST['productid'];

  $updateprod = "UPDATE product_cart
                 SET Quantity = '$proquan', Total_Price = Prod_Price * '$proquan'
                 WHERE Cart_ID = '$cartid';";
  $updateresult = mysqli_query($conn, $updateprod);

  if ($updateresult) {
    echo '<script type="text/javascript">alert("Your product has been updated!");location="../customer/cart.php";</script>';
  }else {
    echo '<script type="text/javascript">alert("Something went wrong! Cannot update your product.");location="../customer/cart.php";</script>';
  }
}



?>
