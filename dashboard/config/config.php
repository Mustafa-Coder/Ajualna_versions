<?php 

$dbservername = 'localhost';
$dbname = 'ajualna';
$user = 'root';
$pass = '';

try {

$con = new PDO("mysql:host=$dbservername;dbname=$dbname;charset=utf8mb4",$user,$pass);
$con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
// echo 'Good';

} catch (PDOException $e) {

	echo "Connection failed: " . $e->getMessage();
	
}