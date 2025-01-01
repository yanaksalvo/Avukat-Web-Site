<?php
session_start();
include '../includes/config.php';

if(!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}

if(isset($_POST['guncelle'])) {
    $adres = $_POST['adres'];
    $telefon = $_POST['telefon'];
    $email = $_POST['email'];
    $calismaSaatleri = $_POST['calismaSaatleri'];
    $maps_code = $_POST['maps_code'];
    
    $stmt = $db->prepare("UPDATE iletisim_bilgileri SET adres = ?, telefon = ?, email = ?, calismaSaatleri = ?, maps_code = ? WHERE id = 1");
    if($stmt->execute([$adres, $telefon, $email, $calismaSaatleri, $maps_code])) {
        $success = true;
    }
}

$iletisim = $db->query("SELECT * FROM iletisim_bilgileri WHERE id = 1")->fetch();
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>İletişim Bilgileri Yönetimi</title>
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.all.min.js"></script>
</head>
<body>
    <div class="admin-container">
        <?php include 'includes/sidebar.php'; ?>

    <?php if(isset($success)): ?>
    <script>
        Swal.fire({
            title: 'Başarılı!',
            text: 'İletişim bilgileri güncellendi',
            icon: 'success',
            confirmButtonText: 'Tamam',
            confirmButtonColor: '#3085d6'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'iletisim-bilgileri.php';
            }
        });
    </script>
    <?php endif; ?>
        
        <div class="content">
            <h2>İletişim Bilgileri Yönetimi</h2>
            
            <form method="POST" action="" class="iletisim-form">
                <div class="form-group">
                    <label>Adres:</label>
                    <textarea name="adres" required><?php echo $iletisim['adres']; ?></textarea>
                </div>
                
                <div class="form-group">
                    <label>Telefon:</label>
                    <input type="text" name="telefon" value="<?php echo $iletisim['telefon']; ?>" required>
                </div>
                
                <div class="form-group">
                    <label>E-posta:</label>
                    <input type="email" name="email" value="<?php echo $iletisim['email']; ?>" required>
                </div>
                
                <div class="form-group">
                    <label>Çalışma Saatleri:</label>
                    <textarea name="calismaSaatleri" required><?php echo $iletisim['calismaSaatleri']; ?></textarea>
                </div>

                <div class="form-group">
                    <label>Google Maps Embed Kodu:</label>
                    <textarea name="maps_code" class="code-area" placeholder="<iframe> kodunu buraya yapıştırın"><?php echo $iletisim['maps_code']; ?></textarea>
                    <small>Google Maps'ten alınan iframe kodunu buraya yapıştırın.</small>
                </div>
                
                <button type="submit" name="guncelle" class="btn-submit">Bilgileri Güncelle</button>
            </form>

            <?php if($iletisim['maps_code']): ?>
            <div class="maps-preview">
                <h3>Harita Önizleme</h3>
                <?php echo $iletisim['maps_code']; ?>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <style>
    .iletisim-form {
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: bold;
    }

    .form-group input,
    .form-group textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
    }

    .form-group textarea {
        height: 100px;
    }

    .code-area {
        font-family: monospace;
        height: 120px;
    }

    .maps-preview {
        margin-top: 30px;
        padding: 20px;
        background: #f5f5f5;
        border-radius: 4px;
    }

    .maps-preview h3 {
        margin-bottom: 15px;
    }

    .maps-preview iframe {
        width: 100%;
        height: 400px;
        border: none;
    }

    .btn-submit {
        background: #3085d6;
        color: white;
        padding: 12px 24px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
    }

    .btn-submit:hover {
        background: #2563eb;
    }

    small {
        display: block;
        margin-top: 5px;
        color: #666;
    }
    </style>
</body>
</html>
