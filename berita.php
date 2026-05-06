<?php
$page_title = "Berita";
require_once 'includes/header.php';

// Program aktif
$programs = $db->query("SELECT * FROM program WHERE aktif = 1 ORDER BY urutan ASC");
?>

<!-- Page Header -->
<section class="page-header">
    <div class="container">
        <h1 class="page-header-title animate-on-scroll">📰 Berita</h1>
        <p class="page-header-breadcrumb animate-on-scroll animate-delay-1">
            <a href="index.php">Beranda</a> / Berita
        </p>
    </div>
</section>

<!-- BERITA SECTION -->
<section class="section section-alt">
    <div class="container">
        <div class="berita-layout">
            
            <!-- MAIN CONTENT -->
            <div class="berita-main">
                <div class="berita-grid">
                    
                    <!-- Berita Card 1 -->
                    <article class="berita-card animate-on-scroll">
                        <div class="berita-img-wrap">
                            <div class="berita-img-placeholder">🎓</div>
                            <span class="berita-kategori-badge">Kegiatan Sekolah</span>
                            <span class="berita-tanggal-badge">📅 5 Juni 2025</span>
                        </div>
                        <div class="berita-content">
                            <h3 class="berita-judul">Kelulusan Siswa Tahun 2025</h3>
                            <p class="berita-deskripsi">
                                Sekolah kita mengadakan acara wisuda pada tanggal 5 Juni 2025 untuk menyelenggarakan kelulusan siswa tahun ini. Selamat kepada seluruh siswa yang telah...
                            </p>
                            <div class="berita-meta">
                                <span class="berita-meta-item">👤 Admin</span>
                                <span class="berita-meta-item">👁️ 234x dibaca</span>
                            </div>
                            <a href="#" class="btn-baca">Baca Selengkapnya →</a>
                        </div>
                    </article>

                    <!-- Berita Card 2 -->
                    <article class="berita-card animate-on-scroll">
                        <div class="berita-img-wrap">
                            <div class="berita-img-placeholder">🎨</div>
                            <span class="berita-kategori-badge">Prestasi</span>
                            <span class="berita-tanggal-badge">📅 12 Maret 2025</span>
                        </div>
                        <div class="berita-content">
                            <h3 class="berita-judul">Siswa Berhasil Meraih Juara Lomba Mewarnai Tingkat Kecamatan</h3>
                            <p class="berita-deskripsi">
                                Salah satu siswa SDN kita berhasil meraih juara dalam lomba mewarnai tingkat kecamatan yang diselenggarakan dalam rangka hari kartini...
                            </p>
                            <div class="berita-meta">
                                <span class="berita-meta-item">👤 Admin</span>
                                <span class="berita-meta-item">👁️ 189x dibaca</span>
                            </div>
                            <a href="#" class="btn-baca">Baca Selengkapnya →</a>
                        </div>
                    </article>

                    <!-- Berita Card 3 -->
                    <article class="berita-card animate-on-scroll">
                        <div class="berita-img-wrap">
                            <div class="berita-img-placeholder">🏃</div>
                            <span class="berita-kategori-badge">Olahraga</span>
                            <span class="berita-tanggal-badge">📅 8 Maret 2025</span>
                        </div>
                        <div class="berita-content">
                            <h3 class="berita-judul">Peringatan Hari Olahraga Nasional 2025</h3>
                            <p class="berita-deskripsi">
                                Dalam rangka memperingati Hari Olahraga Nasional, sekolah mengadakan berbagai lomba olahraga antar kelas yang diikuti oleh seluruh siswa...
                            </p>
                            <div class="berita-meta">
                                <span class="berita-meta-item">👤 Admin</span>
                                <span class="berita-meta-item">👁️ 156x dibaca</span>
                            </div>
                            <a href="#" class="btn-baca">Baca Selengkapnya →</a>
                        </div>
                    </article>

                    <!-- Berita Card 4 -->
                    <article class="berita-card animate-on-scroll">
                        <div class="berita-img-wrap">
                            <div class="berita-img-placeholder">📚</div>
                            <span class="berita-kategori-badge">Akademik</span>
                            <span class="berita-tanggal-badge">📅 1 Maret 2025</span>
                        </div>
                        <div class="berita-content">
                            <h3 class="berita-judul">Ujian Semester Genap Dimulai</h3>
                            <p class="berita-deskripsi">
                                Ujian semester genap tahun ajaran 2024/2025 telah dimulai. Seluruh siswa diharapkan untuk mempersiapkan diri dengan baik dan mengikuti...
                            </p>
                            <div class="berita-meta">
                                <span class="berita-meta-item">👤 Admin</span>
                                <span class="berita-meta-item">👁️ 312x dibaca</span>
                            </div>
                            <a href="#" class="btn-baca">Baca Selengkapnya →</a>
                        </div>
                    </article>

                </div>

                <!-- Pagination -->
                <div class="pagination">
                    <a href="#" class="page-link prev">← Prev</a>
                    <a href="#" class="page-link active">1</a>
                    <a href="#" class="page-link">2</a>
                    <a href="#" class="page-link">3</a>
                    <a href="#" class="page-link next">Next →</a>
                </div>
            </div>

            <!-- SIDEBAR -->
            <aside class="sidebar">
                
                <!-- Search -->
                <div class="sidebar-search animate-on-scroll">
                    <h3 class="search-title">🔍 Cari Berita</h3>
                    <div class="search-box">
                        <input type="text" class="search-input" placeholder="Cari berita...">
                        <button class="search-btn">🔍</button>
                    </div>
                </div>

                <!-- Kategori -->
                <div class="sidebar-kategori animate-on-scroll">
                    <h3 class="kategori-title">📂 Kategori</h3>
                    <div class="kategori-list">
                        <button class="kategori-item active">
                            <span>Semua Berita</span>
                            <span class="kategori-count">24</span>
                        </button>
                        <button class="kategori-item">
                            <span>Kegiatan Sekolah</span>
                            <span class="kategori-count">12</span>
                        </button>
                        <button class="kategori-item">
                            <span>Prestasi</span>
                            <span class="kategori-count">5</span>
                        </button>
                        <button class="kategori-item">
                            <span>Pengumuman</span>
                            <span class="kategori-count">4</span>
                        </button>
                        <button class="kategori-item">
                            <span>Olahraga</span>
                            <span class="kategori-count">3</span>
                        </button>
                    </div>
                </div>

                <!-- Berita Populer -->
                <div class="sidebar-populer animate-on-scroll">
                    <h3 class="populer-title">🔥 Berita Populer</h3>
                    <div class="populer-list">
                        <a href="#" class="populer-item">
                            <span class="populer-num">1</span>
                            <div class="populer-content">
                                <h4 class="populer-judul">Kelulusan Siswa Tahun 2025</h4>
                                <span class="populer-tanggal">5 Juni 2025</span>
                            </div>
                        </a>
                        <a href="#" class="populer-item">
                            <span class="populer-num">2</span>
                            <div class="populer-content">
                                <h4 class="populer-judul">Ujian Semester Genap Dimulai</h4>
                                <span class="populer-tanggal">1 Maret 2025</span>
                            </div>
                        </a>
                        <a href="#" class="populer-item">
                            <span class="populer-num">3</span>
                            <div class="populer-content">
                                <h4 class="populer-judul">Siswa Berhasil Meraih Juara Lomba Mewarnai</h4>
                                <span class="populer-tanggal">12 Maret 2025</span>
                            </div>
                        </a>
                    </div>
                </div>

            </aside>
        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>