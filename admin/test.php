<?php
// test.php - admin klasörü içine kaydedin
$password = "12345"; // istediğiniz şifreyi buraya yazın
$hash = password_hash($password, PASSWORD_DEFAULT);
echo "Hash: " . $hash;
?>
