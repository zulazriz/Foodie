<?php

session_start();
include '../connection.php';

if (isset($_POST['bookslot'])) {

  $custid = $_SESSION['Cust_ID'];
  $quantityofcats = $_POST['quantityofcats'];
  $Check_in = $_POST['checkin'];
  $Check_out = $_POST['checkout'];
  $groom_id = $_POST['groom'];
  $remarks = $_POST['remarks'];
  $Booking_Status = 'Pending';
  $roomslot = $_POST['roomslot'];

  if (isset($_POST['checkin']) || isset($_POST['checkout'])) {
    $Check_in = $_POST['checkin'];
    $Check_out = $_POST['checkout'];

    $checkin = strtotime($Check_in);
    $checkout = strtotime($Check_out);

    $today = date("Y-m-d");
    $todayString = strtotime($today);

    if($checkin <= $todayString || $checkin > $checkout) {
      echo '<script type="text/javascript">alert("Invalid Date.");location="../customer/boarding.php";</script>';
    }else {
      $query1 = "SELECT * FROM booking WHERE Cust_ID = '$custid'";
      $result = mysqli_query($conn, $query1);
      $totalbooking = mysqli_num_rows($result);

      if($totalbooking != 0) {
        $result1 = mysqli_query($conn, "SELECT Check_in, Check_out FROM booking WHERE Cust_ID = '$custid'");
        while($row = mysqli_fetch_array($result1)) {
          $databaseCheckIn = strtotime($row['Check_in']);
          $databaseCheckOut = strtotime($row['Check_out']);

          $query2 = "SELECT * FROM booking
                    WHERE Cust_ID = '$custid'
                    AND (($databaseCheckIn <= $checkin AND $databaseCheckOut >= $checkin)
                    OR ($databaseCheckIn <= $checkout AND $databaseCheckOut >= $checkout)
                    OR (($databaseCheckIn < $checkout AND $databaseCheckOut < $checkout)
                    AND ($databaseCheckIn > $checkin AND $databaseCheckOut > $checkin)))";

          $result2 = mysqli_query($conn, $query2);
          $totalbook = mysqli_num_rows($result2);

          if($totalbook != 0) {
            echo '<script type="text/javascript">alert("You already booked slot at this date. Please select another date.");location="../customer/boarding.php";</script>';
            die();
          }else {
            $query3 = "SELECT * FROM room WHERE Room_ID = 1 AND Room_Slot = 0";
            $result3 = mysqli_query($conn, $query3);
            $totalroom = mysqli_num_rows($result3);

            if ($totalroom != 0 ) {
              echo '<script type="text/javascript">alert("Room slot is full with meow!");location="../customer/boarding.php";</script>';
              die();
            }else {
              $query4 = "INSERT INTO booking (Cust_ID, Room_ID, QuantityofCats, Booking_Date, Booking_Status, Check_in, Check_out, Remarks, Serv_ID, QuantityofBooking) VALUES ('$custid', '$roomslot', '$quantityofcats', NOW(), '$Booking_Status', '$Check_in', '$Check_out', '$remarks', '$groom_id', 1)";
              $result4 = mysqli_query($conn, $query4);

              if ($result4) {
                $query5 = "SELECT booking_id FROM booking WHERE Cust_ID = '$custid' and check_in = '$Check_in'";
                $result5 = mysqli_query($conn, $query5);
                $row1= mysqli_fetch_array($result5);
                $id = $row1['booking_id'];
                $result = mysqli_query($conn, "CALL procedure_duration('$id')");

                if ($result) {
                  $query6 = "UPDATE room SET Room_Slot = (Room_Slot - $quantityofcats) WHERE room_ID = '$roomslot'";
                  $result6 = mysqli_query($conn, $query6);

                  if ($result6) {
                    echo '<script type="text/javascript">alert("Successfully make your booking!");location="../customer/boarding.php";</script>';
                  }else {
                    echo '<script type="text/javascript">alert("Something went wrong!");location="../customer/boarding.php";</script>';
                  }
                }
              }else {
                echo '<script type="text/javascript">alert("Please fill in the booking form!");location="../customer/boarding.php";</script>';
              }
            }
          }
        }
      }
    }
  }
}

?>
