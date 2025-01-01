<?php
session_start();
// Check if user is logged in
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}

include '../includes/config.php';
include 'includes/header.php';

// Hizmet Ekleme
if(isset($_POST['hizmet_ekle'])) {
    $baslik = $_POST['baslik'];
    $aciklama = str_replace('-', '<br><i class="fas fa-check" style="color: #d8b74b;"></i>', $_POST['aciklama']);
    $ikon = $_POST['ikon'];
    
    $stmt = $db->prepare("INSERT INTO hizmetler (baslik, aciklama, ikon) VALUES (?, ?, ?)");
    $stmt->execute([$baslik, $aciklama, $ikon]);
    
    echo "<script>
        Swal.fire({
            icon: 'success',
            title: 'Başarılı!',
            text: 'Hizmet başarıyla eklendi.',
            showConfirmButton: false,
            timer: 1500,
            customClass: {
                popup: 'animated fadeInDown'
            }
        }).then(function() {
            window.location = 'hizmetler.php';
        });
    </script>";
}

$hizmetler = $db->query("SELECT * FROM hizmetler ORDER BY id DESC")->fetchAll();
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Hizmet Yönetimi</h3>
                </div>
                <div class="card-body">
                    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#hizmetEkle">
                        <i class="fas fa-plus"></i> Yeni Hizmet Ekle
                    </button>

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>İkon</th>
                                    <th>Başlık</th>
                                    <th>Açıklama</th>
                                    <th>İşlemler</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($hizmetler as $hizmet): ?>
                                <tr>
                                    <td><i class="<?php echo $hizmet['ikon']; ?> fa-2x"></i></td>
                                    <td><?php echo $hizmet['baslik']; ?></td>
                                    <td><?php echo $hizmet['aciklama']; ?></td>
                                    <td>
                                        <a href="hizmet-duzenle.php?id=<?php echo $hizmet['id']; ?>" class="btn btn-primary btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button onclick="hizmetSil(<?php echo $hizmet['id']; ?>)" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i>
                                        </button>
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

<!-- Hizmet Ekleme Modal -->
<div class="modal fade" id="hizmetEkle">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Yeni Hizmet Ekle</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form method="POST">
                    <div class="mb-3">
                        <label>Başlık</label>
                        <input type="text" name="baslik" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Açıklama</label>
                        <textarea name="aciklama" class="form-control" rows="3" required></textarea>
                        <small class="text-muted">Not: Madde başlarına - işareti koyarsanız otomatik olarak ✓ işaretine dönüşecektir.</small>
                    </div>
                    <div class="mb-3">
                        <label>İkon Seçin</label>
                        <div class="icon-grid">
                            <div class="icon-item">
                                <input type="radio" name="ikon" value="fas fa-gavel" id="icon1" required>
                                <label for="icon1"><i class="fas fa-gavel"></i> Çekiç</label>
                            </div>
                            <div class="icon-item">
                                <input type="radio" name="ikon" value="fas fa-balance-scale" id="icon2">
                                <label for="icon2"><i class="fas fa-balance-scale"></i> Terazi</label>
                            </div>
                            <div class="icon-item">
                                <input type="radio" name="ikon" value="fas fa-briefcase" id="icon3">
                                <label for="icon3"><i class="fas fa-briefcase"></i> Evrak Çantası</label>
                            </div>
                            <div class="icon-item">
                                <input type="radio" name="ikon" value="fas fa-handshake" id="icon4">
                                <label for="icon4"><i class="fas fa-handshake"></i> El Sıkışma</label>
                            </div>
                            <div class="icon-item">
                                <input type="radio" name="ikon" value="fas fa-university" id="icon5">
                                <label for="icon5"><i class="fas fa-university"></i> Adliye</label>
                            </div>
                            <div class="icon-item">
                                <input type="radio" name="ikon" value="fas fa-book" id="icon6">
                                <label for="icon6"><i class="fas fa-book"></i> Kitap</label>
                            </div>
                            <div class="icon-item">
                                <input type="radio" name="ikon" value="fas fa-shield-alt" id="icon7">
                                <label for="icon7"><i class="fas fa-shield-alt"></i> Kalkan</label>
                            </div>
                            <div class="icon-item">
                                <input type="radio" name="ikon" value="fas fa-home" id="icon8">
                                <label for="icon8"><i class="fas fa-home"></i> Ev</label>
                            </div>
                            <div class="icon-item">
                                <input type="radio" name="ikon" value="fas fa-users" id="icon9">
                                <label for="icon9"><i class="fas fa-users"></i> Aile</label>
                            </div>
                            <div class="icon-item">
                                <input type="radio" name="ikon" value="fas fa-file-contract" id="icon10">
                                <label for="icon10"><i class="fas fa-file-contract"></i> Sözleşme</label>
                            </div>
                            <div class="icon-item">
                                <input type="radio" name="ikon" value="fas fa-landmark" id="icon11">
                                <label for="icon11"><i class="fas fa-landmark"></i> Mahkeme</label>
                            </div>
                            <div class="icon-item">
                                <input type="radio" name="ikon" value="fas fa-stamp" id="icon12">
                                <label for="icon12"><i class="fas fa-stamp"></i> Mühür</label>
                            </div>
                        </div>
                    </div>
                    <button type="submit" name="hizmet_ekle" class="btn btn-primary">Ekle</button>
                </form>
            </div>        </div>
    </div>
</div>

<script>
function hizmetSil(id) {
    Swal.fire({
        title: 'Emin misiniz?',
        text: "Bu hizmeti silmek istediğinize emin misiniz?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d8b74b',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Evet, Sil!',
        cancelButtonText: 'İptal'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: 'hizmet-sil.php',
                type: 'POST',
                data: {id: id},
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Başarılı!',
                        text: 'Hizmet başarıyla silindi.',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function() {
                        window.location.reload();
                    });
                }
            });
        }
    });
}
</script>

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
