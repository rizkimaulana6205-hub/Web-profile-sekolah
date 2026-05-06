<?php
require_once '../includes/config.php';
requireLogin();
require_once 'layout.php';

$db = getDB();
$stats = [
    'galeri'  => $db->query("SELECT COUNT(*) c FROM galeri WHERE aktif=1")->fetch_assoc()['c'],
    'program' => $db->query("SELECT COUNT(*) c FROM program WHERE aktif=1")->fetch_assoc()['c'],
    'pesan'   => $db->query("SELECT COUNT(*) c FROM pesan_kontak")->fetch_assoc()['c'],
    'pesan_baru' => $db->query("SELECT COUNT(*) c FROM pesan_kontak WHERE sudah_dibaca=0")->fetch_assoc()['c'],
];

$pesanTerbaru = $db->query("SELECT * FROM pesan_kontak ORDER BY created_at DESC LIMIT 5")->fetch_all(MYSQLI_ASSOC);

adminHeader('Dashboard', 'dashboard');
?>

<div class="page-content">

    <!-- Stats -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon-box">📸</div>
            <div>
                <div class="stat-num"><?= $stats['galeri'] ?></div>
                <div class="stat-label">Foto Galeri</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon-box">📚</div>
            <div>
                <div class="stat-num"><?= $stats['program'] ?></div>
                <div class="stat-label">Program Aktif</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon-box">✉️</div>
            <div>
                <div class="stat-num"><?= $stats['pesan'] ?></div>
                <div class="stat-label">Total Pesan</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon-box">🔔</div>
            <div>
                <div class="stat-num"><?= $stats['pesan_baru'] ?></div>
                <div class="stat-label">Pesan Belum Dibaca</div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="card" style="margin-bottom:24px;">
        <div class="card-header">
            <h2 class="card-title">⚡ Aksi Cepat</h2>
        </div>
        <div class="card-body">
            <div style="display:flex;gap:12px;flex-wrap:wrap;">
                <a href="pengaturan.php" class="btn btn-green">⚙️ Edit Pengaturan</a>
                <a href="kepala_sekolah.php" class="btn btn-yellow">👩‍💼 Edit Kepala Sekolah</a>
                <a href="galeri.php?action=tambah" class="btn btn-outline">📸 Upload Foto</a>
                <a href="program.php?action=tambah" class="btn btn-outline">📚 Tambah Program</a>
                <a href="pesan.php" class="btn btn-outline">✉️ Lihat Pesan</a>
                <a href="../index.php" target="_blank" class="btn btn-outline">🌐 Lihat Website</a>
            </div>
        </div>
    </div>

    <!-- Recent Messages -->
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">✉️ Pesan Terbaru</h2>
            <a href="pesan.php" class="btn btn-outline btn-sm">Lihat Semua</a>
        </div>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Pesan</th>
                        <th>Waktu</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($pesanTerbaru)): ?>
                    <tr><td colspan="5" style="text-align:center;color:#9e9e9e;padding:32px;">Belum ada pesan masuk.</td></tr>
                    <?php else: ?>
                    <?php foreach ($pesanTerbaru as $p): ?>
                    <tr>
                        <td><strong><?= htmlspecialchars($p['nama']) ?></strong></td>
                        <td><?= htmlspecialchars($p['email']) ?></td>
                        <td><?= htmlspecialchars(mb_strimwidth($p['pesan'], 0, 60, '...')) ?></td>
                        <td style="color:#9e9e9e;font-size:0.82rem;">
                            <?= date('d M Y H:i', strtotime($p['created_at'])) ?>
                        </td>
                        <td>
                            <?php if ($p['sudah_dibaca']): ?>
                                <span class="badge badge-green">Dibaca</span>
                            <?php else: ?>
                                <span class="badge badge-yellow">Baru</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<?php adminFooter(); ?>
