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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
            <a href="../admin/products.php" class="active" style="text-decoration: none;"><span class="las la-clipboard-list"></span><span>Products</span></a>
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

          Products
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
                <h2>Products List</h2>
                <button class='btn btn-light btn-sm rounded-0' type='button' data-bs-toggle='modal' data-bs-target='#addProducts'>
                  <i class="la la-plus"></i>
                  Add New Products
                </button>
              </div>

              <?php

              $query = "SELECT * FROM product";
              $result = mysqli_query($conn, $query);
              $i = 1;
              while ($row = mysqli_fetch_array($result)) {
                $i++;
                $prodid = $row['Prod_ID'];
                $prodname = $row['Prod_Name'];
                $prodprice = $row['Prod_Price'];
                $prodstatus = $row['Prod_Status'];
                $prodimages = $row['Prod_Images'];

              ?>

              <div class="container ">
                <div class="row">
                  <div class="col-3 text-center">
                    <img src="<?php echo $prodimages; ?>" width="170x" height="200px">
                  </div>
                  <div class="info col-2 mt-3">
                    <h4><?php echo $prodname; ?></h4>
                  </div>
                  <div class="info col-2 mt-3">
                    <h4>RM <?php echo $prodprice; ?></h4>
                  </div>
                  <div class="info col-2 mt-3">
                    <h4 id="productStatusValue<?php echo $i; ?>"><?php echo $prodstatus; ?></h4>
                  </div>
                  <div class="info col mt-3">
                    <div class="form-check form-switch">
                      <input class="form-check-input" type="text" value="<?php echo $prodid; ?>" id="productIdValue<?php echo $i; ?>"/>

                      <?php

                        if ($prodstatus == "Available") {
                          echo '<input class="form-check-input" type="checkbox" id="changestatus'.$i.'" checked/>';
                        }elseif ($prodstatus == "Not available") {
                          echo '<input class="form-check-input" type="checkbox" id="changestatus'.$i.'"/>';
                        }

                      ?>

                    </div>
                  </div>
                  <div class="info col-2 mt-3">
                    <?php

                    echo "<ul class='list-inline m-0'>
            								<li class='list-inline-item'>
            										<button class='btn btn-success btn-sm rounded-0' role='button' type='button' data-bs-toggle='modal' data-bs-target='#updateProducts".$prodid."'><i class='la la-edit'></i></button>
            								</li>
            								<li class='list-inline-item'>
            									 <button class='btn btn-danger btn-sm rounded-0' type='button' data-bs-toggle='modal' data-bs-target='#deleteProducts".$prodid."'><i class='la la-trash'></i></button>
            								</li>
            							</ul>";

                    ?>
                  </div>
                </div><hr>
              </div>

              <?php

              echo '<script>
                    $(document).ready(function(){
                      $("#changestatus'.$i.'").click(function(){
                        $.post("changestatus.php",
                        {
                          id: $("#productIdValue'.$i.'").val(),
                          status: $("#productStatusValue'.$i.'").text()
                        },
                        function(data,status){
                          if ($("#productStatusValue'.$i.'").text() == "Not available")
                            $("#productStatusValue'.$i.'").text("Available");
                          else
                            $("#productStatusValue'.$i.'").text("Not available");
                        });
                      });
                    });
                    </script>';

              // Modal for delete product
              echo "<div id='deleteProducts".$prodid."' class='modal fade' aria-hidden='true'>
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
                            <a href='../admin/include/deleteproducts.php?Id=".$prodid."' type='button' class='btn btn-danger text-white'>Delete</a>';
                          </div>
                        </div>
                      </div>
                    </div>";

                // Modal Update Products
                echo '<div class="modal fade" id="updateProducts'.$prodid.'" tabindex="-1" role="dialog" aria-hidden="true">
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
                                  <input type="text" class="form-control" placeholder="Enter product name" name="prodname" value="'.$prodname.'">
                                </div>
                                <label>Product Price:</label>
                                <div class="input-group mb-3">
                                  <span class="input-group-text"><i class="las la-dollar-sign"></i></span>
                                  <input type="text" class="form-control" placeholder="Enter product price" name="prodprice" value="'.$prodprice.'">
                                </div>';

										            $sql="SELECT * FROM categories";
										            $catquery=mysqli_query($conn, $sql);


                          echo '<label>Product Category:</label>
                                <div class="input-group mb-3">
                                  <span class="input-group-text"><i class="las la-list-alt"></i></span>
                                  <select class="form-select" name="prodcat">
    										           <option disable selected>Select category</option>';

                                   while($catrow = mysqli_fetch_array($catquery)){
 										                $catid = isset($_GET['categories']) ? $_GET['categories'] : 0;
 										                $selected = ($catid == $catrow['Category_ID']) ? " selected" : "";
 										                echo "<option $selected value=".$catrow['Category_ID'].">".$catrow['Category_Name']."</option>";
 										              }

    										    echo '</select>
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
                      </div>';

                // Modal Add Products
                echo '<div class="modal fade" id="addProducts" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header text-center">
                              <h4 class="modal-title w-100 font-weight-bold">Add New Product</h4>
                              <button type="button" class="close btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="../admin/addproducts.php" method="POST" enctype="multipart/form-data">
                              <div class="modal-body">
                                <label>Product Name:</label>
                                <div class="input-group mb-3">
                                  <span class="input-group-text"><i class="las la-user"></i></span>
                                  <input type="text" class="form-control" placeholder="Enter product name" name="addprodname">
                                </div>
                                <label>Product Price:</label>
                                <div class="input-group mb-3">
                                  <span class="input-group-text"><i class="las la-dollar-sign"></i></span>
                                  <input type="text" class="form-control" placeholder="Enter product price" name="addprodprice">
                                </div>';

                                $sql="SELECT * FROM categories";
                                $catquery=mysqli_query($conn, $sql);

                          echo '<label>Product Category:</label>
                                <div class="input-group mb-3">
                                  <span class="input-group-text"><i class="las la-list-alt"></i></span>
                                  <select class="form-select" name="addprodcat">
    										           <option disable selected>Select category</option>';

                                   while($catrow = mysqli_fetch_array($catquery)){
 										                $catid = isset($_GET['categories']) ? $_GET['categories'] : 0;
 										                $selected = ($catid == $catrow['Category_ID']) ? " selected" : "";
 										                echo "<option $selected value=".$catrow['Category_ID'].">".$catrow['Category_Name']."</option>";
 										              }

                            echo '</select>
                                </div>
                                <div class="wrapper mt-5">
                                  <input type="file" name="addprodimg" id="addprodimg">
                                </div>
                              </div>
                              <div class="modal-footer d-flex justify-content-center">
                                <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" name="add_prod">Add</button>
                              </div>
                            </form>
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
