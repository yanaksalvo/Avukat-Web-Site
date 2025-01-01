<?php
include 'includes/config.php';
include 'includes/header.php';

// Site ayarlarını çek
$site_ayarlari = $db->query("SELECT * FROM site_ayarlari WHERE id = 1")->fetch();

// Slider'dan hero görseli al
$slider = $db->query("SELECT * FROM slider ORDER BY sira ASC LIMIT 1")->fetch();
$heroImage = 'uploads/slider/'.$slider['resim_url'];
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hukuki Hizmetlerimiz - <?php echo $site_ayarlari['site_baslik']; ?></title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/services.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <main class="services-page">
        <!-- Hero Section -->
        <section class="page-hero" style="background-image: url('<?php echo $heroImage; ?>')">
            <div class="hero-overlay"></div>
            <div class="hero-content">
                <h1>Hukuki Hizmetlerimiz</h1>
                <p class="subtitle" style="color: #d4af37;">Uzman kadromuzla tüm hukuki ihtiyaçlarınızda yanınızdayız</p>
            </div>
        </section>

        <!-- Hizmetler Listesi -->
        <section class="services-list">
            <div class="container">
                <?php
                $hizmetler = $db->query("SELECT * FROM hizmetler ORDER BY id ASC");
                while($hizmet = $hizmetler->fetch()) {
                    echo '<div class="service-item">
                        <div class="service-icon">
                            <i class="fas '.$hizmet['ikon'].'"></i>
                        </div>
                        <div class="service-content">
                            <h2>'.$hizmet['baslik'].'</h2>
                            <p>'.$hizmet['aciklama'].'</p>
                        </div>
                    </div>';
                }
                ?>
            </div>
        </section>

        <!-- İletişim CTA -->
        <section class="contact-cta">
            <div class="container">
                <div class="cta-content">
                    <div class="cta-text">
                        <h2>Hukuki Destek İçin Bize Ulaşın</h2>
                        <p>Size en uygun çözümü sunmak için hazırız</p>
                    </div>
                    <div class="cta-buttons">
                        <a href="iletisim.php" class="btn-primary">İletişime Geçin</a>
                        <?php if(!empty($site_ayarlari['whatsapp_telefon']) && $site_ayarlari['whatsapp_telefon'] != ''): ?>
                            <a href="https://wa.me/<?php echo $site_ayarlari['whatsapp_telefon']; ?>" class="btn-whatsapp" target="_blank">
                                <i class="fab fa-whatsapp"></i> WhatsApp
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <style>
    /* Hero/Slider Styles */
    .page-hero {
        height: 400px;
        position: relative;
        background-size: cover;
        background-position: center;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        color: #fff;
        margin-bottom: 60px;
    }

    .hero-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.7);
    }

    .hero-content {
        position: relative;
        z-index: 2;
        max-width: 800px;
        padding: 0 20px;
    }

    .hero-content h1 {
        font-size: 48px;
        margin-bottom: 20px;
        font-weight: 700;
    }

    .hero-content .subtitle {
        font-size: 18px;
        opacity: 0.9;
        margin: 0;
    }

    @media (max-width: 768px) {
        .page-hero {
            height: 300px;
        }
        
        .hero-content h1 {
            font-size: 36px;
        }
        
        .hero-content .subtitle {
            font-size: 16px;
        }
    }
    </style>

    <?php include 'includes/footer.php'; ?>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const serviceItems = document.querySelectorAll('.service-item');
            serviceItems.forEach((item, index) => {
                setTimeout(() => {
                    item.style.opacity = '1';
                    item.style.transform = 'translateY(0)';
                }, 200 * index);
            });
        });
    </script>
</body>
</html>
