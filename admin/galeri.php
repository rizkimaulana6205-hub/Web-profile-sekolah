<?php
require_once '../includes/config.php';
requireLogin();
require_once 'layout.php';

$db = getDB();
$pesan = '';
$tipe = '';

// Delete
if (isset($_GET['hapus'])) {
    $id = (int)$_GET['hapus'];
    $row = $db->query("SELECT foto FROM galeri WHERE id=$id")->fetch_assoc();
    if ($row && $row['foto'] && file_exists("../img/" . $row['foto'])) {
        unlink("../img/" . $row['foto']);
    }
    $db->query("DELETE FROM galeri WHERE id=$id");
    $pesan = 'Foto berhasil dihapus.';
    $tipe = 'success';
}

// Toggle aktif
if (isset($_GET['toggle'])) {
    $id = (int)$_GET['toggle'];
    $db->query("UPDATE galeri SET aktif = !aktif WHERE id=$id");
    redirect('../admin/galeri.php');
}

// Edit mode
$editData = null;
if (isset($_GET['edit'])) {
    $id = (int)$_GET['edit'];
    $editData = $db->query("SELECT * FROM galeri WHERE id=$id")->fetch_assoc();
}

// POST (tambah/update)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id       = (int)($_POST['id'] ?? 0);
    $judul    = sanitize($_POST['judul'] ?? '');
    $deskripsi = $_POST['deskripsi'] ?? '';
    $kategori = sanitize($_POST['kategori'] ?? 'kegiatan');
    $tanggal  = sanitize($_POST['tanggal'] ?? date('Y-m-d'));
    $aktif    = isset($_POST['aktif']) ? 1 : 0;

    $fotoName = $editData['foto'] ?? '';

    if (!empty($_FILES['foto']['name'])) {
        $upload = uploadImage($_FILES['foto'], 'img/');
        if ($upload['success']) {
            $fotoName = $upload['filename'];
        } else {
            $pesan = $upload['message'];
            $tipe = 'error';
        }
    }

    if (empty($pesan) && !empty($judul) && !empty($fotoName)) {
        if ($id > 0) {
            $stmt = $db->prepare("UPDATE galeri SET judul=?, deskripsi=?, foto=?, kategori=?, tanggal=?, aktif=? WHERE id=?");
            $stmt->bind_param("sssssii", $judul, $deskripsi, $fotoName, $kategori, $tanggal, $aktif, $id);
        } else {
            $stmt = $db->prepare("INSERT INTO galeri (judul, deskripsi, foto, kategori, tanggal, aktif) VALUES (?,?,?,?,?,?)");
            $stmt->bind_param("sssssi", $judul, $deskripsi, $fotoName, $kategori, $tanggal, $aktif);
        }
        if ($stmt->execute()) {
            $pesan = $id > 0 ? 'Foto berhasil diperbarui!' : 'Foto berhasil ditambahkan!';
            $tipe = 'success';
            $editData = null;
        } else {
            $pesan = 'Gagal menyimpan.';
            $tipe = 'error';
        }
    } elseif (empty($pesan)) {
        $pesan = 'Judul dan foto wajib diisi!';
        $tipe = 'error';
    }
}

// Pagination
$page = max(1, (int)($_GET['page'] ?? 1));
$perPage = 12;
$offset = ($page - 1) * $perPage;
$total = $db->query("SELECT COUNT(*) c FROM galeri")->fetch_assoc()['c'];
$totalPages = ceil($total / $perPage);

$galeriList = $db->query("SELECT * FROM galeri ORDER BY created_at DESC LIMIT $offset, $perPage");

adminHeader('Galeri Kegiatan', 'galeri');
?>
<div class="page-content">

    <?php if ($pesan): ?>
    <div class="alert alert-<?= $tipe ?>"><?= $tipe === 'success' ? '✅' : '❌' ?> <?= htmlspecialchars($pesan) ?></div>
    <?php endif; ?>

    <div style="display:grid;grid-template-columns:1fr 2fr;gap:24px;align-items:start;">

        <!-- Form Upload -->
        <div class="card" style="position:sticky;top:90px;">
            <div class="card-header">
                <h2 class="card-title">📸 <?= $editData ? 'Edit' : 'Upload' ?> Foto</h2>
            </div>
            <div class="card-body">
                <form method="POST" enctype="multipart/form-data">
                    <?php if ($editData): ?>
                    <input type="hidden" name="id" value="<?= $editData['id'] ?>">
                    <?php endif; ?>

                    <div class="form-group">
                        <label class="form-label">Foto *</label>
                        <div class="img-preview-box" style="width:100%;height:200px;" id="fotoBox" onclick="document.getElementById('fotoInput').click()">
                            <?php if (!empty($editData['foto'])): ?>
                            <img src="../img/<?= htmlspecialchars($editData['foto']) ?>" style="width:100%;height:100%;object-fit:cover;">
                            <?php else: ?>
                            <div class="img-preview-placeholder">
                                <span style="font-size:3rem;">🖼️</span>
                                <p>Klik untuk upload foto</p>
                                <p style="font-size:0.72rem;margin-top:4px;">JPG/PNG/GIF max 5MB</p>
                            </div>
                            <?php endif; ?>
                        </div>
                        <input type="file" id="fotoInput" name="foto" accept="image/*" style="display:none;"
                               onchange="previewImg(this,'fotoBox')" <?= !$editData ? 'required' : '' ?>>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Judul *</label>
                        <input type="text" name="judul" class="form-input" required
                               value="<?= htmlspecialchars($editData['judul'] ?? '') ?>"
                               placeholder="Judul foto atau kegiatan">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="deskripsi" class="form-textarea" style="min-height:80px;"
                                  placeholder="Deskripsi singkat kegiatan"><?= htmlspecialchars($editData['deskripsi'] ?? '') ?></textarea>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Kategori</label>
                        <select name="kategori" class="form-select">
                            <?php foreach(['kegiatan'=>'🎉 Kegiatan','prestasi'=>'🏆 Prestasi','fasilitas'=>'🏫 Fasilitas','umum'=>'📷 Umum'] as $val=>$lab): ?>
                            <option value="<?= $val ?>" <?= ($editData['kategori'] ?? 'kegiatan') === $val ? 'selected' : '' ?>><?= $lab ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Tanggal</label>
                        <input type="date" name="tanggal" class="form-input"
                               value="<?= htmlspecialchars($editData['tanggal'] ?? date('Y-m-d')) ?>">
                    </div>

                    <div class="form-group">
                        <label style="display:flex;align-items:center;gap:8px;cursor:pointer;">
                            <input type="checkbox" name="aktif" <?= ($editData['aktif'] ?? 1) ? 'checked' : '' ?> style="width:18px;height:18px;">
                            <span class="form-label" style="margin:0;">Tampilkan di website</span>
                        </label>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-green">💾 Simpan</button>
                        <?php if ($editData): ?>
                        <a href="galeri.php" class="btn btn-outline">↩ Batal</a>
                        <?php endif; ?>
                    </div>
                </form>
            </div>
        </div>

        <!-- Galeri Grid -->
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">🖼️ Daftar Foto (<?= $total ?>)</h2>
                <span style="font-size:0.82rem;color:#757575;">Halaman <?= $page ?>/<?= $totalPages ?></span>
            </div>
            <div class="card-body">
                <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:14px;">
                    <?php while ($g = $galeriList->fetch_assoc()): ?>
                    <div style="border-radius:10px;overflow:hidden;border:2px solid <?= $g['aktif'] ? '#C8E6C9' : '#EEEEEE' ?>;background:#fafafa;position:relative;">
                        <div style="width:100%;aspect-ratio:4/3;overflow:hidden;background:#E8F5E9;display:flex;align-items:center;justify-content:center;">
                            <?php if ($g['foto'] && file_exists('../img/' . $g['foto'])): ?>
                            <img src="../img/<?= htmlspecialchars($g['foto']) ?>" style="width:100%;height:100%;object-fit:cover;">
                            <?php else: ?>
                            <span style="font-size:3rem;">📷</span>
                            <?php endif; ?>
                        </div>
                        <?php if (!$g['aktif']): ?>
                        <div style="position:absolute;top:6px;left:6px;background:rgba(0,0,0,0.6);color:white;font-size:0.7rem;font-weight:800;padding:3px 8px;border-radius:99px;">Hidden</div>
                        <?php endif; ?>
                        <div style="padding:10px 12px;">
                            <div style="font-weight:800;font-size:0.83rem;margin-bottom:4px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;" title="<?= htmlspecialchars($g['judul']) ?>">
                                <?= htmlspecialchars($g['judul']) ?>
                            </div>
                            <span class="badge badge-<?= ['kegiatan'=>'green','prestasi'=>'yellow','fasilitas'=>'blue','umum'=>'blue'][$g['kategori']] ?? 'green' ?>" style="font-size:0.7rem;margin-bottom:8px;display:inline-flex;">
                                <?= ucfirst($g['kategori']) ?>
                            </span>
                            <div style="display:flex;gap:4px;margin-top:6px;">
                                <a href="?edit=<?= $g['id'] ?>" class="btn btn-yellow btn-sm" style="flex:1;justify-content:center;">✏️</a>
                                <a href="?toggle=<?= $g['id'] ?>" class="btn btn-outline btn-sm" title="<?= $g['aktif'] ? 'Sembunyikan' : 'Tampilkan' ?>" style="flex:1;justify-content:center;"><?= $g['aktif'] ? '👁️' : '🙈' ?></a>
                                <a href="?hapus=<?= $g['id'] ?>" class="btn btn-red btn-sm btn-delete" style="flex:1;justify-content:center;">🗑️</a>
                            </div>
                        </div>
                    </div>
                    <?php endwhile; ?>
                </div>

                <!-- Pagination -->
                <?php if ($totalPages > 1): ?>
                <div class="pagination">
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <a href="?page=<?= $i ?>" class="page-link <?= $i == $page ? 'active' : '' ?>"><?= $i ?></a>
                    <?php endfor; ?>
                </div>
                <?php endif; ?>
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
    btn.addEventListener('click', e => { if (!confirm('Yakin hapus foto ini?')) e.preventDefault(); });
});
</script>

<?php adminFooter(); ?>
