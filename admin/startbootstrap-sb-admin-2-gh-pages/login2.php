<?php
session_start();
$host = 'localhost';
$db = 'jedinstvo';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Konekcija neuspešna: " . $conn->connect_error);
}

// Preuzmi podatke iz forme
$email = $_POST['email'];
$password = $_POST['password'];

// Pronađi korisnika po emailu
$sql = "SELECT * FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();

    if (password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['first_name'];
        header("Location: welcome.php");
        exit();
    } else {
        echo "Pogrešna lozinka!";
    }
} else {
    echo "K
