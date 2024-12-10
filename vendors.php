<?php
if(isset($_POST['vendorID'])) {
    $con = mysqli_connect('localhost:3306', 'root', '', 'Schemashapers_HimalayaStore');

    $vendorID = $_POST['vendorID'];
    $vendorName = $_POST['vendorName'];
    $vendorPhone = $_POST['vendorPhone'];
    $vendorEmail = $_POST['vendorEmail'];
    $vendorAddress = $_POST['vendorAddress'];

    $sql = "INSERT INTO vendors (vendor_id, vendor_name, vendor_phone, vendor_email, vendor_address) VALUES ('$vendorID', '$vendorName', '$vendorPhone', '$vendorEmail', '$vendorAddress')";

    $rs = mysqli_query($con, $sql);
    if($rs) {
        echo "Added vendor $vendorName";
    } else {
        echo "Unable to insert records";
    }
} else {
    echo "No data received";
}
?>