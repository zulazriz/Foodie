<?php

include '../customer/header.php';
include '../connection.php';

?>

				<!-- Main -->
					<div id="main">
						<div class="inner">
							<div class="image main">
								<img src="../images/coverrumahkucing.jpg" class="img-fluid">
							</div>

							<h1 class="text-center" style="color: black;">CAT BOARDING</h1>
							<hr>

							<div class="text-center text-dark">
								<strong>Our high-end rooms provide a truly best experience for your cats. 24/7 Air-Conditioned & CCTV equipped.</strong>
								<p>⭐⭐⭐⭐⭐</p>
								<p>*Please read Boarding requirement first before sending your cat for boarding</p>
							</div><br>

							<section>
								<div class="text-center mt-5">
									<h5>- PREMIUM ROOM -</h5>
									<div class="carousel slide mt-5" data-bs-ride="carousel" data-bs-interval="2000" id="carouselControls">
										<div class="carousel-inner">
											<div class="carousel-item active">
												<img class="d-block w-100" src="../images/room2.jpg">
											</div>
											<div class="carousel-item">
												<img class="d-block w-100" src="../images/room3.jpg">
											</div>
											<div class="carousel-item">
												<img class="d-block w-100" src="../images/room4.jpg">
											</div>
										</div>
										<a class="carousel-control-prev" href="#carouselControls" role="button" data-bs-slide="prev">
									    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
									    <span class="sr-only">Previous</span>
									  </a>
									  <a class="carousel-control-next" href="#carouselControls" role="button" data-bs-slide="next">
									    <span class="carousel-control-next-icon" aria-hidden="true"></span>
									    <span class="sr-only">Next</span>
									  </a>
									</div>
								</div>
							</section>

							<?php

							if (isset($_SESSION["LoginUser"])) {
								echo '<div class="text-center mt-3">
												<button type="button" class="btn btn-warning mt-4 text-dark" data-bs-toggle="modal" data-bs-target="#modalslot">Book Slot</button>
											</div>';
							}else {
								echo '<div class="text-center mt-3">
												<h7>Please <a href="../customer/userLogin.php">login</a> first to continue booking.</h7>
											</div>';
							}

							?>

							<!-- Room Slots Modal -->
							<div class="modal fade" id="modalslot" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  							<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
								  <div class="modal-content">
								    <div class="modal-header">
											<h1 class="modal-title">ROOM SLOTS</h1>
											<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								    </div>
								    <form method="POST" action="../include/booking.php">
											<input type="hidden" id="roomslot" name="roomslot" value="1">
								      <div class="modal-body">
								        <div class="mt-2 text-center">
													<h2>Premium Room</h2>
								          <h4>RM 30.00</h4>
								        </div>

												<div class="mt-5">
													<p>Boarding Requirement <a href="" data-bs-toggle="modal" data-bs-target="#boardReq" data-bs-dismiss="modal">Click Here</a></p>
													<p>For dimension guide <a href="" data-bs-toggle="modal" data-bs-target="#dimension" data-bs-dismiss="modal">Click Here</a></p>
													<strong>*If cannot select date means the room is already full</strong>
												</div>

												<hr>

												<div class="text-center mt-5">
								          <label>Room slot available:</label>

								          <?php
								              $sql1="SELECT Room_Slot FROM room WHERE Room_ID = 1";
								              $room1=mysqli_query($conn, $sql1);
								              $row = mysqli_fetch_array($room1);
								              $roomid = $row['Room_Slot'];

															if ($roomid > 0) {

								            ?>

								            <h5 class="text-center"><?php echo $roomid;?></h5>
								        </div>

												<div class="container-fluid mt-4">
													<div class="row">
														<div class="col-md-5">
															<p>HOW MANY CATS?</p>
															<select class="form-select" aria-label="Default select example" name="quantityofcats" required>
																<option selected value="1">1</option>
																<option value="2">2</option>
																<option value="3">3</option>
																<option value="4">4</option>
																<option value="5">5</option>
																<option value="6">6</option>
																<option value="7">7</option>
																<option value="8">8</option>
																<option value="9">9</option>
																<option value="10">10</option>
															</select>

															<p class="mt-3">FROM:</p>
															<input type="date" name="checkin" id="date1" onchange="cal()" required>

															<p class="mt-3">TO:</p>
															<input type="date" name="checkout" id="date2" onchange="cal()" required>
														</div>

														<div class="col-md-7 ms-auto">
															<p>WANT GROOM YOUR CATS?</p>
										          <select class="form-select" id="groom" name="groom" required>
										            <!-- <option disable selected>Choose grooming</option> -->
										            <?php
										              $sql="SELECT * FROM service";
										              $groomquery=mysqli_query($conn, $sql);
										              while($groomrow = mysqli_fetch_array($groomquery)){
										                $groomid = isset($_GET['service']) ? $_GET['service'] : 0;
										                $selected = ($groomid == $groomrow['Serv_ID']) ? " selected" : "";
										                echo "<option $selected value=".$groomrow['Serv_ID'].">".$groomrow['Serv_Name']."</option>";
										              }
										            ?>
										          </select>

															<p class="mt-3">NIGHTS</p>
															<input type="form-control" class="text-center" name="nights" id="nights" aria-label="readonly input example" readonly>

															<div class="form-group mt-3">
																<p>REMARKS:</p>
																<textarea class="form-control" name="remarks" rows="5"></textarea>
															</div>
										        </div>
													</div>
												</div>

									      <div class="modal-footer justify-content-center mt-5">
									        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
									        <button type="submit" class="btn btn-primary" name="bookslot">Book Now</button>
									      </div>
									    </form>

											<?php

										}else {
											echo "<h1 class='display-6'>Not Available</h1>";
										}

											?>
									  </div>
									</div>
								</div>
							</div>

							<!-- Boarding Requirement Modal -->
							<div class="modal fade" id="boardReq" tabindex="-1" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="boardReq">Boarding Requirement</h5>
											<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
										</div>
										<div class="modal-body text-center">
											<img src="../images/boardingreq.jpg" width="400px">
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#modalslot">Close</button>
										</div>
									</div>
								</div>
							</div>

							<!-- Dimension Guide Modal -->
							<div class="modal fade" id="dimension" tabindex="-1" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="dimension">Dimension Guide</h5>
											<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
										</div>
										<div class="modal-body">
											<h6 class="text-center"><u>PREMIUM ROOM</u></h6>
											<ul class="mt-5 float-left" style="list-style-type: dark circle;">
												<li>RM30/each cats and a room slots</li>
												<li>Add up to RM70 for additional grooming services</li>
												<li>Suitable and room can fit up to 30++ cats</li>
												<li>2x Feeding time</li>
												<li>1x Playtime at morning and evening for every days</li>
												<li>24 hour air conditioned and air ventilation</li>
												<li>Litter and pet bowl are provided</li>

												<hr>

												<p>F.O.C Royal Canin Fit 32</p>
												<p>F.O.C Pine wood litter</p>
											</ul>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#modalslot">Close</button>
										</div>
									</div>
								</div>
							</div>
						</div>

						<script type="text/javascript">
							function GetDays(){
								var date1 = new Date(document.getElementById("date1").value);
								var date2 = new Date(document.getElementById("date2").value);
								return parseInt((date2 - date1) / (60 * 60 * 1000 * 24));
							}

							function cal(){
								if(document.getElementById("date2")){
										document.getElementById("nights").value=GetDays();
								}
							}
						</script>

<?php

include '../customer/footer.php';

?>
