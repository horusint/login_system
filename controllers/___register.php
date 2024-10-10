<?php
require_once '../config/db.php';
require_once '../includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $role = $_POST['role'];
    if (validate_csrf_token($_POST['csrf_token'])) {
        $resultado = register_user($username, $email, $password, $role, $pdo);
        if(isset($resultado)){
            if ($resultado) {
                header('Location: ../views/logout.php');
                exit;
            } else {
                $error = 'Error al registrar el usuario.';
            }
        }
    } else {
        $error = 'Token CSRF inválido.';
    }
} else {
    $error = 'problema con el POST';
}
?>
