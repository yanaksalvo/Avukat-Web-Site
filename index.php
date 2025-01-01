<?php
include 'includes/config.php';
include 'includes/header.php';

// Site ayarlarını çek
$site_ayarlari = $db->query("SELECT * FROM site_ayarlari WHERE id = 1")->fetch();

// Rastgele 3 hizmet çek
$hizmetler = $db->query("SELECT * FROM hizmetler ORDER BY RAND() LIMIT 3")->fetchAll();
?>

<main>
    <!-- Modern Slider Section -->
    <section class="hero-slider">
        <div class="slider-container">
            <?php
            $stmt = $db->query("SELECT * FROM slider ORDER BY sira ASC");
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo '<div class="slide">
                    <div class="slide-image" style="background-image: url(uploads/slider/'.$row['resim_url'].')"></div>
                    <div class="slide-content container">
                        <h2 class="animate-text">'.$row['baslik'].'</h2>
                        <p class="animate-text">'.$row['aciklama'].'</p>
                        <a href="'.$row['button_link'].'" class="btn-primary animate-text">'.$row['button_text'].'</a>
                    </div>
                </div>';
            }
            ?>
            <button class="slider-button prev">❮</button>
            <button class="slider-button next">❯</button>
        </div>
    </section>

    <!-- Modern Services Section -->
    <section class="services-preview">
        <div class="container">
            <div class="section-header">
                <h2>Hukuki Hizmetlerimiz</h2>
                <p>Uzman kadromuzla yanınızdayız</p>
            </div>
            <div class="services-grid">
                <?php foreach($hizmetler as $hizmet): 
                    $aciklama = explode('<br>', $hizmet['aciklama'])[0];
                ?>
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas <?php echo $hizmet['ikon']; ?>"></i>
                    </div>
                    <h3><?php echo $hizmet['baslik']; ?></h3>
                    <p><?php echo $aciklama; ?></p>
                    <a href="hizmetler.php" class="service-link">Detaylı Bilgi →</a>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Müvekkil Yorumları Section -->
    <section class="testimonials">
        <div class="container">
            <div class="section-header">
                <h2>Müvekkil Yorumları</h2>
                <p>Müvekkillerimizin Değerlendirmeleri</p>
            </div>
            <div class="testimonials-grid">
                <?php
                $yorumlar = $db->query("SELECT * FROM yorumlar WHERE durum = 1 ORDER BY RAND() LIMIT 3")->fetchAll();
                foreach($yorumlar as $yorum):
                ?>
                <div class="testimonial-card">
                    <div class="testimonial-content">
                        <i class="fas fa-quote-left"></i>
                        <p><?php echo $yorum['yorum']; ?></p>
                    </div>
                    <div class="testimonial-author">
                        <h4><?php echo $yorum['isim']; ?></h4>
                        <span><?php echo $yorum['unvan']; ?></span>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <div style="text-align: center; margin-top: 40px;">
                <a href="muvekkil-yorumlari.php" style="display: inline-block; padding: 12px 30px; background-color: #d8b74b; color: #fff; text-decoration: none; border-radius: 5px; font-weight: 500; transition: all 0.3s ease;">
                    <i class="fas fa-comments" style="margin-right: 8px;"></i> Diğer Yorumları Gör
                </a>
            </div>
        </div>
    </section>

    <!-- Modern Why Us Section -->
    <section class="why-us">
        <div class="container">
            <div class="section-header light">
                <h2>Neden Bizi Seçmelisiniz?</h2>
            </div>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <h3><?php echo $site_ayarlari['deneyim_yili']; ?> Yıl Deneyim</h3>
                    <p>Sektörde <?php echo $site_ayarlari['deneyim_yili']; ?> yılı aşkın deneyim</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-trophy"></i>
                    </div>
                    <h3>Yüzlerce Başarılı Dava</h3>
                    <p>Kanıtlanmış başarı geçmişi</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-user-tie"></i>
                    </div>
                    <h3>Uzman Kadro</h3>
                    <p>Alanında uzman avukat kadrosu</p>
                </div>
            </div>
        </div>
    </section>
</main>

<style>
.testimonials {
    padding: 80px 0;
    background: #f9f9f9;
}

.testimonials-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 30px;
    margin-top: 40px;
}

.testimonial-card {
    background: #fff;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    transition: transform 0.3s ease;
}

.testimonial-card:hover {
    transform: translateY(-5px);
}

.testimonial-content {
    margin-bottom: 20px;
}

.testimonial-content i {
    color: #d8b74b;
    font-size: 24px;
    margin-bottom: 15px;
}

.testimonial-content p {
    font-style: italic;
    color: #666;
    line-height: 1.6;
}

.testimonial-author h4 {
    color: #333;
    margin: 0;
    font-size: 18px;
}

.testimonial-author span {
    color: #888;
    font-size: 14px;
}

.why-us .section-header h2,
.why-us .section-header.light h2 {
    color: #ffffff;
}
</style>

<?php include 'includes/footer.php'; ?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let currentSlide = 0;
    const slides = document.querySelectorAll('.slide');
    const totalSlides = slides.length;

    function showSlide(index) {
        slides.forEach(slide => {
            slide.style.display = 'none';
            slide.style.opacity = '0';
        });
        
        slides[index].style.display = 'block';
        setTimeout(() => {
            slides[index].style.opacity = '1';
        }, 100);
    }

    function nextSlide() {
        currentSlide = (currentSlide + 1) % totalSlides;
        showSlide(currentSlide);
    }

    function prevSlide() {
        currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
        showSlide(currentSlide);
    }

    showSlide(currentSlide);
    setInterval(nextSlide, 5000);

    document.querySelector('.slider-button.next').addEventListener('click', nextSlide);
    document.querySelector('.slider-button.prev').addEventListener('click', prevSlide);
});
</script>
