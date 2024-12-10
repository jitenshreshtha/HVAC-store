<?php
if(isset($_POST['productID']))
{
$con = mysqli_connect('localhost:3306', 'root', '','Schemashapers_HimalayaStore');

$productID = $_POST['productID'];
$productName = $_POST['productName'];
$category = $_POST['category'];
$price = $_POST['price'];

$sql = "INSERT INTO `products` (`product_id`, `product_name`, `product_category`, `price`) VALUES ('$productID', '$productName', '$category', '$price')";

$rs = mysqli_query($con, $sql);
if($rs)
{
	echo "Added product $productName";
}
}
else
{
	echo "Unable to insert Records";
	
}
?>