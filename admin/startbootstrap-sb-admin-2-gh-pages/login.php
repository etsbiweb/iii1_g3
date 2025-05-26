<?php
// Pokreni sesiju
session_start();

// Proveri da li je forma poslata
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Primi podatke iz forme
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // Ovo je primer sa hardkodiranim korisničkim podacima
    $correctEmail = "admin@gmail.com";
    $correctPassword = "12345";

    if ($email === $correctEmail && $password === $correctPassword) {
        // Uspesna prijava
        $_SESSION['user'] = $email;
        header("Location: index.html"); // Idi na dashboard
        exit();
    } else {
        // Neuspešna prijava
        echo "<script>alert('Invalid email or password'); window.location.href='login.html';</script>";
    }
} else {
    header("Location: login.html");
    exit();
}
?>
