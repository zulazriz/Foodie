<?php

function emptyInputRegister($fname, $lname, $pnum, $email, $dob, $address, $gender, $pwd, $confirmpwd) {
  $result;
  if (empty($fname) || empty($lname) || empty($pnum) || empty($email) || empty($dob) || empty($address) || empty($gender) || empty($pwd) || empty($confirmpwd)) {
    $result = true;
  } else {
    $result = false;
  }
  return $result;
}

function pwdMatch($pwd, $confirmpwd) {
  $result;
  if ($pwd !== $confirmpwd) {
    $result = true;
  } else {
    $result = false;
  }
  return $result;
}

function EmailExists($conn, $email) {
  $sql = "SELECT * FROM customer WHERE Cust_Email = ?;";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../customer/userRegister.php?error=stmtfailed");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "s", $email);
  mysqli_stmt_execute($stmt);

  $resultData = mysqli_stmt_get_result($stmt);

  if ($row = mysqli_fetch_assoc($resultData)) {
    return $row;
  }else {
    $result = false;
    return $result;
  }

  mysqli_stmt_close($stmt);
}

function createUser($conn, $fname, $lname, $pnum, $email, $dob, $address, $gender, $pwd) {
  $sql = "INSERT INTO customer (Cust_Fname, Cust_Lname, Cust_Phoneno, Cust_Email, Cust_DOB, Cust_Address, Cust_Gender, Cust_Password, Images_Location) VALUES (?, ?, ?, ?, ?, ?, ?, ?, '../images/user profile picture/default_profile.png');";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../customer/userRegister.php?error=stmtfailed");
    exit();
  }

  $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

  mysqli_stmt_bind_param($stmt, "ssssssss", $fname, $lname, $pnum, $email, $dob, $address, $gender, $hashedPwd);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);
  header("location: ../customer/userRegister.php?error=none");
  exit();
}

function emptyInputLogin($email, $password) {
  $result;
  if (empty($email) || empty($password)) {
    $result = true;
  } else {
    $result = false;
  }
  return $result;
}


?>
