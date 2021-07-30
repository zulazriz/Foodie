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
            <a href="../admin/orders.php" class="active" style="text-decoration: none;"><span class="las la-shopping-bag"></span><span>Orders</span></a>
          </li>
          <li>
            <a href="../admin/bookings.php" style="text-decoration: none;"><span class="las la-receipt"></span><span>Bookings</span></a>
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

          Orders
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
              <h2>Order List</h2>
            </div>
          </div>

          <div class="customers">
            <div class="card">
              <div class="container">
                <div class="row">
                  <table class="mt-5">
                    <thead style="padding: 0rem;">
                      <tr>
                        <th class="text-center">Item</th>
                        <th></th>
                        <th>Total</th>
                        <th>Status</th>
                        <th></th>
                        <th></th>
                      </tr>
                    </thead>
          <?php
          $query = "SELECT product.prod_images, pc.cart_id, pc.prod_id, pc.prod_name, SUM(pc.quantity) AS quantity, SUM(pc.total_price) AS total_price, pc.prod_status, c.Cust_ID, c.Cust_Fname, c.Cust_Lname
                    FROM product_cart pc
                    INNER JOIN product product ON pc.Prod_ID = product.Prod_ID
                    INNER JOIN customer c ON c.Cust_ID = pc.Cust_ID
                    WHERE pc.prod_status = 'pending' OR pc.prod_status = 'paid'
                    GROUP BY pc.prod_name, pc.prod_status";

        	$result = mysqli_query($conn, $query);

        	while ($row = mysqli_fetch_array($result)) {
            $cfname = $row['Cust_Fname'];
            $clname = $row['Cust_Lname'];
            $img = $row['prod_images'];
            $name = $row["prod_name"];
            $quantity = $row["quantity"];
            $total = $row["total_price"];
            $status = $row["prod_status"];

            echo '<tbody style="padding: 0rem;">
                    <tr>
                      <td style="padding: 0rem; width: 100px;">
                        <img src='.$img.' width="170" height="200">
                      </td>
                      <td style="padding: 0rem; width: 400px;">
                        <div class="mt-3">
                          <p>Customer: '.$cfname.' '.$clname.'</p>
                        </div>
                        <div class="mt-3">
                          <p>Product: '.$name.'</p>
                        </div>
                        <div class="mt-3">
                          <p>Quantity: '.$quantity.'</p>
                        </div>
                      </td>
                      <td style="padding: 0rem; width: 180px;">
                        <p>RM '.$total.'</p>
                      </td>
                      <td style="padding: 0rem; width: 200px;">
                        <p>'.$status.'</p>
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
      </main>
    </div>
  </body>
</html>
