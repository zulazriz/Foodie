<?php

include '../connection.php';

$query1 = "SELECT COUNT(Cust_ID) AS total_cust FROM customer";
$result1 = mysqli_query($conn, $query1);
$row = mysqli_fetch_array($result1);

$query2 = "SELECT COUNT(Cart_ID) AS total_cart FROM product_cart";
$result2 = mysqli_query($conn, $query2);
$row2 = mysqli_fetch_array($result2);

$query3 = "SELECT COUNT(Booking_ID) AS total_booking FROM booking";
$result3 = mysqli_query($conn, $query3);
$row3 = mysqli_fetch_array($result3);

$query4 = "SELECT SUM(total) AS total_sales FROM payment";
$result4 = mysqli_query($conn, $query4);
$row4 = mysqli_fetch_array($result4);

$query5 = "SELECT
           SUM(IF(month = 'Jan', total, 0)) AS 'Jan',
           SUM(IF(month = 'Feb', total, 0)) AS 'Feb',
           SUM(IF(month = 'Mar', total, 0)) AS 'Mar',
           SUM(IF(month = 'Apr', total, 0)) AS 'Apr',
           SUM(IF(month = 'May', total, 0)) AS 'May',
           SUM(IF(month = 'Jun', total, 0)) AS 'Jun',
           SUM(IF(month = 'Jul', total, 0)) AS 'Jul',
           SUM(IF(month = 'Aug', total, 0)) AS 'Aug',
           SUM(IF(month = 'Sep', total, 0)) AS 'Sep',
           SUM(IF(month = 'Oct', total, 0)) AS 'Oct',
           SUM(IF(month = 'Nov', total, 0)) AS 'Nov',
           SUM(IF(month = 'Dec', total, 0)) AS 'Dec',
           SUM(total) AS total_yearly
           FROM (
           SELECT DATE_FORMAT(Payment_Timestamp, '%b') AS month, SUM(total) as total
           FROM payment
           WHERE Payment_Timestamp <= NOW() and Payment_Timestamp >= Date_add(Now(),interval - 12 month)
           GROUP BY DATE_FORMAT(Payment_Timestamp, '%m-%Y')) as sub";
$result5 = mysqli_query($conn, $query5);
$row5 = mysqli_fetch_array($result5);

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
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Month', 'Sales'],
          ['January', <?php echo $row5['Jan']; ?>],
          ['February', <?php echo $row5['Feb']; ?>],
          ['March', <?php echo $row5['Mar']; ?>],
          ['April', <?php echo $row5['Apr']; ?>],
          ['May', <?php echo $row5['May']; ?>],
          ['June', <?php echo $row5['Jun']; ?>],
          ['July', <?php echo $row5['Jul']; ?>],
          ['August', <?php echo $row5['Aug']; ?>],
          ['September', <?php echo $row5['Sep']; ?>],
          ['October', <?php echo $row5['Oct']; ?>],
          ['November', <?php echo $row5['Nov']; ?>],
          ['December', <?php echo $row5['Dec']; ?>]
        ]);

        var options = {
          chart: {
            title: 'Rumah Kucing Monthly Sales Chart',
            subtitle: 'Sales by month',
          },
          bars: 'vertical' // Required for Material Bar Charts.
        };

        var chart = new google.charts.Bar(document.getElementById('barchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
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
            <a href="" class="active" style="text-decoration: none;"><span class="las la-igloo"></span><span>Dashboard</span></a>
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

          Dashboard
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
        <div class="cards">
          <div class="card-single">
            <div>
              <h1><?php echo $row['total_cust']; ?></h1>
              <span>Customers</span>
            </div>
            <div>
              <span class="las la-users"></span>
            </div>
          </div>

          <div class="card-single">
            <div>
              <h1><?php echo $row2['total_cart']; ?></h1>
              <span>Orders</span>
            </div>
            <div>
              <span class="las la-shopping-bag"></span>
            </div>
          </div>

          <div class="card-single">
            <div>
              <h1><?php echo $row3['total_booking']; ?></h1>
              <span>Booking</span>
            </div>
            <div>
              <span class="las la-clipboard-list"></span>
            </div>
          </div>

          <div class="card-single">
            <div>
              <h1>RM <?php echo $row4['total_sales']; ?></h1>
              <span>Sales</span>
            </div>
            <div>
              <span class="las la-dollar-sign"></span>
            </div>
          </div>
        </div>

        <div class="mt-5">
          <div id="barchart_material" style="width: 1010px; height: 500px;"></div>
        </div>

        <div class="recent-grid">
          <div class="projects">
            <div class="card">
              <div class="card-header">
                <h4>Bookings</h4>
                <a href="../admin/bookings.php"><button>See all<span class="las la-arrow-right"></span></button></a>
              </div>

              <div class="card-body">
                <div class="table-responsive">
                  <table width="100%">
                    <thead>
                      <tr>
                        <td>Customer</td>
                        <td>Room</td>
                        <td>Grooming</td>
                        <td>Status</td>
                      </tr>
                    </thead>

                    <?php

                    $booking = "SELECT c.Cust_ID, c.Cust_Fname, c.Cust_Lname, s.Serv_ID, s.Serv_Name, r.Room_ID, r.Room_Type, b.Booking_Status
                                FROM booking b
                                INNER JOIN customer c ON b.Cust_ID = c.Cust_ID
                                INNER JOIN service s ON b.Serv_ID = s.Serv_ID
                                INNER JOIN room r ON b.Room_ID = r.Room_ID
                                ORDER BY Booking_Status LIMIT 10";
                    $resultbook = mysqli_query($conn, $booking);

                    while ($row = mysqli_fetch_array($resultbook)) {
                      $cfname = $row['Cust_Fname'];
                      $clname = $row['Cust_Lname'];
                      $rname = $row['Room_Type'];
                      $sname = $row['Serv_Name'];
                      $status = $row['Booking_Status'];

                      ?>

                      <tbody>
                        <tr>
                          <td><?php echo "$cfname $clname"; ?></td>
                          <td><?php echo $rname ?></td>
                          <td><?php echo $sname ?></td>
                          <td>
                            <?php

                            if ($status == 'Pending') {
                              echo '<span class="status red"></span>
                                    '.$status.'';
                            }elseif ($status == 'Paid') {
                              echo '<span class="status green"></span>
                                    '.$status.'';
                            }

                            ?>
                          </td>
                        </tr>
                      </tbody>

                      <?php
                      }
                      ?>

                  </table>
                </div>
              </div>
            </div>

            <div class="projects mt-5">
              <div class="card">
                <div class="card-header">
                  <h4>Orders</h4>
                  <a href="../admin/orders.php"><button>See all<span class="las la-arrow-right"></span></button></a>
                </div>

                <div class="card-body">
                  <div class="table-responsive">
                    <table width="100%">
                      <thead>
                        <tr>
                          <td>Customer</td>
                          <td>Item</td>
                          <td>Status</td>
                        </tr>
                      </thead>

                      <?php

                      $product = "SELECT c.Cust_ID, c.Cust_Fname, c.Cust_Lname, pc.Cust_ID, pc.Prod_Name, pc.Prod_Status
                                  FROM product_cart pc
                                  INNER JOIN customer c ON pc.Cust_ID = c.Cust_ID
                                  ORDER BY Prod_Status LIMIT 10";
                      $resultprod = mysqli_query($conn, $product);

                      while ($row = mysqli_fetch_array($resultprod)) {
                        $cfname = $row['Cust_Fname'];
                        $clname = $row['Cust_Lname'];
                        $name = $row['Prod_Name'];
                        $status = $row['Prod_Status'];

                        ?>

                        <tbody>
                          <tr>
                            <td><?php echo "$cfname $clname"; ?></td>
                            <td><?php echo $name ?></td>
                            <td>
                              <?php

                              if ($status == 'Pending') {
                                echo '<span class="status red"></span>
                                      '.$status.'';
                              }elseif ($status == 'Paid') {
                                echo '<span class="status green"></span>
                                      '.$status.'';
                              }

                              ?>
                            </td>
                          </tr>
                        </tbody>

                        <?php
                        }
                        ?>

                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="customers">
            <div class="card">
              <div class="card-header">
                <h4>Customer</h4>
                <a href="../admin/customer.php"><button>See all<span class="las la-arrow-right"></span></button></a>
              </div>

              <?php

              $cust = "SELECT * FROM customer";
              $resultcust = mysqli_query($conn, $cust);

              while ($row = mysqli_fetch_array($resultcust)) {
                $img = $row['Images_Location'];
                $fname = $row['Cust_Fname'];
                $lname = $row['Cust_Lname'];
                $email = $row['Cust_Email'];

                echo '<div class="card-body">
                        <div class="customer">
                          <div class="info">
                            <img src="'.$img.'" width="40x" height="40px">
                            <div>
                              <h4>'.$fname.' '.$lname.'</h4>
                              <small>'.$email.'</small>
                            </div>
                          </div>
                        </div>
                      </div>';
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
