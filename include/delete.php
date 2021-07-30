<?php

session_start();
include '../connection.php';

$bookingid = $_GET['Id'];
$custid = $_SESSION['Cust_ID'];

$query = "SELECT * FROM booking WHERE Booking_ID = $bookingid AND Cust_ID = $custid";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

$quan = $row['QuantityofCats'];
$roomid = $row['Room_ID'];

if ($bookingid) {

  $query2 = "UPDATE room SET Room_Slot = (Room_Slot + $quan) WHERE Room_ID = $roomid";
  $result2 = mysqli_query($conn, $query2);

  if ($result2) {
    $query3 = "DELETE FROM booking WHERE booking_id = $bookingid AND Cust_ID = $custid";
    $result3 = mysqli_query($conn, $query3);

    echo '<script type="text/javascript">alert("Successfully delete!");location="../customer/cart.php";</script>';
  }else {
    echo '<script type="text/javascript">alert("Oopss! Something wrong.");location="../customer/cart.php";</script>';
  }
}

?>
