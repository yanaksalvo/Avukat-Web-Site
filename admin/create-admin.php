<?php
include '../includes/config.php';

$username = "yeni_admin";
$password = "yeni_sifre";
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$stmt = $db->prepare("INSERT INTO admin (username, password) VALUES (?, ?)");
$stmt->execute([$username, $hashed_password]);

echo "Admin başarıyla oluşturuldu!";
?>
