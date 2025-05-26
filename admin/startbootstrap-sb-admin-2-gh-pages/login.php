<?php
session_start();
include 'config.php'; // konekcija na bazu

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // Admin hardkodirani podaci
    $adminEmail = "admin@gmail.com";
    $adminPassword = "12345";

    if ($email === $adminEmail && $password === $adminPassword) {
        // Admin prijava - ne koristiš bazu, ideš direktno na admin dashboard
        $_SESSION['user'] = $email;
        $_SESSION['role'] = 'admin';
        header("Location: http://localhost/iii1_g3/admin/startbootstrap-sb-admin-2-gh-pages/index.html");
        exit();
    } else {
        // Korisnik - provjera u bazi
        $sql = "SELECT id, first_name, password FROM users WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();

            // Provjeri lozinku (hashirana u bazi)
            if (password_verify($password, $user['password'])) {
                // Prijava uspješna
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['first_name'] = $user['first_name'];
                $_SESSION['role'] = 'user';
                header("Location: http://localhost/iii1_g3/");
                exit();
            } else {
                echo "<script>alert('Neispravna lozinka.'); window.location.href='login.html';</script>";
                exit();
            }
        } else {
            echo "<script>alert('Korisnik nije pronađen.'); window.location.href='login.html';</script>";
            exit();
        }
    }
} else {
    header("Location: login.html");
    exit();
}
?>
