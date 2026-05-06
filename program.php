<?php
$page_title = "Program Unggulan";
require_once 'includes/header.php';

// Program aktif
$programs = $db->query("SELECT * FROM program WHERE aktif = 1 ORDER BY urutan ASC");
?>

<!-- Page Header -->
<section class="page-header">
    <div class="container">
        <h1 class="page-header-title animate-on-scroll">📚 Program Unggulan</h1>
        <p class="page-header-breadcrumb animate-on-scroll animate-delay-1">
            <a href="index.php">Beranda</a> / Program
        </p>
    </div>
</section>

<!-- ===== PROGRAM ===== -->
<section class="section section-alt">
    <div class="container">
        <div class="section-header">
            <div class="section-badge animate-on-scroll">📚 Program Unggulan</div>
            <h2 class="section-title animate-on-scroll animate-delay-1">Program <span>Pembelajaran</span> Kami</h2>
            <p class="section-desc animate-on-scroll animate-delay-2">Beragam program dirancang khusus untuk mengembangkan potensi siswa secara menyeluruh dan menyenangkan</p>
        </div>

        <div class="program-grid">
            <?php
            $programColors = ['#E3F2FD', '#FBE9E7', '#E8F5E9', '#EDE7F6', '#FFFDE7', '#E0F2F1'];
            $pi = 0;
            while ($prog = $programs->fetch_assoc()):
                $cardColor = $prog['warna'] ?? '#1565C0';
                $bgColor = $programColors[$pi % count($programColors)];
                $pi++;
            ?>
            <div class="program-card animate-on-scroll animate-delay-<?= $pi ?>"
                 style="--card-color: <?= htmlspecialchars($cardColor) ?>; --card-bg: <?= $bgColor ?>">
                <div class="program-icon-wrap">
                    <?= $prog['ikon'] ?? '📌' ?>
                </div>
                <h3 class="program-name"><?= htmlspecialchars($prog['nama_program']) ?></h3>
                <p class="program-desc"><?= htmlspecialchars($prog['deskripsi'] ?? '') ?></p>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>
