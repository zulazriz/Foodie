<?php

include '../customer/header.php';
include '../connection.php';

if (isset($_SESSION['LoginUser']))
{
  $custid = $_SESSION['Cust_ID'];

  $query = "SELECT * FROM Customer WHERE Cust_ID = '$custid'";
  $result = mysqli_query($conn, $query);
  while($row = mysqli_fetch_array($result)) {
    $fname = $row['Cust_Fname'];
    $lname = $row['Cust_Lname'];
    $email = $row['Cust_Email'];
    $dob = $row['Cust_DOB'];
    $phonenum = $row['Cust_PhoneNo'];
    $address = $row['Cust_Address'];
    $imgpath = $row['Images_Location'];
  }
}

?>

<style>
  .wrapper {
    height: 200px;
    width: 200px;
    position: relative;
    border:5px solid #fff;
    border-radius: 50%;
    background: url('<?php echo $imgpath ?>');
    background-size: 100% 100%;
    margin: 100px auto;
    overflow: hidden;
  }

  .my_file {
    position: absolute;
    bottom: 1;
    outline: none;
    color: transparent;
    width: 100%;
    box-sizing: border-box;
    padding: 85px 86px;
    cursor: pointer;
    transition: 0.5s;
    background: rgba(0, 0, 0, 0.5);
    opacity: 0;
  }

  .my_file::-webkit-file-upload-button {
    visibility: hidden;
  }

  .my_file::before {
    content: '\f030';
    font-family: fontAwesome;
    font-size: 20px;
    color: #fff;
    display: inline-block;
    -webkit-user-select: none;
    text
  }

  .my_file::after {
    color: #fff;
    display: block;
    top: 100px;
    font-size: 14px;
    position: absolute;
  }
  .my_file:hover {
    opacity: 1;
  }

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

<div class="container mt-5 mb-5">
  <div class="row">
    <div class="col-md-3 border-right">
      <form action="../include/uploadimages.php" method="POST" id="form" enctype="multipart/form-data">
        <div class="wrapper">
          <input type="file" class="my_file" name="up_img" id="up_img">
        </div>
      </form>
      <div class="d-flex flex-column align-items-center">
        <span>Hi, <?php echo "$fname $lname" ?></span>
      </div>
    </div>

    <div class="col-md-4 border-right">
      <div class="p-3 py-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <h4 class="text-right">Profile</h4>
        </div>
        <div class="row mt-2">
          <div class="col-md-6">
            <label class="labels">First Name</label>
            <input type="text" class="form-control" placeholder="first name" value="<?php echo "$fname" ?>" name="fname" disabled>
          </div>
          <div class="col-md-6">
            <label class="labels">Last Name</label>
            <input type="text" class="form-control" placeholder="last name" value="<?php echo "$lname" ?>" name="lname" disabled>
          </div>
        </div>
        <div class="row mt-3">
          <div class="col-md-12">
            <label class="labels">Mobile Number</label>
            <input type="text" class="form-control" placeholder="enter phone number" value="0<?php echo "$phonenum" ?>" name="phonenum" disabled>
          </div>
          <div class="col-md-12">
            <label class="labels">Birthday</label>
            <input type="text" class="form-control" value="<?php echo "$dob" ?>" disabled>
          </div>
          <div class="col-md-12">
            <label class="labels">Email</label>
            <input type="text" class="form-control" placeholder="enter email" value="<?php echo "$email" ?>" name="email" disabled>
          </div>
          <div class="col-md-12">
            <label class="labels">Address</label>
            <input type="text" class="form-control" placeholder="enter address" value="<?php echo "$address" ?>" name="address" disabled>
          </div>
        </div>
        <div class="mt-5 text-center">
          <button class="btn btn-success" type="button" data-bs-toggle='modal' data-bs-target='#updateProfile'>Update Profile</button>
        </div>
      </div>
    </div>

    <div class="col-md-5">
      <div class="p-3 py-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <h4 class="text-right">Your Cats</h4>
        </div>
        <div class="d-flex justify-content-between align-items-center experience">
          <span class="border px-3 p-1 add-experience">
            <button class='btn btn-light btn-sm rounded-0' type='button' data-bs-toggle='modal' data-bs-target='#addPet'>
              <i class="fa fa-plus"></i>
              &nbsp;Add Cat
            </button>
          </span>
        </div><br>

        <table class="table">
          <thead>
            <tr>
              <th scope="col">Name</th>
              <th scope="col">Colour</th>
              <th scope="col">Breed</th>
              <th scope="col">Sex</th>
            </tr>
          </thead>
          <?php

          $petquery = "SELECT pet.Pet_ID, pet.Pet_Name, pet.Pet_Colour, pet.Pet_Sex, breed.Breed_Name
                       FROM pet INNER JOIN breed
                       WHERE pet.Breed_ID = breed.Breed_ID
                       AND pet.Cust_ID = '$custid';";
          $petresult = mysqli_query($conn, $petquery);

          if ($petresult) {
            foreach ($petresult as $row) {

              echo "<tbody>
                      <tr>
                        <td>".$row['Pet_Name']."</td>
                        <td>".$row['Pet_Colour']."</td>
                        <td>".$row['Breed_Name']."</td>
                        <td>".$row['Pet_Sex']."</td>
                        <td>
                          <ul class='list-inline m-0'>
                            <li class='list-inline-item'>
                               <button class='btn btn-danger btn-sm rounded-0' type='button' data-bs-toggle='modal' data-bs-target='#petDelete".$row['Pet_ID']."'><i class='fa fa-trash'></i></button>
                            </li>
                          </ul>
                        </td>
                      </tr>
                    </tbody>";

              // Modal for delete
              echo "<div id='petDelete".$row['Pet_ID']."' class='modal fade' aria-hidden='true'>
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
                            <a href='../include/deletepet.php?Id=".$row['Pet_ID']."' type='button' class='btn btn-danger text-white'>Delete</a>';
                          </div>
                        </div>
                      </div>
                    </div>";
            }
          }

          ?>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Modal Add Cat -->
<div class="modal fade" id="addPet" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">Add your cat</h4>
        <button type='button' class='close btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
      </div>
      <form action="../include/addpet.php" method="POST">
        <div class="modal-body">
          <div class="container">
            <div class="row">
              <div class="col">
                <label>Name:</label>
                <div class="input-group mb-3">
                  <span class="input-group-text"><i class="fas fa-cat"></i></span>
                  <input type="text" class="form-control" placeholder=" Cat name" name="catname">
                </div>
              </div>
              <div class="col">
                <label>Color:</label>
                <div class="input-group mb-3">
                  <span class="input-group-text"><i class="fas fa-palette"></i></span>
                  <input type="text" class="form-control" placeholder=" Cat fur color" name="catcolor">
                </div>
              </div>
            </div>
            <div>
              <label>Sex:</label>
              <select class="form-select" aria-label="Default select example" name="sex">
                <option value="Male">Male</option>
                <option value="Female">Female</option>
              </select>

              <label class="mt-3">Breed:</label>
              <select class="form-select" aria-label="Default select example" name="breed">
                <?php
                  $breedquery = "SELECT * FROM breed";
                  $breedresult = mysqli_query($conn, $breedquery);
                  while ($row = mysqli_fetch_array($breedresult)) {
                    $breedid = isset($_GET['breed']) ? $_GET['breed'] : 0;
                    $selected = ($breedid == $row['Breed_ID']) ? " selected" : "";
                    echo "<option $selected value=".$row['Breed_ID'].">".$row['Breed_Name']."</option>";
                  }
                ?>
              </select>
            </div>
          </div>
        </div>
        <div class="modal-footer d-flex justify-content-center">
          <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button class="btn btn-primary">Add</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Update Profile -->
<div class="modal fade" id="updateProfile" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">Update Your Profile</h4>
        <button type='button' class='close btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
      </div>
      <form action="../include/updateprofile.php" method="POST">
        <div class="container">
          <div class="row mt-2">
            <div class="col-md-6">
              <label class="labels">First Name</label>
              <input type="text" class="form-control" placeholder="first name" name="fname">
            </div>
            <div class="col-md-6">
              <label class="labels">Last Name</label>
              <input type="text" class="form-control" placeholder="last name" name="lname">
            </div>
          </div>
          <div class="row mt-3">
            <div class="col-md-12">
              <label class="labels">Mobile Number</label>
              <input type="text" class="form-control" placeholder="enter phone number" name="phonenum">
            </div>
            <div class="col-md-12">
              <label class="labels">Email</label>
              <input type="text" class="form-control" placeholder="enter email" name="email">
            </div>
            <div class="col-md-12">
              <label class="labels">Address</label>
              <input type="text" class="form-control" placeholder="enter address" name="address">
            </div>
          </div>
        </div>
        <div class="modal-footer d-flex justify-content-center">
          <button class="btn btn-primary" name="updateProfile">Save Changes</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  document.getElementById("up_img").onchange = function() {
    document.getElementById("form").submit();
  };
</script>

<?php

include '../customer/footer.php';

?>
