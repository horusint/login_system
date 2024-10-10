<?php
// require_once '../includes/functions.php';

class conexion_db{
    private $mi_pdo;
    public function __construct(){
        $host = "127.0.0.1";
        $db = "login_system";
        $user = "login_escritor";
        $pass = "writeAccess";
        try {
            $this->mi_pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
        } catch (PDOException $e) {
            echo "Error al conectar con la DB.";
            error_log($e->getMessage());
            die('Error de Conexion a la base de datos.');
        }
    }
    public function get_pdo(){
        return $this->mi_pdo;
    }
}


?>

 
