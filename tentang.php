<?php
$page_title = "Tentang Kami";
require_once 'includes/header.php';

// Kepala sekolah aktif
$kepsek = $db->query("SELECT * FROM kepala_sekolah WHERE aktif = 1 ORDER BY id DESC LIMIT 1")->fetch_assoc();
?>

<!-- Page Header -->
<section class="page-header">
    <div class="container">
        <h1 class="page-header-title animate-on-scroll">🏫 Tentang Kami</h1>
        <p class="page-header-breadcrumb animate-on-scroll animate-delay-1">
            <a href="index.php">Beranda</a> / Tentang Kami
        </p>
    </div>
</section>

<!-- ===== ABOUT / TENTANG ===== -->
<section class="section">
    <div class="container">
        <div class="about-grid">
            <div class="about-image-block animate-left">
                <div class="about-img-placeholder">🏫</div>
                <div class="about-img-badge">
                    <div class="about-badge-num"><?= date('Y') - (int)($settings['tahun_berdiri'] ?? 1975) ?>+</div>
                    <div class="about-badge-label">Tahun Mengabdi</div>
                </div>
                <div class="about-sticker">⭐</div>
            </div>

            <div class="about-content animate-right">
                <div class="section-badge">🏫 Tentang Sekolah</div>
                <h2 class="section-title">Mengenal <span>SDN NEGLASARI 01</span></h2>
                <p class="about-desc"><?= htmlspecialchars($settings['tentang'] ?? '') ?></p>

                <div class="about-highlights">
                    <div class="highlight-item">
                        <span class="highlight-icon">📍</span>
                        <span class="highlight-text">KABUPATEN BOGOR</span>
                    </div>
                    <div class="highlight-item">
                        <span class="highlight-icon">🏆</span>
                        <span class="highlight-text">Akreditasi B</span>
                    </div>
                    <div class="highlight-item">
                        <span class="highlight-icon">📅</span>
                        <span class="highlight-text">Berdiri <?= s($settings, 'tahun_berdiri', '1975') ?></span>
                    </div>
                    <div class="highlight-item">
                        <span class="highlight-icon">🎓</span>
                        <span class="highlight-text">NPSN <?= s($settings, 'npsn') ?></span>
                    </div>
                </div>

                <a href="kontak.php" class="btn-primary">📞 Hubungi Kami →</a>
            </div>
        </div>
    </div>
</section>

<!-- ===== VISI MISI ===== -->
<section class="section section-green-light">
    <div class="container">
        <div class="section-header">
            <div class="section-badge animate-on-scroll">🌟 Visi & Misi</div>
            <h2 class="section-title animate-on-scroll animate-delay-1">Arah <span>Tujuan</span> Kami</h2>
            <p class="section-desc animate-on-scroll animate-delay-2">Kami berkomitmen untuk memberikan pendidikan berkualitas tinggi yang membentuk generasi penerus bangsa</p>
        </div>

        <div class="visi-misi-grid">
            <div class="vm-card vm-card-visi animate-on-scroll animate-delay-1">
                <div class="vm-icon">🌟</div>
                <h3 class="vm-title">Visi Sekolah</h3>
                <p class="vm-text"><?= htmlspecialchars($settings['visi'] ?? '') ?></p>
            </div>

            <div class="vm-card vm-card-misi animate-on-scroll animate-delay-2">
                <div class="vm-icon">🎯</div>
                <h3 class="vm-title">Misi Sekolah</h3>
                <div class="misi-list">
                    <?php
                    $misiKeys = ['misi_1', 'misi_2', 'misi_3', 'misi_4'];
                    foreach ($misiKeys as $i => $key):
                        if (!empty($settings[$key])):
                    ?>
                    <div class="misi-item">
                        <span class="misi-num"><?= $i + 1 ?></span>
                        <span class="misi-text"><?= htmlspecialchars($settings[$key]) ?></span>
                    </div>
                    <?php endif; endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== KEPALA SEKOLAH ===== -->
<?php if ($kepsek): ?>
<section class="section kepsek-section" id="kepsek">
    <div class="container">
        <div class="kepsek-grid">
            <div class="kepsek-photo-wrap animate-left">
                <?php if (!empty($kepsek['foto'])): ?>
                    <img src="img/<?= htmlspecialchars($kepsek['foto']) ?>" alt="<?= htmlspecialchars($kepsek['nama']) ?>" class="kepsek-photo">
                <?php else: ?>
                    <div class="kepsek-photo-placeholder">👩‍💼</div>
                <?php endif; ?>
                <div class="kepsek-badge-wrap">
                    <span>👑</span> Kepala Sekolah
                </div>
            </div>

            <div class="kepsek-content animate-right">
                <div class="section-badge">👩‍💼 Kepala Sekolah</div>
                <h2 class="kepsek-name"><?= htmlspecialchars($kepsek['nama']) ?></h2>
                <?php if ($kepsek['nip']): ?>
                <p class="kepsek-nip">NIP: <?= htmlspecialchars($kepsek['nip']) ?></p>
                <?php endif; ?>
                <?php if ($kepsek['pendidikan']): ?>
                <p class="kepsek-edu">🎓 <?= htmlspecialchars($kepsek['pendidikan']) ?></p>
                <?php endif; ?>

                <div class="kepsek-quote">
                    <p class="kepsek-quote-text"><?= htmlspecialchars($kepsek['sambutan'] ?? '') ?></p>
                </div>

                <?php if ($kepsek['periode']): ?>
                <div class="kepsek-periode">
                    <span>📅</span> Menjabat: <?= htmlspecialchars($kepsek['periode']) ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<?php require_once 'includes/footer.php'; ?>
