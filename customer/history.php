<link rel="stylesheet" href="../assets/css/historystyle.css">

<?php

include('../connection.php');
include('../customer/header.php');

echo '<div id="main">
        <div class="inner">
          <h1 class="text-center ">- Transaction History -</h1>
        </div>
      </div>

      <div class="container">
              <div class="table-responsive custom-table-responsive">
                <table class="table custom-table">
                  <thead>
                    <tr>
                      <th scope="col" class="text-center">Item</th>
                      <th scope="col" class="text-center">Description</th>
                      <th scope="col" class="text-center">Quantity</th>
                      <th scope="col" class="text-center">Total</th>
                      <th scope="col" class="text-center">Status</th>
                    </tr>
                  </thead>';

$query1 = "SELECT r.room_id, r.room_type, r.room_slot, r.room_price, r.room_images,
                 s.serv_id, s.serv_name, s.serv_fee, b.Room_ID, b.booking_status, b.Booking_ID, b.quantityofcats,
                 b.remarks, b.nights, b.Check_in, b.Check_out, b.quantityofbooking, c.Cust_Fname, c.Cust_Lname, c.Cust_Address
          FROM booking b
          INNER JOIN room r ON r.room_id = b.Room_ID
          INNER JOIN service s ON s.serv_id = b.serv_id
          INNER JOIN customer c ON c.Cust_ID = b.Cust_ID
          WHERE b.Cust_ID = '$custid'
          ORDER BY b.booking_status DESC";

$result1 = mysqli_query($conn, $query1);

while ($row = mysqli_fetch_assoc($result1)) {

  $date = $row['Check_in'];
  $date2 = $row['Check_out'];
  $bookingid = $row['Booking_ID'];
  $roomid = $row['Room_ID'];
  $img = $row['room_images'];
  $rtype = $row['room_type'];
  $rprice = $row['room_price'];
  $sname = $row['serv_name'];
  $sprice = $row['serv_fee'];
  $nights = $row['nights'];
  $quancat = $row['quantityofcats'];
  $remarks = $row['remarks'];
  $status = $row['booking_status'];
  $quanbook = $row['quantityofbooking'];
  $fname = $row['Cust_Fname'];
  $lname = $row['Cust_Lname'];
  $address = $row['Cust_Address'];
  $total = $rprice * $nights + $sprice;

  echo '<tbody>
          <tr scope="row">
            <td class="text-center">
              <img src='.$img.' width="200" height="170">
            </td>
            <td >
              <div>
                <small>Boarding: '.$rtype.' (RM '.$rprice.')</small>
              </div>
              <div>
                <small>Grooming: '.$sname.' (RM '.$sprice.')</small>
              </div>
              <div>
                <small>Check in: '.date('l, d M Y', strtotime($date)).'</small>
              </div>
              <div>
                <small>Check out: '.date('l, d M Y', strtotime($date2)).'</small>
              </div>
              <div>
                <small>Nights: '.$nights.'</small>
              </div>
              <div>
                <small>Number of cats: '.$quancat.'</small>
              </div>
              <div>
                <small>Remarks: '.$remarks.'</small>
              </div>
            </td>
            <td class="text-center">
              <p>'.$quanbook.'</p>
            </td>
            <td class="text-center">
              <p>RM '.$total.'.00</p>
            </td>
            <td class="text-center">
              <p>'.$status.'</p>
            </td>
          </tr>
          <tr class="spacer"><td colspan="100"></td></tr>
        </tbody>';
}

$query2 = "SELECT product.prod_id, product.prod_images, pc.cart_id, pc.cust_id, pc.prod_id, pc.prod_name, pc.prod_price, pc.quantity, pc.total_price, pc.prod_status
           FROM product_cart pc
           INNER JOIN product product
           WHERE product.prod_id = pc.prod_id
           AND pc.cust_id = '$custid'
           ORDER BY pc.prod_status DESC";
$result2 = mysqli_query($conn, $query2);

while ($row2 = mysqli_fetch_array($result2)) {

  $cartid = $row2['cart_id'];
  $prodimg = $row2['prod_images'];
  $prodname = $row2['prod_name'];
  $prodprice = $row2['prod_price'];
  $prodquan = $row2['quantity'];
  $tp = $row2['total_price'];
  $prodstatus = $row2['prod_status'];

  echo '<tbody>
          <tr scope="row">
            <td class="text-center">
              <img src='.$prodimg.' width="190" height="190">
            </td>
            <td>
              <div>
                <small>Product Name: '.$prodname.'</small>
              </div>
              <div>
                <small>Product Price: '.$prodprice.'</small>
              </div>
            </td>
            <td class="text-center">
              <p>'.$prodquan.'</p>
            </td>
            <td class="text-center">
              <p>RM '.$tp.'</p>
            </td>
            <td class="text-center">
              <p>'.$prodstatus.'</p>
            </td>
          </tr>
          <tr class="spacer"><td colspan="100"></td></tr>
        </tbody>';
}

echo '</table>
    </div>
  </div>';
?>

<?php

include('../customer/footer.php');

?>
