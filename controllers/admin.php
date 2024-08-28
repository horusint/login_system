<?php
require_once '../config/db.php';
require_once '../includes/functions.php';
session_start();

if (!is_admin($_SESSION['user_id'], $pdo)) {
    header('Location: ../views/index.php');
    exit;
}

$logs = get_logs($pdo);
?>

<!-- HTML para mostrar el registro de accesos -->
 
