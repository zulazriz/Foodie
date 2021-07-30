<?php

session_start();
include '../connection.php';

$custid = $_SESSION['Cust_ID'];

if(isset($_FILES['up_img']['name'])){

    $maxsize = 10000024; // 10MB

    $name = $_FILES['up_img']['name'];
    $target_dir = "../images/user profile picture/";
    $target_file = $target_dir . $_FILES["up_img"]["name"];

    // Select file type
    $imagesFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Valid file extensions
    $extensions_arr = array("jpg","png","gif","jpeg","webp");

    // Check extension
    if(in_array($imagesFileType,$extensions_arr) ){

        // Check file size
        if(($_FILES['up_img']['size'] >= $maxsize) || ($_FILES['up_img']['size'] == 0)) {
          echo '<script type="text/javascript">alert("File too large. File must be less than 10MB.");location="../customer/profile.php";</script>';
        }else {
            // Upload
            if(move_uploaded_file($_FILES['up_img']['tmp_name'],$target_file)){
                // Insert into db
                $query = "UPDATE customer SET Images_Name = '$name', Images_Location = '$target_file', Images_Datatype = '$name' WHERE Cust_ID = '$custid'";

                mysqli_query($conn,$query);
                echo '<script type="text/javascript">alert("Upload successfully!");location="../customer/profile.php";</script>';
                // echo "$custid | $name | $target_file";
            }
        }
    }else{
        echo '<script type="text/javascript">alert("Invalid file type!");location="../customer/profile.php";</script>';
    }
}

?>
