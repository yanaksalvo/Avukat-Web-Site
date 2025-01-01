<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Avukat Web Sitesi</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <?php
    $site_ayarlari = $db->query("SELECT site_baslik, logo, logotype FROM site_ayarlari WHERE id = 1")->fetch();
    ?>
    
    <header class="main-header">
        <div class="container">
            <nav class="navbar">
                <div class="logo">
                    <a href="index.php">
                        <?php if (!empty($site_ayarlari['logo'])): ?>
                            <img src="uploads/<?php echo $site_ayarlari['logo']; ?>" alt="<?php echo $site_ayarlari['site_baslik']; ?>">
                        <?php else: ?>
                            <div class="logotype"><?php echo $site_ayarlari['logotype']; ?></div>
                        <?php endif; ?>
                    </a>
                </div>
                
                <div class="mobile-menu-btn" id="mobileMenuBtn">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                <ul class="nav-menu" id="navMenu">
                    <li><a href="index.php" class="nav-link">Ana Sayfa</a></li>
                    <li><a href="hakkimda.php" class="nav-link">Hakkımda</a></li>
                    <li><a href="hizmetler.php" class="nav-link">Hizmetler</a></li>
                    <li><a href="iletisim.php" class="nav-link">İletişim</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <style>
    .main-header {
        background: #fff;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        position: fixed;
        width: 100%;
        top: 0;
        z-index: 1000;
    }

    .navbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px 0;
    }

    .logo img {
        max-height: 50px;
    }

    .logotype {
        font-size: 24px;
        font-weight: bold;
        color: #333;
    }

    .nav-menu {
        display: flex;
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .nav-link {
        color: #333;
        text-decoration: none;
        padding: 10px 20px;
        transition: color 0.3s;
    }

    .nav-link:hover {
        color: #d4af37;
    }

    .mobile-menu-btn {
        display: none;
        flex-direction: column;
        cursor: pointer;
        padding: 10px;
    }

    .mobile-menu-btn span {
        width: 25px;
        height: 3px;
        background: #333;
        margin: 2px 0;
        transition: 0.3s;
    }

    @media (max-width: 768px) {
        .mobile-menu-btn {
            display: flex;
        }

        .nav-menu {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            width: 100%;
            background: #fff;
            flex-direction: column;
            padding: 20px 0;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .nav-menu.active {
            display: flex;
        }

        .nav-menu li {
            text-align: center;
        }

        .nav-link {
            display: block;
            padding: 15px 20px;
        }

        .mobile-menu-btn.active span:nth-child(1) {
            transform: rotate(45deg) translate(5px, 5px);
        }

        .mobile-menu-btn.active span:nth-child(2) {
            opacity: 0;
        }

        .mobile-menu-btn.active span:nth-child(3) {
            transform: rotate(-45deg) translate(5px, -5px);
        }
    }
    </style>

    <script>
        document.getElementById('mobileMenuBtn').addEventListener('click', function() {
            this.classList.toggle('active');
            document.getElementById('navMenu').classList.toggle('active');
        });
    </script>
