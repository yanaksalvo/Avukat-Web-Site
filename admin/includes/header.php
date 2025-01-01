<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - <?php echo $site_ayarlari['site_baslik']; ?></title>
    
    <!-- CSS Files -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="css/admin.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3>Admin Panel</h3>
            </div>
            <ul class="list-unstyled components">
                <li>
                    <a href="index.php"><i class="fas fa-home"></i> Ana Sayfa</a>
                </li>
                <li>
                    <a href="slider.php"><i class="fas fa-images"></i> Slider Yönetimi</a>
                </li>
                <li>
                    <a href="hizmetler.php"><i class="fas fa-briefcase"></i> Hizmetler</a>
                </li>
                <li>
                    <a href="yorumlar.php"><i class="fas fa-comments"></i> Müvekkil Yorumları</a>
                </li>
                <li>
                    <a href="mesajlar.php"><i class="fas fa-envelope"></i> Mesajlar</a>
                </li>
                <li>
                    <a href="tasarim.php"><i class="fas fa-paint-brush"></i> Tasarım Ayarları</a>
                </li>
                <li>
                    <a href="ayarlar.php"><i class="fas fa-cog"></i> Site Ayarları</a>
                </li>
                <li>
                    <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Çıkış Yap</a>
                </li>
            </ul>
        </nav>

        <!-- Page Content -->
        <div id="content">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <button type="button" id="sidebarCollapse" class="btn btn-primary">
                        <i class="fas fa-bars"></i>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ms-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="../index.php" target="_blank">
                                    <i class="fas fa-external-link-alt"></i> Siteyi Görüntüle
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
