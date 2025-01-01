<?php
session_start();
// Verify admin login
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}

include '../includes/config.php';
include 'includes/header.php';

$id = $_GET['id'];
$slider = $db->query("SELECT * FROM slider WHERE id = $id")->fetch();

if(isset($_POST['slider_duzenle'])) {
    $baslik = $_POST['baslik'];
    $aciklama = $_POST['aciklama'];
    $button_text = $_POST['button_text'];
    $button_link = $_POST['button_link'];
    
    if($_FILES['resim']['size'] > 0) {
        // Eski resmi sil
        if(file_exists('../uploads/slider/' . $slider['resim_url'])) {
            unlink('../uploads/slider/' . $slider['resim_url']);
        }
        
        // Yeni resmi yükle
        $resim = $_FILES['resim']['name'];
        $tmp_resim = $_FILES['resim']['tmp_name'];
        $resim_yolu = time() . '_' . $resim;
        
        move_uploaded_file($tmp_resim, '../uploads/slider/' . $resim_yolu);
        
        $stmt = $db->prepare("UPDATE slider SET baslik = ?, aciklama = ?, resim_url = ?, button_text = ?, button_link = ? WHERE id = ?");
        $stmt->execute([$baslik, $aciklama, $resim_yolu, $button_text, $button_link, $id]);
    } else {
        $stmt = $db->prepare("UPDATE slider SET baslik = ?, aciklama = ?, button_text = ?, button_link = ? WHERE id = ?");
        $stmt->execute([$baslik, $aciklama, $button_text, $button_link, $id]);
    }
    
    $success = "Slider başarıyla güncellendi.";
    
    // Güncel veriyi çek
    $slider = $db->query("SELECT * FROM slider WHERE id = $id")->fetch();
}
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Slider Düzenle</h3>
                    <a href="slider.php" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Geri Dön
                    </a>
                </div>
                <div class="card-body">
                    <?php if(isset($success)): ?>
                        <div class="alert alert-success">
                            <?php echo $success; ?>
                        </div>
                    <?php endif; ?>

                    <form method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Mevcut Resim</label><br>
                                    <img src="../uploads/slider/<?php echo $slider['resim_url']; ?>" class="img-fluid mb-2" style="max-width: 300px;">
                                </div>
                                
                                <div class="mb-3">
                                    <label>Yeni Resim (Değiştirmek istemiyorsanız boş bırakın)</label>
                                    <input type="file" name="resim" class="form-control">
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Başlık</label>
                                    <input type="text" name="baslik" class="form-control" value="<?php echo $slider['baslik']; ?>" required>
                                </div>

                                <div class="mb-3">
                                    <label>Açıklama</label>
                                    <textarea name="aciklama" class="form-control" rows="4" required><?php echo $slider['aciklama']; ?></textarea>
                                </div>

                                <div class="mb-3">
                                    <label>Buton Metni</label>
                                    <input type="text" name="button_text" class="form-control" value="<?php echo $slider['button_text']; ?>" required>
                                </div>

                                <div class="mb-3">
                                    <label>Buton Linki</label>
                                    <select name="button_link" class="form-control" required>
                                        <option value="iletisim.php" <?php echo ($slider['button_link'] == 'iletisim.php') ? 'selected' : ''; ?>>İletişim Sayfası</option>
                                        <option value="hizmetler.php" <?php echo ($slider['button_link'] == 'hizmetler.php') ? 'selected' : ''; ?>>Hizmetler Sayfası</option>
                                        <option value="hakkimizda.php" <?php echo ($slider['button_link'] == 'hakkimizda.php') ? 'selected' : ''; ?>>Hakkımızda Sayfası</option>
                                    </select>
                                </div>

                                <button type="submit" name="slider_duzenle" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Güncelle
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
