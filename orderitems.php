<?php
if(isset($_POST['orderItemID']))
{
$con = mysqli_connect('localhost:3306', 'root', '','Schemashapers_HimalayaStore');

$orderItemID = $_POST['orderItemID'];
$orderID = $_POST['orderID'];
$productID = $_POST['productID'];
$quantity = $_POST['quantity'];
$subtotal = $_POST['subtotal'];


$sql = "INSERT INTO `order_items` (`order_item_id`, `order_id`, `product_id`, `quantity`, `items_price`) VALUES ('$orderItemID', '$orderID', '$productID', '$quantity', `$subtotal`)";

$rs = mysqli_query($con, $sql);
if($rs)
{
	echo "Added orderitem $orderItemID in oder $orderID ";
}
}
else
{
	echo "Unable to insert Records";
	
}
?>