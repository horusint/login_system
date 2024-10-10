<?php

require_once 'csrf_check.php';
require_once 'conexion_db.php';


class usuario{
    private $mi_csrf;
    private $mi_conexion;


    // Constructor      ------------------------------------------------------------------------------------------------------
    public function __construct(){
        $this->mi_csrf = new csrf_check();

        $unaConexion = new conexion_db();

        $this->mi_conexion = $unaConexion->get_pdo();


    }

    // Métodos públicos ------------------------------------------------------------------------------------------------------
    public function auth(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            echo '<pre>';
            print_r($_POST);
            echo '</pre>';

            $username = trim($_POST['username']);
            $password = trim($_POST['password']);
            $checkeo = $this->mi_csrf->validate_csrf_token($_POST['csrf_token']);

            if ( $checkeo ) {
                // $mi_conexion = $this->mi_conexion;
                $user = $this->db_authenticate_user($username, $password);
                if ($user) {
                    if(!isset($_SESSION)){
                        session_start();
                    }
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['role'] = $user['role'];
                    $this->log_access($user['id']);
                    header('Location: ../views/dashboard.php');
                    exit;
                } else {
                    $error = 'Credenciales incorrectas.';
                }
            } else {
                $error = 'Token CSRF inválido.';
            }
        }
    }
    public function register_user($username, $email, $password, $role) {
        if (user_exists($username, $email)) {
            return false;
        }
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        $mi_conexion = $this->mi_conexion;
        $stmt = $mi_conexion->prepare("INSERT INTO users (username, email, password, role) VALUES (:username, :email, :password, :role)");
        return $stmt->execute(['username' => $username, 'email' => $email, 'password' => $hashed_password, 'role' => $role]);
    }

    public function panel_admin(){
        // Si el usuario está logueado y es admin, lo redirecciono.
        // Soy admin ? redirecciono.
        if (isset($_SESSION['user_id'])) {
            // Esta logueado
            if( $this->is_admin( $_SESSION['user_id'] ) ){
                // Es admin.
                $devolver = $this->get_logs();
                return $devolver;
            } else {
                // NO es admin.
                header('Location: ../views/dashboard.php');
                exit;
            }
        } else {
            // NO está logueado.
            header('Location: ../views/index.php');
            exit;
        }
    }


    public function get_logs(){
        $mi_conexion = $this->mi_conexion;
        $stmt = $mi_conexion->query("SELECT users.username, access_logs.access_time FROM access_logs INNER JOIN users ON access_logs.user_id = users.id ORDER BY access_logs.access_time DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Métodos privados ------------------------------------------------------------------------------------------------------
    private function log_access($user_id){
        $mi_conexion = $this->mi_conexion;
        $stmt = $mi_conexion->prepare("INSERT INTO access_logs (user_id, access_time) VALUES (:user_id, NOW())");
        $stmt->execute(['user_id' => $user_id]);
    }
    private function user_exists($username, $email) {
        $mi_conexion = $this->mi_conexion;
        $stmt = $mi_conexion->prepare("SELECT id FROM users WHERE username = :username OR email = :email");
        $stmt->execute(['username' => $username, 'email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    private function user_exists_by_email($email) {
        $mi_conexion = $this->mi_conexion;
        $stmt = $mi_conexion->prepare("SELECT id FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    private function is_admin($user_id) {
        $mi_conexion = $this->mi_conexion;
        $stmt = $mi_conexion->prepare("SELECT role FROM users WHERE id = :id");
        $stmt->execute(['id' => $user_id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user && $user['role'] === 'admin';
    }
    private function db_authenticate_user($username, $password) {
        $mi_conexion = $this->mi_conexion;
        $stmt = $mi_conexion->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }






}




?>
