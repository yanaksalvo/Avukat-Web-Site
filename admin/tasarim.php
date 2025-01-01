<?php
include '../includes/config.php';
include 'includes/header.php';

if(isset($_POST['submit'])) {
    $logotype = isset($_POST['logotype']) ? $_POST['logotype'] : '';
    $dava_sayisi = isset($_POST['dava_sayisi']) ? $_POST['dava_sayisi'] : '';
    $muvekkil_sayisi = isset($_POST['muvekkil_sayisi']) ? $_POST['muvekkil_sayisi'] : '';
    $deneyim_yili = isset($_POST['deneyim_yili']) ? $_POST['deneyim_yili'] : '';
    $biyografi = isset($_POST['biyografi']) ? $_POST['biyografi'] : '';
    $egitim = isset($_POST['egitim']) ? $_POST['egitim'] : '';
    
    $stmt = $db->prepare("UPDATE site_ayarlari SET
        logotype = ?,
        dava_sayisi = ?,
        muvekkil_sayisi = ?,
        deneyim_yili = ?,
        biyografi = ?,
        egitim = ?
        WHERE id = 1");
    
    $stmt->execute([
        $logotype,
        $dava_sayisi,
        $muvekkil_sayisi,
        $deneyim_yili,
        $biyografi,
        $egitim
    ]);
    
    if(isset($_FILES['logo']) && $_FILES['logo']['size'] > 0) {
        $upload_dir = '../uploads/';
        $logo_path = $upload_dir . 'logo.png';
        
        if(file_exists($logo_path)) {
            unlink($logo_path);
        }
        
        move_uploaded_file($_FILES['logo']['tmp_name'], $logo_path);
        
        $stmt = $db->prepare("UPDATE site_ayarlari SET logo = ? WHERE id = 1");
        $stmt->execute(['logo.png']);
    }
    
    if(isset($_FILES['avukat_gorsel']) && $_FILES['avukat_gorsel']['size'] > 0) {
        $upload_dir = '../uploads/';
        $avukat_gorsel = time() . '_' . $_FILES['avukat_gorsel']['name'];
        move_uploaded_file($_FILES['avukat_gorsel']['tmp_name'], $upload_dir . $avukat_gorsel);
        
        $stmt = $db->prepare("UPDATE site_ayarlari SET avukat_gorsel = ? WHERE id = 1");
        $stmt->execute([$avukat_gorsel]);
    }
    
    $success = "Tasarım ayarları başarıyla güncellendi.";
}

if(isset($_POST['logo_sil'])) {
    if(!empty($site_ayarlari['logo'])) {
        $logo_path = '../uploads/' . $site_ayarlari['logo'];
        if(file_exists($logo_path)) {
            unlink($logo_path);
        }
    }
    
    $stmt = $db->prepare("UPDATE site_ayarlari SET logo = NULL WHERE id = 1");
    $stmt->execute();
    
    header("Location: tasarim.php");
    exit;
}

$site_ayarlari = $db->query("SELECT * FROM site_ayarlari WHERE id = 1")->fetch(PDO::FETCH_ASSOC);
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Tasarım Ayarları</h1>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <?php if(isset($success)): ?>
                    <div class="alert alert-success"><?php echo $success; ?></div>
                <?php endif; ?>

                <form method="POST" action="" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Site Logosu</label>
                        <?php if(!empty($site_ayarlari['logo'])): ?>
                            <div class="mb-2">
                                <img src="../uploads/<?php echo $site_ayarlari['logo']; ?>" alt="Mevcut Logo" style="max-width: 200px;">
                                <button type="submit" name="logo_sil" class="btn btn-danger btn-sm ml-2">
                                    <i class="fas fa-trash"></i> Logoyu Kaldır
                                </button>
                            </div>
                        <?php endif; ?>
                        <input type="file" name="logo" class="form-control" accept="image/*">
                        <small class="form-text text-muted">Önerilen logo boyutu: 300x100 piksel</small>
                    </div>

                    <div class="form-group">
                        <label>Logotype Yazısı</label>
                        <input type="text" name="logotype" class="form-control" value="<?php echo isset($site_ayarlari['logotype']) ? $site_ayarlari['logotype'] : ''; ?>" required>
                        <small class="form-text text-muted">Logo olmadığında görünecek yazı</small>
                    </div>

                    <div class="form-group">
                        <label>Avukat Görseli</label>
                        <?php if(!empty($site_ayarlari['avukat_gorsel'])): ?>
                            <div class="mb-2">
                                <img src="../uploads/<?php echo $site_ayarlari['avukat_gorsel']; ?>" alt="Mevcut Görsel" style="max-width: 200px;">
                            </div>
                        <?php endif; ?>
                        <input type="file" name="avukat_gorsel" class="form-control">
                        <small class="form-text text-muted">Hakkımda sayfasında görünecek avukat görseli</small>
                    </div>

                    <div class="form-group">
                        <label>Başarılı Dava Sayısı</label>
                        <input type="text" name="dava_sayisi" class="form-control" value="<?php echo isset($site_ayarlari['dava_sayisi']) ? $site_ayarlari['dava_sayisi'] : ''; ?>">
                        <small class="form-text text-muted">Örnek: 500+</small>
                    </div>

                    <div class="form-group">
                        <label>Mutlu Müvekkil Sayısı</label>
                        <input type="text" name="muvekkil_sayisi" class="form-control" value="<?php echo isset($site_ayarlari['muvekkil_sayisi']) ? $site_ayarlari['muvekkil_sayisi'] : ''; ?>">
                        <small class="form-text text-muted">Örnek: 1000+</small>
                    </div>

                    <div class="form-group">
                        <label>Deneyim Yılı</label>
                        <input type="text" name="deneyim_yili" class="form-control" value="<?php echo isset($site_ayarlari['deneyim_yili']) ? $site_ayarlari['deneyim_yili'] : ''; ?>">
                        <small class="form-text text-muted">Örnek: 20+</small>
                    </div>

                    <div class="form-group">
                        <label>Kısa Biyografi</label>
                        <textarea name="biyografi" class="form-control" rows="4"><?php echo isset($site_ayarlari['biyografi']) ? $site_ayarlari['biyografi'] : ''; ?></textarea>
                    </div>

                    <div class="form-group">
                        <label>Eğitim Bilgileri</label>
                        <textarea name="egitim" class="form-control" rows="4" placeholder="Her satıra bir eğitim bilgisi yazın"><?php echo isset($site_ayarlari['egitim']) ? $site_ayarlari['egitim'] : ''; ?></textarea>
                        <small class="form-text text-muted">Her eğitim bilgisini yeni satıra yazın</small>
                    </div>

                    <button type="submit" name="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Güncelle
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
