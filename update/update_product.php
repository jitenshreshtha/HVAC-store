<?php
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productID = mysqli_real_escape_string($con, $_POST['productID']);
    $productName = mysqli_real_escape_string($con, $_POST['productName']);
    $category = mysqli_real_escape_string($con, $_POST['category']);
    $price = mysqli_real_escape_string($con, $_POST['price']);

    $sql = "UPDATE products SET 
            product_name = '$productName', 
            product_category = '$category', 
            price = '$price' 
            WHERE product_id = '$productID'";

    if (mysqli_query($con, $sql)) {
        echo "Product updated successfully!";
    } else {
        echo "Error updating product: " . mysqli_error($con);
    }
}

mysqli_close($con);
?>
