<?php
require __DIR__ . '/../database/database.php';

class login
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function check_logged()
    {
        $this->check_session();
        if (empty($_SESSION['id']))
        {
            return;
        } else {
            header('location: ../acess_verify.php');
        }
        
    }

    public function login_process($email, $senha)
    {
        if (empty($email) || empty($senha)) {
            return false;
        }

        $query_login = "SELECT * FROM users WHERE user_email = :user_email";
        $params = [':user_email' => $email];
        $login_process = $this->db->get_select($query_login, $params);

        if ($login_process && password_verify($senha, $login_process['user_password'])) {
            $this->check_session();
            session_regenerate_id(true);

            $_SESSION['id'] = $login_process['user_id'];
            $_SESSION['nome'] = $login_process['user_name'];
            $_SESSION['nivel_acesso'] = $login_process['user_nivel'];

            header('location: ../acess_verify.php');
        } 
    }

    public function acess_verify()
    {
        $this->check_session();
        
        if (empty($_SESSION['id'])) {
            header('Location: views/form_login.php');
            exit;
        }

        if ($_SESSION['nivel_acesso'] === 'admin') {
            header('Location: views/dashboard.php');
            exit;
        } else {
            header('Location: views/painel_usuario.php');
            exit;
        }
    }

    public function logout()
    {
        $this->check_session();
        session_unset();
        session_destroy();

        header('Location: form_login.php');
        exit;
    }

    private function check_session()
    {
        if ( session_status() !== PHP_SESSION_ACTIVE)
        {
            session_start();
        }
    }

}
