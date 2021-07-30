<?php

session_start();
include('../connection.php');

if (isset($_POST['pay'])) {

	$custid = $_SESSION['Cust_ID'];
	$totalpay = $_POST['total2'];

	$query = "INSERT INTO payment (Cust_ID, Total, Payment_Timestamp) VALUES ('$custid','$totalpay', NOW())";
	$result = mysqli_query($conn,$query);

	if ($result){
		$query2 = "UPDATE Booking SET Booking_Status='Paid' WHERE Cust_ID = $custid AND Booking_Status = 'Pending';";
		$result2 = mysqli_query($conn,$query2);

		if ($result2) {
			$query3 = "UPDATE product_cart SET Prod_Status='Paid' WHERE Cust_ID = $custid AND Prod_Status = 'Pending';";
			$result3 = mysqli_query($conn,$query3);

			if ($result3) {
				echo '<script type="text/javascript">alert("Thank you for your payment!");location="../customer/cart.php";</script>';
			}else {
				echo '<script type="text/javascript">alert("Something went wrong! Please try again");location="../customer/cart.php";</script>';
			}
		}else {
			echo '<script type="text/javascript">alert("Something went wrong! Please try again");location="../customer/cart.php";</script>';
		}
	}else {
		echo '<script type="text/javascript">alert("Something went wrong! Please try again");location="../customer/cart.php";</script>';
	}
}

?>
