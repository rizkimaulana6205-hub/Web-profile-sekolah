<?php
$page_title = "Galeri Kegiatan";
require_once 'includes/header.php';

// Galeri aktif
$galeri = $db->query("SELECT * FROM galeri WHERE aktif = 1 ORDER BY tanggal DESC");
?>

<!-- Page Header -->
<section class="page-header">
    <div class="container">
        <h1 class="page-header-title animate-on-scroll">📸 Galeri Kegiatan</h1>
        <p class="page-header-breadcrumb animate-on-scroll animate-delay-1">
            <a href="index.php">Beranda</a> / Galeri
        </p>
    </div>
</section>

<!-- ===== GALERI ===== -->
<section class="section">
    <div class="container">
        <div class="section-header">
            <div class="section-badge animate-on-scroll">📸 Galeri Kegiatan</div>
            <h2 class="section-title animate-on-scroll animate-delay-1">Momen <span>Berharga</span> Bersama</h2>
            <p class="section-desc animate-on-scroll animate-delay-2">Dokumentasi berbagai kegiatan seru dan bermakna yang dilakukan seluruh warga sekolah kami</p>
        </div>

        <div class="galeri-filter animate-on-scroll">
            <button class="filter-btn active" data-filter="semua">🌈 Semua</button>
            <button class="filter-btn" data-filter="kegiatan">🎉 Kegiatan</button>
            <button class="filter-btn" data-filter="prestasi">🏆 Prestasi</button>
            <button class="filter-btn" data-filter="fasilitas">🏫 Fasilitas</button>
        </div>

        <div class="galeri-grid">
            <?php
            $galeriItems = $galeri->fetch_all(MYSQLI_ASSOC);
            $galeriEmojis = ['🎨', '🔬', '⚽', '📚', '🎵', '🎭', '🏕️', '🌳', '🎓'];
            foreach ($galeriItems as $idx => $item):
            ?>
            <div class="galeri-item animate-scale animate-delay-<?= ($idx % 6) + 1 ?>"
                 data-kategori="<?= htmlspecialchars($item['kategori']) ?>">
                <?php if (!empty($item['foto']) && file_exists('img/' . $item['foto'])): ?>
                    <img src="img/<?= htmlspecialchars($item['foto']) ?>"
                         alt="<?= htmlspecialchars($item['judul']) ?>"
                         class="galeri-img">
                <?php else: ?>
                    <div class="galeri-placeholder">
                        <span><?= $galeriEmojis[$idx % count($galeriEmojis)] ?></span>
                        <span class="galeri-placeholder-text"><?= htmlspecialchars(mb_strimwidth($item['judul'], 0, 30, '...')) ?></span>
                    </div>
                <?php endif; ?>

                <div class="galeri-overlay">
                    <div class="galeri-caption">
                        <span class="galeri-cat"><?= ucfirst(htmlspecialchars($item['kategori'])) ?></span>
                        <span class="galeri-title"><?= htmlspecialchars($item['judul']) ?></span>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>
