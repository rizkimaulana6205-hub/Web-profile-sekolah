<?php
$page_title = "Guru dan staff";
require_once 'includes/header.php';

// ============================================================
// DATA GURU & STAFF (DUMMY - nanti pindah ke database)
// ============================================================

$guru_data = [
    // KEPALA SEKOLAH (1 orang)
    [
        'id' => 1,
        'nama' => 'Drs. H. Ahmad Sudrajat, M.Pd.',
        'nip' => '196805121993031002',
        'jabatan' => 'kepsek',
        'jabatan_label' => 'Kepala Sekolah',
        'mapel' => '-',
        'foto' => '',
        'email' => 'kepsek@sdnnusantarajaya.sch.id',
        'telepon' => '0812-3456-7890',
        'alamat' => 'Jl. Pendidikan No. 1, Jakarta',
        'quote' => 'Pendidikan adalah investasi terbaik untuk masa depan bangsa. Mari bersama-sama mencerdaskan anak-anak kita.',
        'status' => 'PNS'
    ],
    
    // WAKASEK (1 orang)
    [
        'id' => 2,
        'nama' => 'Siti Aminah, S.Pd.',
        'nip' => '197205151998032003',
        'jabatan' => 'wakasek',
        'jabatan_label' => 'Wakil Kepala Sekolah',
        'mapel' => 'Matematika',
        'foto' => '',
        'email' => 'wakasek@sdnnusantarajaya.sch.id',
        'telepon' => '0813-9876-5432',
        'alamat' => 'Jl. Melati No. 5, Jakarta',
        'status' => 'PNS'
    ],
    
    // GURU KELAS (6 orang)
    [
        'id' => 3,
        'nama' => 'Budi Santoso, S.Pd.',
        'nip' => '198003102005011001',
        'jabatan' => 'guru',
        'jabatan_label' => 'Guru Kelas 1',
        'mapel' => 'Kelas 1',
        'foto' => '',
        'email' => 'budi.santoso@sdnnusantarajaya.sch.id',
        'telepon' => '0821-1111-2222',
        'status' => 'PNS'
    ],
    [
        'id' => 4,
        'nama' => 'Dewi Lestari, S.Pd.',
        'nip' => '198512052010012002',
        'jabatan' => 'guru',
        'jabatan_label' => 'Guru Kelas 2',
        'mapel' => 'Kelas 2',
        'foto' => '',
        'email' => 'dewi.lestari@sdnnusantarajaya.sch.id',
        'telepon' => '0822-3333-4444',
        'status' => 'PNS'
    ],
    [
        'id' => 5,
        'nama' => 'Eko Prasetyo, S.Pd.',
        'nip' => '199001152015011003',
        'jabatan' => 'guru',
        'jabatan_label' => 'Guru Kelas 3',
        'mapel' => 'Kelas 3',
        'foto' => '',
        'email' => 'eko.prasetyo@sdnnusantarajaya.sch.id',
        'telepon' => '0823-5555-6666',
        'status' => 'PTT'
    ],
    [
        'id' => 6,
        'nama' => 'Fitriani, S.Pd.',
        'nip' => '198807202012012004',
        'jabatan' => 'guru',
        'jabatan_label' => 'Guru Kelas 4',
        'mapel' => 'Kelas 4',
        'foto' => '',
        'email' => 'fitriani@sdnnusantarajaya.sch.id',
        'telepon' => '0831-7777-8888',
        'status' => 'PNS'
    ],
    [
        'id' => 7,
        'nama' => 'Gunawan, S.Pd.',
        'nip' => '199205102018011005',
        'jabatan' => 'guru',
        'jabatan_label' => 'Guru Kelas 5',
        'mapel' => 'Kelas 5',
        'foto' => '',
        'email' => 'gunawan@sdnnusantarajaya.sch.id',
        'telepon' => '0832-9999-0000',
        'status' => 'PTT'
    ],
    [
        'id' => 8,
        'nama' => 'Heni Susanti, S.Pd.',
        'nip' => '198609252011012006',
        'jabatan' => 'guru',
        'jabatan_label' => 'Guru Kelas 6',
        'mapel' => 'Kelas 6',
        'foto' => '',
        'email' => 'heni.susanti@sdnnusantarajaya.sch.id',
        'telepon' => '0856-1212-3434',
        'status' => 'PNS'
    ],
    
    // GURU MATA PELAJARAN (4 orang)
    [
        'id' => 9,
        'nama' => 'Irfan Hakim, S.Pd.',
        'nip' => '198703152009011007',
        'jabatan' => 'guru',
        'jabatan_label' => 'Guru Agama Islam',
        'mapel' => 'Pendidikan Agama Islam',
        'foto' => '',
        'email' => 'irfan.hakim@sdnnusantarajaya.sch.id',
        'telepon' => '0857-5656-7878',
        'status' => 'PNS'
    ],
    [
        'id' => 10,
        'nama' => 'Joko Widodo, S.Pd.',
        'nip' => '199510102020011008',
        'jabatan' => 'guru',
        'jabatan_label' => 'Guru PJOK',
        'mapel' => 'Pendidikan Jasmani',
        'foto' => '',
        'email' => 'joko.widodo@sdnnusantarajaya.sch.id',
        'telepon' => '0858-9090-1212',
        'status' => 'PTT'
    ],
    [
        'id' => 11,
        'nama' => 'Kartini, S.Pd.',
        'nip' => '198409052006012009',
        'jabatan' => 'guru',
        'jabatan_label' => 'Guru Seni Budaya',
        'mapel' => 'Seni Budaya',
        'foto' => '',
        'email' => 'kartini@sdnnusantarajaya.sch.id',
        'telepon' => '0811-2323-4545',
        'status' => 'PNS'
    ],
    [
        'id' => 12,
        'nama' => 'Lukman Hakim, S.Pd.I.',
        'nip' => '199312252019011010',
        'jabatan' => 'guru',
        'jabatan_label' => 'Guru Bahasa Inggris',
        'mapel' => 'Bahasa Inggris',
        'foto' => '',
        'email' => 'lukman@sdnnusantarajaya.sch.id',
        'telepon' => '0812-6767-8989',
        'status' => 'PTT'
    ],
    
    // TATA USAHA (2 orang)
    [
        'id' => 13,
        'nama' => 'Mulyani',
        'nip' => '-',
        'jabatan' => 'tata-usaha',
        'jabatan_label' => 'Tata Usaha',
        'mapel' => '-',
        'foto' => '',
        'email' => 'tu@sdnnusantarajaya.sch.id',
        'telepon' => '0877-1111-2222',
        'status' => 'Honorer'
    ],
    [
        'id' => 14,
        'nama' => 'Nurhayati',
        'nip' => '-',
        'jabatan' => 'tata-usaha',
        'jabatan_label' => 'Tata Usaha',
        'mapel' => '-',
        'foto' => '',
        'email' => 'tu2@sdnnusantarajaya.sch.id',
        'telepon' => '0878-3333-4444',
        'status' => 'Honorer'
    ],
    
    // PENJAGA SEKOLAH (1 orang)
    [
        'id' => 15,
        'nama' => 'Pak Surya',
        'nip' => '-',
        'jabatan' => 'penjaga',
        'jabatan_label' => 'Penjaga Sekolah',
        'mapel' => '-',
        'foto' => '',
        'email' => '-',
        'telepon' => '0896-5555-6666',
        'status' => 'Honorer'
    ]
];

// Hitung statistik
$total_guru = count(array_filter($guru_data, fn($g) => $g['jabatan'] === 'guru'));
$total_pns = count(array_filter($guru_data, fn($g) => $g['status'] === 'PNS'));
$total_ptt = count(array_filter($guru_data, fn($g) => $g['status'] === 'PTT'));
$total_staff = count(array_filter($guru_data, fn($g) => in_array($g['jabatan'], ['tata-usaha', 'penjaga'])));

// Kelompokkan data
$kepsek = array_values(array_filter($guru_data, fn($g) => $g['jabatan'] === 'kepsek'));
$wakasek = array_values(array_filter($guru_data, fn($g) => $g['jabatan'] === 'wakasek'));
$guru_kelas = array_values(array_filter($guru_data, fn($g) => $g['jabatan'] === 'guru' && str_contains($g['jabatan_label'], 'Kelas')));
$guru_mapel = array_values(array_filter($guru_data, fn($g) => $g['jabatan'] === 'guru' && !str_contains($g['jabatan_label'], 'Kelas')));
$tata_usaha = array_values(array_filter($guru_data, fn($g) => $g['jabatan'] === 'tata-usaha'));
$penjaga = array_values(array_filter($guru_data, fn($g) => $g['jabatan'] === 'penjaga'));

// Fungsi render card
function renderGuruCard($guru, $isKepsek = false) {
    $jabatanClass = $guru['jabatan'];
    $cardClass = $isKepsek ? 'guru-card kepsek-card' : 'guru-card';
    ?>
    <div class="<?= $cardClass ?> animate-on-scroll">
        <div class="guru-card-header <?= $jabatanClass ?>">
            <?php if ($isKepsek): ?>
                <div class="guru-foto-wrap">
                    <?php if (!empty($guru['foto'])): ?>
                        <img src="uploads/guru/<?= htmlspecialchars($guru['foto']) ?>" alt="<?= htmlspecialchars($guru['nama']) ?>" class="guru-foto">
                    <?php else: ?>
                        <div class="guru-foto-placeholder">👨‍🏫</div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
        
        <?php if (!$isKepsek): ?>
        <div class="guru-foto-wrap">
            <?php if (!empty($guru['foto'])): ?>
                <img src="uploads/guru/<?= htmlspecialchars($guru['foto']) ?>" alt="<?= htmlspecialchars($guru['nama']) ?>" class="guru-foto">
            <?php else: ?>
                <div class="guru-foto-placeholder">
                    <?= $guru['jabatan'] === 'penjaga' ? '👮' : ($guru['jabatan'] === 'tata-usaha' ? '👩‍💼' : '👨‍🏫') ?>
                </div>
            <?php endif; ?>
        </div>
        <?php endif; ?>
        
        <div class="guru-konten">
            <span class="guru-jabatan-badge <?= $jabatanClass ?>"><?= $guru['jabatan_label'] ?></span>
            
            <h3 class="guru-nama"><?= htmlspecialchars($guru['nama']) ?></h3>
            
            <?php if ($guru['nip'] !== '-'): ?>
            <p class="guru-nip">NIP. <?= htmlspecialchars($guru['nip']) ?></p>
            <?php endif; ?>
            
            <?php if ($guru['mapel'] !== '-'): ?>
            <span class="guru-mapel">📚 <?= htmlspecialchars($guru['mapel']) ?></span>
            <?php endif; ?>
            
            <?php if ($isKepsek && !empty($guru['quote'])): ?>
            <div class="guru-quote">"<?= htmlspecialchars($guru['quote']) ?>"</div>
            <?php endif; ?>
            
            <div class="guru-info-list">
                <?php if ($guru['email'] !== '-'): ?>
                <div class="guru-info-item">
                    <span class="guru-info-icon">📧</span>
                    <span><?= htmlspecialchars($guru['email']) ?></span>
                </div>
                <?php endif; ?>
                <div class="guru-info-item">
                    <span class="guru-info-icon">📱</span>
                    <span><?= htmlspecialchars($guru['telepon']) ?></span>
                </div>
                <?php if (!empty($guru['alamat'])): ?>
                <div class="guru-info-item">
                    <span class="guru-info-icon">📍</span>
                    <span><?= htmlspecialchars($guru['alamat']) ?></span>
                </div>
                <?php endif; ?>
                <div class="guru-info-item">
                    <span class="guru-info-icon">🎖️</span>
                    <span>Status: <strong><?= $guru['status'] ?></strong></span>
                </div>
            </div>
            
            <div class="guru-sosial">
                <a href="#" class="guru-sosial-link" title="WhatsApp">💬</a>
                <a href="#" class="guru-sosial-link" title="Email">📧</a>
            </div>
        </div>
    </div>
    <?php
}
?>

<!-- Page Header -->
<section class="page-header">
    <div class="container">
        <h1 class="page-header-title animate-on-scroll">Guru dan staff</h1>
        <p class="page-header-breadcrumb animate-on-scroll animate-delay-1">
            <a href="index.php">Beranda</a> / guru-dan-staff
        </p>
    </div>
</section>

<!-- STATS BANNER -->
<section class="section" style="padding-bottom: 0;">
    <div class="container">
        <div class="guru-stats-banner animate-on-scroll">
            <div class="guru-stats-grid">
                <div class="guru-stat-card">
                    <span class="guru-stat-icon">👨‍🏫</span>
                    <div class="guru-stat-num"><?= $total_guru ?></div>
                    <div class="guru-stat-label">Guru</div>
                </div>
                <div class="guru-stat-card">
                    <span class="guru-stat-icon">🎖️</span>
                    <div class="guru-stat-num"><?= $total_pns ?></div>
                    <div class="guru-stat-label">Guru PNS</div>
                </div>
                <div class="guru-stat-card">
                    <span class="guru-stat-icon">📝</span>
                    <div class="guru-stat-num"><?= $total_ptt ?></div>
                    <div class="guru-stat-label">Guru PTT</div>
                </div>
                <div class="guru-stat-card">
                    <span class="guru-stat-icon">👩‍💼</span>
                    <div class="guru-stat-num"><?= $total_staff ?></div>
                    <div class="guru-stat-label">Staff</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FILTER -->
<section class="section" style="padding-bottom: 0;">
    <div class="container">
        <div class="guru-filter animate-on-scroll">
            <button class="guru-filter-btn active">👥 Semua</button>
            <button class="guru-filter-btn">👨‍🏫 Guru Kelas</button>
            <button class="guru-filter-btn">📚 Guru Mapel</button>
            <button class="guru-filter-btn">👩‍💼 Tata Usaha</button>
        </div>
    </div>
</section>

<!-- KEPALA SEKOLAH -->
<section class="section" style="padding-bottom: 0;">
    <div class="container">
        <h2 class="guru-section-title">⭐ Pimpinan Sekolah</h2>
        <div class="guru-grid">
            <?php foreach ($kepsek as $g): renderGuruCard($g, true); endforeach; ?>
        </div>
    </div>
</section>

<!-- WAKASEK -->
<?php if (!empty($wakasek)): ?>
<section class="section" style="padding-bottom: 0;">
    <div class="container">
        <h2 class="guru-section-title">🎯 Wakil Kepala Sekolah</h2>
        <div class="guru-grid">
            <?php foreach ($wakasek as $g): renderGuruCard($g); endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- GURU KELAS -->
<section class="section" style="padding-bottom: 0;">
    <div class="container">
        <h2 class="guru-section-title">🏫 Guru Kelas</h2>
        <div class="guru-grid">
            <?php foreach ($guru_kelas as $g): renderGuruCard($g); endforeach; ?>
        </div>
    </div>
</section>

<!-- GURU MATA PELAJARAN -->
<section class="section" style="padding-bottom: 0;">
    <div class="container">
        <h2 class="guru-section-title">📚 Guru Mata Pelajaran</h2>
        <div class="guru-grid">
            <?php foreach ($guru_mapel as $g): renderGuruCard($g); endforeach; ?>
        </div>
    </div>
</section>

<!-- TATA USAHA -->
<section class="section" style="padding-bottom: 0;">
    <div class="container">
        <h2 class="guru-section-title">👩‍💼 Tata Usaha</h2>
        <div class="guru-grid">
            <?php foreach ($tata_usaha as $g): renderGuruCard($g); endforeach; ?>
        </div>
    </div>
</section>

<!-- PENJAGA -->
<section class="section">
    <div class="container">
        <h2 class="guru-section-title">👮 Tenaga Keamanan</h2>
        <div class="guru-grid">
            <?php foreach ($penjaga as $g): renderGuruCard($g); endforeach; ?>
        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>