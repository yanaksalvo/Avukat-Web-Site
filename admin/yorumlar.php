<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}

include '../includes/config.php';
include 'includes/header.php';

// Yorumları listele
$yorumlar = $db->query("SELECT * FROM yorumlar ORDER BY id DESC")->fetchAll();
?>

<div class="container-fluid">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title">Müvekkil Yorumları</h3>
            <a href="yorum-ekle.php" class="btn btn-primary">
                <i class="fas fa-plus"></i> Yeni Yorum Ekle
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>İsim</th>
                            <th>Unvan</th>
                            <th>Yorum</th>
                            <th>Durum</th>
                            <th>Tarih</th>
                            <th>İşlemler</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($yorumlar as $yorum): ?>
                        <tr>
                            <td><?php echo $yorum['id']; ?></td>
                            <td><?php echo $yorum['isim']; ?></td>
                            <td><?php echo $yorum['unvan']; ?></td>
                            <td><?php echo substr($yorum['yorum'], 0, 100) . '...'; ?></td>
                            <td>
                                <?php if($yorum['durum'] == 1): ?>
                                    <span class="badge bg-success">Aktif</span>
                                <?php else: ?>
                                    <span class="badge bg-danger">Pasif</span>
                                <?php endif; ?>
                            </td>
                            <td><?php echo date('d.m.Y H:i', strtotime($yorum['created_at'])); ?></td>
                            <td>
                                <a href="yorum-duzenle.php?id=<?php echo $yorum['id']; ?>" class="btn btn-sm btn-info">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="yorum-sil.php?id=<?php echo $yorum['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Silmek istediğinize emin misiniz?')">
                                    <i class="fas fa-trash"></i>
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

<?php include 'includes/footer.php'; ?>
