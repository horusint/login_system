<?php

session_start();

/*
if (!isset($_SESSION['csrf_token'])) {
    echo "no esta seteado csfr_token.";
}else{
    echo "csrf_token SET!";
    // echo $_SESSION['csrf_token'];
    // lo voy a redireccionar al dashboard!
    // header('Location: dashboard.php');
}
*/
// --------$_SESSION['user_id']
if (!isset($_SESSION['user_id'])) {
    echo "no hay usuario logueado.";
}else{
    echo "LOGGED IN !";
    // echo $_SESSION['csrf_token'];
    // lo voy a redireccionar al dashboard!
    header('Location: dashboard.php');
}




// ---------



$elPath = get_include_path();
$nuevo = $elPath . "/" . "login_system";
set_include_path($nuevo);
/*
echo "get_include_path(): [ ";
echo get_include_path();
echo " ]";
*/
require_once '../includes/headers.php';
require_once '../includes/functions.php';

$un_csrf_token = generate_csrf_token();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    Sistema de Login - Grupo B-4
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <div class="container">
        <h1>Login</h1>
        <form action="../controllers/auth.php" method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="hidden" name="csrf_token" value="<?php echo $un_csrf_token; ?>">
            <input type="submit" value="Login">
            <?php if (isset($error)): ?>
                <div class="error"><?php echo $error; ?></div>
            <?php endif; ?>
        </form>
        <a href="register.php">Registrar</a> | <a href="forgot_password.php">Olvido Password?</a>
    </div>
</body>
</html>
