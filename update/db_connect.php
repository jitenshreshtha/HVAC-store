<?php
$con = mysqli_connect('localhost:3306', 'root', '', 'Schemashapers_HimalayaStore');

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
?>