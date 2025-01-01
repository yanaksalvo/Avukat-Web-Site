<?php
session_start();
// Check if user is logged in
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}

include '../includes/config.php';
include 'includes/header.php';

$id = $_GET['id'];
$hizmet = $db->query("SELECT * FROM hizmetler WHERE id = $id")->fetch();

if(isset($_POST['hizmet_duzenle'])) {
    $baslik = $_POST['baslik'];
    $aciklama = str_replace('-', '<br><i class="fas fa-check" style="color: #d8b74b;"></i>', $_POST['aciklama']);
    $ikon = $_POST['ikon'];
    
    $stmt = $db->prepare("UPDATE hizmetler SET baslik = ?, aciklama = ?, ikon = ? WHERE id = ?");
    $stmt->execute([$baslik, $aciklama, $ikon, $id]);
    
    $success = "Hizmet başarıyla güncellendi.";
    
    // Güncel veriyi çek
    $hizmet = $db->query("SELECT * FROM hizmetler WHERE id = $id")->fetch();
}
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Hizmet Düzenle</h3>
                    <a href="hizmetler.php" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Geri Dön
                    </a>
                </div>
                <div class="card-body">
                    <?php if(isset($success)): ?>
                        <div class="alert alert-success">
                            <?php echo $success; ?>
                        </div>
                    <?php endif; ?>

                    <form method="POST">
                        <div class="mb-3">
                            <label>Başlık</label>
                            <input type="text" name="baslik" class="form-control" value="<?php echo $hizmet['baslik']; ?>" required>
                        </div>

                        <div class="mb-3">
                            <label>Açıklama</label>
                            <textarea name="aciklama" class="form-control" rows="6" required><?php echo $hizmet['aciklama']; ?></textarea>
                            <small class="text-muted">Not: Madde başlarına - işareti koyarsanız otomatik olarak ✓ işaretine dönüşecektir.</small>
                        </div>
                          <div class="mb-3">
                              <label>İkon Seçin</label>
                              <div class="icon-grid">
                                  <div class="icon-item">
                                      <input type="radio" name="ikon" value="fas fa-gavel" id="icon1" <?php if($hizmet['ikon'] == 'fas fa-gavel') echo 'checked'; ?>>
                                      <label for="icon1"><i class="fas fa-gavel"></i> Çekiç</label>
                                  </div>
                                  <div class="icon-item">
                                      <input type="radio" name="ikon" value="fas fa-balance-scale" id="icon2" <?php if($hizmet['ikon'] == 'fas fa-balance-scale') echo 'checked'; ?>>
                                      <label for="icon2"><i class="fas fa-balance-scale"></i> Terazi</label>
                                  </div>
                                  <div class="icon-item">
                                      <input type="radio" name="ikon" value="fas fa-briefcase" id="icon3" <?php if($hizmet['ikon'] == 'fas fa-briefcase') echo 'checked'; ?>>
                                      <label for="icon3"><i class="fas fa-briefcase"></i> Evrak Çantası</label>
                                  </div>
                                  <div class="icon-item">
                                      <input type="radio" name="ikon" value="fas fa-handshake" id="icon4" <?php if($hizmet['ikon'] == 'fas fa-handshake') echo 'checked'; ?>>
                                      <label for="icon4"><i class="fas fa-handshake"></i> El Sıkışma</label>
                                  </div>
                                  <div class="icon-item">
                                      <input type="radio" name="ikon" value="fas fa-university" id="icon5" <?php if($hizmet['ikon'] == 'fas fa-university') echo 'checked'; ?>>
                                      <label for="icon5"><i class="fas fa-university"></i> Adliye</label>
                                  </div>
                                  <div class="icon-item">
                                      <input type="radio" name="ikon" value="fas fa-book" id="icon6" <?php if($hizmet['ikon'] == 'fas fa-book') echo 'checked'; ?>>
                                      <label for="icon6"><i class="fas fa-book"></i> Kitap</label>
                                  </div>
                                  <div class="icon-item">
                                      <input type="radio" name="ikon" value="fas fa-shield-alt" id="icon7" <?php if($hizmet['ikon'] == 'fas fa-shield-alt') echo 'checked'; ?>>
                                      <label for="icon7"><i class="fas fa-shield-alt"></i> Kalkan</label>
                                  </div>
                                  <div class="icon-item">
                                      <input type="radio" name="ikon" value="fas fa-home" id="icon8" <?php if($hizmet['ikon'] == 'fas fa-home') echo 'checked'; ?>>
                                      <label for="icon8"><i class="fas fa-home"></i> Ev</label>
                                  </div>
                                  <div class="icon-item">
                                      <input type="radio" name="ikon" value="fas fa-users" id="icon9" <?php if($hizmet['ikon'] == 'fas fa-users') echo 'checked'; ?>>
                                      <label for="icon9"><i class="fas fa-users"></i> Aile</label>
                                  </div>
                                  <div class="icon-item">
                                      <input type="radio" name="ikon" value="fas fa-file-contract" id="icon10" <?php if($hizmet['ikon'] == 'fas fa-file-contract') echo 'checked'; ?>>
                                      <label for="icon10"><i class="fas fa-file-contract"></i> Sözleşme</label>
                                  </div>
                                  <div class="icon-item">
                                      <input type="radio" name="ikon" value="fas fa-landmark" id="icon11" <?php if($hizmet['ikon'] == 'fas fa-landmark') echo 'checked'; ?>>
                                      <label for="icon11"><i class="fas fa-landmark"></i> Mahkeme</label>
                                  </div>
                                  <div class="icon-item">
                                      <input type="radio" name="ikon" value="fas fa-stamp" id="icon12" <?php if($hizmet['ikon'] == 'fas fa-stamp') echo 'checked'; ?>>
                                      <label for="icon12"><i class="fas fa-stamp"></i> Mühür</label>
                                  </div>
                              </div>
                          </div>
                        <button type="submit" name="hizmet_duzenle" class="btn btn-primary">
                            <i class="fas fa-save"></i> Güncelle
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.icon-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 15px;
    margin-top: 10px;
}

.icon-item {
    text-align: center;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
    cursor: pointer;
}

.icon-item:hover {
    background: #f8f9fa;
}

.icon-item input[type="radio"] {
    display: none;
}

.icon-item label {
    cursor: pointer;
    display: block;
}

.icon-item i {
    font-size: 24px;
    margin-bottom: 5px;
    display: block;
}

.icon-item input[type="radio"]:checked + label {
    color: #0d6efd;
}

.icon-item input[type="radio"]:checked + label i {
    color: #0d6efd;
}
</style>

<?php include 'includes/footer.php'; ?>
