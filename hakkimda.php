<?php
include 'includes/config.php';
include 'includes/header.php';

// Site ayarlarını al
$site_ayarlari = $db->query("SELECT * FROM site_ayarlari WHERE id = 1")->fetch();

// Slider görseli al
$slider = $db->query("SELECT * FROM slider ORDER BY sira ASC LIMIT 1")->fetch();
$sliderImage = 'uploads/slider/'.$slider['resim_url'];
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hakkımda - <?php echo $site_ayarlari['site_baslik']; ?></title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <main class="about-page">
        <!-- Hero Section -->
        <section class="page-hero" style="background-image: url('<?php echo $sliderImage; ?>')">
            <div class="hero-overlay"></div>
            <div class="hero-content">
                <h1><?php echo $site_ayarlari['logotype']; ?></h1>
                <p class="subtitle" style="color: #d4af37;"><?php echo $site_ayarlari['deneyim_yili']; ?> Yıllık Hukuk Deneyimi</p>
            </div>
        </section>

        <!-- Profil Bilgileri -->
        <section class="about-info">
            <div class="container">
                <div class="profile-section">
                    <div class="profile-image">
                        <img src="uploads/<?php echo $site_ayarlari['avukat_gorsel']; ?>" alt="<?php echo $site_ayarlari['logotype']; ?>">
                    </div>
                    <div class="profile-text">
                        <div class="section-header">
                            <h2><?php echo $site_ayarlari['logotype']; ?></h2>
                        </div>
                        <!-- Biyografi -->
                        <div class="profile-description">
                            <?php echo nl2br($site_ayarlari['biyografi']); ?>
                        </div>
                        <!-- Eğitim -->
                        <div class="info-block">
                            <h3>Eğitim</h3>
                            <ul class="info-list">
                                <?php
                                if(!empty($site_ayarlari['egitim'])) {
                                    $egitimler = explode("\n", $site_ayarlari['egitim']);
                                    foreach($egitimler as $egitim) {
                                        if(trim($egitim) != '') {
                                            echo '<li><i class="fas fa-graduation-cap" style="color: #d4af37;"></i> '.trim($egitim).'</li>';
                                        }
                                    }
                                }
                                ?>
                            </ul>
                        </div>
                        <!-- Uzmanlık Alanları -->
                        <div class="info-block">
                            <h3>Uzmanlık Alanları</h3>
                            <ul class="info-list">
                                <?php
                                $hizmetler = $db->query("SELECT baslik, ikon FROM hizmetler ORDER BY id ASC");
                                while($hizmet = $hizmetler->fetch()) {
                                    echo '<li><i class="fas '.$hizmet['ikon'].'" style="color: #d4af37;"></i> '.$hizmet['baslik'].'</li>';
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Başarılar ve İstatistikler -->
        <section class="achievements">
            <div class="container">
                <div class="achievements-grid">
                    <div class="achievement-item">
                        <i class="fas fa-trophy"></i>
                        <div class="achievement-count"><?php echo $site_ayarlari['dava_sayisi']; ?></div>
                        <div class="achievement-title">Başarılı Dava</div>
                    </div>
                    <div class="achievement-item">
                        <i class="fas fa-users"></i>
                        <div class="achievement-count"><?php echo $site_ayarlari['muvekkil_sayisi']; ?></div>
                        <div class="achievement-title">Mutlu Müvekkil</div>
                    </div>
                    <div class="achievement-item">
                        <i class="fas fa-star"></i>
                        <div class="achievement-count"><?php echo $site_ayarlari['deneyim_yili']; ?></div>
                        <div class="achievement-title">Yıllık Deneyim</div>
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

    /* Diğer stiller buraya eklenebilir */
    </style>

    <?php include 'includes/footer.php'; ?>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const animateElements = document.querySelectorAll('.animate-text');
            animateElements.forEach(element => {
                element.style.opacity = '1';
                element.style.transform = 'translateY(0)';
            });
        });
    </script>
</body>
</html>
