<?php

include '../../connection.php';

$staffid = $_GET['Id'];

$query = "DELETE FROM staff WHERE Staff_ID = $staffid";
$result = mysqli_query($conn, $query);

if ($result) {
  echo '<script type="text/javascript">alert("Successfully delete!");location="../staff.php";</script>';
}else {
  echo '<script type="text/javascript">alert("Oopss! Something wrong.");location="../staff.php";</script>';
}



?>
