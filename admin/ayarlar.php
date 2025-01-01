<?php
session_start();
// Check if user is logged in
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}

include '../includes/config.php';
include 'includes/header.php';

if(isset($_POST['submit'])) {
    $site_baslik = $_POST['site_baslik'];
    $logotype = $_POST['logotype'];
    $email = $_POST['email'];
    $telefon = $_POST['telefon'];
    $whatsapp_telefon = $_POST['whatsapp_telefon'];
    $adres = $_POST['adres'];
    $calisma_saatleri = nl2br($_POST['calisma_saatleri']);
    $maps_code = $_POST['maps_code'];
    $facebook = $_POST['facebook'];
    $twitter = $_POST['twitter'];
    $instagram = $_POST['instagram'];
    $linkedin = $_POST['linkedin'];
    
    $stmt = $db->prepare("UPDATE site_ayarlari SET
        site_baslik = ?,
        logotype = ?,
        email = ?,
        telefon = ?,
        whatsapp_telefon = ?,
        adres = ?,
        calisma_saatleri = ?,
        maps_code = ?,
        facebook = ?,
        twitter = ?,
        instagram = ?,
        linkedin = ?
        WHERE id = 1");
        
    $stmt->execute([
        $site_baslik,
        $logotype,
        $email,
        $telefon,
        $whatsapp_telefon,
        $adres,
        $calisma_saatleri,
        $maps_code,
        $facebook,
        $twitter,
        $instagram,
        $linkedin
    ]);
    
    $success = "Ayarlar başarıyla güncellendi.";
}

$ayarlar = $db->query("SELECT * FROM site_ayarlari WHERE id = 1")->fetch();
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Site Ayarları</h3>
                </div>
                <div class="card-body">
                    <?php if(isset($success)): ?>
                        <div class="alert alert-success"><?php echo $success; ?></div>
                    <?php endif; ?>

                    <form method="POST">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Site Başlığı</label>
                                    <input type="text" name="site_baslik" class="form-control" value="<?php echo $ayarlar['site_baslik']; ?>" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label>Logotype</label>
                                    <input type="text" name="logotype" class="form-control" value="<?php echo $ayarlar['logotype']; ?>" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label>E-posta</label>
                                    <input type="email" name="email" class="form-control" value="<?php echo $ayarlar['email']; ?>" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label>Telefon</label>
                                    <input type="text" name="telefon" class="form-control" value="<?php echo $ayarlar['telefon']; ?>" required>
                                </div>

                                <div class="mb-3">
                                    <label>WhatsApp Telefon</label>
                                    <input type="text" name="whatsapp_telefon" class="form-control" value="<?php echo $ayarlar['whatsapp_telefon']; ?>" placeholder="Örnek: 905xxxxxxxxx">
                                    <small class="text-muted">Başında 90 olacak şekilde yazın. Boş bırakırsanız WhatsApp butonu görünmez.</small>
                                </div>
                                
                                <div class="mb-3">
                                    <label>Adres</label>
                                    <textarea name="adres" class="form-control" rows="3" required><?php echo $ayarlar['adres']; ?></textarea>
                                </div>

                                <div class="mb-3">
                                    <label>Çalışma Saatleri</label>
                                    <textarea name="calisma_saatleri" class="form-control" rows="3" required><?php echo strip_tags($ayarlar['calisma_saatleri']); ?></textarea>
                                    <small class="text-muted">Örnek: Pazartesi - Cuma: 09:00 - 18:00</small>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Google Maps Yerleşim Kodu</label>
                                    <textarea name="maps_code" class="form-control" rows="5"><?php echo $ayarlar['maps_code']; ?></textarea>
                                    <small class="text-muted">Google Maps'ten aldığınız iframe kodunu buraya yapıştırın</small>
                                </div>

                                <div class="mb-3">
                                    <label>Facebook</label>
                                    <input type="url" name="facebook" class="form-control" value="<?php echo $ayarlar['facebook']; ?>">
                                </div>

                                <div class="mb-3">
                                    <label>Twitter</label>
                                    <input type="url" name="twitter" class="form-control" value="<?php echo $ayarlar['twitter']; ?>">
                                </div>

                                <div class="mb-3">
                                    <label>Instagram</label>
                                    <input type="url" name="instagram" class="form-control" value="<?php echo $ayarlar['instagram']; ?>">
                                </div>

                                <div class="mb-3">
                                    <label>LinkedIn</label>
                                    <input type="url" name="linkedin" class="form-control" value="<?php echo $ayarlar['linkedin']; ?>">
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <button type="submit" name="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Güncelle
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
