<?php
require_once __DIR__ . '/config.php';
$db = getDB();

// Ambil pengaturan
$settingResult = $db->query("SELECT kunci, nilai FROM pengaturan");
$settings = [];
while ($row = $settingResult->fetch_assoc()) {
    $settings[$row['kunci']] = $row['nilai'];
}

function s($settings, $key, $default = '') {
    return htmlspecialchars($settings[$key] ?? $default);
}

// Tentukan halaman aktif
$current_page = basename($_SERVER['PHP_SELF'], '.php');
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= s($settings, 'nama_sekolah') ?> - <?= s($settings, 'tagline') ?>">
    <title><?= $page_title ?? s($settings, 'nama_sekolah') ?> | Sekolah Dasar Unggulan</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&family=Fredoka+One&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="css/style.css">

    <!-- Favicon -->
    <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>🏫</text></svg>">
</head>
<body>

<!-- PAGE LOADER -->
<div class="page-loader">
    <div class="loader-content">
        <span class="loader-star">⭐</span>
        <p class="loader-text">SDN NEGLASARI 01</p>
        <div class="loader-bar"><div class="loader-bar-fill"></div></div>
    </div>
</div>

<!-- ===== NAVBAR ===== -->
<nav class="navbar <?= $current_page !== 'index' ? 'scrolled' : '' ?>" id="navbar">
    <div class="nav-container">
        <a href="index.php" class="nav-brand">
            <div class="nav-logo">
                <?php if (!empty($settings['logo_sekolah'])): ?>
                    <img src="img/<?= htmlspecialchars($settings['logo_sekolah']) ?>" alt="Logo <?= s($settings, 'nama_sekolah') ?>">
                <?php else: ?>
                    🏫
                <?php endif; ?>
            </div>
            <div class="nav-brand-text">
                <div class="nav-brand-name"><?= s($settings, 'nama_sekolah') ?></div>
                <div class="nav-brand-sub">Sekolah Dasar Unggulan</div>
            </div>
        </a>

        <ul class="nav-menu">
            <li><a href="index.php" class="nav-link <?= $current_page === 'index' ? 'active' : '' ?>">🏠 Beranda</a></li>
            <li><a href="tentang.php" class="nav-link <?= $current_page === 'tentang' ? 'active' : '' ?>">🏫 Tentang</a></li>
            <li><a href="program.php" class="nav-link <?= $current_page === 'program' ? 'active' : '' ?>">📚 Program</a></li>
             <!-- Dropdown: Informasi -->
            <li class="nav-item">
                <a href="#" class="nav-link nav-link-dropdown <?= in_array($current_page, ['galeri', 'berita', 'pengumuman', 'ppdb']) ? 'active' : '' ?>">📰 Informasi</a>
                <ul class="dropdown-menu">
                    <li><a href="galeri.php" class="dropdown-item <?= $current_page === 'galeri' ? 'active' : '' ?>">📸 Galeri</a></li>
                    <li><a href="berita.php" class="dropdown-item <?= $current_page === 'berita' ? 'active' : '' ?>">📰 Berita</a></li>
                    <li><a href="pengumuman.php" class="dropdown-item <?= $current_page === 'pengumuman' ? 'active' : '' ?>">📢 Pengumuman</a></li>
                </ul>
            </li>
            <li><a href="staff-guru.php" class="nav-link <?= $current_page === 'staff-guru' ? 'active' : '' ?>">👨‍🏫 Guru dan Staff</a></li>
            <li><a href="kontak.php" class="nav-link nav-cta <?= $current_page === 'kontak' ? 'active' : '' ?>">📞 Kontak</a></li>
        </ul>

        <button class="nav-toggle" aria-label="Toggle menu">
            <span></span><span></span><span></span>
        </button>
    </div>
</nav>
