<?php
require_once '../config/db.php';
require_once '../includes/functions.php';


echo "get_include_path(): [ ";
echo get_include_path();
echo " ]";
echo "</br>";


echo "</br>";
echo "</br>";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $role = $_POST['role'];

    echo "datos del POST:";
    echo "</br>";
    echo $username;
    echo "</br>";
    echo $email;
    echo "</br>";
    echo $password;
    echo "</br>";
    echo $role;
    echo "</br>";
    echo $_POST['csrf_token'];
    echo "</br>";
    echo validate_csrf_token($_POST['csrf_token']);
    echo "</br>";


    if (validate_csrf_token($_POST['csrf_token'])) {
        echo "csrf_token OK.";
        echo "</br>";
        echo "Llamo a register_user";
        echo "</br>";
        $resultado = register_user($username, $email, $password, $role, $pdo);
        echo "FIN Llamado a register_user";
        echo "</br>";
        if(isset($resultado)){
            if ($resultado) {
                echo "Cambio el header al index.";
                echo "</br>";
                header('Location: ../views/logout.php');
                exit;
            } else {
                $error = 'Error al registrar el usuario.';
            }
        }else{
            echo "register_user no devolvió nada.";
            echo "</br>";
        }
    } else {
        $error = 'Token CSRF inválido.';
    }
} else {
    $error = 'problema con el POST';
}

echo "</br>";
echo "</br>";
echo "llego hasta acá (FIN).";
?>

<!-- HTML para el formulario de registro -->
