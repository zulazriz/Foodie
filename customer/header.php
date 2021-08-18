<?php

  session_start();
  include '../connection.php';

  if (isset($_SESSION['LoginUser']))
  {
    $custid = $_SESSION['Cust_ID'];
    $query = "SELECT * FROM Customer WHERE Cust_ID = '$custid'";
    $result = mysqli_query($conn, $query);
    while($row = mysqli_fetch_array($result)) {
      $fname = $row['Cust_Fname'];
      $lname = $row['Cust_Lname'];
    }
  }

?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>Rumah Kucing</title>
		<meta charset="utf-8" />
		<link rel="icon" href="../images/paw.ico" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="../assets/css/style.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.3/css/fontawesome.min.css" integrity="undefined" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://www.paypal.com/sdk/js?client-id=ARPv-KwGvUp3zr06fA4k-d-53dCPi7o15HYQnMSdMQorKC2cEDjqv-YFRgIONHclKHqDkGvXG_bLnqwK&currency=MYR&components=buttons"></script>
		<noscript><link rel="stylesheet" href="../assets/css/noscript.css" /></noscript>
	</head>
	<body class="is-preload">
		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Header -->
					<header id="header">
						<div class="inner">

							<!-- Logo -->
								<a href="../index.php" class="logo">
									<span><img src="../images/logo3.jpg"></span> <span class="title">Rumah Kucing</span>
								</a>

							<!-- Nav -->
								<nav>
									<ul>
										<li><a href="#menu">Menu</a></li>
									</ul>
								</nav>

						</div>
					</header>

				<!-- Menu -->
				<nav id="menu">
					<h2>Menu</h2>
          <br>
					<ul>
            <?php
							if (isset($_SESSION["LoginUser"])) {
								echo "<li><a href='../index.php?Id=$custid&User=$fname $lname' class='text-decoration-none'>Home</a></li>
          						<li><a href='../customer/boarding.php?Id=$custid&User=$fname $lname' class='text-decoration-none'>Cat Boarding</a></li>
                      <li><a href='../customer/products.php?Id=$custid&User=$fname $lname' class='text-decoration-none'>Products</a></li>
          						<li><a href='../customer/about.php?Id=$custid&User=$fname $lname' class='text-decoration-none'>About Us</a></li>

                      <div class='mt-5'>
												<div class='row'>
													<div class='col-md-auto'>
														<a href='../customer/profile.php?Id=$custid&User=$fname $lname'><i class='fas fa-user fa-lg' style='color: white;'></i></a>
													</div>

													<div class='col-2'>
														<a href='../customer/cart.php?Id=$custid&User=$fname $lname'><i class='fas fa-shopping-cart fa-lg' style='color: white;'></i></a>
													</div>
												</div>
											</div>
											<div class='mt-3'>
												<div class='row'>
													<div class='col-md-auto'>
														<p>Welcome, $fname $lname</p>
														<a href='../include/logout.php' class='text-decoration-none' style='color: white;'>Logout</a>
													</div>
												</div>
											</div>";
							}else {
								echo "<li><a href='../index.php' class='text-decoration-none'>Home</a></li>
                      <li><a href='../customer/boarding.php' class='text-decoration-none'>Cat Boarding</a></li>
                      <li><a href='../customer/products.php' class='text-decoration-none'>Products</a></li>
                      <li><a href='../customer/about.php' class='text-decoration-none'>About Us</a></li>
                      <li><a href='../customer/userLogin.php' class='text-decoration-none'>Login</a></li>";
							}
						?>
					</ul>
				</nav>
