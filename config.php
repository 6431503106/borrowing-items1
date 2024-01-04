<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "borrowing_items";

// Create connection
$conn = mysqli_connect('localhost', 'root', '', 'borrowing_items');

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>