<?php
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $techID = mysqli_real_escape_string($con, $_POST['techID']);
    $firstName = mysqli_real_escape_string($con, $_POST['firstName']);
    $lastName = mysqli_real_escape_string($con, $_POST['lastName']);
    $specialisation = mysqli_real_escape_string($con, $_POST['specialisation']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);

    $sql = "UPDATE technicians SET 
            first_name = '$firstName', 
            last_name = '$lastName', 
            specialization = '$specialisation', 
            technician_phone = '$phone' 
            WHERE technician_id = '$techID'";

    if (mysqli_query($con, $sql)) {
        echo "Technician updated successfully!";
    } else {
        echo "Error updating technician: " . mysqli_error($con);
    }
}

mysqli_close($con);
?>
