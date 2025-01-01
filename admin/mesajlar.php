<?php
session_start();
// Verify admin login
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}

include '../includes/config.php';
include 'includes/header.php';

// Mesaj Silme
if(isset($_GET['sil'])) {
    $id = $_GET['sil'];
    $db->query("DELETE FROM mesajlar WHERE id = $id");
    header('Location: mesajlar.php');
}

$mesajlar = $db->query("SELECT * FROM mesajlar ORDER BY id DESC")->fetchAll();
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Gelen Mesajlar</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Ad Soyad</th>
                                    <th>Email</th>
                                    <th>Telefon</th>
                                    <th>Konu</th>
                                    <th>Mesaj</th>
                                    <th>Tarih</th>
                                    <th>İşlemler</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($mesajlar as $mesaj): ?>
                                <tr>
                                    <td><?php echo $mesaj['ad_soyad']; ?></td>
                                    <td><?php echo $mesaj['email']; ?></td>
                                    <td><?php echo $mesaj['telefon']; ?></td>
                                    <td><?php echo $mesaj['konu']; ?></td>
                                    <td><?php echo $mesaj['mesaj']; ?></td>
                                    <td><?php echo date('d.m.Y H:i', strtotime($mesaj['created_at'])); ?></td>
                                    <td>
                                        <a href="mesaj-detay.php?id=<?php echo $mesaj['id']; ?>" class="btn btn-info btn-sm" title="Mesajı Görüntüle">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="?sil=<?php echo $mesaj['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Silmek istediğinize emin misiniz?')">
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
    </div>
</div>
<?php include 'includes/footer.php'; ?>
