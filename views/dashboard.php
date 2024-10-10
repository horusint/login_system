<?php
require_once '../includes/headers.php';
// require_once '../includes/functions.php';


if(!isset($_SESSION)){
    session_start();
}


if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <div class="container">
        <h1>Welcome to your Dashboard</h1>
        <p>Your user ID is: <?php echo $_SESSION['user_id']; ?></p>
        <a href="admin.php">Admin Panel</a> | <a href="logout.php">Logout</a>
    </div>
</body>
</html>
 
