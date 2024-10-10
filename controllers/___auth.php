<?php
require_once '../config/db.php';
require_once '../includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (validate_csrf_token($_POST['csrf_token'])) {
        $user = authenticate_user($username, $password, $pdo);
        if ($user) {
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];
            log_access($user['id'], $pdo);
            header('Location: ../views/dashboard.php');
            exit;
        } else {
            $error = 'Credenciales incorrectas.';
        }
    } else {
        $error = 'Token CSRF inválido.';
    }
}
?>

<!-- HTML para el formulario de login -->

 
