<?php
//session_start();
$host="localhost:3306";
$username="root";
$pass="";
$db="shreshtha48";
 
$conn=mysqli_connect($host,$username,$pass,$db);
if(!$conn){
	die("Database connection error");
}
 
?>