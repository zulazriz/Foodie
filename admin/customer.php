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
            <a href="../admin/customer.php" class="active" style="text-decoration: none;"><span class="las la-users"></span><span>Customer</span></a>
          </li>
          <li>
            <a href="../admin/products.php" style="text-decoration: none;"><span class="las la-clipboard-list"></span><span>Products</span></a>
          </li>
          <li>
            <a href="../admin/orders.php" style="text-decoration: none;"><span class="las la-shopping-bag"></span><span>Orders</span></a>
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

          Customer
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
                <h2>Registered Customer</h2>
              </div>

              <?php

              $query = "SELECT * FROM customer";
              $result = mysqli_query($conn, $query);

              while ($row = mysqli_fetch_array($result)) {
                $fname = $row['Cust_Fname'];
                $lname = $row['Cust_Lname'];
                $email = $row['Cust_Email'];
                $phonenum = $row['Cust_PhoneNo'];
                $gender = $row['Cust_Gender'];
                $address = $row['Cust_Address'];
                $picture = $row['Images_Location'];

              ?>

              <div class="container ">
                <div class="row">
                  <div class="col-4">
                    <div class="info mt-3">
                      <img src="<?php echo $picture; ?>" width="40x" height="40px">
                      <div>
                        <h4><?php echo "$fname $lname"; ?></h4>
                        <small><?php echo $email; ?></small>
                      </div>
                    </div>
                  </div>
                  <div class="info col-2 mt-3">
                    <h4><?php echo $gender; ?></h4>
                  </div>
                  <div class="info col-2 mt-3">
                    <h4><?php echo $phonenum; ?></h4>
                  </div>
                  <div class="info col-4 mt-3">
                    <h4><?php echo $address; ?></h4>
                  </div>
                </div><hr>
              </div>

              <?php

              }

              ?>

              </div>
            </div>
          </div>
        </div>
      </main>
    </div>

  </body>
</html>
