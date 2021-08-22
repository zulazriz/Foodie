<?php

	session_start();
	include 'connection.php';

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
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/style.css" />
		<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css" />
		<link rel="icon" href="images/paw.ico" />
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
		<link rel="preconnect" href="https://fonts.gstatic.com">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
	</head>

	<style>
		.btn1 {
			height: 45px;
			width: 35%;
			border: none;
			outline: none;
			background-color: rgba(248, 26, 92);
			color: white;
			font-weight: 700;
			border-radius: 60px;
		}

		.btn1:hover {
			background-color: rgba(223, 15, 77);
			transition: 0.5s;
		}

		.card:hover {
			box-shadow: -2px -1px 25px -3px rgba(0,0,0,0.75);
			-webkit-box-shadow: -2px -1px 25px -3px rgba(0,0,0,0.75);
			-moz-box-shadow: -2px -1px 25px -3px rgba(0,0,0,0.75);
			transition: 0.5s;
		}

		.row__inner {
		  transition: 450ms -webkit-transform;
		  transition: 450ms transform;
		  transition: 450ms transform, 450ms -webkit-transform;
		  font-size: 0;
		  white-space: nowrap;
		  margin: 70.3125px 0;
		  padding-bottom: 10px;
		}
		.tile {
		  position: relative;
		  display: inline-block;
		  width: 250px;
		  height: 140.625px;
		  margin-right: 10px;
		  font-size: 20px;
		  cursor: pointer;
		  transition: 450ms all;
		  -webkit-transform-origin: center left;
		          transform-origin: center left;
		}
		.row__inner:hover {
		  -webkit-transform: translate3d(-62.5px, 0, 0);
		          transform: translate3d(-62.5px, 0, 0);
		}
		.row__inner:hover .tile {
		  opacity: 0.3;
		}
		.row__inner:hover .tile:hover {
		  -webkit-transform: scale(1.5);
		          transform: scale(1.5);
		  opacity: 1;
		}
		.tile:hover ~ .tile {
		  -webkit-transform: translate3d(125px, 0, 0);
		          transform: translate3d(125px, 0, 0);
		}
	</style>

	<body class="is-preload">

		<!-- Wrapper -->
			<div id="wrapper">
				<!-- Header -->
				<header id="header">
						<div class="inner">
							<!-- Logo -->
								<a href="index.php" class="logo">
									<span><img src="images/logo3.jpg"></span> <span class="title">Rumah Kucing</span>
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
								echo "<li><a href='./index.php?Id=$custid&User=$fname $lname' class='text-decoration-none'>Home</a></li>
											<li><a href='customer/boarding.php?Id=$custid&User=$fname $lname' class='text-decoration-none'>Cat Boarding</a></li>
											<li><a href='customer/products.php?Id=$custid&User=$fname $lname' class='text-decoration-none'>Products</a></li>
											<li><a href='customer/history.php?Id=$custid&User=$fname $lname' class='text-decoration-none'>Transaction History</a></li>
											<li><a href='customer/about.php?Id=$custid&User=$fname $lname' class='text-decoration-none'>About Us</a></li>

											<div class='mt-5'>
												<div class='row'>
													<div class='col-md-auto'>
														<a href='customer/profile.php?Id=$custid&User=$fname $lname'><i class='fas fa-user fa-lg' style='color: white;'></i></a>
													</div>

													<div class='col-2'>
														<a href='customer/cart.php?Id=$custid&User=$fname $lname'><i class='fas fa-shopping-cart fa-lg' style='color: white;'></i></a>
													</div>
												</div>
											</div>
											<div class='mt-3'>
												<div class='row'>
													<div class='col-md-auto'>
														<p>Welcome, $fname $lname</p>
														<a href='include/logout.php' class='text-decoration-none' style='color: white;'>Logout</a>
													</div>
												</div>
											</div>";
							}else {
								echo "<li><a href='./index.php' class='text-decoration-none'>Home</a></li>
											<li><a href='customer/boarding.php' class='text-decoration-none'>Cat Boarding</a></li>
											<li><a href='customer/products.php' class='text-decoration-none'>Products</a></li>
											<li><a href='customer/about.php' class='text-decoration-none'>About Us</a></li>
											<li><a href='./customer/userLogin.php' class='text-decoration-none'>Login</a></li>";
							}
						?>
					</ul>
				</nav>

				<div id="main">
					<div class="carousel slide" data-bs-ride="carousel" data-bs-interval="2000">
						<div class="carousel-inner">
							<div class="carousel-item active">
								<img class="d-block w-100" src="images/cat1.jpg">
							</div>
							<div class="carousel-item">
								<img class="d-block w-100" src="images/adik.jpg">
							</div>
							<div class="carousel-item">
								<img class="d-block w-100" src="images/celoreng.jpg">
							</div>
						</div>
					</div>

					<br>

					<div class="inner">
						<!-- About Us -->
						<header id="inner">
							<p class="text-center fs-4 fw-bold text-uppercase mt-5">Rumah Kucing: Cat hotel with best boarding & Grooming services</p>
						</header><br><br>

						<div class="text-center">
							<img src="images/rumah kucing2.jpg">
						</div>

						<div class="container mt-5">
							<p class="text-center">
								Find your perfect and safe place to leave your puffy friends!
								Still find a place to leave your cat during your hectic week?
								This is the right place for you! Home for cats.
							</p>
						</div>

						<br><br><br><br><br><br><br><br>

						<div class="container">
							<div class="row align-items-center">
								<div class="col col-md-5" style="text-align: justify;">
									<p>Rumah Kucing</p>
									<h2>Boarding</h2>
									<p class="mt-5">
									Some of the rooms are equipped with closed-circuit television cameras (CCTVs) so that cat owners can watch and check on their beloved felines from their smartphones. Because we know 40% of our customers are frequent travelers.
									They always don’t want to miss out on any ca-tastics moments of their cats.
									</p>
									<p>
										Bedrooms with connecting doors are available too. Whether you need long or short term boarding to accommodate a business trip, vacation or move, our professional staff will take loving care of your pets—
										there’s simply no better way to take care of your cat while you are away! We provide close personal attention to your cat to keep them happy and healthy. We monitor each cat multiple times each day.
									</p>
								</div>
								<div class="col-md-6 ms-auto">
									<img src="images/room2.jpg" width="550px" height="400px"/>
								</div>
							</div>
						</div>

						<br><br><br><br><br><br><br><br>

						<div class="container">
							<div class="row align-items-center">
								<div class="col col-md-5">
									<img src="images/catgroom.jpg" width="550px" height="800px"/>
								</div>
								<div class="col-md-5 ms-auto" style="text-align: justify;">
									<p>Rumah Kucing</p>
									<h2>Grooming</h2>
									<p class="mt-5">
										Help your feline friends stay happy and healthy with one of
										our grooming packages that includes premium shampoo & conditioner
										specially formulated for all skin & fur types.
									</p>
									<p>
										The products we use are commonly used for cat grooming.
										As cat lovers, we strictly understand that our feline friends need some
										good pampering too!
									</p>
									<p>
										Here at Rumah Kucing, we provide the best pampering service for our
										feline friends done by our professionally trained groomers. Our premium
										grooming includes feline manicure and spa too!
									</p>
								</div>
							</div>
						</div>

						<br><br><br><br><br><br><br><br><hr>

						<h3 class="text-center mt-5">CAT FOODS</h3>
						<section class="products">
							<div class="container mt-5">
								<div class="row">
									<div class="col-lg-4 text-center mt-3">
										<div class="card border-0 bg-light mb-2">
											<div class="card-body">
												<img src="images/products/rc_fit_32.png" class="img-fluid">
											</div>
										</div>
										<h6>Royal Canin Fit 32</h6>
									</div>

									<div class="col-lg-4 text-center mt-3">
										<div class="card border-0 bg-light mb-2">
											<div class="card-body">
												<img src="images/products/rc_kitten.png" class="img-fluid">
											</div>
										</div>
										<h6>Royal Canin Kitten</h6>
									</div>

									<div class="col-lg-4 text-center mt-3">
										<div class="card border-0 bg-light mb-2">
											<div class="card-body">
												<img src="images/products/rc_hairball.png" class="img-fluid">
											</div>
										</div>
										<h6>Royal Canin Hairball</h6>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-6 text-center m-auto mt-5">
									<a href="customer/products.php"><button class="btn1">See more</button></a>
								</div>
							</div>
					  </section>

						<br><br><br><br><hr>

						<h3 class="text-center mt-5">our videos</h3>
						<div class="row">
							<div class="row__inner text-center">
								<div class="tile">
									<div class="tile__media">
										<video width="250" height="240" loop autoplay muted>
											<source src="videos/video1.mp4" type="video/mp4">
										</video>
									</div>
								</div>

								<div class="tile">
									<div class="tile__media">
										<video width="250" height="240" loop autoplay muted>
											<source src="videos/video2.mp4" type="video/mp4">
										</video>
									</div>
								</div>

								<div class="tile">
									<div class="tile__media">
										<video width="250" height="240" loop autoplay muted>
											<source src="videos/video3.mp4" type="video/mp4">
										</video>
									</div>
								</div>

								<div class="tile">
									<div class="tile__media">
										<video width="250" height="240" loop autoplay muted>
											<source src="videos/video4.mp4" type="video/mp4">
										</video>
									</div>
								</div>
							</div>
						</div>

						<hr>

						<h3 class="text-center mt-5">WHAT OTHERS SAY ABOUT US</h3>

						<div class="container mt-5">
						  <div class="row">
						    <div class="col-lg-4 text-center mt-3">
									<p>
										<i class="fas fa-quote-left"></i>
										As a cat lover who owns a cat, I recommend Rumah Kucing as a 5 star place for my cat.
										The grooming packages are absolutely great! My cat's fur now is much more healthy and beauty
										after grooming.
										<i class="fas fa-quote-right"></i>
									</p>
									😻😻😻😻😻
						    </div>
								<div class="col-lg-4 text-center mt-3">
									<p>
										<i class="fas fa-quote-left"></i>
										Send Oyen for grooming. He enjoyed the session and seems calmer and approachable compare
										to before 🥰. The place is well kept and adhere to COVID-19 SOP. Love it so much! Really recommended!
										<i class="fas fa-quote-right"></i>
									</p>
									⭐⭐⭐⭐⭐
						    </div>
								<div class="col-lg-4 text-center mt-3">
									<p>
										<i class="fas fa-quote-left"></i>
										The only cat hotel that I trust. Sent my cats to Rumah Kucing Melaka for boarding. The staffs
										were very friendly and they really took good care of the cats. Furthermore, the place is nice
										and clean. Kudos to Rumah Kucing team. You guys are the best!! 🔥🔥🔥
										<i class="fas fa-quote-right"></i>
									</p>
									❤️❤️❤️❤️❤️
						    </div>
						  </div>
						</div>
					</div>
				</div>
			</div>

			<!-- Footer -->
			<footer class="bg-dark text-white pt-5 pb-4">
				<div class="container">
					<div class="row">
						<div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
							<h5 class="text-uppercase mb-4 font-weight-bold text-warning text-center">Rumah Kucing</h5>
						</div>

						<p class="text-justify">
							Rumah Kucing is a cat hotel for cat lovers that prioritize maximum comfort for your furry friends that embraces the nature and modern concept.
							Rumah Kucing offers pet services which include grooming and boarding.
							We believe the cats need holidays too. They always prefer to be treated as a boss.
							It means the environment must be felt like home, always being cuddled and hugged, and most importantly they don’t want to feel lonely.
						</p>

						<div class="col-md-2 col-lg-2 col-xl-3 mx-auto mt-3">
							<h5 class="text-uppercase mb-4 font-weight-bold text-warning">Customer Care</h5>
							<p class="text-white" style="text-decoration: none;">Term & Conditions</p>
							<p class="text-white" style="text-decoration: none;">Frequently Asked Question (FAQ)</p>
							<p class="text-white" style="text-decoration: none;">Help</p>
						</div>

						<div class="col-md-3 col-lg-2 col-xl-2 mx-5 mt-3">
	            <h5 class="text-uppercase mb-4 font-weight-bold text-warning">Links</h5>
	            <p><a href="customer/about.php" class="text-white text-decoration-none">About us</a></p>
	            <p><a href="customer/boarding.php" class="text-white text-decoration-none">Cat boarding</a></p>
							<p><a href="customer/products.php" class="text-white text-decoration-none">Products</a></p>
	          </div>

	          <div class="col-md-4 col-lg-3 col-xl-3 mx-5 mt-3">
	            <h5 class="text-uppercase mb-4 font-weight-bold text-warning">Contact Us</h5>
	            <p><i class="fas fa-map-pin mr-3"></i>  19, Jalan Komersial TAKH 2, Taman Ayer Keroh Heights, 75450 Ayer Keroh, Melaka</p>
	            <p><i class="fas fa-envelope mr-3"></i>  myrumahkucing@gmail.com</p>
	            <p><i class="fas fa-phone mr-3"></i>  011-21932912</p>
	            <p><i class="fas fa-clock mr-3"></i>  TUESDAY - SUNDAY &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 10:00AM - 8:00PM</p>
	          </div>
					</div>

					<hr class="mb-4">

					<div class="row align-items-center">
						<div class="col-md-7 col-lg-8">
							<p>©2021
								<a style="text-decoration: none;">
									<strong class="text-warning">Rumah Kucing</strong>
								</a>
							</p>
						</div>

						<div class="col-md-5 col-lg-4">
							<div class="text-center text-md-right">
								<ul class="list-unstyled list-inline">
									<li class="list-inline-item">
										<a href="https://www.facebook.com/RumahKucing20/" class="btn-floating btn-sm" style="font-size: 23px; color: #3b5998;">
											<i class="fab fa-facebook-f fa-lg"></i>
										</a>
									</li>
									<li class="list-inline-item">
										<a class="btn-floating btn-sm" style="font-size: 23px; color: #55acee;">
											<i class="fab fa-twitter fa-lg"></i>
										</a>
									</li>
									<li class="list-inline-item">
										<a href="https://www.instagram.com/rumah_kucing20/" class="btn-floating btn-sm" style="font-size: 23px; color: #ac2bac;">
											<i class="fab fa-instagram fa-lg"></i>
										</a>
									</li>
									<li class="list-inline-item">
										<a class="btn-floating btn-sm" style="font-size: 23px; color: #dd4b39;">
											<i class="fab fa-youtube fa-lg"></i>
										</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</footer>

		<!-- Scripts -->
		<script src="assets/js/jquery.min.js"></script>
		<script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
		<script src="assets/js/jquery.scrolly.min.js"></script>
		<script src="assets/js/jquery.scrollex.min.js"></script>
		<script src="assets/js/main.js"></script>

	</body>
</html>
