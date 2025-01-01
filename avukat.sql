-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost:3306
-- Üretim Zamanı: 28 Ara 2024, 03:22:20
-- Sunucu sürümü: 5.5.68-MariaDB
-- PHP Sürümü: 8.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `asli`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', '123456');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `hakkimda`
--

CREATE TABLE `hakkimda` (
  `id` int(11) NOT NULL,
  `baslik` varchar(255) NOT NULL,
  `aciklama` text NOT NULL,
  `profil_resmi` varchar(255) NOT NULL,
  `egitim` text NOT NULL,
  `uzmanlik_alanlari` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `hakkimda`
--

INSERT INTO `hakkimda` (`id`, `baslik`, `aciklama`, `profil_resmi`, `egitim`, `uzmanlik_alanlari`, `created_at`) VALUES
(1, 'Profesyonel Geçmiş', 'İstanbul Üniversitesi Hukuk Fakültesi\'nden 2003 yılında mezun olduktan sonra, kariyerime önde gelen hukuk bürolarında başladım. 2010 yılında kendi hukuk büromu kurdum.', 'avukat-profil.jpg', '[\"İstanbul Üniversitesi Hukuk Fakültesi (1999-2003)\",\"Ticaret Hukuku Yüksek Lisans (2003-2005)\"]', '[\"Ticaret Hukuku\",\"Gayrimenkul Hukuku\",\"İş Hukuku\",\"Aile Hukuku\"]', '2024-12-26 17:46:25');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `hizmetler`
--

CREATE TABLE `hizmetler` (
  `id` int(11) NOT NULL,
  `baslik` varchar(255) NOT NULL,
  `aciklama` text NOT NULL,
  `ikon` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `hizmetler`
--

INSERT INTO `hizmetler` (`id`, `baslik`, `aciklama`, `ikon`, `created_at`) VALUES
(11, 'Ceza Hukuku', 'Ceza davalarında uzman ekibimizle yanınızdayız. Adli süreçlerin her aşamasında profesyonel destek sağlıyoruz.\r\n<br><i class=\"fas fa-check\" style=\"color: #d8b74b;\"></i>Ağır Ceza Davaları\r\n<br><i class=\"fas fa-check\" style=\"color: #d8b74b;\"></i>Temyiz Başvuruları\r\n<br><i class=\"fas fa-check\" style=\"color: #d8b74b;\"></i>Hukuki Danışmanlık', 'fas fa-balance-scale', '2024-12-27 00:20:02'),
(12, 'Ticaret Hukuku', 'Şirketinizin tüm hukuki süreçlerinde profesyonel destek sağlıyoruz.\r\n<br><i class=\"fas fa-check\" style=\"color: #d8b74b;\"></i>Şirket Kuruluşları\r\n<br><i class=\"fas fa-check\" style=\"color: #d8b74b;\"></i>Ticari Davalar\r\n<br><i class=\"fas fa-check\" style=\"color: #d8b74b;\"></i>Sözleşme Hazırlama', 'fas fa-briefcase', '2024-12-27 00:22:26'),
(13, 'Gayrimenkul Hukuku', 'Gayrimenkul alım satım ve kiralama süreçlerinde hukuki danışmanlık hizmeti veriyoruz.\r\n<br><i class=\"fas fa-check\" style=\"color: #d8b74b;\"></i>Tapu İşlemleri\r\n<br><i class=\"fas fa-check\" style=\"color: #d8b74b;\"></i>Kira Sözleşmeleri\r\n<br><i class=\"fas fa-check\" style=\"color: #d8b74b;\"></i>Gayrimenkul Davaları', 'fas fa-home', '2024-12-27 00:22:53'),
(14, 'Aile Hukuku', 'Aile hukukuyla ilgili tüm süreçlerde yanınızdayız.\r\n<br><i class=\"fas fa-check\" style=\"color: #d8b74b;\"></i>Boşanma Davaları\r\n<br><i class=\"fas fa-check\" style=\"color: #d8b74b;\"></i>Nafaka İşlemleri\r\n<br><i class=\"fas fa-check\" style=\"color: #d8b74b;\"></i>Velayet Davaları', 'fas fa-users', '2024-12-27 00:26:57');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `iletisim_bilgileri`
--

CREATE TABLE `iletisim_bilgileri` (
  `id` int(11) NOT NULL,
  `adres` text,
  `telefon` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `calismaSaatleri` text,
  `maps_code` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `iletisim_bilgileri`
--

INSERT INTO `iletisim_bilgileri` (`id`, `adres`, `telefon`, `email`, `calismaSaatleri`, `maps_code`) VALUES
(1, 'İstanbul, Türkiye', '+90 505 404 33 22', 'denememail@gmail.com', 'Pazartesi - Cuma: 09:01 - 18:24\r\nCumartesi: 09:48 - 13:11', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d24071.763925093826!2d28.78968358039857!3d41.04777440502714!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14caa5a83957dee3%3A0xbd5ae729a0ad57d7!2s212%20Outlet!5e0!3m2!1str!2str!4v1735233813589!5m2!1str!2str\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `mesajlar`
--

CREATE TABLE `mesajlar` (
  `id` int(11) NOT NULL,
  `ad_soyad` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telefon` varchar(20) DEFAULT NULL,
  `konu` varchar(200) DEFAULT NULL,
  `mesaj` text,
  `okundu` tinyint(1) NOT NULL DEFAULT '0',
  `tarih` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `mesajlar`
--

INSERT INTO `mesajlar` (`id`, `ad_soyad`, `email`, `telefon`, `konu`, `mesaj`, `okundu`, `tarih`) VALUES
(1, 'Rıza Altıner', 'rizaa.altiner@gmail.com', '05432014349', 'Deneme', 'Bu bir deneme mesajıdır birader', 1, '2024-12-27 23:46:13');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `site_ayarlari`
--

CREATE TABLE `site_ayarlari` (
  `id` int(11) NOT NULL,
  `site_baslik` varchar(255) NOT NULL,
  `logotype` varchar(255) NOT NULL,
  `avukat_gorsel` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `dava_sayisi` varchar(50) DEFAULT NULL,
  `muvekkil_sayisi` varchar(50) DEFAULT NULL,
  `deneyim_yili` varchar(50) DEFAULT NULL,
  `biyografi` text,
  `egitim` text,
  `uzmanlik` text,
  `email` varchar(255) NOT NULL,
  `telefon` varchar(20) NOT NULL,
  `adres` text NOT NULL,
  `calisma_saatleri` text,
  `maps_code` text,
  `facebook` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `whatsapp_telefon` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `site_ayarlari`
--

INSERT INTO `site_ayarlari` (`id`, `site_baslik`, `logotype`, `avukat_gorsel`, `logo`, `dava_sayisi`, `muvekkil_sayisi`, `deneyim_yili`, `biyografi`, `egitim`, `uzmanlik`, `email`, `telefon`, `adres`, `calisma_saatleri`, `maps_code`, `facebook`, `twitter`, `instagram`, `linkedin`, `created_at`, `whatsapp_telefon`) VALUES
(1, 'Avukat Aslı Bostan', 'Aslı Bostan', '1735249818_asli.png', NULL, '78+', '230+', '4+', '2006 yılında Darüşşafaka\'da başlayan eğitim hayatım, Galatasaray Lisesi ve İstanbul Üniversitesi Hukuk Fakültesi\'nde devam etti. Galatasaray Üniversitesi\'nde Özel Hukuk alanında yüksek lisans yaparak akademik kariyerimi tamamladım. Meslek hayatım boyunca yerli ve yabancı müvekkillerime hukuki danışmanlık hizmeti sundum. Özellikle ticaret hukuku ve iş hukuku alanlarında uzmanlaşarak, müvekkillerimin haklarını en iyi şekilde savunmaya devam ediyorum.', 'Özel Darüşşafaka Ortaokulu (2006-2010)\r\nGalatasaray Lisesi (2010-2014)\r\nİstanbul Üniversitesi Hukuk Fakültesi (2014-2018)\r\nİstanbul Barosu Avukatlık Stajı (2018-2019)\r\nGalatasaray Üniversitesi Özel Hukuk Yüksek Lisans (2019-2021)', 'Ticaret Hukuku\r\nİş Hukuku\r\nGayrimenkul Hukuku\r\nAile Hukuku\r\nCeza Hukuku', 'info@avukat.com', '+90 555 123 45 67', 'İstanbul, Türkiye', 'Pazartesi - Cuma: 09:00 - 18:00<br />\r\nCumartesi: 09:00 - 13:00', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d24071.763925093826!2d28.78968358039857!3d41.04777440502714!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14caa5a83957dee3%3A0xbd5ae729a0ad57d7!2s212%20Outlet!5e0!3m2!1str!2str!4v1735233813589!5m2!1str!2str\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>', '', '', '', '', '2024-12-26 19:16:39', '905432014349');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `slider`
--

CREATE TABLE `slider` (
  `id` int(11) NOT NULL,
  `baslik` varchar(100) DEFAULT NULL,
  `aciklama` text,
  `resim_url` varchar(255) DEFAULT NULL,
  `sira` int(11) DEFAULT NULL,
  `button_text` varchar(50) DEFAULT NULL,
  `button_link` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `slider`
--

INSERT INTO `slider` (`id`, `baslik`, `aciklama`, `resim_url`, `sira`, `button_text`, `button_link`) VALUES
(2, 'Deneme slider', 'Deneme slider açıklama yazısı', '1735233341_hukuk.jpg', 1, 'İletişim', 'iletisim.php'),
(3, 'Yeni Slider', 'Slider açıklaması', 'resim.jpg', 2, 'Buton Yazısı', 'sayfa.php');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `yorumlar`
--

CREATE TABLE `yorumlar` (
  `id` int(11) NOT NULL,
  `isim` varchar(255) NOT NULL,
  `unvan` varchar(255) NOT NULL,
  `yorum` text NOT NULL,
  `durum` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `yorumlar`
--

INSERT INTO `yorumlar` (`id`, `isim`, `unvan`, `yorum`, `durum`, `created_at`) VALUES
(4, 'Mehmet K.', 'İş İnsanı', 'Şirket birleşme sürecinde gösterdiği profesyonel yaklaşım ve detaylı hukuki danışmanlık için teşekkür ederim. Süreç boyunca her aşamayı net bir şekilde aktardı.', 1, '2024-12-28 00:17:47'),
(5, 'Ayşe B.', 'Eczacı', 'Miras davamızda gösterdiği özen ve sabır için minnettarım. Aile içi hassas konuları çok profesyonelce yönetti.', 1, '2024-12-28 00:17:47'),
(6, 'Hakan Y.', 'Mimar', 'İnşaat projemizdeki hukuki süreçleri başarıyla yönetti. Karmaşık prosedürleri anlayabileceğimiz şekilde açıkladı.', 1, '2024-12-28 00:17:47'),
(7, 'Zeynep D.', 'Akademisyen', 'Telif hakları konusunda sunduğu danışmanlık hizmeti gerçekten değerliydi. Akademik çalışmalarımı güvence altına aldı.', 1, '2024-12-28 00:17:47'),
(8, 'Ali R.', 'Restaurant İşletmecisi', 'Ticari anlaşmazlığımızı kısa sürede ve etkili bir şekilde çözüme kavuşturdu. İş hayatımıza güvenle devam ediyoruz.', 1, '2024-12-28 00:17:47'),
(9, 'Fatma S.', 'Ev Hanımı', 'Boşanma sürecinde gösterdiği anlayış ve profesyonel yaklaşım için teşekkür ederim. Zor süreci kolaylaştırdı.', 1, '2024-12-28 00:17:47'),
(10, 'Mustafa T.', 'Sanayici', 'Şirketimizin hukuki danışmanlığını 3 yıldır yürütüyor. Ticari işlemlerimizde kendimizi güvende hissediyoruz.', 1, '2024-12-28 00:17:47'),
(11, 'Selin M.', 'Doktor', 'Tıbbi ihmal davamızda gösterdiği uzmanlık ve kararlılık sayesinde hakkımızı aldık. Teşekkürler.', 1, '2024-12-28 00:17:47'),
(12, 'Ahmet P.', 'Yazılımcı', 'Start-up şirketimizin kuruluş sürecini sorunsuz yönetti. Dijital hukuk alanındaki bilgisi çok değerli.', 1, '2024-12-28 00:17:47'),
(13, 'Esra K.', 'Öğretmen', 'İş hukuku konusundaki uzmanlığı ile hakkımı aramama yardımcı oldu. Süreç boyunca destekleyici yaklaşımı için teşekkürler.', 1, '2024-12-28 00:17:47'),
(14, 'Burak S.', 'Mali Müşavir', 'Vergi hukuku konusundaki derin bilgisi ve pratik çözümleri ile işlerimizi kolaylaştırdı.', 1, '2024-12-28 00:17:47'),
(15, 'Deniz A.', 'Galerici', 'Ticari ihtilafımızı uzlaşma yoluyla çözüme kavuşturdu. Arabuluculuk sürecini ustaca yönetti.', 1, '2024-12-28 00:17:47'),
(16, 'Canan Y.', 'Tekstilci', 'Marka tescili ve fikri mülkiyet haklarımızı güvence altına aldı. Sektörde kendimizi güvende hissediyoruz.', 1, '2024-12-28 00:17:47'),
(17, 'Kemal B.', 'Emekli Memur', 'Emeklilik haklarımla ilgili davada gösterdiği gayret için teşekkür ederim. Haklarımı sonuna kadar savundu.', 1, '2024-12-28 00:17:47'),
(18, 'Sevgi M.', 'Sanatçı', 'Telif hakları konusundaki uzmanlığı sayesinde eserlerimi güvence altına aldım. Sanat camiasına öneriyorum.', 1, '2024-12-28 00:17:47'),
(19, 'Orhan T.', 'İnşaat Müteahhidi', 'Kentsel dönüşüm projemizdeki hukuki süreçleri başarıyla yönetti. Profesyonel yaklaşımı için teşekkürler.', 1, '2024-12-28 00:17:47'),
(20, 'Leyla K.', 'Psikolog', 'Ofis kiralama sürecindeki hukuki desteği için teşekkürler. Sözleşme sürecini güvenle tamamladık.', 1, '2024-12-28 00:17:47'),
(21, 'Serkan D.', 'E-ticaret Girişimcisi', 'Online ticaret süreçlerimizi yasal çerçevede düzenledi. E-ticaret hukukundaki güncel bilgisi çok değerli.', 1, '2024-12-28 00:17:47'),
(22, 'Yeliz B.', 'Spor Salonu İşletmecisi', 'İşyeri açma sürecindeki bürokratik işlemleri sorunsuz halletti. Çözüm odaklı yaklaşımı takdire şayan.', 1, '2024-12-28 00:17:47'),
(23, 'Murat C.', 'Otel Sahibi', 'Turizm sektöründeki yasal düzenlemelere hakimiyeti ve sektörel tecrübesi işimizi çok kolaylaştırdı.', 1, '2024-12-28 00:17:47');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `hakkimda`
--
ALTER TABLE `hakkimda`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `hizmetler`
--
ALTER TABLE `hizmetler`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `iletisim_bilgileri`
--
ALTER TABLE `iletisim_bilgileri`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `mesajlar`
--
ALTER TABLE `mesajlar`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `site_ayarlari`
--
ALTER TABLE `site_ayarlari`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `yorumlar`
--
ALTER TABLE `yorumlar`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `hakkimda`
--
ALTER TABLE `hakkimda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `hizmetler`
--
ALTER TABLE `hizmetler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Tablo için AUTO_INCREMENT değeri `iletisim_bilgileri`
--
ALTER TABLE `iletisim_bilgileri`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `mesajlar`
--
ALTER TABLE `mesajlar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `site_ayarlari`
--
ALTER TABLE `site_ayarlari`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `slider`
--
ALTER TABLE `slider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `yorumlar`
--
ALTER TABLE `yorumlar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
