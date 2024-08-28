<?php
require_once '../config/db.php';
require_once '../includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $role = $_POST['role'];

    if (validate_csrf_token($_POST['csrf_token'])) {
        if (register_user($username, $email, $password, $role, $pdo)) {
            header('Location: ../views/index.php');
            exit;
        } else {
            $error = 'Error al registrar el usuario.';
        }
    } else {
        $error = 'Token CSRF inválido.';
    }
}
?>

<!-- HTML para el formulario de registro -->
