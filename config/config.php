<?php

$DB_HOST = 'localhost'; 
$DB_USERNAME = 'root';
$DB_PASSWORD = '';
$DB_DATABASE = '20221212_projectakhir';

$conn = mysqli_connect($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    echo "<script>console.log('Connection Success')</script>";
}
?>