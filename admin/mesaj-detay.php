<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}

include '../includes/config.php';
include 'includes/header.php';

// Hata raporlamayı aktif et
error_reporting(E_ALL);
ini_set('display_errors', 1);

// ID kontrolü
if (!isset($_GET['id'])) {
    header('Location: mesajlar.php');
    exit;
}

$id = intval($_GET['id']);

try {
    // Mesajı okundu olarak işaretle
    $updateStmt = $db->prepare("UPDATE mesajlar SET okundu = 1 WHERE id = ?");
    $updateStmt->execute([$id]);

    // Mesaj detaylarını getir
    $stmt = $db->prepare("SELECT * FROM mesajlar WHERE id = ?");
    $stmt->execute([$id]);
    $mesaj = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$mesaj) {
        echo "Mesaj bulunamadı. ID: " . $id;
        exit;
    }

} catch (PDOException $e) {
    echo "Veritabanı Hatası: " . $e->getMessage();
    exit;
}
?>

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
                    <h3 class="card-title m-0">Mesaj Detayı</h3>
                    <a href="mesajlar.php" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Geri Dön
                    </a>
                </div>
                <div class="card-body p-4">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="info-group">
                                <label class="text-muted mb-2">Gönderen</label>
                                <h5 class="fw-bold"><?php echo htmlspecialchars($mesaj['ad_soyad']); ?></h5>
                            </div>
                            
                            <div class="info-group">
                                <label class="text-muted mb-2">E-posta</label>
                                <h5><a href="mailto:<?php echo htmlspecialchars($mesaj['email']); ?>" class="text-primary text-decoration-none"><?php echo htmlspecialchars($mesaj['email']); ?></a></h5>
                            </div>
                            
                            <div class="info-group">
                                <label class="text-muted mb-2">Telefon</label>
                                <h5><a href="tel:<?php echo htmlspecialchars($mesaj['telefon']); ?>" class="text-primary text-decoration-none"><?php echo htmlspecialchars($mesaj['telefon']); ?></a></h5>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="info-group">
                                <label class="text-muted mb-2">Tarih</label>
                                <h5>
                                    <?php 
                                    if (isset($mesaj['tarih']) && !empty($mesaj['tarih'])) {
                                        echo date('d.m.Y H:i', strtotime($mesaj['tarih']));
                                    } else if (isset($mesaj['created_at']) && !empty($mesaj['created_at'])) {
                                        echo date('d.m.Y H:i', strtotime($mesaj['created_at']));
                                    } else {
                                        echo 'Tarih belirtilmemiş';
                                    }
                                    ?>
                                </h5>
                            </div>
                            
                            <div class="info-group">
                                <label class="text-muted mb-2">Konu</label>
                                <h5><?php echo htmlspecialchars($mesaj['konu']); ?></h5>
                            </div>
                            
                            <div class="info-group">
                                <label class="text-muted mb-2">Durum</label>
                                <h5><span class="badge bg-success">Okundu</span></h5>
                            </div>
                        </div>
                    </div>
                    
                    <div class="message-content mt-4">
                        <label class="text-muted mb-2">Mesaj İçeriği</label>
                        <div class="message-box p-4 bg-light rounded border">
                            <?php echo nl2br(htmlspecialchars($mesaj['mesaj'])); ?>
                        </div>
                    </div>
                    
                    <div class="d-flex gap-2 mt-4">
                        <button onclick="window.print()" class="btn btn-info">
                            <i class="fas fa-print"></i> Yazdır
                        </button>
                        <a href="mesajlar.php?sil=<?php echo $mesaj['id']; ?>" class="btn btn-danger" onclick="return confirm('Bu mesajı silmek istediğinize emin misiniz?')">
                            <i class="fas fa-trash"></i> Mesajı Sil
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.info-group {
    margin-bottom: 1.5rem;
}

.info-group label {
    display: block;
    font-size: 0.9rem;
    color: #6c757d;
}

.info-group h5 {
    margin: 0;
    font-size: 1.1rem;
    color: #2c3e50;
}

.message-box {
    min-height: 150px;
    line-height: 1.6;
    color: #2c3e50;
    background-color: #f8f9fa !important;
}

@media print {
    .btn, .card-header {
        display: none !important;
    }
    .card {
        border: none !important;
        box-shadow: none !important;
    }
    .message-box {
        border: none !important;
    }
}
</style>

<?php include 'includes/footer.php'; ?>
