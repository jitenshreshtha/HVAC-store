<?php
include 'db_connect.php';

// Check if form data is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and validate inputs
    $customerID = mysqli_real_escape_string($con, $_POST['customerID']);
    $firstName = mysqli_real_escape_string($con, $_POST['firstName']);
    $lastName = mysqli_real_escape_string($con, $_POST['lastName']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $address = mysqli_real_escape_string($con, $_POST['address']);

    // Update query
    $sql = "UPDATE customers SET 
            first_name = '$firstName', 
            last_name = '$lastName', 
            customer_email = '$email', 
            customer_phone = '$phone', 
            address = '$address' 
            WHERE customer_id = '$customerID'";

    if (mysqli_query($con, $sql)) {
        echo "Customer updated successfully!";
    } else {
        echo "Error updating customer: " . mysqli_error($con);
    }
}

// Close the connection
mysqli_close($con);
?>