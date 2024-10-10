<?php
require_once '../config/db.php';
require_once '../includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    if (validate_csrf_token($_POST['csrf_token'])) {
        if (send_password_reset($email, $pdo)) {
            $message = 'Correo enviado con instrucciones.';
        } else {
            $error = 'Error al enviar el correo.';
        }
    } else {
        $error = 'Token CSRF inválido.';
    }
}
?>

<!-- HTML para la recuperación de contraseña -->

