<?php
$host = 'localhost';
$db = 'jedinstvo';
$user = 'root'; // promeni po potrebi
$pass = '';     // promeni po potrebi

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
