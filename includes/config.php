<?php
// Veritabanı bağlantı bilgileri
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'asli';

try {
    $db = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->exec("SET NAMES 'utf8'");
    $db->exec("SET CHARACTER SET utf8");
} catch(PDOException $e) {
    echo "Bağlantı hatası: " . $e->getMessage();
}
?>
