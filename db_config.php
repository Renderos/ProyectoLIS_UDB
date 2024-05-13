<?php
$host = 'localhost'; 
$dbname = 'concupedu';
$user = 'root';
$password = 'root';


$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>