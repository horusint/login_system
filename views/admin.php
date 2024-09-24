<?php
require_once '../includes/headers.php';
require_once '../includes/functions.php';
require_once '../config/db.php';

session_start();





if (!is_admin($_SESSION['user_id'], $pdo)) {
    header('Location: index.php');
    exit;
}

$logs = get_logs($pdo);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <div class="container">
        <h1>Admin Panel</h1>
        <table>
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Access Time</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($logs as $log): ?>
                    <tr>
                        <td><?php echo $log['username']; ?></td>
                        <td><?php echo $log['access_time']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="dashboard.php">Back to Dashboard</a> | <a href="logout.php">Logout</a>
    </div>
</body>
</html>
