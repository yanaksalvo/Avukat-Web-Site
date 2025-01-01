<?php
include 'includes/config.php';
include 'includes/header.php';

if(isset($_POST['submit'])) {
    $ad_soyad = $_POST['ad_soyad'];
    $email = $_POST['email'];
    $telefon = $_POST['telefon'];
    $konu = $_POST['konu'];
    $mesaj = $_POST['mesaj'];
   
    $stmt = $db->prepare("INSERT INTO mesajlar (ad_soyad, email, telefon, konu, mesaj) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$ad_soyad, $email, $telefon, $konu, $mesaj]);
   
    $success = "Mesajınız başarıyla gönderildi.";
}

// Site ayarlarını çek
$site_ayarlari = $db->query("SELECT * FROM site_ayarlari WHERE id = 1")->fetch();

// Slider'dan rastgele görsel al
$sliderImage = $db->query("SELECT resim_url FROM slider ORDER BY RAND() LIMIT 1")->fetch();
$heroBackground = 'uploads/slider/' . $sliderImage['resim_url'];
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>İletişim - <?php echo $site_ayarlari['site_baslik']; ?></title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/contact.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <main class="contact-page">
        <section class="contact-hero" style="background-image: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('<?php echo $heroBackground; ?>')">
            <div class="contact-hero-content">
                <h1>İletişim</h1>
                <p>Hukuki danışmanlık için bizimle iletişime geçin</p>
            </div>
        </section>

        <section class="contact-content">
            <div class="container">
                <div class="contact-grid">
                    <div class="contact-info">
                        <h2>İletişim Bilgileri</h2>
                        
                        <div class="info-items">
                            <div class="info-item">
                                <i class="fas fa-map-marker-alt"></i>
                                <div class="info-text">
                                    <h3>Adres</h3>
                                    <p><?php echo $site_ayarlari['adres']; ?></p>
                                </div>
                            </div>

                            <div class="info-item">
                                <i class="fas fa-phone"></i>
                                <div class="info-text">
                                    <h3>Telefon</h3>
                                    <p><?php echo $site_ayarlari['telefon']; ?></p>
                                </div>
                            </div>

                            <div class="info-item">
                                <i class="fas fa-envelope"></i>
                                <div class="info-text">
                                    <h3>E-posta</h3>
                                    <p><?php echo $site_ayarlari['email']; ?></p>
                                </div>
                            </div>

                            <div class="info-item">
                                <i class="fas fa-clock"></i>
                                <div class="info-text">
                                    <h3>Çalışma Saatleri</h3>
                                    <p><?php echo $site_ayarlari['calisma_saatleri']; ?></p>
                                </div>
                            </div>
                        </div>

                        <div class="social-links">
                            <?php if($site_ayarlari['facebook']): ?>
                                <a href="<?php echo $site_ayarlari['facebook']; ?>" target="_blank"><i class="fab fa-facebook"></i></a>
                            <?php endif; ?>
                            
                            <?php if($site_ayarlari['twitter']): ?>
                                <a href="<?php echo $site_ayarlari['twitter']; ?>" target="_blank"><i class="fab fa-twitter"></i></a>
                            <?php endif; ?>
                            
                            <?php if($site_ayarlari['instagram']): ?>
                                <a href="<?php echo $site_ayarlari['instagram']; ?>" target="_blank"><i class="fab fa-instagram"></i></a>
                            <?php endif; ?>
                            
                            <?php if($site_ayarlari['linkedin']): ?>
                                <a href="<?php echo $site_ayarlari['linkedin']; ?>" target="_blank"><i class="fab fa-linkedin"></i></a>
                            <?php endif; ?>
                        </div>

                        <div class="map-container">
                            <?php echo $site_ayarlari['maps_code']; ?>
                        </div>
                    </div>
                      <div class="contact-form">
                          <h2>Bize Ulaşın</h2>
                        
                          <?php if(isset($success)): ?>
                              <div class="success-message">
                                  <i class="fas fa-check-circle"></i>
                                  <?php echo $success; ?>
                              </div>
                          <?php endif; ?>

                          <form method="POST" action="">
                              <div class="form-group">
                                  <label for="ad_soyad">Ad Soyad</label>
                                  <input type="text" id="ad_soyad" name="ad_soyad" required>
                              </div>

                              <div class="form-group">
                                  <label for="email">E-posta</label>
                                  <input type="email" id="email" name="email" required>
                              </div>

                              <div class="form-group">
                                  <label for="telefon">Telefon</label>
                                  <input type="tel" id="telefon" name="telefon" pattern="[0-9]{10,11}" placeholder="05xxxxxxxxx" required>
                              </div>

                              <div class="form-group">
                                  <label for="konu">Konu</label>
                                  <input type="text" id="konu" name="konu" required>
                              </div>

                              <div class="form-group">
                                  <label for="mesaj">Mesajınız</label>
                                  <textarea id="mesaj" name="mesaj" rows="5" required></textarea>
                              </div>

                              <div class="form-buttons">
                                  <button type="submit" name="submit" class="btn-submit">
                                      <i class="fas fa-paper-plane"></i> Gönder
                                  </button>
                                
                                  <?php if(!empty($site_ayarlari['whatsapp_telefon'])): ?>
                                      <a href="https://wa.me/<?php echo $site_ayarlari['whatsapp_telefon']; ?>" class="btn-whatsapp" target="_blank">
                                          <i class="fab fa-whatsapp"></i> WhatsApp
                                      </a>
                                  <?php endif; ?>
                              </div>
                          </form>
                      </div>
                  </div>
            </div>
        </section>
    </main>

    <?php include 'includes/footer.php'; ?>

    <script src="js/main.js"></script>
</body>
</html>
