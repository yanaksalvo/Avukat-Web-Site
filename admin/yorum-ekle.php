<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}

include '../includes/config.php';
include 'includes/header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $isim = $_POST['isim'];
    $unvan = $_POST['unvan'];
    $yorum = $_POST['yorum'];
    $durum = isset($_POST['durum']) ? 1 : 0;

    $stmt = $db->prepare("INSERT INTO yorumlar (isim, unvan, yorum, durum) VALUES (?, ?, ?, ?)");
    $stmt->execute([$isim, $unvan, $yorum, $durum]);

    header('Location: yorumlar.php?success=1');
    exit;
}
?>

<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Yeni Yorum Ekle</h3>
        </div>
        <div class="card-body">
            <form action="" method="post">
                <div class="mb-3">
                    <label>İsim</label>
                    <input type="text" name="isim" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Unvan</label>
                    <input type="text" name="unvan" class="form-control">
                </div>
                <div class="mb-3">
                    <label>Yorum</label>
                    <textarea name="yorum" class="form-control" rows="5" required></textarea>
                </div>
                <div class="mb-3">
                    <label>
                        <input type="checkbox" name="durum" checked> Aktif
                    </label>
                </div>
                <button type="submit" class="btn btn-primary">Kaydet</button>
            </form>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
