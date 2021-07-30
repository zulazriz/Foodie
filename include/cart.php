<?php

session_start();
include '../connection.php';

if (isset($_POST['submitproduct'])) {

  $custid = $_SESSION['Cust_ID'];
  $prodquan = $_POST['quantityproduct'];
  $prodid = $_GET['id'];

  $query = "SELECT * FROM product WHERE Prod_ID = '$prodid'";
  $result = mysqli_query($conn, $query);

  while ($row = mysqli_fetch_assoc($result)) {

    $prodname = $row['Prod_Name'];
    $prodprice = $row['Prod_Price'];

    $totalprice = $prodprice * $prodquan;

    $selectcount = "SELECT COUNT(prod_id) AS prodcount
                    FROM product_cart
                    WHERE prod_id = $prodid
                    AND Cust_ID = $custid
                    AND Prod_Status = 'Pending'";
    $resultcount = mysqli_query($conn, $selectcount);

    while ($row2 = mysqli_fetch_array($resultcount)) {
      $prodcount = $row2['prodcount'];
      // echo $row2['prodcount'];

      if ($prodcount > 0) {
        $updateprod = "UPDATE product_cart
                       SET Quantity = Quantity + '$prodquan', Total_Price = Total_Price + (Prod_Price * '$prodquan')
                       WHERE prod_id = '$prodid' AND Cust_ID = $custid;";
        $updateresult = mysqli_query($conn, $updateprod);

        if ($updateresult) {
          echo '<script type="text/javascript">alert("Your item has been added to cart.");location="../customer/products.php";</script>';
        }else {
          echo '<script type="text/javascript">alert("Something went wrong! Cannot add to cart.");location="../customer/products.php";</script>';
        }
      }else {
        $query2 = "INSERT INTO product_cart(Cust_ID, Prod_ID, Prod_Name, Prod_Price, Quantity, Total_Price, Prod_Status)
                   VALUES ('$custid', '$prodid', '$prodname', '$prodprice', '$prodquan', '$totalprice', 'Pending')";
        $result2 = mysqli_query($conn, $query2);

        if ($result2) {
          echo '<script type="text/javascript">alert("Your item has been added to cart.");location="../customer/products.php";</script>';
        }else {
          echo '<script type="text/javascript">alert("Something went wrong! Cannot add to cart.");location="../customer/products.php";</script>';
        }
      }
    }
  }
}


?>
