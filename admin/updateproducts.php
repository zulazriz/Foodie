<?php

include '../connection.php';

if (isset($_POST['up_prod'])) {
  $prodid = $_GET['Id'];
  $prodname = $_POST['prodname'];
  $prodprice = $_POST['prodprice'];
  $prodcat = $_POST['prodcat'];

  if ($prodname != '') {

    $query = "UPDATE product SET Prod_Name = '$prodname' WHERE Prod_ID = '$prodid'";
    mysqli_query($conn,$query);

    echo '<script type="text/javascript">alert("Successfully updated product details!");location="../admin/products.php";</script>';
  }

  if ($prodprice != '' ) {

    $query = "UPDATE product SET Prod_Price = '$prodprice'WHERE Prod_ID = '$prodid'";
    mysqli_query($conn,$query);

    echo '<script type="text/javascript">alert("Successfully updated product details!");location="../admin/products.php";</script>';
  }

  if ($prodcat != '' ) {

    $query = "UPDATE product SET Category_ID = '$prodcat'WHERE Prod_ID = '$prodid'";
    mysqli_query($conn,$query);

    echo '<script type="text/javascript">alert("Successfully updated product details!");location="../admin/products.php";</script>';
  }

  if ($_FILES['prodimg']['name'] != '') {

    $maxsize = 10000024; // 10MB

    $name = $_FILES['prodimg']['name'];
    $target_dir = "../images/products/";
    $target_file = $target_dir . $_FILES["prodimg"]["name"];

    // Select file type
    $imagesFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Valid file extensions
    $extensions_arr = array("jpg","png","gif","jpeg","webp");

    // Check extension
    if(in_array($imagesFileType, $extensions_arr) ){

        // Check file size
        if(($_FILES['prodimg']['size'] >= $maxsize) || ($_FILES['prodimg']['size'] == 0)) {
          echo '<script type="text/javascript">alert("File too large. File must be less than 10MB.");location="../admin/products.php";</script>';
        }else {
            // Upload
            if(move_uploaded_file($_FILES['prodimg']['tmp_name'],$target_file)){

              $query = "UPDATE product SET Prod_Images = '$target_file' WHERE Prod_ID = '$prodid'";
              mysqli_query($conn,$query);

              echo '<script type="text/javascript">alert("Successfully updated product details!");location="../admin/products.php";</script>';
            }
        }
    }else{
      echo '<script type="text/javascript">alert("Invalid file type!");location="../admin/products.php";</script>';
    }
  }
  echo '<script type="text/javascript">alert("Successfully updated product details!");location="../admin/products.php";</script>';
}




?>
