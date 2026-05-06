<?php
require_once '../includes/config.php';
requireLogin();
require_once 'layout.php';

$db = getDB();
$pesan = '';
$tipe = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fields = [
        'nama_sekolah', 'tagline', 'npsn', 'akreditasi', 'alamat',
        'telepon', 'email', 'instagram', 'facebook', 'youtube',
        'tentang', 'tahun_berdiri', 'jumlah_siswa', 'jumlah_guru',
        'maps_embed'
    ];

    $db->begin_transaction();
    try {
        foreach ($fields as $field) {
            $val = $_POST[$field] ?? '';
            $stmt = $db->prepare("INSERT INTO pengaturan (kunci, nilai) VALUES (?, ?) ON DUPLICATE KEY UPDATE nilai = VALUES(nilai)");
            $stmt->bind_param("ss", $field, $val);
            $stmt->execute();
        }

        // Upload logo
        if (!empty($_FILES['logo_sekolah']['name'])) {
            $upload = uploadImage($_FILES['logo_sekolah'], 'img/');
            if ($upload['success']) {
                $val = $upload['filename'];
                $stmt = $db->prepare("INSERT INTO pengaturan (kunci, nilai) VALUES ('logo_sekolah', ?) ON DUPLICATE KEY UPDATE nilai = VALUES(nilai)");
                $stmt->bind_param("s", $val);
                $stmt->execute();
            }
        }

        // Upload hero
        if (!empty($_FILES['foto_hero']['name'])) {
            $upload = uploadImage($_FILES['foto_hero'], 'img/');
            if ($upload['success']) {
                $val = $upload['filename'];
                $stmt = $db->prepare("INSERT INTO pengaturan (kunci, nilai) VALUES ('foto_hero', ?) ON DUPLICATE KEY UPDATE nilai = VALUES(nilai)");
                $stmt->bind_param("s", $val);
                $stmt->execute();
            }
        }

        $db->commit();
        $pesan = 'Pengaturan berhasil disimpan!';
        $tipe = 'success';
    } catch (Exception $e) {
        $db->rollback();
        $pesan = 'Gagal menyimpan: ' . $e->getMessage();
        $tipe = 'error';
    }
}

// Load current settings
$res = $db->query("SELECT kunci, nilai FROM pengaturan");
$set = [];
while ($r = $res->fetch_assoc()) {
    $set[$r['kunci']] = $r['nilai'];
}

function sv($set, $k, $d = '') { return htmlspecialchars($set[$k] ?? $d); }

adminHeader('Pengaturan Umum', 'pengaturan');
?>

<div class="page-content">

    <?php if ($pesan): ?>
    <div class="alert alert-<?= $tipe ?>">
        <?= $tipe === 'success' ? '✅' : '❌' ?> <?= htmlspecialchars($pesan) ?>
    </div>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data">

        <!-- Informasi Sekolah -->
        <div class="card" style="margin-bottom:24px;">
            <div class="card-header">
                <h2 class="card-title">🏫 Informasi Sekolah</h2>
            </div>
            <div class="card-body">
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Nama Sekolah *</label>
                        <input type="text" name="nama_sekolah" class="form-input" value="<?= sv($set,'nama_sekolah') ?>" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">NPSN</label>
                        <input type="text" name="npsn" class="form-input" value="<?= sv($set,'npsn') ?>">
                    </div>
                    <div class="form-group form-full">
                        <label class="form-label">Tagline / Slogan</label>
                        <input type="text" name="tagline" class="form-input" value="<?= sv($set,'tagline') ?>">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Akreditasi</label>
                        <select name="akreditasi" class="form-select">
                            <?php foreach(['A','B','C','Belum Terakreditasi'] as $a): ?>
                            <option value="<?= $a ?>" <?= sv($set,'akreditasi') === $a ? 'selected' : '' ?>><?= $a ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Tahun Berdiri</label>
                        <input type="number" name="tahun_berdiri" class="form-input" value="<?= sv($set,'tahun_berdiri') ?>">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Jumlah Siswa</label>
                        <input type="number" name="jumlah_siswa" class="form-input" value="<?= sv($set,'jumlah_siswa') ?>">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Jumlah Guru & Staf</label>
                        <input type="number" name="jumlah_guru" class="form-input" value="<?= sv($set,'jumlah_guru') ?>">
                    </div>
                    <div class="form-group form-full">
                        <label class="form-label">Tentang Sekolah</label>
                        <textarea name="tentang" class="form-textarea" style="min-height:160px;"><?= sv($set,'tentang') ?></textarea>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kontak & Sosmed -->
        <div class="card" style="margin-bottom:24px;">
            <div class="card-header">
                <h2 class="card-title">📞 Kontak & Sosial Media</h2>
            </div>
            <div class="card-body">
                <div class="form-grid">
                    <div class="form-group form-full">
                        <label class="form-label">Alamat Lengkap</label>
                        <textarea name="alamat" class="form-textarea" style="min-height:80px;"><?= sv($set,'alamat') ?></textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Nomor Telepon</label>
                        <input type="text" name="telepon" class="form-input" value="<?= sv($set,'telepon') ?>">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-input" value="<?= sv($set,'email') ?>">
                    </div>
                    <div class="form-group">
                        <label class="form-label">📸 Instagram (URL)</label>
                        <input type="url" name="instagram" class="form-input" value="<?= sv($set,'instagram') ?>" placeholder="https://instagram.com/...">
                    </div>
                    <div class="form-group">
                        <label class="form-label">👥 Facebook (URL)</label>
                        <input type="url" name="facebook" class="form-input" value="<?= sv($set,'facebook') ?>" placeholder="https://facebook.com/...">
                    </div>
                    <div class="form-group form-full">
                        <label class="form-label">🎥 YouTube (URL)</label>
                        <input type="url" name="youtube" class="form-input" value="<?= sv($set,'youtube') ?>" placeholder="https://youtube.com/...">
                    </div>
                    <div class="form-group form-full">
                        <label class="form-label">Google Maps Embed URL</label>
                        <input type="text" name="maps_embed" class="form-input" value="<?= sv($set,'maps_embed') ?>">
                        <p class="form-hint">Dapatkan dari Google Maps → Share → Embed a map → copy URL dari src="..."</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Upload Gambar -->
        <div class="card" style="margin-bottom:24px;">
            <div class="card-header">
                <h2 class="card-title">🖼️ Gambar Website</h2>
            </div>
            <div class="card-body">
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Logo Sekolah</label>
                        <div style="display:flex;gap:20px;align-items:flex-start;">
                            <div class="img-preview-box" onclick="document.getElementById('logo-input').click()">
                                <?php if (!empty($set['logo_sekolah'])): ?>
                                <img id="preview-logo_sekolah" src="../img/<?= htmlspecialchars($set['logo_sekolah']) ?>" alt="Logo">
                                <?php else: ?>
                                <div class="img-preview-placeholder">
                                    <span>🏫</span>
                                    <p>Upload Logo</p>
                                </div>
                                <?php endif; ?>
                            </div>
                            <div>
                                <input type="file" id="logo-input" name="logo_sekolah" accept="image/*" style="display:none;">
                                <button type="button" class="btn btn-outline" onclick="document.getElementById('logo-input').click()">📤 Pilih File</button>
                                <p class="form-hint" style="margin-top:8px;">Format: JPG/PNG/GIF (Max 5MB)<br>Disarankan: 200x200px</p>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Foto Hero / Banner Utama</label>
                        <div style="display:flex;gap:20px;align-items:flex-start;">
                            <div class="img-preview-box" style="width:200px;" onclick="document.getElementById('hero-input').click()">
                                <?php if (!empty($set['foto_hero'])): ?>
                                <img id="preview-foto_hero" src="../img/<?= htmlspecialchars($set['foto_hero']) ?>" alt="Hero">
                                <?php else: ?>
                                <div class="img-preview-placeholder">
                                    <span>🌄</span>
                                    <p>Upload Hero</p>
                                </div>
                                <?php endif; ?>
                            </div>
                            <div>
                                <input type="file" id="hero-input" name="foto_hero" accept="image/*" style="display:none;">
                                <button type="button" class="btn btn-outline" onclick="document.getElementById('hero-input').click()">📤 Pilih File</button>
                                <p class="form-hint" style="margin-top:8px;">Format: JPG/PNG (Max 5MB)<br>Disarankan: 1920x1080px</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-green">💾 Simpan Pengaturan</button>
            <a href="dashboard.php" class="btn btn-outline">↩ Kembali</a>
        </div>
    </form>
</div>

<script>
document.querySelectorAll('input[type="file"]').forEach(input => {
    input.addEventListener('change', function() {
        if (this.files[0]) {
            const reader = new FileReader();
            const previewId = 'preview-' + this.name;
            reader.onload = e => {
                let img = document.getElementById(previewId);
                if (!img) {
                    img = document.createElement('img');
                    img.id = previewId;
                    const box = this.closest('.img-preview-box') || this.parentElement.querySelector('.img-preview-box');
                    if (box) {
                        box.innerHTML = '';
                        box.appendChild(img);
                    }
                }
                img.src = e.target.result;
            };
            reader.readAsDataURL(this.files[0]);
        }
    });
});
</script>

<?php adminFooter(); ?>
