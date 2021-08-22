<?php

include('../connection.php');
include('../customer/header.php');

if (isset($_SESSION['LoginUser']))
{
	$custid = $_SESSION['Cust_ID'];
	$discount = 0.00;
	$total2 = 0;
?>

<style>
	.modal-confirm {
		color: #636363;
		width: 400px;
	}
	.modal-confirm .modal-content {
		padding: 20px;
		border-radius: 5px;
		border: none;
		text-align: center;
		font-size: 14px;
	}
	.modal-confirm .modal-header {
		border-bottom: none;
		position: relative;
	}
	.modal-confirm h4 {
		text-align: center;
		font-size: 26px;
		margin: 30px 0 -10px;
	}
	.modal-confirm .close {
		position: absolute;
		top: -5px;
		right: -2px;
	}
	.modal-confirm .modal-body {
		color: #999;
	}
	.modal-confirm .modal-footer {
		border: none;
		text-align: center;
		border-radius: 5px;
		font-size: 13px;
		padding: 10px 15px 25px;
	}
	.modal-confirm .modal-footer a {
		color: #999;
	}
	.modal-confirm .icon-box {
		width: 80px;
		height: 80px;
		margin: 0 auto;
		border-radius: 50%;
		z-index: 9;
		text-align: center;
		border: 3px solid #f15e5e;
	}
	.modal-confirm .icon-box i {
		color: #f15e5e;
		font-size: 46px;
		display: inline-block;
		margin-top: 13px;
	}
	.modal-confirm .btn, .modal-confirm .btn:active {
		color: #fff;
		border-radius: 4px;
		background: #60c7c1;
		text-decoration: none;
		transition: all 0.4s;
		line-height: normal;
		min-width: 120px;
		border: none;
		min-height: 40px;
		border-radius: 3px;
		margin: 0 5px;
	}
	.modal-confirm .btn-secondary {
		background: #c1c1c1;
	}
	.modal-confirm .btn-secondary:hover, .modal-confirm .btn-secondary:focus {
		background: #a8a8a8;
	}
	.modal-confirm .btn-danger {
		background: #f15e5e;
	}
	.modal-confirm .btn-danger:hover, .modal-confirm .btn-danger:focus {
		background: #ee3535;
	}
	.trigger-btn {
		display: inline-block;
		margin: 100px auto;
	}
</style>

<?php

// $custquery = "SELECT * FROM customer WHERE Cust_ID = $custid";
// $custresult = mysqli_query($conn, $custquery);
//
// while ($row = mysqli_fetch_array($custresult)) {
// 	$fname = $row['Cust_Fname'];
// 	$lname = $row['Cust_Lname'];
// 	$address = $row['Cust_Address'];
// 	$email = $row['Cust_Email'];
// 	$pnum = $row['Cust_PhoneNo'];
//
// 	echo "<input type='hidden' value='".$custid."' id='custid'>
// 				<input type='hidden' value='".$fname."' id='fname'>
// 				<input type='hidden' value='".$lname."' id='lname'>
// 				<input type='hidden' value='".$address."' id='address'>
// 				<input type='hidden' value='".$email."' id='email'>
// 				<input type='hidden' value='".$pnum."' id='pnum'>";
// }

echo "<div class='container'>
				<div class='row'>
					<h1 class='text-center'>CART</h1>
				</div>
				<form action='../include/payment.php' method='POST'>
					<div class='row'>
						<div class='col-sm-12'>
							<table class='table table-border checkout-table mt-5'>
								<thead>
									<tr>
										<th class='text-center'>Item</th>
										<th></th>
										<th class='text-center'>Quantity</th>
										<th class='text-center'>Total</th>
									</tr>
								</thead>
								<tbody>";

	$query = "SELECT room.room_id, room.room_type, room.room_slot, room.room_price, room.room_images, service.serv_name, service.serv_fee,
						booking.QuantityofBooking, booking.Room_ID, booking.Booking_ID, booking.quantityofcats, booking.remarks, booking.nights,
						booking.Check_in, booking.Check_out, room.room_price * booking.nights + service.serv_fee
						AS total
						FROM booking INNER JOIN room INNER JOIN service
						WHERE booking.room_id = room.room_id
						AND booking.remarks = booking.remarks
						AND booking.Booking_ID = booking.Booking_ID
						AND booking.serv_id = service.serv_id
						AND booking.booking_status = 'Pending'
						AND booking.Cust_ID ='$custid';";
	$result = mysqli_query($conn, $query);

	while ($row = mysqli_fetch_assoc($result)) {
		$total = $row['total'];
		$total2 += $total;
		$date = $row['Check_in'];
		$date2 = $row['Check_out'];
		$bookingid = $row['Booking_ID'];
		$roomid = $row['Room_ID'];

		echo "<tr>
						<td>
							<div class='mt-3 align-center m-auto'>
								<img src='".$row['room_images']."' width='400'>
							</div>
						</td>
						<td>
							<div>
								<small class='text-muted'>Boarding: ".$row['room_type']." (RM ".$row['room_price'].")</small>
							</div>
							<div>
								<small class='text-muted'>Grooming: ".$row['serv_name']." (RM ".$row['serv_fee'].")</small>
							</div>
							<div>
								<small class='text-muted'>Check in: ".date('l, d M Y', strtotime($date))."</small>
							</div>
							<div>
								<small class='text-muted'>Check out: ".date('l, d M Y', strtotime($date2))."</small>
							</div>
							<div>
								<small class='text-muted'>Nights: ".$row['nights']."</small>
							</div>
							<div>
								<small class='text-muted'>Number of cats: ".$row['quantityofcats']."</small>
							</div>
							<div>
								<small class='text-muted'>Remarks: ".$row['remarks']."</small>
							</div>
						</td>
						<td>
							<h5 class='text-center'>".$row['QuantityofBooking']."</h5>
						</td>
						<td>
							<h5 class='text-center'>RM ".$total."</h5>
						</td>
						<td>
							<ul class='list-inline m-0'>
								<li class='list-inline-item'>
										<button class='btn btn-success btn-sm rounded-0' role='button' type='button' data-bs-toggle='modal' data-bs-target='#modalUpdate".$bookingid."'><i class='fa fa-edit'></i></button>
								</li>
								<li class='list-inline-item'>
									 <button class='btn btn-danger btn-sm rounded-0' type='button' data-bs-toggle='modal' data-bs-target='#modalDelete".$bookingid."'><i class='fa fa-trash'></i></button>
								</li>
							</ul>
						</td>
					</tr>";

		// Modal for delete booking
		echo "<div id='modalDelete".$bookingid."' class='modal fade' aria-hidden='true'>
					<div class='modal-dialog modal-confirm'>
						<div class='modal-content'>
							<div class='modal-header flex-column'>
								<div class='icon-box'>
									<i class='material-icons'>&#xE5CD;</i>
								</div>
								<h4 class='modal-title w-100 text-dark'>Are you sure?</h4>
								<button type='button' class='close btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
							</div>
							<div class='modal-body'>
								<p class='text-dark'>Do you really want to delete these? This process cannot be undone.</p>
							</div>
							<div class='modal-footer justify-content-center text-white'>
								<a data-bs-dismiss='modal' type='button' class='btn btn-secondary text-white'>Cancel</a>';
								<a href='../include/delete.php?Id=$bookingid' type='button' class='btn btn-danger text-white'>Delete</a>';
							</div>
						</div>
					</div>
				</div>";
	}

	$query2 = "SELECT product.prod_id, product.prod_images, pc.cart_id, pc.cust_id, pc.prod_id, pc.prod_name, pc.prod_price, pc.quantity, pc.total_price
						 FROM product_cart pc
						 INNER JOIN product product
						 WHERE product.prod_id = pc.prod_id
						 AND pc.prod_status = 'Pending'
						 AND pc.cust_id = '$custid';";
	$result2 = mysqli_query($conn, $query2);

	while ($row2 = mysqli_fetch_array($result2)) {

		$cartid = $row2['cart_id'];

		echo "<tr>
						<td>
							<div class='mt-3 align-center m-auto'>
								<img src='".$row2['prod_images']."' width='170' height='210'>
							</div>
						</td>
						<td>
							<div>
								<small class='text-muted'>Product: ".$row2['prod_name']."</small>
							</div>
							<div>
								<small class='text-muted'>Price: RM ".$row2['prod_price']."</small>
							</div>
						</td>
						<td>
							<h5 class='text-center'>".$row2['quantity']."</h5>
						</td>
						<td>
							<h5 class='text-center'>RM ".$row2['total_price']."</h5>
						</td>
						<td>
							<ul class='list-inline m-0'>
								<li class='list-inline-item'>
										<button class='btn btn-success btn-sm rounded-0' role='button' type='button' data-bs-toggle='modal' data-bs-target='#modalUpdate2".$cartid."'><i class='fa fa-edit'></i></button>
								</li>
								<li class='list-inline-item'>
									 <button class='btn btn-danger btn-sm rounded-0' type='button' data-bs-toggle='modal' data-bs-target='#modalDelete2".$cartid."'><i class='fa fa-trash'></i></button>
								</li>
							</ul>
						</td>
					</tr>";

					// Modal for delete product
					echo "<div id='modalDelete2".$cartid."' class='modal fade' aria-hidden='true'>
								<div class='modal-dialog modal-confirm'>
									<div class='modal-content'>
										<div class='modal-header flex-column'>
											<div class='icon-box'>
												<i class='material-icons'>&#xE5CD;</i>
											</div>
											<h4 class='modal-title w-100 text-dark'>Are you sure?</h4>
											<button type='button' class='close btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
										</div>
										<div class='modal-body'>
											<p class='text-dark'>Do you really want to delete these? This process cannot be undone.</p>
										</div>
										<div class='modal-footer justify-content-center text-white'>
											<a data-bs-dismiss='modal' type='button' class='btn btn-secondary text-white'>Cancel</a>';
											<a href='../include/deletecart.php?Id=$cartid' type='button' class='btn btn-danger text-white'>Delete</a>';
										</div>
									</div>
								</div>
							</div>";
	}

	$querytotal = "SELECT SUM(total_price) AS 'total_price' FROM product_cart WHERE Cust_ID = '$custid' AND Prod_Status = 'Pending';";
	$resulttotal = mysqli_query($conn, $querytotal);

	while ($row3 = mysqli_fetch_array($resulttotal)) {

		$tp = $row3['total_price'];
	}

	echo '</tbody>
			</table>
		</div>
	</div>

	<div class="row mt-70">
		<div class="col-sm-5 col-sm-offset-7">
			<div class="shop-Cart-totalbox">
				<h4 class="font-alt mt-5">Cart Total</h4>
				<table class="table table-border checkout-table">
					<tbody>
						<tr>
							<th>Subtotal :</th>
							<td>RM '.floatval($total2 + $tp).'</td>
						</tr>
						<tr>
							<th>Delivery Charges :</th>
							<td>Free</td>
						</tr>
						<tr class="shop-Cart-totalprice">
							<th>Payment Total 	 :</th>
							<td>RM '.floatval($total2 + $tp).'</td>
						</tr>
					</tbody>
				</table>
				<input type="hidden" name="total2" value='.floatval($total2 + $tp).' id="total">
				<div id="paypal-button-container"></div>
			</div>
		</div>
	</div>
</form>
</div>';

// <div class="text-center">
// 	<button type="submit" class="btn btn-lg btn-round btn-primary" name="pay">Pay</button>
// </div>

// <button type="submit" class="btn btn-lg btn-round btn-primary" name="pay">Pay</button>
// <div id="paypal-payment-button" type="submit" name="pay"></div>

// Modal Update Booking
$test = mysqli_query($conn, "SELECT book.Cust_ID, book.Booking_ID, book.QuantityofCats, book.Check_in, book.Check_out, book.Remarks, book.Serv_ID, service.Serv_ID, service.Serv_Name
														 FROM booking book
														 INNER JOIN service service
														 WHERE book.Cust_ID = $custid
														 AND book.Serv_ID = service.Serv_ID");
while ($row = mysqli_fetch_assoc($test)) {

	$bookingid = $row['Booking_ID'];
	$quancat = $row['QuantityofCats'];
	$date1 = $row['Check_in'];
	$date2 = $row['Check_out'];
	$remarks = $row['Remarks'];
	$groom = $row['Serv_Name'];

	echo '<div id="modalUpdate'.$bookingid.'" class="modal fade" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
						<div class="modal-content">
							<div class="modal-header">
								<h1 class="modal-title">UPDATE BOOKING</h1>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<form method="POST" action="../include/updatebooking.php">
								<input type="hidden" id="bookingid" name="bookingid" value="'.$bookingid.'">
								<input type="hidden" id="roomslot" name="roomslot" value="1">
								<div class="modal-body">
									<div class="mt-2 text-center">
										<h2>Premium Room</h2>
										<h4>RM 30.00</h4>
									</div>

									<div class="text-center mt-5">
										<label>Room slot available:</label>';

										$query2 = "SELECT Room_Slot FROM room WHERE Room_ID = $roomid";
										$result2 = mysqli_query($conn, $query2);
										$row = mysqli_fetch_array($result2);
										$roomslot = $row['Room_Slot'];

							echo '<h5 class="text-center">'.$roomslot.'</h5>';
							echo '<div class="mt-5">
											<strong>*If cannot select date means the room is already full</strong>
										</div>
									</div>
									<div class="container-fluid mt-4">
										<div class="row">
											<div class="col-md-5">
												<p>HOW MANY CATS?</p>
												<select class="form-select" aria-label="Default select example" name="quantityofcats">
													<option selected value="'.$quancat.'">'.$quancat.'</option>
													<option value="1">1</option>
													<option value="2">2</option>
													<option value="3">3</option>
													<option value="4">4</option>
													<option value="5">5</option>
													<option value="6">6</option>
													<option value="7">7</option>
													<option value="8">8</option>
													<option value="9">9</option>
													<option value="10">10</option>
												</select>

												<p class="mt-3">FROM:</p>
												<input type="date" name="checkin" id="date1" onchange="cal()" value="'.$date1.'">

												<p class="mt-3">TO:</p>
												<input type="date" name="checkout" id="date2" onchange="cal()" value="'.$date2.'">
											</div>

											<div class="col-md-7 ms-auto">
												<p>WANT GROOM YOUR CATS?</p>
												<select class="form-select" id="groom" name="groom">';

												$query3 = "SELECT * FROM service";
												$result3 = mysqli_query($conn, $query3);
												while ($row = mysqli_fetch_array($result3)) {
													$groomid = isset($_GET['service']) ? $_GET['service'] : 0;
													$groomid = $row['Serv_ID'];
													$groomname = $row['Serv_Name'];
													$selected = ($groom == $groomname) ? " selected" : "";

													echo '<option '.$selected.' value="'.$groomid.'">'.$groomname.'</option>';
												}

									 echo'</select>
												<div class="form-group mt-3">
													<p>REMARKS:</p>
													<textarea class="form-control" name="remarks" rows="5">'.$remarks.'</textarea>
												</div>
											</div>
										</div>
									</div>

									<div class="modal-footer justify-content-center mt-5">
										<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
										<button type="submit" class="btn btn-success" name="updatebooking">Update</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>';
}

// Modal Update Product
$produp = mysqli_query($conn, "SELECT * FROM product_cart WHERE Cust_ID = $custid");
while ($row2 = mysqli_fetch_assoc($produp)) {

	$cartid = $row2['Cart_ID'];
	$quantity = $row2['Quantity'];

	echo '<div id="modalUpdate2'.$cartid.'" class="modal fade" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
						<div class="modal-content">
							<div class="modal-header">
								<h1 class="modal-title">UPDATE PRODUCT</h1>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<form method="POST" action="../include/updateproduct.php">
								<input type="hidden" id="productid" name="productid" value="'.$cartid.'">
								<div class="modal-body">
									<div class="container-fluid mt-4">
										<div class="row">
											<div class="col text-center">
												<p>Quantity</p>
												<input type="number" name="quantityproduct" value="'.$quantity.'" min="1" max="99" style="width: 70px; height: 33px; text-align: center;">
											</div>
										</div>
									</div>
								</div>
								<div class="modal-footer justify-content-center mt-5">
									<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
									<button type="submit" class="btn btn-success" name="updateproduct">Update</button>
								</div>
							</form>
						</div>
					</div>
				</div>';
}

?>

<script src="../assets/js/paypal.js"></script>

<?php
include('../customer/footer.php');
?>

<?php
}
?>
