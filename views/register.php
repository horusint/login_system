<?php
require_once '../includes/headers.php';
require_once '../includes/functions.php';

/*
echo "get_include_path(): [ ";
echo get_include_path();
echo " ]";
*/
$csrf_token = generate_csrf_token();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <div class="container">
        <h1>Register</h1>
        <form action="../controllers/register.php" method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <select name="role" required>
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>
            <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
            <input type="submit" value="Register">
            <?php if (isset($error)): ?>
                <div class="error"><?php echo $error; ?></div>
            <?php endif; ?>
        </form>
        <a href="index.php">Back to Login</a>
    </div>
</body>
</html>
