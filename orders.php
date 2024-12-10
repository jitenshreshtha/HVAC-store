<?php
if(isset($_POST['orderID']))
{
$con = mysqli_connect('localhost:3306', 'root', '','Schemashapers_HimalayaStore');

$orderID = $_POST['orderID'];
$customerID = $_POST['customerID'];
$techID = $_POST['techID'];
$orderDate = $_POST['orderDate'];
$totalAmount = $_POST['totalAmount'];
$status = $_POST['status'];

$sql = "INSERT INTO `orders` (`order_id`, `customer_id`, `technician_id`, `order_total`, `order_date`, `status`) VALUES ('$orderID', '$customerID', '$techID', '$totalAMount', `$orderDate`, `$status`)";

$rs = mysqli_query($con, $sql);
if($rs)
{
	echo "Added order $orderID";
}
}
else
{
	echo "Unable to insert Records";
	
}
?>