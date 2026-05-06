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
    $db->query("DELETE FROM program WHERE id=$id");
    $pesan = 'Program berhasil dihapus.'; $tipe = 'success';
}

// Toggle
if (isset($_GET['toggle'])) {
    $id = (int)$_GET['toggle'];
    $db->query("UPDATE program SET aktif = !aktif WHERE id=$id");
    redirect('../admin/program.php');
}

// Edit mode
$editData = null;
if (isset($_GET['edit'])) {
    $id = (int)$_GET['edit'];
    $editData = $db->query("SELECT * FROM program WHERE id=$id")->fetch_assoc();
}

// POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int)($_POST['id'] ?? 0);
    $nama  = sanitize($_POST['nama_program'] ?? '');
    $desk  = $_POST['deskripsi'] ?? '';
    $ikon  = sanitize($_POST['ikon'] ?? '📌');
    $warna = sanitize($_POST['warna'] ?? '#2E7D32');
    $urutan = (int)($_POST['urutan'] ?? 0);
    $aktif = isset($_POST['aktif']) ? 1 : 0;

    if (!empty($nama)) {
        if ($id > 0) {
            $stmt = $db->prepare("UPDATE program SET nama_program=?,deskripsi=?,ikon=?,warna=?,urutan=?,aktif=? WHERE id=?");
            $stmt->bind_param("sssssii", $nama,$desk,$ikon,$warna,$urutan,$aktif,$id);
        } else {
            $stmt = $db->prepare("INSERT INTO program (nama_program,deskripsi,ikon,warna,urutan,aktif) VALUES (?,?,?,?,?,?)");
            $stmt->bind_param("ssssii", $nama,$desk,$ikon,$warna,$urutan,$aktif);
        }
        if ($stmt->execute()) {
            $pesan = $id > 0 ? 'Program diperbarui!' : 'Program ditambahkan!';
            $tipe = 'success'; $editData = null;
        } else { $pesan = 'Gagal.'; $tipe = 'error'; }
    } else { $pesan = 'Nama wajib diisi.'; $tipe = 'error'; }
}

$programs = $db->query("SELECT * FROM program ORDER BY urutan ASC");

adminHeader('Program Unggulan', 'program');
?>
<div class="page-content">

    <?php if ($pesan): ?>
    <div class="alert alert-<?= $tipe ?>"><?= $tipe === 'success' ? '✅' : '❌' ?> <?= htmlspecialchars($pesan) ?></div>
    <?php endif; ?>

    <div style="display:grid;grid-template-columns:1fr 1.5fr;gap:24px;align-items:start;">

        <!-- Form -->
        <div class="card" style="position:sticky;top:90px;">
            <div class="card-header">
                <h2 class="card-title">📚 <?= $editData ? 'Edit' : 'Tambah' ?> Program</h2>
            </div>
            <div class="card-body">
                <form method="POST">
                    <?php if ($editData): ?>
                    <input type="hidden" name="id" value="<?= $editData['id'] ?>">
                    <?php endif; ?>

                    <div class="form-group">
                        <label class="form-label">Nama Program *</label>
                        <input type="text" name="nama_program" class="form-input" required
                               value="<?= htmlspecialchars($editData['nama_program'] ?? '') ?>"
                               placeholder="cth: Belajar Sains & Teknologi">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="deskripsi" class="form-textarea"><?= htmlspecialchars($editData['deskripsi'] ?? '') ?></textarea>
                    </div>
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">Ikon (Emoji)</label>
                            <input type="text" name="ikon" class="form-input"
                                   value="<?= htmlspecialchars($editData['ikon'] ?? '📌') ?>"
                                   placeholder="🔬">
                            <p class="form-hint">Copy-paste emoji dari keyboard</p>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Warna Aksen</label>
                            <input type="color" name="warna" class="form-input" style="height:42px;padding:4px;"
                                   value="<?= htmlspecialchars($editData['warna'] ?? '#2E7D32') ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Urutan Tampil</label>
                        <input type="number" name="urutan" class="form-input" min="0"
                               value="<?= (int)($editData['urutan'] ?? 0) ?>">
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
                        <a href="program.php" class="btn btn-outline">↩ Batal</a>
                        <?php endif; ?>
                    </div>
                </form>
            </div>
        </div>

        <!-- List -->
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">📋 Daftar Program</h2>
            </div>
            <div class="table-wrap">
                <table>
                    <thead><tr><th>#</th><th>Program</th><th>Status</th><th>Aksi</th></tr></thead>
                    <tbody>
                        <?php while ($p = $programs->fetch_assoc()): ?>
                        <tr>
                            <td style="width:40px;font-size:1.5rem;"><?= $p['ikon'] ?></td>
                            <td>
                                <div style="font-weight:800;font-size:0.9rem;"><?= htmlspecialchars($p['nama_program']) ?></div>
                                <div style="color:#757575;font-size:0.8rem;"><?= htmlspecialchars(mb_strimwidth($p['deskripsi'], 0, 60, '...')) ?></div>
                            </td>
                            <td><span class="badge badge-<?= $p['aktif'] ? 'green' : 'red' ?>"><?= $p['aktif'] ? 'Aktif' : 'Nonaktif' ?></span></td>
                            <td>
                                <div style="display:flex;gap:4px;">
                                    <a href="?edit=<?= $p['id'] ?>" class="btn btn-yellow btn-sm">✏️</a>
                                    <a href="?toggle=<?= $p['id'] ?>" class="btn btn-outline btn-sm"><?= $p['aktif'] ? '👁️' : '🙈' ?></a>
                                    <a href="?hapus=<?= $p['id'] ?>" class="btn btn-red btn-sm btn-delete">🗑️</a>
                                </div>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
<script>
document.querySelectorAll('.btn-delete').forEach(btn => {
    btn.addEventListener('click', e => { if (!confirm('Yakin hapus program ini?')) e.preventDefault(); });
});
</script>
<?php adminFooter(); ?>
