<?php

// $host = 'fourpaws.mysql.database.azure.com';
// $username = 'group15@fourpaws';
// $password = 'Cathotelg15';
// $db_name = 'cathoteldb';
//
// //Establishes the connection
// $conn = mysqli_init();
// mysqli_real_connect($conn, $host, $username, $password, $db_name, 3306);
//
// if (mysqli_connect_errno($conn)) {
// 	die('Failed to connect to MySQL: '.mysqli_connect_error());
// }

// $host = 'localhost';
// $username = 'root';
// $password = '';
// $db_name = 'rumah_kucing';
//
// //Establishes the connection
// $conn = mysqli_init();
// mysqli_real_connect($conn, $host, $username, $password, $db_name, 3306);
//
// if (mysqli_connect_errno($conn)) {
// 	die('Failed to connect to MySQL: '.mysqli_connect_error());
// }

$host = 'z5zm8hebixwywy9d.cbetxkdyhwsb.us-east-1.rds.amazonaws.com';
$username = 'h14ty5dq8nv37o2a';
$password = 'q9o6ipjho97x5drh';
$db_name = 'rr4ns5h0shlq0pm5';

//Establishes the connection
$conn = mysqli_init();
mysqli_real_connect($conn, $host, $username, $password, $db_name, 3306);

if (mysqli_connect_errno()) {
	die('Failed to connect to MySQL: '.mysqli_connect_error());
}
?>
