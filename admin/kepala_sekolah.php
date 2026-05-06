<?php
require_once '../includes/config.php';
requireLogin();
require_once 'layout.php';

$db = getDB();
$pesan = '';
$tipe = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id       = (int)($_POST['id'] ?? 0);
    $nama     = sanitize($_POST['nama'] ?? '');
    $nip      = sanitize($_POST['nip'] ?? '');
    $pendidikan = sanitize($_POST['pendidikan'] ?? '');
    $periode  = sanitize($_POST['periode'] ?? '');
    $sambutan = $_POST['sambutan'] ?? '';
    $aktif    = isset($_POST['aktif']) ? 1 : 0;

    $fotoName = '';
    if (!empty($_FILES['foto']['name'])) {
        $upload = uploadImage($_FILES['foto'], 'img/');
        if ($upload['success']) {
            $fotoName = $upload['filename'];
        } else {
            $pesan = $upload['message'];
            $tipe = 'error';
        }
    }

    if (empty($pesan)) {
        if ($id > 0) {
            // Update
            if ($fotoName) {
                $stmt = $db->prepare("UPDATE kepala_sekolah SET nama=?, nip=?, pendidikan=?, periode=?, sambutan=?, foto=?, aktif=? WHERE id=?");
                $stmt->bind_param("ssssssii", $nama, $nip, $pendidikan, $periode, $sambutan, $fotoName, $aktif, $id);
            } else {
                $stmt = $db->prepare("UPDATE kepala_sekolah SET nama=?, nip=?, pendidikan=?, periode=?, sambutan=?, aktif=? WHERE id=?");
                $stmt->bind_param("sssssi i", $nama, $nip, $pendidikan, $periode, $sambutan, $aktif, $id);
            }
        } else {
            // Insert
            $stmt = $db->prepare("INSERT INTO kepala_sekolah (nama, nip, pendidikan, periode, sambutan, foto, aktif) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssssi", $nama, $nip, $pendidikan, $periode, $sambutan, $fotoName, $aktif);
        }

        if ($stmt->execute()) {
            $pesan = $id > 0 ? 'Data berhasil diperbarui!' : 'Data berhasil ditambahkan!';
            $tipe = 'success';
        } else {
            $pesan = 'Gagal menyimpan data.';
            $tipe = 'error';
        }
    }
}

// Handle delete
if (isset($_GET['hapus'])) {
    $id = (int)$_GET['hapus'];
    $db->query("DELETE FROM kepala_sekolah WHERE id = $id");
    $pesan = 'Data berhasil dihapus.';
    $tipe = 'success';
}

// Edit mode
$editData = null;
if (isset($_GET['edit'])) {
    $id = (int)$_GET['edit'];
    $editData = $db->query("SELECT * FROM kepala_sekolah WHERE id = $id")->fetch_assoc();
}

$list = $db->query("SELECT * FROM kepala_sekolah ORDER BY id DESC");

adminHeader('Kepala Sekolah', 'kepala_sekolah');
?>
<div class="page-content">

    <?php if ($pesan): ?>
    <div class="alert alert-<?= $tipe ?>">
        <?= $tipe === 'success' ? '✅' : '❌' ?> <?= htmlspecialchars($pesan) ?>
    </div>
    <?php endif; ?>

    <div style="display:grid;grid-template-columns:1.2fr 1fr;gap:24px;align-items:start;">

        <!-- Form -->
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">👩‍💼 <?= $editData ? 'Edit' : 'Tambah' ?> Kepala Sekolah</h2>
            </div>
            <div class="card-body">
                <form method="POST" enctype="multipart/form-data">
                    <?php if ($editData): ?>
                    <input type="hidden" name="id" value="<?= $editData['id'] ?>">
                    <?php endif; ?>

                    <div class="form-group">
                        <label class="form-label">Nama Lengkap + Gelar *</label>
                        <input type="text" name="nama" class="form-input"
                               value="<?= htmlspecialchars($editData['nama'] ?? '') ?>" required
                               placeholder="cth: Dra. Siti Rahayu, M.Pd">
                    </div>
                    <div class="form-group">
                        <label class="form-label">NIP</label>
                        <input type="text" name="nip" class="form-input"
                               value="<?= htmlspecialchars($editData['nip'] ?? '') ?>"
                               placeholder="Nomor Induk Pegawai">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Pendidikan Terakhir</label>
                        <input type="text" name="pendidikan" class="form-input"
                               value="<?= htmlspecialchars($editData['pendidikan'] ?? '') ?>"
                               placeholder="cth: S2 Manajemen Pendidikan - UNJ">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Periode Menjabat</label>
                        <input type="text" name="periode" class="form-input"
                               value="<?= htmlspecialchars($editData['periode'] ?? '') ?>"
                               placeholder="cth: 2020 - Sekarang">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Sambutan / Bio</label>
                        <textarea name="sambutan" class="form-textarea" style="min-height:140px;"><?= htmlspecialchars($editData['sambutan'] ?? '') ?></textarea>
                    </div>

                    <!-- Foto -->
                    <div class="form-group">
                        <label class="form-label">Foto</label>
                        <div style="display:flex;gap:16px;align-items:flex-start;">
                            <div class="img-preview-box" id="fotoBox">
                                <?php if (!empty($editData['foto'])): ?>
                                <img src="../img/<?= htmlspecialchars($editData['foto']) ?>" alt="Foto" id="fotoPreview">
                                <?php else: ?>
                                <div class="img-preview-placeholder">
                                    <span>📷</span><p>Upload Foto</p>
                                </div>
                                <?php endif; ?>
                            </div>
                            <div>
                                <input type="file" id="fotoInput" name="foto" accept="image/*" style="display:none;"
                                       onchange="previewImg(this,'fotoBox')">
                                <button type="button" class="btn btn-outline" onclick="document.getElementById('fotoInput').click()">📤 Pilih Foto</button>
                                <p class="form-hint" style="margin-top:8px;">JPG/PNG, max 5MB<br>Disarankan: 400x500px</p>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label style="display:flex;align-items:center;gap:8px;cursor:pointer;">
                            <input type="checkbox" name="aktif" <?= ($editData['aktif'] ?? 1) ? 'checked' : '' ?> style="width:18px;height:18px;">
                            <span class="form-label" style="margin:0;">Tampilkan sebagai kepala sekolah aktif</span>
                        </label>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-green">💾 Simpan</button>
                        <?php if ($editData): ?>
                        <a href="kepala_sekolah.php" class="btn btn-outline">↩ Batal</a>
                        <?php endif; ?>
                    </div>
                </form>
            </div>
        </div>

        <!-- List -->
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">📋 Daftar Kepala Sekolah</h2>
            </div>
            <div class="card-body" style="padding:0;">
                <?php while ($ks = $list->fetch_assoc()): ?>
                <div style="display:flex;gap:14px;align-items:center;padding:16px 20px;border-bottom:1px solid #eee;">
                    <div style="width:56px;height:56px;border-radius:10px;overflow:hidden;flex-shrink:0;background:#E8F5E9;display:flex;align-items:center;justify-content:center;font-size:2rem;">
                        <?php if ($ks['foto']): ?>
                        <img src="../img/<?= htmlspecialchars($ks['foto']) ?>" style="width:100%;height:100%;object-fit:cover;">
                        <?php else: ?>
                        👩‍💼
                        <?php endif; ?>
                    </div>
                    <div style="flex:1;min-width:0;">
                        <div style="font-weight:800;font-size:0.92rem;"><?= htmlspecialchars($ks['nama']) ?></div>
                        <div style="font-size:0.78rem;color:#757575;"><?= htmlspecialchars($ks['periode'] ?? '') ?></div>
                        <span class="badge <?= $ks['aktif'] ? 'badge-green' : 'badge-red' ?>" style="margin-top:4px;">
                            <?= $ks['aktif'] ? 'Aktif' : 'Non-aktif' ?>
                        </span>
                    </div>
                    <div style="display:flex;gap:6px;flex-shrink:0;">
                        <a href="?edit=<?= $ks['id'] ?>" class="btn btn-yellow btn-sm">✏️</a>
                        <a href="?hapus=<?= $ks['id'] ?>" class="btn btn-red btn-sm btn-delete">🗑️</a>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
        </div>

    </div>
</div>

<script>
function previewImg(input, boxId) {
    if (input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            const box = document.getElementById(boxId);
            box.innerHTML = `<img src="${e.target.result}" style="width:100%;height:100%;object-fit:cover;">`;
        };
        reader.readAsDataURL(input.files[0]);
    }
}
document.querySelectorAll('.btn-delete').forEach(btn => {
    btn.addEventListener('click', e => { if (!confirm('Yakin hapus data ini?')) e.preventDefault(); });
});
</script>

<?php adminFooter(); ?>
