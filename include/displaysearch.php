<?php

session_start();
require_once '../connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $query = $_POST['query'];
  $sql = "SELECT * FROM product WHERE Prod_Name LIKE '%".$query."%' LIMIT 6";
  $result = mysqli_query($conn, $sql);

  $output = '<div class="row">
              <h4>Search result</h4>';

  while ($row = mysqli_fetch_assoc($result)) {

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
