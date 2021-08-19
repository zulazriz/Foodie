<?php

session_start();
include '../connection.php';

if (isset($_POST['updatebooking'])) {

    $custid = $_SESSION['Cust_ID'];
    $quantityofcats = $_POST['quantityofcats'];
    $Check_in = $_POST['checkin'];
    $Check_out = $_POST['checkout'];
    $groom = $_POST['groom'];
    $remarks = $_POST['remarks'];
    $Booking_Status = 'Pending';
    $bookingid = $_POST['bookingid'];
    $roomslot = $_POST['roomslot'];
    $Check_in = $_POST['checkin'];
    $Check_out = $_POST['checkout'];

    $checkin = strtotime($Check_in);
    $checkout = strtotime($Check_out);

    $today = date("Y-m-d");
    $todayString = strtotime($today);

    $balanceroom = '';
    $quan2 = '';
    $databaseCheckIn = '';
    $databaseCheckOut = '';

    $test = "SELECT booking.Booking_ID, booking.QuantityofCats, room.Room_Slot
           FROM booking JOIN room ON booking.Room_ID = room.Room_ID
           WHERE booking.Booking_ID = $bookingid";
    $resulttest = mysqli_query($conn, $test);

    while ($row = mysqli_fetch_array($resulttest)) {
        $balanceroom = $row['Room_Slot'];
        $quan2 = $row['QuantityofCats'];
    }

    if($checkin <= $todayString || $checkin > $checkout)
    {
        echo '<script type="text/javascript">alert("Invalid Date.");location="../customer/cart.php";</script>';
    }
    else
    {
        $query1 = "SELECT * FROM booking WHERE Cust_ID = '$custid'";
        $result = mysqli_query($conn, $query1);
        $totalbooking = mysqli_num_rows($result);

        if($totalbooking !== 0)
        {
            $result1 = mysqli_query($conn, "SELECT Check_in, Check_out FROM booking WHERE Cust_ID = '$custid'");

            while($row = mysqli_fetch_array($result1))
            {
                $databaseCheckIn = strtotime($row['Check_in']);
                $databaseCheckOut = strtotime($row['Check_out']);
            }

            //check new data and current date
            if($databaseCheckIn != $checkin && $databaseCheckOut != $Check_out){
                $query2 = "SELECT * FROM booking
                  WHERE Cust_ID = '$custid'
                  AND (($databaseCheckIn <= $checkin AND $databaseCheckOut >= $checkin)
                  OR ($databaseCheckIn <= $checkout AND $databaseCheckOut >= $checkout)
                  OR (($databaseCheckIn < $checkout AND $databaseCheckOut < $checkout)
                  AND ($databaseCheckIn > $checkin AND $databaseCheckOut > $checkin)))";

                $result2 = mysqli_query($conn, $query2);
                $totalbook = mysqli_num_rows($result2);

                if($totalbook !== 0)
                {
                    echo '<script type="text/javascript">alert("You already booked slot at this date. Please select another date.");location="../customer/cart.php";</script>';
                    die();
                }
                else
                {
                    $query3 = "SELECT Room_Slot FROM room WHERE Room_ID = 1";
                    $result3 = mysqli_query($conn, $query3);
                    $totalroom = mysqli_num_rows($result3);

                    if ($totalroom == 0 )
                    {
                        echo '<script type="text/javascript">alert("Room slot is full with meow!");location="../customer/cart.php";</script>';
                        die();

                    }
                    else
                    {
                        $query4 = "UPDATE booking
                                 SET Cust_ID = '$custid', Room_ID = '$roomslot', QuantityofCats = '$quantityofcats', Booking_Date = NOW(), Booking_Status = '$Booking_Status', Check_in = '$Check_in', Check_out = '$Check_out', Remarks = '$remarks', Serv_ID = '$groom'
                                 WHERE Booking_ID = $bookingid AND Cust_ID = $custid";
                        $result4 = mysqli_query($conn, $query4);

                        if ($result4)
                        {
                            $query5 = "SELECT booking_id FROM booking WHERE Cust_ID = '$custid' and check_in = '$Check_in'";
                            $result5 = mysqli_query($conn, $query5);
                            $row1= mysqli_fetch_array($result5);
                            $id = $row1['booking_id'];

                            $result = mysqli_query($conn, "CALL procedure_duration('$id')");

                            if ($result)
                            {
                                $query6 = " UPDATE room SET Room_Slot = ($balanceroom + $quan2 - $quantityofcats) WHERE room_ID = '$roomslot'";
                                $result6 = mysqli_query($conn, $query6);

                                if ($result6)
                                {
                                    echo '<script type="text/javascript">alert("Successfully update your booking!");location="../customer/cart.php";</script>';
                                }
                                else
                                {
                                    echo '<script type="text/javascript">alert("Something went wrong!");location="../customer/cart.php";</script>';
                                }
                            }
                        }
                        else
                        {
                            echo '<script type="text/javascript">alert("Please fill in the booking form!");location="../customer/cart.php";</script>';
                        }
                    }
                }
            } //start sini tak compare tarikh
            else{
                $query3 = "SELECT Room_Slot FROM room WHERE Room_ID = 1";
                $result3 = mysqli_query($conn, $query3);
                $totalroom = mysqli_num_rows($result3);

                if ($totalroom == 0 )
                {
                    echo '<script type="text/javascript">alert("Room slot is full with meow!");location="../customer/cart.php";</script>';
                    die();

                }
                else
                {
                    $query4 = "UPDATE booking
                               SET Cust_ID = '$custid', Room_ID = '$roomslot', QuantityofCats = '$quantityofcats', Booking_Date = NOW(), Booking_Status = '$Booking_Status', Check_in = '$Check_in', Check_out = '$Check_out', Remarks = '$remarks', Serv_ID = '$groom'
                               WHERE Booking_ID = $bookingid AND Cust_ID = $custid";
                    $result4 = mysqli_query($conn, $query4);

                    if ($result4)
                    {
                        $query5 = "SELECT booking_id FROM booking WHERE Cust_ID = '$custid' and check_in = '$Check_in'";
                        $result5 = mysqli_query($conn, $query5);
                        $row1= mysqli_fetch_array($result5);
                        $id = $row1['booking_id'];

                        $result = mysqli_query($conn, "CALL procedure_duration('$id')");

                        if ($result)
                        {
                            $query6 = " UPDATE room SET Room_Slot = ($balanceroom + $quan2 - $quantityofcats) WHERE room_ID = '$roomslot'";
                            $result6 = mysqli_query($conn, $query6);

                            if ($result6)
                            {
                                echo '<script type="text/javascript">alert("Successfully update your booking!");location="../customer/cart.php";</script>';
                            }
                            else
                            {
                                echo '<script type="text/javascript">alert("Something went wrong!");location="../customer/cart.php";</script>';
                            }
                        }
                    }
                    else
                    {
                        echo '<script type="text/javascript">alert("Please fill in the booking form!");location="../customer/cart.php";</script>';
                    }
                }
            }
        }
    }
}

?>
