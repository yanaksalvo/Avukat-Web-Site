<?php
mb_internal_encoding('UTF-8');
header('Content-Type: text/html; charset=utf-8');
?>
<footer>
    <div class="container">
        <div class="footer-grid">
            <!-- İletişim Bilgileri -->
            <div class="footer-section">
                <h3>İletişim Bilgileri</h3>
                <?php
                $iletisim = $db->query("SELECT * FROM iletisim_bilgileri WHERE id = 1")->fetch();
                ?>
                <ul class="footer-links">
                    <li>
                        <i class="fas fa-map-marker-alt"></i>
                        <span><?php echo htmlspecialchars($iletisim['adres'], ENT_QUOTES, 'UTF-8'); ?></span>
                    </li>
                    <li>
                        <i class="fas fa-phone"></i>
                        <span><?php echo htmlspecialchars($iletisim['telefon'], ENT_QUOTES, 'UTF-8'); ?></span>
                    </li>
                    <li>
                        <i class="fas fa-envelope"></i>
                        <span><?php echo htmlspecialchars($iletisim['email'], ENT_QUOTES, 'UTF-8'); ?></span>
                    </li>
                    <li>
                        <i class="fas fa-clock"></i>
                        <span><?php echo htmlspecialchars($iletisim['calismaSaatleri'], ENT_QUOTES, 'UTF-8'); ?></span>
                    </li>
                </ul>
            </div>

            <!-- Hızlı Linkler -->
            <div class="footer-section">
                <h3>Hızlı Linkler</h3>
                <ul class="footer-links">
                    <li><a href="index.php">Ana Sayfa</a></li>
                    <li><a href="hakkimda.php">Hakkımda</a></li>
                    <li><a href="hizmetler.php">Hizmetler</a></li>
                    <li><a href="iletisim.php">İletişim</a></li>
                </ul>
            </div>

            <!-- Sosyal Medya -->
            <div class="footer-section">
                <h3>Sosyal Medya</h3>
                <div class="social-links">
                    <a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" target="_blank"><i class="fab fa-twitter"></i></a>
                    <a href="#" target="_blank"><i class="fab fa-instagram"></i></a>
                    <a href="#" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
        </div>

        <div class="copyright">
            <p>&copy; <?php echo date('Y'); ?> Tüm Hakları Saklıdır</p>
        </div>
    </div>

    <!-- Yukarı Çık Butonu -->
    <div class="scroll-top">
        <i class="fas fa-arrow-up"></i>
    </div>
</footer>

<script>
// Yukarı Çık Butonu İşlevi
window.addEventListener('scroll', function() {
    const scrollTop = document.querySelector('.scroll-top');
    if (window.pageYOffset > 300) {
        scrollTop.classList.add('active');
    } else {
        scrollTop.classList.remove('active');
    }
});

document.querySelector('.scroll-top').addEventListener('click', function() {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
});
</script>

</body>
</html>
