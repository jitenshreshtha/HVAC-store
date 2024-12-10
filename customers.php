<?php
if(isset($_POST['customerID']))
{
$con = mysqli_connect('localhost:3306', 'root', '','Schemashapers_HimalayaStore');

$customerID = $_POST['customerID'];
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$address = $_POST['address'];

$sql = "INSERT INTO `customers` (`customer_id`, `first_name`, `last_name`, `customer_email`, `customer_phone`, `address`) VALUES ('$customerID', '$firstName', '$lastName', '$email', '$phone', '$address')";

$rs = mysqli_query($con, $sql);
if($rs)
{
	echo "Added Customer $firstName $lastName";
}
}
else
{
	echo "Unable to insert Records";
	
}
?>