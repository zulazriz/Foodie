<?php

session_start();
include "../connection.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  $id = $_POST['category'];

  $sql = "SELECT product.Prod_ID, product.Prod_Name, product.Prod_Price, product.Prod_Images,
                 product.Prod_Status, product.Category_ID, categories.Category_ID, categories.Category_Name
          FROM product INNER JOIN categories
          ON product.Category_ID = categories.Category_ID
          WHERE product.Prod_Status = 'Available'
          AND categories.Category_Name = '$id'
          ORDER BY product.Prod_ID DESC
          LIMIT 9";
  $run_query = mysqli_query($conn, $sql);

     $output = '<div class="row">
                 <h4>'.$id.'</h4>';

     while ($row = mysqli_fetch_assoc($run_query)) {

        $output .= '<div class="col-lg-4 text-center mt-3">
                          <div class="card border-0 bg-light mb-2">
                              <div class="card-body">';

                              $output .= '
                                  <img src="'.$row['Prod_Images'].'" class="img-fluid" style="height: 200px;">';

                                  $output .= '
                              </div>
                          </div>';

                         $output .= '
                          <form action="../include/cart.php?id='.$row['Prod_ID'].'" method="POST">';
                          $output .= '
                              <div class="title">
                                  <p>'.$row['Prod_Name'].'</p>
                              </div>';

                              $output .= '
                              <p>RM '.$row['Prod_Price'].'</p>';

                          if (isset($_SESSION["LoginUser"])) {
                          $output .= '<div class="row">
                                        <div class="col quantity buttons_added">';
                              $output .= '<input type="button" value="-" class="minus"><input type="number" step="1" min="1" max="" name="quantityproduct" value="0" title="Qty" class="input-text qty text" size="4" pattern="" inputmode=""><input type="button" value="+" class="plus">';
                            $output .= '</div>
                                        <div class="col">';
                              $output .= '<button type="submit" class="btn1" name="submitproduct"><i class="fas fa-shopping-cart"></i> Add to cart</button>';
                            $output .= '</div>
                                      </div>';
                          }else {
                            $output .= ' ';
                          }
                          $output .= '</form>
                                   </div>';
     }

     $output .= '</div>';

     echo $output;

}
?>
