<?php
require_once '../includes/functions.php';

/*
$host = getenv('DB_HOST');
$db = getenv('DB_NAME');
$user = getenv('DB_USER');
$pass = getenv('DB_PASS');


DB_HOST=127.0.0.1
DB_NAME=login_system
DB_USER=login_escritor
DB_PASS=writeAccess

*/
$host = "127.0.0.1";
$db = "login_system";
$user = "login_escritor";
$pass = "writeAccess";



try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Intenté conectar a DB con:";
    echo "</br>";
    echo $host;
    echo "</br>";
    echo $db;
    echo "</br>";
    echo $user;
    echo "</br>";
    echo $pass;
    echo "</br>";
    error_log($e->getMessage());
    die('Error de Conexion a Database.');
}
?>

 
