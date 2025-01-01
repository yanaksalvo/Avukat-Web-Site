<?php
session_start();
include '../includes/config.php';

if(!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}

$id = $_GET['id'];

// Önce resmi sil
$stmt = $db->prepare("SELECT resim_url FROM slider WHERE id = ?");
$stmt->execute([$id]);
$slider = $stmt->fetch();

if($slider['resim_url']) {
    unlink('../uploads/slider/' . $slider['resim_url']);
}

// Slider kaydını sil
$stmt = $db->prepare("DELETE FROM slider WHERE id = ?");
$stmt->execute([$id]);

header('Location: slider.php');
exit;
