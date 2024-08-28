<?php
require_once '../config/db.php';
require_once '../includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['user_id'];
    if (unlock_account($user_id, $pdo)) {
        $message = 'Cuenta desbloqueada exitosamente.';
    } else {
        $error = 'Error al desbloquear la cuenta.';
    }
}
?>

<!-- HTML para desbloquear cuentas -->

