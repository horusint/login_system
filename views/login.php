<?php

if(!isset($_SESSION)){
    session_start();
}
if (!isset($_SESSION['user_id'])) {
    echo "no hay usuario logueado.";
}else{
    echo "LOGGED IN !";
    // echo $_SESSION['csrf_token'];
    // lo voy a redireccionar al dashboard!
    header('Location: dashboard.php');
}

require_once '../includes/headers.php';
require_once '../controllers/usuario.php';

$mi_usuario = new usuario();
$mi_usuario->auth();



?>
