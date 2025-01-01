<?php
include '../includes/config.php';

if(isset($_POST['id'])) {
    $id = $_POST['id'];
    $db->query("DELETE FROM hizmetler WHERE id = $id");
    echo 'success';
}
