<?php

require_once '../connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $search = $_POST['search'];
  $searchquery = "SELECT * FROM product WHERE Prod_Name LIKE '%".$search."%'";
  $result = mysqli_query($conn, $searchquery);

  if (mysqli_num_rows($result)) {
    while ($row = mysqli_fetch_assoc($result)) {
      echo '<a class="list-group-item list-group-item-action p-2 border" style="text-decoration: none; color: #000000; cursor: pointer;">'.$row['Prod_Name'].'</a>';
    }
  }else {
    echo '<p class="list-group list-group-item"> Search Not Found! </p>';
  }
}
?>
