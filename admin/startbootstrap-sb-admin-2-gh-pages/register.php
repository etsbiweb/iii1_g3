<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Uzmi podatke iz POST
    $firstName = trim($_POST['first_name']);
    $lastName = trim($_POST['last_name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Osnovna validacija
    if (empty($firstName) || empty($lastName) || empty($email) || empty($password)) {
        echo "Sva polja su obavezna!";
        exit;
    }

    // Hash lozinke
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    // SQL upit za unos
    $sql = "INSERT INTO users (first_name, last_name, email, password) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $firstName, $lastName, $email, $passwordHash);

    if ($stmt->execute()) {
        header("Location: login.html");
        exit;
    } else {
        if ($conn->errno === 1062) { // Duplicate entry (email već postoji)
            echo "Email već postoji, pokušajte se prijaviti.";
        } else {
            echo "Greška: " . $stmt->error;
        }
    }
}
?>
