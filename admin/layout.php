<?php
function adminHeader($pageTitle, $activeMenu = '') {
    $nama = htmlspecialchars($_SESSION['admin_nama'] ?? $_SESSION['admin_username'] ?? 'Admin');
    require_once __DIR__ . '/../includes/config.php';
    $db = getDB();
    $pesanBaru = $db->query("SELECT COUNT(*) as c FROM pesan_kontak WHERE sudah_dibaca = 0")->fetch_assoc()['c'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle) ?> - Admin Panel</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&family=Fredoka+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>

<!-- SIDEBAR -->
<aside class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <div class="sidebar-logo">🏫</div>
        <div>
            <div class="sidebar-name"><?= SITE_NAME ?></div>
            <div class="sidebar-sub">Admin Panel</div>
        </div>
    </div>

    <nav class="sidebar-nav">
        <div class="nav-group-title">Utama</div>
        <a href="dashboard.php" class="sidebar-item <?= $activeMenu === 'dashboard' ? 'active' : '' ?>">
            <span class="sidebar-icon">📊</span> Dashboard
        </a>

        <div class="nav-group-title">Konten Website</div>
        <a href="pengaturan.php" class="sidebar-item <?= $activeMenu === 'pengaturan' ? 'active' : '' ?>">
            <span class="sidebar-icon">⚙️</span> Pengaturan Umum
        </a>
        <a href="kepala_sekolah.php" class="sidebar-item <?= $activeMenu === 'kepala_sekolah' ? 'active' : '' ?>">
            <span class="sidebar-icon">👩‍💼</span> Kepala Sekolah
        </a>
        <a href="program.php" class="sidebar-item <?= $activeMenu === 'program' ? 'active' : '' ?>">
            <span class="sidebar-icon">📚</span> Program
        </a>
        <a href="galeri.php" class="sidebar-item <?= $activeMenu === 'galeri' ? 'active' : '' ?>">
            <span class="sidebar-icon">📸</span> Galeri
        </a>
        <a href="visi_misi.php" class="sidebar-item <?= $activeMenu === 'visi_misi' ? 'active' : '' ?>">
            <span class="sidebar-icon">🌟</span> Visi & Misi
        </a>

        <div class="nav-group-title">Komunikasi</div>
        <a href="pesan.php" class="sidebar-item <?= $activeMenu === 'pesan' ? 'active' : '' ?>">
            <span class="sidebar-icon">✉️</span> Pesan Masuk
            <?php if ($pesanBaru > 0): ?>
            <span class="sidebar-badge"><?= $pesanBaru ?></span>
            <?php endif; ?>
        </a>

        <div class="nav-group-title">Akun</div>
        <a href="ganti_password.php" class="sidebar-item <?= $activeMenu === 'ganti_password' ? 'active' : '' ?>">
            <span class="sidebar-icon">🔒</span> Ganti Password
        </a>
        <a href="logout.php" class="sidebar-item">
            <span class="sidebar-icon">🚪</span> Logout
        </a>
    </nav>
</aside>

<!-- MAIN CONTENT -->
<div class="main-content">
    <!-- Header -->
    <header class="admin-header">
        <h1 class="header-title">📋 <?= htmlspecialchars($pageTitle) ?></h1>
        <div class="header-actions">
            <a href="../index.php" target="_blank" class="btn btn-outline btn-sm">
                🌐 Lihat Website
            </a>
            <div class="header-user">
                <div class="user-avatar">👤</div>
                <span class="user-name"><?= $nama ?></span>
            </div>
            <a href="logout.php" class="btn-logout">
                🚪 Keluar
            </a>
        </div>
    </header>
<?php
}

function adminFooter() {
?>
</div><!-- end main-content -->

<script>
// Sidebar mobile toggle
document.addEventListener('DOMContentLoaded', function() {
    const toggleBtn = document.getElementById('sidebarToggle');
    const sidebar = document.getElementById('sidebar');
    if (toggleBtn && sidebar) {
        toggleBtn.addEventListener('click', () => sidebar.classList.toggle('open'));
    }

    // Image preview
    document.querySelectorAll('input[type="file"]').forEach(input => {
        input.addEventListener('change', function() {
            const preview = document.querySelector('#preview-' + this.name);
            if (preview && this.files[0]) {
                const reader = new FileReader();
                reader.onload = e => { preview.src = e.target.result; preview.style.display = 'block'; };
                reader.readAsDataURL(this.files[0]);
            }
        });
    });

    // Confirm delete
    document.querySelectorAll('.btn-delete').forEach(btn => {
        btn.addEventListener('click', function(e) {
            if (!confirm('Yakin ingin menghapus data ini?')) e.preventDefault();
        });
    });
});
</script>
</body>
</html>
<?php
}
?>
