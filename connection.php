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

$host = 'localhost';
$username = 'root';
$password = '';
$db_name = 'rumah_kucing';

//Establishes the connection
$conn = mysqli_init();
mysqli_real_connect($conn, $host, $username, $password, $db_name, 3306);

if (mysqli_connect_errno($conn)) {
	die('Failed to connect to MySQL: '.mysqli_connect_error());
}
?>
