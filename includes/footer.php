<!-- ===== FOOTER ===== -->
<footer class="footer">
    <div class="container">
        <div class="footer-grid">
            <div class="footer-about">
                <div class="footer-logo">
                    <div class="footer-logo-icon">🏫</div>
                    <div>
                        <div class="footer-logo-text"><?= s($settings, 'nama_sekolah') ?></div>
                        <div class="footer-logo-sub">Sekolah Dasar Unggulan</div>
                    </div>
                </div>
                <p class="footer-desc">
                    <?= s($settings, 'tagline') ?>. Kami berkomitmen menciptakan lingkungan belajar yang menyenangkan dan penuh inspirasi.
                </p>
                <div class="footer-sosmed">
                    <?php if (!empty($settings['instagram'])): ?>
                    <a href="<?= s($settings, 'instagram') ?>" class="footer-sosmed-link" target="_blank" title="Instagram">📸</a>
                    <?php endif; ?>
                    <?php if (!empty($settings['facebook'])): ?>
                    <a href="<?= s($settings, 'facebook') ?>" class="footer-sosmed-link" target="_blank" title="Facebook">👥</a>
                    <?php endif; ?>
                    <?php if (!empty($settings['youtube'])): ?>
                    <a href="<?= s($settings, 'youtube') ?>" class="footer-sosmed-link" target="_blank" title="YouTube">🎥</a>
                    <?php endif; ?>
                </div>
            </div>

            <div>
                <h4 class="footer-col-title">Menu Utama</h4>
                <ul class="footer-links">
                    <li><a href="index.php" class="footer-link">Beranda</a></li>
                    <li><a href="tentang.php" class="footer-link">Tentang Kami</a></li>
                    <li><a href="program.php" class="footer-link">Program</a></li>
                    <li><a href="galeri.php" class="footer-link">Galeri</a></li>
                    <li><a href="kontak.php" class="footer-link">Kontak</a></li>
                </ul>
            </div>

            <div>
                <h4 class="footer-col-title">Program</h4>
                <ul class="footer-links">
                    <li><a href="program.php" class="footer-link">Sains & Teknologi</a></li>
                    <li><a href="program.php" class="footer-link">Seni & Kreativitas</a></li>
                    <li><a href="program.php" class="footer-link">Olahraga</a></li>
                    <li><a href="program.php" class="footer-link">Literasi & Bahasa</a></li>
                    <li><a href="program.php" class="footer-link">Pendidikan Karakter</a></li>
                </ul>
            </div>

            <div>
                <h4 class="footer-col-title">Kontak Kami</h4>
                <div class="footer-contact-items">
                    <div class="footer-contact-item">
                        <span class="fc-icon">📍</span>
                        <span><?= s($settings, 'alamat') ?></span>
                    </div>
                    <div class="footer-contact-item">
                        <a href="#">📞  083844267561</a>
                    </div>
                    <div class="footer-contact-item">
                        <span class="fc-icon">✉️</span>
                        <span><?= s($settings, 'email') ?></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <p class="footer-copyright">
                © <?= date('Y') ?> <span><?= s($settings, 'nama_sekolah') ?></span>. Hak Cipta Dilindungi.
                Dibuat dengan ❤️ untuk pendidikan Indonesia.
            </p>
            <div class="footer-bottom-links">
                <a href="#" class="footer-bottom-link">Kebijakan Privasi</a>
                <a href="#" class="footer-bottom-link">Syarat & Ketentuan</a>
            </div>
        </div>
    </div>
</footer>

<!-- Back to Top -->
<button class="back-to-top" aria-label="Kembali ke atas">↑</button>

<!-- Scripts -->
<script src="js/main.js"></script>
</body>
</html>
