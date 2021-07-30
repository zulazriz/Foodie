<?php

include '../../connection.php';

$prodid = $_GET['Id'];

$query = "DELETE FROM product WHERE Prod_ID = $prodid";
$result = mysqli_query($conn, $query);

if ($result) {
  echo '<script type="text/javascript">alert("Successfully delete!");location="../products.php";</script>';
}else {
  echo '<script type="text/javascript">alert("Oopss! Something wrong.");location="../products.php";</script>';
}



?>
