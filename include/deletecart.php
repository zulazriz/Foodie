<?php

session_start();
include '../connection.php';

$cartid = $_GET['Id'];
$custid = $_SESSION['Cust_ID'];

$delprod = "DELETE FROM product_cart WHERE Cart_ID = $cartid AND Cust_ID = $custid";
$delresult = mysqli_query($conn, $delprod);

if ($delresult) {
  echo '<script type="text/javascript">alert("Successfully delete!");location="../customer/cart.php";</script>';
}else {
  echo '<script type="text/javascript">alert("Oopss! Something wrong. Try again later!");location="../customer/cart.php";</script>';
}

?>
