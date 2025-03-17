<?php
$servername = "localhost";
$username = "root"; // Change if using another username
$password = ""; // Change if your database has a password
$database = "house_registration_system";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
