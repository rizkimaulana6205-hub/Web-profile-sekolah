<?php
require_once '../includes/config.php';
requireLogin();
require_once 'layout.php';

$db = getDB();
$pesan = '';
$tipe = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $passwordLama = $_POST['password_lama'] ?? '';
    $passwordBaru = $_POST['password_baru'] ?? '';
    $konfirmasi   = $_POST['konfirmasi'] ?? '';

    if (empty($passwordLama) || empty($passwordBaru) || empty($konfirmasi)) {
        $pesan = 'Semua field wajib diisi.'; $tipe = 'error';
    } elseif ($passwordBaru !== $konfirmasi) {
        $pesan = 'Password baru tidak cocok.'; $tipe = 'error';
    } elseif (strlen($passwordBaru) < 6) {
        $pesan = 'Password minimal 6 karakter.'; $tipe = 'error';
    } else {
        $id = $_SESSION['admin_id'];
        $admin = $db->query("SELECT password FROM admin WHERE id=$id")->fetch_assoc();

        if (password_verify($passwordLama, $admin['password'])) {
            $hash = password_hash($passwordBaru, PASSWORD_DEFAULT);
            $stmt = $db->prepare("UPDATE admin SET password=? WHERE id=?");
            $stmt->bind_param("si", $hash, $id);
            if ($stmt->execute()) {
                $pesan = 'Password berhasil diganti!'; $tipe = 'success';
            } else {
                $pesan = 'Gagal mengganti password.'; $tipe = 'error';
            }
        } else {
            $pesan = 'Password lama salah!'; $tipe = 'error';
        }
    }
}

adminHeader('Ganti Password', 'ganti_password');
?>
<div class="page-content" style="max-width:500px;">
    <?php if ($pesan): ?>
    <div class="alert alert-<?= $tipe ?>"><?= $tipe === 'success' ? '✅' : '❌' ?> <?= htmlspecialchars($pesan) ?></div>
    <?php endif; ?>

    <div class="card">
        <div class="card-header"><h2 class="card-title">🔒 Ganti Password</h2></div>
        <div class="card-body">
            <form method="POST">
                <div class="form-group">
                    <label class="form-label">Password Lama</label>
                    <input type="password" name="password_lama" class="form-input" required placeholder="Masukkan password lama">
                </div>
                <div class="form-group">
                    <label class="form-label">Password Baru</label>
                    <input type="password" name="password_baru" class="form-input" required placeholder="Minimal 6 karakter">
                </div>
                <div class="form-group">
                    <label class="form-label">Konfirmasi Password Baru</label>
                    <input type="password" name="konfirmasi" class="form-input" required placeholder="Ulangi password baru">
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-green">💾 Simpan Password</button>
                    <a href="dashboard.php" class="btn btn-outline">↩ Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>
<?php adminFooter(); ?>
