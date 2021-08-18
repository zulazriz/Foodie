<?php

include '../customer/header.php';

?>

<link rel="stylesheet" href="../assets/css/productstyle.css">

<div class="main">
  <div class="inner">
    <h1 class="text-center mt-5" style="color: black;">OUR PRODUCTS</h1>
  </div>

  <div class="container">
    <hr>
  </div>

  <div class="container-fluid mt-5">
    <div class="row mt-5">
      <div class="col-3">
        <div class="search">
          <form method="POST" class="form-inline">
            <div class="search-wrapper">
              <span class="fas fa-search" type="button" id="btn-search"></span>
              <input type="text" class="form-control" id="search" placeholder="Search here">
            </div>
            <div class="list-group list-group-item-action" id="content">

            </div>
          </form>
        </div>
        <div class="card bg-light mb-3">
            <div class="card-header bg-primary text-white text-uppercase"><i class="fa fa-list"></i> Categories</div>
            <ul class="list-group category_block">
              <li class="list-group-item"><a onclick="resetSearch()">All</a></li>
              <?php

              $category_query = "SELECT * FROM categories";
            	$run_query = mysqli_query($conn, $category_query);

            	if(mysqli_num_rows($run_query) > 0){
            		while($row = mysqli_fetch_array($run_query)){
            			$catid = $row["Category_ID"];
            			$catname = $row["Category_Name"];

                  echo "<li class='list-group-item' id='get_category' value='$catid'><a class='click_cat' data-id='$catname'>$catname</a></li>";
            		}
            	}

              ?>
            </ul>
        </div>
      </div>
      <div class="col">
        <div class="row">
          <section class="products">
            <div class="container">
              <div class="row">
                <div class="col" id="searchResult"></div>
              </div>
              <div class="row" id="allProduct">
                <h4>New products</h4>
                <?php
                $prodquery = "SELECT * FROM product WHERE Prod_Status = 'Available' ORDER BY Prod_ID DESC LIMIT 9";
                $prodresult = mysqli_query($conn, $prodquery);

                while ($row = mysqli_fetch_array($prodresult)) {
                ?>

                <div class="col-lg-4 text-center mt-3 p-4">
                  <div class="card border-0 bg-light mb-2">
                    <div class="card-body">
                      <img src="<?php echo $row['Prod_Images']; ?>" class="img-fluid" style="height: 200px;">
                    </div>
                  </div>
                  <form action="../include/cart.php?id=<?php echo $row['Prod_ID']; ?>" method="POST">
                    <div class="title">
                      <p><?php echo $row['Prod_Name']; ?></p>
                    </div>
                    <p>RM <?php echo $row['Prod_Price']; ?></p>

                    <?php
                    if (isset($_SESSION["LoginUser"])) {
                      echo '<div class="row">
                                <div class="col-5 quantity buttons_added">
                                  <input type="button" value="-" class="minus"><input type="number" step="1" min="1" max="99" name="quantityproduct" value="0" title="Qty" class="input-text qty text" size="4" pattern="" inputmode=""><input type="button" value="+" class="plus">
                                </div>
                                <div class="col">
                                  <button type="submit" class="btn1" name="submitproduct"><i class="fas fa-shopping-cart"></i> Add to cart</button>
                                </div>
                            </div>';
                    }else {

                    }
                    ?>
                  </form>
                </div>
                <?php
                }
                ?>
              </div>
            </div>
          </section>
        </div>

        <div class="col-12 mt-5" id="pagination_number">
          <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
              <li class="page-item disabled">
                <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
              </li>
              <li class="page-item"><a class="page-link" href="#">1</a></li>
              <li class="page-item"><a class="page-link" href="#">2</a></li>
              <li class="page-item"><a class="page-link" href="#">3</a></li>
              <li class="page-item">
                <a class="page-link" href="#">Next</a>
              </li>
            </ul>
          </nav>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  document.getElementById("searchResult").style.display = "none";

  function resetSearch(){
    // document.getElementById("searchResult").style.display = "none";
    // document.getElementById("allProduct").style.display = "block";
    location.reload();
  }
</script>

<?php

include '../customer/footer.php';

?>
