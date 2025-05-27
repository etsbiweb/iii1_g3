<?php
header('Content-Type: application/json');

$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$address = trim($_POST['address'] ?? '');
$message = trim($_POST['message'] ?? '');

if (!$name || !$email) {
    echo json_encode(['status' => 'error', 'message' => 'Ime i email su obavezni.']);
    exit;
}

$new_contact = [
    'name' => $name,
    'email' => $email,
    'address' => $address,
    'message' => $message,
    'timestamp' => date('Y-m-d H:i:s')
];

$file = 'kontakti.json';

if (file_exists($file)) {
    $data = json_decode(file_get_contents($file), true);
    if (!is_array($data)) {
        $data = [];
    }
} else {
    $data = [];
}

$data[] = $new_contact;

if (file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE))) {
    echo json_encode(['status' => 'success', 'message' => 'Uspešno ste poslali poruku.']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Greška pri čuvanju podataka.']);
}
?>
