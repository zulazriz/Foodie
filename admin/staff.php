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
            <a href="../admin/staff.php" class="active" style="text-decoration: none;"><span class="las la-user-tie"></span><span>Staff</span></a>
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

          Staff
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
                <h2>Rumah Kucing Staff</h2>

                <button class='btn btn-light btn-sm rounded-0' type='button' data-bs-toggle='modal' data-bs-target='#addStaff'>
                  <i class="la la-plus"></i>
                  Register New Staff
                </button>
              </div>

              <?php

              $query = "SELECT * FROM staff";
              $result = mysqli_query($conn, $query);

              while ($row = mysqli_fetch_array($result)) {
                $staffid = $row['Staff_ID'];
                $name = $row['Staff_Name'];
                $email = $row['Staff_Email'];
                $phonenum = $row['Staff_PhoneNo'];
                $gender = $row['Staff_Gender'];
                $address = $row['Staff_Address'];
                $picture = $row['Staff_Images'];

              ?>

              <div class="container ">
                <div class="row">
                  <div class="col-4">
                    <div class="info mt-3">
                      <img src="<?php echo $picture; ?>" width="40x" height="40px">
                      <div>
                        <h4><?php echo $name; ?></h4>
                        <small><?php echo $email; ?></small>
                      </div>
                    </div>
                  </div>
                  <div class="info col-1 mt-3">
                    <h4><?php echo $gender; ?></h4>
                  </div>
                  <div class="info col-2 mt-3">
                    <h4><?php echo $phonenum; ?></h4>
                  </div>
                  <div class="info col-4 mt-3">
                    <h4><?php echo $address; ?></h4>
                  </div>
                  <div class="col mt-3">
                    <?php
                    echo "<button class='btn btn-danger btn-sm rounded-0' type='button' data-bs-toggle='modal' data-bs-target='#modalDelete".$staffid."'><i class='las la-trash'></i></button>";
                    ?>
                  </div>
                </div><hr>
              </div>


              <?php
              // Modal for delete staff
              echo "<div id='modalDelete".$staffid."' class='modal fade' aria-hidden='true'>
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
                            <a href='../admin/include/deletestaff.php?Id=".$staffid."' type='button' class='btn btn-danger text-white'>Delete</a>';
                          </div>
                        </div>
                      </div>
                    </div>";
              }

              ?>

                <!-- Modal Register Staff -->
                <div class="modal fade" id="addStaff" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header text-center">
                        <h4 class="modal-title w-100 font-weight-bold">Register staff</h4>
                        <button type='button' class='close btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                      </div>
                      <form action="../admin/include/registerstaff.php" method="POST">
                        <div class="modal-body">
                          <label>Name:</label>
                          <div class="input-group mb-3">
                            <span class="input-group-text"><i class="las la-user"></i></span>
                            <input type="text" class="form-control" placeholder="Enter name" name="sname" required>
                          </div>
                          <label>Email:</label>
                          <div class="input-group mb-3">
                            <span class="input-group-text"><i class="las la-envelope"></i></span>
                            <input type="text" class="form-control" placeholder="Enter email" name="semail" required>
                          </div>
                          <label>Phone Number:</label>
                          <div class="input-group mb-3">
                            <span class="input-group-text"><i class="las la-phone"></i></span>
                            <input type="text" maxlength="12" class="form-control" placeholder="Enter phone number" name="spnum" required>
                          </div>
                          <label>Address:</label>
                          <div class="input-group mb-3">
                            <span class="input-group-text"><i class="la la-map-marker"></i></span>
                            <input type="text" class="form-control" placeholder="Enter address" name="saddress" required>
                          </div>
                          <label>Gender:</label>
                          <select class="form-select" aria-label="Default select example" name="sgender" required>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                          </select>
                        </div>
                        <div class="modal-footer d-flex justify-content-center">
                          <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-primary" name="registerstaff">Register</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </main>
    </div>

  </body>
</html>
