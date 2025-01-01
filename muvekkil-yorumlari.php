<?php
include 'includes/config.php';
include 'includes/header.php';

// Site ayarlarını çek
$site_ayarlari = $db->query("SELECT * FROM site_ayarlari WHERE id = 1")->fetch();

// Slider'dan hero görseli al
$slider = $db->query("SELECT * FROM slider ORDER BY sira ASC LIMIT 1")->fetch();
$heroImage = 'uploads/slider/'.$slider['resim_url'];

// Sayfalama ayarları
$sayfa = isset($_GET['sayfa']) ? (int)$_GET['sayfa'] : 1;
$limit = 9;
$offset = ($sayfa - 1) * $limit;

// Toplam yorum sayısını al
$total = $db->query("SELECT COUNT(*) FROM yorumlar WHERE durum = 1")->fetchColumn();
$total_pages = ceil($total / $limit);

// Sayfalanmış yorumları al
$yorumlar = $db->query("SELECT * FROM yorumlar WHERE durum = 1 ORDER BY id DESC LIMIT $offset, $limit")->fetchAll();
?>

<main>
    <!-- Hero Section -->
    <section class="page-hero" style="background-image: url('<?php echo $heroImage; ?>')">
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <h1>Müvekkil Yorumları</h1>
            <p class="subtitle" style="color: #d4af37;">Değerli müvekkillerimizin görüşleri bizim için önemlidir</p>
        </div>
    </section>

    <!-- Yorumlar Bölümü -->
    <section class="testimonials-page">
        <div class="container">
            <div class="testimonials-grid">
                <?php foreach($yorumlar as $yorum): ?>
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

            <?php if($total_pages > 1): ?>
            <div class="pagination">
                <?php for($i = 1; $i <= $total_pages; $i++): ?>
                <a href="?sayfa=<?php echo $i; ?>" class="page-link <?php echo ($sayfa == $i) ? 'active' : ''; ?>">
                    <?php echo $i; ?>
                </a>
                <?php endfor; ?>
            </div>
            <?php endif; ?>
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

/* Testimonials Styles */
.testimonials-page {
    padding: 0 0 80px 0;
}

.testimonials-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 30px;
    margin-bottom: 40px;
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
    display: block;
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

.pagination {
    display: flex;
    justify-content: center;
    gap: 10px;
    margin-top: 40px;
}

.page-link {
    display: inline-block;
    padding: 8px 16px;
    background: #f5f5f5;
    color: #333;
    text-decoration: none;
    border-radius: 5px;
    transition: all 0.3s ease;
}

.page-link:hover,
.page-link.active {
    background: #d8b74b;
    color: #fff;
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
    
    .testimonials-grid {
        grid-template-columns: 1fr;
    }
}
</style>

<?php include 'includes/footer.php'; ?>
