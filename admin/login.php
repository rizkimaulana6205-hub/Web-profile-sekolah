<?php
require_once '../includes/config.php';

if (isLoggedIn()) {
    redirect('../admin/dashboard.php');
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = sanitize($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($username) || empty($password)) {
        $error = 'Username dan password wajib diisi!';
    } else {
        $db = getDB();
        $stmt = $db->prepare("SELECT * FROM admin WHERE username = ? LIMIT 1");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $admin = $stmt->get_result()->fetch_assoc();

        if ($admin && password_verify($password, $admin['password'])) {
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['admin_username'] = $admin['username'];
            $_SESSION['admin_nama'] = $admin['nama_lengkap'];
            redirect('../admin/dashboard.php');
        } else {
            $error = 'Username atau password salah!';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - <?= SITE_NAME ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&family=Fredoka+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
<div class="login-page">
    <div class="login-card">
        <div class="login-logo">
            <div class="login-logo-icon">🏫</div>
            <h1 class="login-title"><?= SITE_NAME ?></h1>
            <p class="login-sub">Panel Administrasi Website</p>
        </div>

        <?php if ($error): ?>
        <div class="alert alert-error">⚠️ <?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="form-group">
                <label class="form-label" for="username">👤 Username</label>
                <input type="text" id="username" name="username" class="form-input"
                       placeholder="Masukkan username"
                       value="<?= htmlspecialchars($_POST['username'] ?? '') ?>" required autofocus>
            </div>

            <div class="form-group">
                <label class="form-label" for="password">🔒 Password</label>
                <input type="password" id="password" name="password" class="form-input"
                       placeholder="Masukkan password" required>
            </div>

            <button type="submit" class="btn btn-green" style="width:100%;justify-content:center;padding:13px;font-size:1rem;margin-top:8px;">
                🚀 Masuk ke Admin Panel
            </button>
        </form>

        <p style="text-align:center;margin-top:20px;font-size:0.82rem;color:#757575;">
            Default: admin / admin123
        </p>

        <a href="../index.php" style="display:block;text-align:center;margin-top:12px;color:#2E7D32;font-weight:700;font-size:0.85rem;">
            ← Kembali ke Website
        </a>
    </div>
</div>
</body>
</html>
