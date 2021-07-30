<?php

include '../connection.php';

if (isset($_POST['add_prod'])) {
  $prodname = $_POST['addprodname'];
  $prodprice = $_POST['addprodprice'];
  $prodcat = $_POST['addprodcat'];

  if(isset($_FILES['addprodimg']['name'])){

      $maxsize = 10000024; //10MB

      $name = $_FILES['addprodimg']['name'];
      $target_dir = "../images/products/";
      $target_file = $target_dir . $_FILES["addprodimg"]["name"];

      // Select file type
      $imagesFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

      // Valid file extensions
      $extensions_arr = array("jpg","png","gif","jpeg","webp");

      // Check extension
      if(in_array($imagesFileType, $extensions_arr) ){

          // Check file size
          if(($_FILES['addprodimg']['size'] >= $maxsize) || ($_FILES['addprodimg']['size'] == 0)) {
            echo '<script type="text/javascript">alert("File too large. File must be less than 10MB.");location="../admin/products.php";</script>';
          }else {
              // Upload
              if(move_uploaded_file($_FILES['addprodimg']['tmp_name'],$target_file)){
                  // Insert into db
                  $query = "INSERT INTO product (Prod_Name, Prod_Price, Prod_Status, Category_ID, Prod_Images)
                            VALUES ('$prodname', '$prodprice', 'Available', '$prodcat', '$target_file')";

                  mysqli_query($conn,$query);
                  echo '<script type="text/javascript">alert("Successfully added new product!");location="../admin/products.php";</script>';
                  // echo "$prodname | $prodprice | $target_file";
              }
          }
      }else{
          echo '<script type="text/javascript">alert("Invalid file type!");location="../admin/products.php";</script>';
      }
  }
}

?>
