<?php
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $vendorID = mysqli_real_escape_string($con, $_POST['vendorID']);
    $vendorName = mysqli_real_escape_string($con, $_POST['vendorName']);
    $vendorPhone = mysqli_real_escape_string($con, $_POST['vendorPhone']);
    $vendorEmail = mysqli_real_escape_string($con, $_POST['vendorEmail']);
    $vendorAddress = mysqli_real_escape_string($con, $_POST['vendorAddress']);

    $sql = "UPDATE vendors SET 
            vendor_name = '$vendorName', 
            vendor_phone = '$vendorPhone', 
            vendor_email = '$vendorEmail', 
            vendor_address = '$vendorAddress' 
            WHERE vendor_id = '$vendorID'";

    if (mysqli_query($con, $sql)) {
        echo "Vendor updated successfully!";
    } else {
        echo "Error updating vendor: " . mysqli_error($con);
    }
}

mysqli_close($con);
?>
