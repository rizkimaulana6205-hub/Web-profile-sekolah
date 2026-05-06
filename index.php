<?php
$page_title = "Beranda";
require_once 'includes/header.php';
?>

<!-- ===== HERO SECTION ===== -->
<section class="hero" id="home">
    <div class="hero-bg">
        <?php if (!empty($settings['foto_hero'])): ?>
            <img src="img/<?= htmlspecialchars($settings['foto_hero']) ?>" alt="Hero Background">
        <?php else: ?>
            <div class="hero-bg-placeholder"></div>
        <?php endif; ?>
    </div>

    <!-- Animated shapes -->
    <div class="hero-shapes">
        <div class="shape shape-1"></div>
        <div class="shape shape-2"></div>
        <div class="shape shape-3"></div>
        <div class="shape shape-4"></div>
        <div class="shape shape-5"></div>
    </div>

    <div class="hero-container">
        <div class="hero-content">
            <div class="hero-badge">
                ⭐ Akreditasi B | NPSN: <?= s($settings, 'npsn') ?>
            </div>

            <h1 class="hero-title">
                Selamat Datang di
                <span class="hero-title-accent">SDN NEGLASARI 01</span>
            </h1>

            <p class="hero-subtitle">
                <?= s($settings, 'tagline') ?>
            </p>

            <div class="hero-actions">
                <a href="tentang.php" class="btn-hero-primary">
                    🎓 Kenali Kami <span>→</span>
                </a>
                <a href="kontak.php" class="btn-hero-secondary">
                    📞 Hubungi Kami
                </a>
            </div>

            <div class="hero-stats">
                <div class="hero-stat-item">
                    <div class="hero-stat-num" data-count="<?= s($settings, 'jumlah_siswa', '540') ?>" data-suffix="+"><?= s($settings, 'jumlah_siswa', '540') ?>+</div>
                    <div class="hero-stat-label">Siswa Aktif</div>
                </div>
                <div class="hero-stat-divider"></div>
                <div class="hero-stat-item">
                    <div class="hero-stat-num" data-count="<?= s($settings, 'jumlah_guru', '28') ?>" data-suffix="+"><?= s($settings, 'jumlah_guru', '28') ?>+</div>
                    <div class="hero-stat-label">Guru & Staf</div>
                </div>
                <div class="hero-stat-divider"></div>
                <div class="hero-stat-item">
                    <div class="hero-stat-num" data-count="<?= date('Y') - (int)($settings['tahun_berdiri'] ?? 1975) ?>" data-suffix="+"><?= date('Y') - (int)($settings['tahun_berdiri'] ?? 1975) ?>+</div>
                    <div class="hero-stat-label">Tahun Berdiri</div>
                </div>
            </div>
        </div>

        <div class="hero-visual">
            <div class="hero-card-stack">
                <div class="hero-main-card">
                    <div class="hero-card-emoji">👨‍🎓</div>
                    <div class="hero-card-title">Belajar Itu Menyenangkan!</div>
                    <div class="hero-card-sub">Mari bergabung bersama kami</div>
                </div>
                <div class="hero-floating-badge fb-1">
                    <span class="badge-icon">🏆</span>
                    <span>Prestasi Terbaik</span>
                </div>
                <div class="hero-floating-badge fb-2">
                    <span class="badge-icon">💡</span>
                    <span>Inovatif & Kreatif</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Wave -->
    <div class="hero-wave">
        <svg viewBox="0 0 1440 80" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
            <path d="M0,60 C360,10 1080,90 1440,40 L1440,80 L0,80 Z" fill="#ffffff"/>
        </svg>
    </div>
</section>

<!-- ===== STATS BANNER ===== -->
<div class="stats-banner">
    <div class="container">
        <div class="stats-banner-grid">
            <div class="stat-item animate-on-scroll">
                <div class="stat-icon">👨‍🎓</div>
                <div class="stat-num" data-count="<?= s($settings, 'jumlah_siswa', '540') ?>" data-suffix="+">0+</div>
                <div class="stat-label">Siswa Aktif</div>
            </div>
            <div class="stat-item animate-on-scroll animate-delay-2">
                <div class="stat-icon">👩‍🏫</div>
                <div class="stat-num" data-count="<?= s($settings, 'jumlah_guru', '28') ?>" data-suffix="+">0+</div>
                <div class="stat-label">Guru Berpengalaman</div>
            </div>
            <div class="stat-item animate-on-scroll animate-delay-3">
                <div class="stat-icon">🏆</div>
                <div class="stat-num" data-count="150" data-suffix="+">0+</div>
                <div class="stat-label">Prestasi Diraih</div>
            </div>
            <div class="stat-item animate-on-scroll animate-delay-4">
                <div class="stat-icon">📅</div>
                <div class="stat-num" data-count="<?= date('Y') - (int)($settings['tahun_berdiri'] ?? 1975) ?>" data-suffix="+">0+</div>
                <div class="stat-label">Tahun Pengalaman</div>
            </div>
        </div>
    </div>
</div>

<!-- ===== QUICK LINKS ===== -->
<section class="section">
    <div class="container">
        <div class="section-header">
            <div class="section-badge animate-on-scroll">🌟 Informasi</div>
            <h2 class="section-title animate-on-scroll animate-delay-1">Jelajahi <span>Lebih Lanjut</span></h2>
            <p class="section-desc animate-on-scroll animate-delay-2">Kenali lebih dekat sekolah kami melalui menu-menu berikut</p>
        </div>

        <div class="quick-links-grid" style="display:grid;grid-template-columns:repeat(4,1fr);gap:24px;margin-top:48px;">
            <a href="tentang.php" class="quick-link-card animate-on-scroll animate-delay-1">
                <div class="qlc-icon">🏫</div>
                <h3 class="qlc-title">Tentang Kami</h3>
                <p class="qlc-desc">Visi, misi, dan profil sekolah</p>
            </a>
            <a href="program.php" class="quick-link-card animate-on-scroll animate-delay-2">
                <div class="qlc-icon">📚</div>
                <h3 class="qlc-title">Program</h3>
                <p class="qlc-desc">Program unggulan kami</p>
            </a>
            <a href="galeri.php" class="quick-link-card animate-on-scroll animate-delay-3">
                <div class="qlc-icon">📸</div>
                <h3 class="qlc-title">Galeri</h3>
                <p class="qlc-desc">Dokumentasi kegiatan</p>
            </a>
            <a href="kontak.php" class="quick-link-card animate-on-scroll animate-delay-4">
                <div class="qlc-icon">📞</div>
                <h3 class="qlc-title">Kontak</h3>
                <p class="qlc-desc">Hubungi kami</p>
            </a>
        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>
