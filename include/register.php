<?php

if (isset($_POST["register"])) {

  $fname = $_POST["firstname"];
  $lname = $_POST["lastname"];
  $pnum = $_POST["pnumber"];
  $email = $_POST["email"];
  $dob = $_POST["dob"];
  $address = $_POST["address"];
  $gender = $_POST["gender"];
  $pwd = $_POST["pwd"];
  $confirmpwd = $_POST["confirmpwd"];

  require_once '../connection.php';
  require_once 'functions.php';

  if (emptyInputRegister($fname, $lname, $pnum, $email, $dob, $address, $gender, $pwd, $confirmpwd) !== false) {
    header("location: ../customer/userRegister.php?error=emptyinput");
    exit();
  }
  if (pwdMatch($pwd, $confirmpwd) !== false) {
    header("location: ../customer/userRegister.php?error=passwordsdontmatch");
    exit();
  }
  if (EmailExists($conn, $email) !== false) {
    header("location: ../customer/userRegister.php?error=emailtaken");
    exit();
  }
  createUser($conn, $fname, $lname, $pnum, $email, $dob, $address, $gender, $pwd);
}else {
  header("location: ../customer/userRegister.php");
  exit();
}

?>
