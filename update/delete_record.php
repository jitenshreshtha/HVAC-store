<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

$con = mysqli_connect('localhost:3306', 'root', '', 'Schemashapers_HimalayaStore');

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

$type = mysqli_real_escape_string($con, $_POST['type']);
$id = mysqli_real_escape_string($con, $_POST['id']);

$table = '';
$id_column = '';

switch ($type) {
    case 'customer':
        $table = 'customers';
        $id_column = 'customer_id';
        break;
    case 'technician':
        $table = 'technicians';
        $id_column = 'technician_id';
        break;
    case 'product':
        $table = 'products';
        $id_column = 'product_id';
        break;
    case 'vendor':
        $table = 'vendors';
        $id_column = 'vendor_id';
        break;
    default:
        echo "Invalid type";
        exit;
}

$sql = "DELETE FROM $table WHERE $id_column = '$id'";

if (mysqli_query($con, $sql)) {
    echo ucfirst($type) . " deleted successfully.";
} else {
    echo "Error deleting " . $type . ": " . mysqli_error($con);
}

mysqli_close($con);
?>