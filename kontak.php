<?php
$page_title = "Kontak";
require_once 'includes/header.php';
?>

<!-- Page Header -->
<section class="page-header">
    <div class="container">
        <h1 class="page-header-title animate-on-scroll">📞 Kontak Kami</h1>
        <p class="page-header-breadcrumb animate-on-scroll animate-delay-1">
            <a href="index.php">Beranda</a> / Kontak
        </p>
    </div>
</section>

<!-- ===== KONTAK ===== -->
<section class="section section-green-light">
    <div class="container">
        <div class="section-header">
            <div class="section-badge animate-on-scroll">📞 Hubungi Kami</div>
            <h2 class="section-title animate-on-scroll animate-delay-1">Ayo <span>Terhubung</span> Bersama Kami</h2>
            <p class="section-desc animate-on-scroll animate-delay-2">Kami siap membantu Anda! Jangan ragu untuk menghubungi kami</p>
        </div>

        <div>
            <div class="animate-left">
                <div class="kontak-items">
                    <div class="kontak-item">
                        <div class="kontak-icon-wrap">📍</div>
                        <div>
                            <div class="kontak-label">Alamat</div>
                            <div class="kontak-value"><?= s($settings, 'alamat') ?></div>
                        </div>
                    </div>
                    <div class="kontak-item">
                        <div class="kontak-icon-wrap">📞</div>
                        <div>
                            <div class="kontak-label">Telepon</div>
                            <div class="kontak-value"><?= s($settings, 'telepon') ?></div>
                        </div>
                    </div>
                    <div class="kontak-item">
                        <div class="kontak-icon-wrap">✉️</div>
                        <div>
                            <div class="kontak-label">Email</div>
                            <div class="kontak-value"><?= s($settings, 'email') ?></div>
                        </div>
                    </div>
                </div>

                <div class="sosmed-section">
                    <h3 class="sosmed-title">🌐 Ikuti Kami</h3>
                    <div class="sosmed-links">
                        <?php if (!empty($settings['instagram'])): ?>
                        <a href="<?= s($settings, 'instagram') ?>" class="sosmed-link" target="_blank">
                            📸 Instagram
                        </a>
                        <?php endif; ?>
                        <?php if (!empty($settings['facebook'])): ?>
                        <a href="<?= s($settings, 'facebook') ?>" class="sosmed-link" target="_blank">
                            👥 Facebook
                        </a>
                        <?php endif; ?>
                        <?php if (!empty($settings['youtube'])): ?>
                        <a href="<?= s($settings, 'youtube') ?>" class="sosmed-link" target="_blank">
                            🎥 YouTube
                        </a>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Map -->
                <?php if (!empty($settings['maps_embed'])): ?>
                <div class="map-container" style="margin-top:28px;">
                    <iframe src="<?= htmlspecialchars($settings['maps_embed']) ?>"
                            allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>
