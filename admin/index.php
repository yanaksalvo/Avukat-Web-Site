<?php
session_start();
// Giriş kontrolü
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}

include '../includes/config.php';
include 'includes/header.php';

// İstatistikler için verileri çek
$slider_sayisi = $db->query("SELECT COUNT(*) FROM slider")->fetchColumn();
$hizmet_sayisi = $db->query("SELECT COUNT(*) FROM hizmetler")->fetchColumn();
$mesaj_sayisi = $db->query("SELECT COUNT(*) FROM mesajlar")->fetchColumn();
$okunmamis_mesaj = $db->query("SELECT COUNT(*) FROM mesajlar WHERE okundu = 0")->fetchColumn();

// Son mesajları çek
$son_mesajlar = $db->query("SELECT *, CASE WHEN okundu = 1 THEN 'Okundu' ELSE 'Okunmadı' END as durum 
                           FROM mesajlar ORDER BY id DESC LIMIT 5")->fetchAll();
?>

<div class="container-fluid">
    <!-- İstatistik Kartları -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="stats-card bg-primary text-white">
                <div class="inner">
                    <h3><?php echo $slider_sayisi; ?></h3>
                    <p>Slider Sayısı</p>
                </div>
                <div class="icon">
                    <i class="fas fa-images"></i>
                </div>
                <a href="slider.php" class="small-box-footer">
                    Detaylar <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6">
            <div class="stats-card bg-success text-white">
                <div class="inner">
                    <h3><?php echo $hizmet_sayisi; ?></h3>
                    <p>Hizmet Sayısı</p>
                </div>
                <div class="icon">
                    <i class="fas fa-briefcase"></i>
                </div>
                <a href="hizmetler.php" class="small-box-footer">
                    Detaylar <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6">
            <div class="stats-card bg-warning text-white">
                <div class="inner">
                    <h3><?php echo $mesaj_sayisi; ?></h3>
                    <p>Toplam Mesaj</p>
                </div>
                <div class="icon">
                    <i class="fas fa-envelope"></i>
                </div>
                <a href="mesajlar.php" class="small-box-footer">
                    Detaylar <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6">
            <div class="stats-card bg-danger text-white">
                <div class="inner">
                    <h3><?php echo $okunmamis_mesaj; ?></h3>
                    <p>Okunmamış Mesaj</p>
                </div>
                <div class="icon">
                    <i class="fas fa-envelope-open"></i>
                </div>
                <a href="mesajlar.php" class="small-box-footer">
                    Detaylar <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Son Mesajlar ve Hızlı İşlemler -->
    <div class="row">
        <!-- Son Mesajlar -->
        <div class="col-xl-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Son Mesajlar</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Ad Soyad</th>
                                    <th>Email</th>
                                    <th>Konu</th>
                                    <th>Tarih</th>
                                    <th>Durum</th>
                                    <th>İşlem</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($son_mesajlar as $mesaj): ?>
                                <tr>
                                    <td><?php echo $mesaj['ad_soyad']; ?></td>
                                    <td><?php echo $mesaj['email']; ?></td>
                                    <td><?php echo $mesaj['konu']; ?></td>
                                    <td><?php echo date('d.m.Y H:i', strtotime($mesaj['tarih'])); ?></td>
                                    <td>
                                        <?php if($mesaj['okundu'] == 0): ?>
                                            <span class="badge bg-danger">Okunmadı</span>
                                        <?php else: ?>
                                            <span class="badge bg-success">Okundu</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="mesaj-detay.php?id=<?php echo $mesaj['id']; ?>" class="badge bg-info text-white">
                                            <i class="fas fa-eye"></i> Oku
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Hızlı İşlemler -->
        <div class="col-xl-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Hızlı İşlemler</h3>
                </div>
                <div class="card-body">
                    <div class="quick-actions">
                        <a href="slider.php" class="btn btn-primary btn-lg btn-block mb-3">
                            <i class="fas fa-images"></i> Slider Yönetimi
                        </a>
                        <a href="hizmetler.php" class="btn btn-success btn-lg btn-block mb-3">
                            <i class="fas fa-briefcase"></i> Hizmet Yönetimi
                        </a>
                        <a href="mesajlar.php" class="btn btn-warning btn-lg btn-block mb-3">
                            <i class="fas fa-envelope"></i> Mesajları Görüntüle
                        </a>
                        <a href="ayarlar.php" class="btn btn-info btn-lg btn-block">
                            <i class="fas fa-cog"></i> Site Ayarları
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.stats-card {
    position: relative;
    padding: 20px;
    margin-bottom: 20px;
    border-radius: 10px;
    overflow: hidden;
}
.stats-card .inner {
    padding: 10px;
}
.stats-card .inner h3 {
    font-size: 38px;
    font-weight: bold;
    margin: 0;
    color: #ffffff !important;
}
.stats-card .inner p {
    margin: 0;
    font-size: 18px;
    color: #ffffff !important;
}
.stats-card .icon {
    position: absolute;
    right: 20px;
    top: 20px;
    font-size: 60px;
    opacity: 0.3;
}
.stats-card .small-box-footer {
    position: relative;
    text-align: center;
    padding: 3px 0;
    color: #fff;
    text-decoration: none;
    display: block;
    background: rgba(0,0,0,0.1);
    margin: 0 -20px -20px;
}
.quick-actions .btn {
    width: 100%;
    text-align: left;
    padding: 15px;
}
.quick-actions .btn i {
    margin-right: 10px;
}
.badge {
    text-decoration: none;
}
</style>

<?php include 'includes/footer.php'; ?>
