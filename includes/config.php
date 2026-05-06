<?php
// Konfigurasi Database
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'db_sekolah');

// Koneksi Database
function getDB() {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }
    $conn->set_charset("utf8mb4");
    return $conn;
}

// Base URL
define('BASE_URL', 'http://localhost/sekolah/');
define('SITE_NAME', 'SDN Nusantara Jaya');

// Session
session_start();

// Helper Functions
function sanitize($input) {
    return htmlspecialchars(strip_tags(trim($input)));
}

function redirect($url) {
    header("Location: " . $url);
    exit();
}

function isLoggedIn() {
    return isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;
}

function requireLogin() {
    if (!isLoggedIn()) {
        redirect(BASE_URL . 'admin/login.php');
    }
}

function uploadImage($file, $folder = 'img/') {
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
    $maxSize = 5 * 1024 * 1024; // 5MB

    if (!in_array($file['type'], $allowedTypes)) {
        return ['success' => false, 'message' => 'Format file tidak diizinkan.'];
    }
    if ($file['size'] > $maxSize) {
        return ['success' => false, 'message' => 'Ukuran file terlalu besar (max 5MB).'];
    }

    $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
    $newName = uniqid() . '_' . time() . '.' . $ext;
    $uploadPath = __DIR__ . '/../' . $folder . $newName;

    if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
        return ['success' => true, 'filename' => $newName, 'path' => $folder . $newName];
    }
    return ['success' => false, 'message' => 'Gagal mengupload file.'];
}
?>
