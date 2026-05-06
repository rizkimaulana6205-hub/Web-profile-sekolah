<?php
require_once '../includes/config.php';
requireLogin();
require_once 'layout.php';

$db = getDB();
$pesan = '';
$tipe = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fields = ['visi', 'misi_1', 'misi_2', 'misi_3', 'misi_4'];
    $db->begin_transaction();
    try {
        foreach ($fields as $f) {
            $val = $_POST[$f] ?? '';
            $stmt = $db->prepare("INSERT INTO pengaturan (kunci, nilai) VALUES (?, ?) ON DUPLICATE KEY UPDATE nilai = VALUES(nilai)");
            $stmt->bind_param("ss", $f, $val);
            $stmt->execute();
        }
        $db->commit();
        $pesan = 'Visi & Misi berhasil disimpan!';
        $tipe = 'success';
    } catch (Exception $e) {
        $db->rollback();
        $pesan = 'Gagal: ' . $e->getMessage();
        $tipe = 'error';
    }
}

$res = $db->query("SELECT kunci, nilai FROM pengaturan WHERE kunci IN ('visi','misi_1','misi_2','misi_3','misi_4')");
$data = [];
while ($r = $res->fetch_assoc()) $data[$r['kunci']] = $r['nilai'];

function sv2($d, $k, $def = '') { return htmlspecialchars($d[$k] ?? $def); }

adminHeader('Visi & Misi', 'visi_misi');
?>
<div class="page-content" style="max-width:860px;">

    <?php if ($pesan): ?>
    <div class="alert alert-<?= $tipe ?>"><?= $tipe === 'success' ? '✅' : '❌' ?> <?= htmlspecialchars($pesan) ?></div>
    <?php endif; ?>

    <div class="card">
        <div class="card-header">
            <h2 class="card-title">🌟 Edit Visi & Misi</h2>
        </div>
        <div class="card-body">
            <form method="POST">
                <div class="form-group">
                    <label class="form-label" style="font-size:1rem;color:#1B5E20;">🌟 VISI SEKOLAH</label>
                    <textarea name="visi" class="form-textarea" style="min-height:120px;" placeholder="Masukkan visi sekolah..."><?= sv2($data,'visi') ?></textarea>
                </div>

                <div style="margin-top:8px;margin-bottom:12px;">
                    <label class="form-label" style="font-size:1rem;color:#1B5E20;">🎯 MISI SEKOLAH</label>
                    <p class="form-hint">Isi misi sekolah (maksimal 4 poin misi)</p>
                </div>

                <?php for ($i = 1; $i <= 4; $i++): ?>
                <div class="form-group" style="display:flex;gap:12px;align-items:flex-start;">
                    <div style="width:36px;height:36px;background:#2E7D32;color:white;border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:800;flex-shrink:0;margin-top:2px;"><?= $i ?></div>
                    <div style="flex:1;">
                        <textarea name="misi_<?= $i ?>" class="form-textarea" style="min-height:90px;" placeholder="Misi ke-<?= $i ?> (kosongkan jika tidak dipakai)"><?= sv2($data,'misi_'.$i) ?></textarea>
                    </div>
                </div>
                <?php endfor; ?>

                <div class="form-actions">
                    <button type="submit" class="btn btn-green">💾 Simpan Visi & Misi</button>
                    <a href="dashboard.php" class="btn btn-outline">↩ Kembali</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Preview -->
    <div class="card" style="margin-top:24px;">
        <div class="card-header">
            <h2 class="card-title">👁️ Preview</h2>
        </div>
        <div class="card-body">
            <div style="background:#1B5E20;color:white;border-radius:12px;padding:24px;margin-bottom:16px;">
                <div style="font-size:1.4rem;font-weight:900;font-family:'Fredoka One',cursive;margin-bottom:12px;">🌟 Visi</div>
                <p style="opacity:0.9;line-height:1.8;"><?= htmlspecialchars($data['visi'] ?? '-') ?></p>
            </div>
            <div style="background:white;border:2px solid #C8E6C9;border-radius:12px;padding:24px;">
                <div style="font-size:1.4rem;font-weight:900;font-family:'Fredoka One',cursive;color:#1B5E20;margin-bottom:16px;">🎯 Misi</div>
                <?php for ($i = 1; $i <= 4; $i++): if (!empty($data["misi_$i"])): ?>
                <div style="display:flex;gap:12px;align-items:flex-start;padding:10px 0;border-bottom:1px solid #E8F5E9;">
                    <span style="width:28px;height:28px;background:#2E7D32;color:white;border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:800;font-size:0.85rem;flex-shrink:0;"><?= $i ?></span>
                    <p style="color:#424242;line-height:1.7;"><?= htmlspecialchars($data["misi_$i"]) ?></p>
                </div>
                <?php endif; endfor; ?>
            </div>
        </div>
    </div>
</div>
<?php adminFooter(); ?>
