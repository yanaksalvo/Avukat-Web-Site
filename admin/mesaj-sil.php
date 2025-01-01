<?php
session_start();
include '../includes/config.php';

if(!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}

$id = $_GET['id'];
$stmt = $db->prepare("DELETE FROM mesajlar WHERE id = ?");
$stmt->execute([$id]);

header('Location: mesajlar.php');
exit;
