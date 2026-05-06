<?php
$page_title = "Pengumuman";
require_once 'includes/header.php';

// ============================================================
// CONTOH DATA (nanti ganti dengan query database)
// ============================================================

$pengumuman_utama = [
    'id' => 1,
    'judul' => 'Pembukaan SPMB SD Nusantara Jaya Tahun Ajaran 2025/2026',
    'kategori' => 'SPMB',
    'deskripsi' => 'Pendaftaran siswa baru tahun ajaran 2025/2026 telah dibuka. Orang tua calon siswa dapat mendaftarkan putra-putrinya secara online melalui website ini atau langsung datang ke sekolah.',
    'tanggal_mulai' => '2025-06-01',
    'tanggal_selesai' => '2025-07-15',
    'status' => 'berjalan',
    'icon' => '📝'
];

$timeline = [
    [
        'id' => 2,
        'judul' => 'Jadwal Ujian Semester Genap 2025',
        'ringkasan' => 'Ujian semester genap akan dilaksanakan mulai tanggal 2 Juni 2025. Siswa diharapkan mempersiapkan diri.',
        'tanggal' => '2025-06-02',
        'status' => 'berjalan',
        'urgent' => true
    ],
    [
        'id' => 3,
        'judul' => 'Libur Hari Raya Idul Adha 2025',
        'ringkasan' => 'Sekolah libur pada tanggal 6-7 Juni 2025 dalam rangka memperingati Hari Raya Idul Adha 1446 H.',
        'tanggal' => '2025-06-06',
        'status' => 'selesai',
        'urgent' => false
    ],
    [
        'id' => 4,
        'judul' => 'Pembagian Raport Akhir Semester',
        'ringkasan' => 'Pembagian raport akhir semester genap akan dilaksanakan pada tanggal 20 Juni 2025.',
        'tanggal' => '2025-06-20',
        'status' => 'baru',
        'urgent' => false
    ],
    [
        'id' => 5,
        'judul' => 'Mosque Competitions Tingkat Kecamatan',
        'ringkasan' => 'Sekolah mengirimkan perwakilan siswa untuk mengikuti lomba Mosque Competitions tingkat kecamatan.',
        'tanggal' => '2025-05-28',
        'status' => 'selesai',
        'urgent' => false
    ],
    [
        'id' => 6,
        'judul' => 'Pemeliharaan dan Perbaikan Fasilitas',
        'ringkasan' => 'Akan dilakukan pemeliharaan rutin fasilitas sekolah pada akhir pekan ini.',
        'tanggal' => '2025-06-14',
        'status' => 'baru',
        'urgent' => false
    ]
];

function tanggalIndo($tanggal) {
    $bulan = [
        1 => 'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun',
        'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'
    ];
    $tgl = date('j', strtotime($tanggal));
    $bln = $bulan[(int)date('n', strtotime($tanggal))];
    $thn = date('Y', strtotime($tanggal));
    return "$tgl $bln $thn";
}

// Hitung countdown (contoh)
function hitungCountdown($target) {
    $now = time();
    $target_time = strtotime($target);
    $diff = $target_time - $now;
    
    if ($diff <= 0) return null;
    
    $hari = floor($diff / 86400);
    $jam = floor(($diff % 86400) / 3600);
    $menit = floor(($diff % 3600) / 60);
    
    return compact('hari', 'jam', 'menit');
}

$countdown = hitungCountdown($pengumuman_utama['tanggal_selesai']);
?>

<!-- $programs = $db->query("SELECT * FROM program WHERE aktif = 1 ORDER BY urutan ASC");
?> -->

<!-- Page Header -->
<section class="page-header">
    <div class="container">
        <h1 class="page-header-title animate-on-scroll">📢 Pengumuman</h1>
        <p class="page-header-breadcrumb animate-on-scroll animate-delay-1">
            <a href="index.php">Beranda</a> / Pengumuman
        </p>
    </div>
</section>

<!-- FEATURED PENGUMUMAN -->
<section class="section" style="padding-bottom: 0;">
    <div class="container">
        <div class="pengumuman-featured animate-on-scroll">
            <div class="featured-card">
                
                <div class="featured-gambar">
                    <?= $pengumuman_utama['icon'] ?>
                </div>
                
                <div class="featured-konten">
                    <span class="featured-kategori">📂 <?= htmlspecialchars($pengumuman_utama['kategori']) ?></span>
                    
                    <h2 class="featured-judul"><?= htmlspecialchars($pengumuman_utama['judul']) ?></h2>
                    
                    <p class="featured-deskripsi"><?= htmlspecialchars($pengumuman_utama['deskripsi']) ?></p>
                    
                    <div class="featured-meta">
                        <span class="featured-meta-item">📅 <?= tanggalIndo($pengumuman_utama['tanggal_mulai']) ?> - <?= tanggalIndo($pengumuman_utama['tanggal_selesai']) ?></span>
                        <span class="featured-meta-item">⏰ Status: <strong style="color: var(--orange-primary);"><?= ucfirst($pengumuman_utama['status']) ?></strong></span>
                    </div>
                    
                    <?php if ($countdown): ?>
                    <div class="featured-countdown">
                        <span class="countdown-label">⏳ Sisa waktu pendaftaran:</span>
                        <div class="countdown-waktu">
                            <div class="countdown-box">
                                <span class="countdown-angka"><?= str_pad($countdown['hari'], 2, '0', STR_PAD_LEFT) ?></span>
                                <span class="countdown-satuan">Hari</span>
                            </div>
                            <div class="countdown-box">
                                <span class="countdown-angka"><?= str_pad($countdown['jam'], 2, '0', STR_PAD_LEFT) ?></span>
                                <span class="countdown-satuan">Jam</span>
                            </div>
                            <div class="countdown-box">
                                <span class="countdown-angka"><?= str_pad($countdown['menit'], 2, '0', STR_PAD_LEFT) ?></span>
                                <span class="countdown-satuan">Menit</span>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                    
                    <a href="#" class="btn-featured">📋 Lihat Detail & Daftar →</a>
                </div>
                
            </div>
        </div>
    </div>
</section>

<!-- TIMELINE PENGUMUMAN -->
<section class="pengumuman-timeline-section section-alt">
    <div class="container">
        
        <div class="timeline-header animate-on-scroll">
            <span class="timeline-badge">📅 Jadwal & Agenda</span>
            <h2 class="timeline-title">Pengumuman Lainnya</h2>
        </div>
        
        <!-- Filter Tabs -->
        <div class="pengumuman-filter animate-on-scroll">
            <button class="filter-tab active">Semua</button>
            <button class="filter-tab">📚 Akademik</button>
            <button class="filter-tab">🎉 Kegiatan</button>
            <button class="filter-tab">📋 Administrasi</button>
        </div>
        
        <!-- Timeline -->
        <div class="timeline">
            <?php foreach ($timeline as $index => $item): ?>
            <div class="timeline-item animate-on-scroll">
                <div class="timeline-dot <?= $item['urgent'] ? 'urgent' : '' ?>"></div>
                <div class="timeline-card">
                    <div class="timeline-tanggal <?= $item['urgent'] ? 'urgent' : '' ?>">
                        📅 <?= tanggalIndo($item['tanggal']) ?>
                        <?php if ($item['urgent']): ?>
                        <span style="margin-left: 4px;">🔥</span>
                        <?php endif; ?>
                    </div>
                    <h3 class="timeline-judul"><?= htmlspecialchars($item['judul']) ?></h3>
                    <p class="timeline-ringkasan"><?= htmlspecialchars($item['ringkasan']) ?></p>
                    <span class="timeline-status status-<?= $item['status'] ?>">
                        <?= [
                            'baru' => '🟢',
                            'berjalan' => '🟡',
                            'selesai' => '🔵'
                        ][$item['status']] ?>
                        <?= ucfirst($item['status']) ?>
                    </span>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        
    </div>
</section>

<!-- ARSIP PENGUMUMAN -->
<section class="section">
    <div class="container" style="text-align: center;">
        <h2 class="section-title" style="margin-bottom: 16px;">📂 Arsip Pengumuman</h2>
        <p class="section-desc" style="margin-bottom: 24px;">
            Lihat pengumuman-pengumuman sebelumnya yang telah berlalu
        </p>
        <a href="#" class="btn-primary">Lihat Arsip 2024 →</a>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>