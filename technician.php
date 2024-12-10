<?php
if(isset($_POST['techID']))
{
$con = mysqli_connect('localhost:3306', 'root', '','Schemashapers_HimalayaStore');

$techID = $_POST['techID'];
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$specialisation = $_POST['specialisation'];
$phone = $_POST['phone'];

$sql = "INSERT INTO `technicians` (`technician_id`, `first_name`, `last_name`, `specialization`, `technician_phone`) VALUES ('$techID', '$firstName', '$lastName', '$specialisation', '$phone')";

$rs = mysqli_query($con, $sql);
if($rs)
{
	echo "Added Technician $firstName $lastName";
}
}
else
{
	echo "Unable to insert Records";
	
}
?>