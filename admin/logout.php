<?php

  session_start();
  session_unset();
  session_destroy();

  header("location: ../customer/userLogin.php");
  exit();

?>
