<?php

include '../connection.php';

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
    <title>Admin</title>
    <link rel="icon" href="../images/paw.ico" />
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
  </head>
  <body>

    <input type="checkbox" id="nav-toggle">
    <div class="sidebar">
      <div class="sidebar-brand">
        <h2><span><img src="../images/logo4.jpg" width="54px" height="56px"></span><span>RUMAH KUCING</span></h2>
      </div>

      <div class="sidebar-menu">
        <ul class="px-0">
          <li>
            <a href="../admin/index.php" style="text-decoration: none;"><span class="las la-igloo"></span><span>Dashboard</span></a>
          </li>
          <li>
            <a href="../admin/staff.php" style="text-decoration: none;"><span class="las la-user-tie"></span><span>Staff</span></a>
          </li>
          <li>
            <a href="../admin/customer.php" style="text-decoration: none;"><span class="las la-users"></span><span>Customer</span></a>
          </li>
          <li>
            <a href="../admin/products.php" style="text-decoration: none;"><span class="las la-clipboard-list"></span><span>Products</span></a>
          </li>
          <li>
            <a href="../admin/orders.php" style="text-decoration: none;"><span class="las la-shopping-bag"></span><span>Orders</span></a>
          </li>
          <li>
            <a href="../admin/bookings.php" class="active" style="text-decoration: none;"><span class="las la-receipt"></span><span>Bookings</span></a>
          </li>
          <li>
            <a href="../admin/logout.php" style="text-decoration: none;"><span class="las la-sign-out-alt"></span><span>Log out</span></a>
          </li>
        </ul>
      </div>
    </div>

    <div class="main-content">
      <header>
        <h2>
          <label for="nav-toggle">
            <span class="las la-bars"></span>
          </label>

          Bookings
        </h2>

        <div class="search-wrapper">
          <span class="las la-search"></span>
          <input type="search" placeholder="Search here">
        </div>

        <div class="user-wrapper">
          <img src="../images/user profile picture/default_profile.png" width="30px" height="30px">
          <div>
            <h4>Admin</h4>
            <small>Super Admin</small>
          </div>
        </div>
      </header>

      <main>
        <div class="customers">
          <div class="card">
            <div class="card-header">
              <h2>Booking List</h2>
            </div>
          </div>

          <div class="customers">
            <div class="card">
              <div class="container">
                <div class="row">
                  <table class="mt-5">
                    <thead style="padding: 0rem;">
                      <tr>
                        <th></th>
                        <th class="text-center col-3">Customer</th>
                        <th class="text-center">Item</th>
                        <th>Status</th>
                        <th>Total</th>
                        <th></th>
                        <th></th>
                      </tr>
                    </thead>
          <?php

          $query = "SELECT r.room_id, r.room_type, r.room_slot, r.room_price, r.room_images,
                           s.serv_id, s.serv_name, s.serv_fee, b.Room_ID, b.booking_status, b.Booking_ID, b.quantityofcats,
                           b.remarks, b.nights, b.Check_in, b.Check_out, c.Cust_Fname, c.Cust_Lname, c.Cust_Address
                    FROM booking b
                    INNER JOIN room r ON r.room_id = b.Room_ID
                    INNER JOIN service s ON s.serv_id = b.serv_id
                    INNER JOIN customer c ON c.Cust_ID = b.Cust_ID";

        	$result = mysqli_query($conn, $query);

        	while ($row = mysqli_fetch_assoc($result)) {

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
            $fname = $row['Cust_Fname'];
            $lname = $row['Cust_Lname'];
            $address = $row['Cust_Address'];
            $total = $rprice * $nights + $sprice;

            echo '<tbody style="padding: 0rem;">
                    <tr>
                      <td class="text-center" style="width: 200px;">
                        <img src='.$img.' width="200" height="200">
                      </td>
                      <td>
                        <div>
                          <p>Name: '.$fname.' '.$lname.'</p>
                        </div>
                        <div>
                          <p>Address: '.$address.'</p>
                        </div>
                      </td>
                      <td style="padding: 0rem; width: 400px;">
                        <div>
                          <small class="text-muted">Boarding: '.$rtype.' (RM '.$rprice.')</small>
                        </div>
                        <div>
                          <small class="text-muted">Grooming: '.$sname.' (RM '.$sprice.')</small>
                        </div>
                        <div>
                          <small class="text-muted">Check in: '.date('l, d M Y', strtotime($date)).'</small>
                        </div>
                        <div>
                          <small class="text-muted">Check out: '.date('l, d M Y', strtotime($date2)).'</small>
                        </div>
                        <div>
                          <small class="text-muted">Nights: '.$nights.'</small>
                        </div>
                        <div>
                          <small class="text-muted">Number of cats: '.$quancat.'</small>
                        </div>
                        <div>
                          <small class="text-muted">Remarks: '.$remarks.'</small>
                        </div>
                      </td>
                      <td style="padding: 0rem; width: 150px;">
                        <p>'.$status.'</p>
                      </td>
                      <td style="padding: 0rem; width: 150px;">
                        <p>RM '.$total.'</p>
                      </td>
                    </tr>
                  </tbody>';

          }

          ?>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Modal Update Products -->
        <div class="modal fade" id="editRoom" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">Update Products</h4>
                <button type="button" class="close btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form action="../admin/updateproducts.php?Id='.$prodid.'" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                  <label>Product Name:</label>
                  <div class="input-group mb-3">
                    <span class="input-group-text"><i class="las la-user"></i></span>
                    <input type="text" class="form-control" placeholder="Enter product name" name="prodname">
                  </div>
                  <label>Product Price:</label>
                  <div class="input-group mb-3">
                    <span class="input-group-text"><i class="las la-dollar-sign"></i></span>
                    <input type="text" class="form-control" placeholder="Enter product price" name="prodprice">
                  </div>
                  <div class="wrapper mt-5">
                    <input type="file" name="prodimg" id="prodimg">
                  </div>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                  <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary" name="up_prod">Update</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </main>
    </div>
  </body>
</html>
