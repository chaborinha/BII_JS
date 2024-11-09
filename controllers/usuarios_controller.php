<?php
require __DIR__ . '/../database/database.php';

class usuario
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getDb()
    {
        return $this->db;
    }

    public function register_user($nome, $email, $senha)
    {
        if ($this->email_exists($email)) {
            return 'E-mail já cadastrado.';
        }

        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

        $user_nivel = 'usuario';

        $query_insert = "INSERT INTO users (user_name, user_email, user_password, user_nivel)
                         VALUES (:user_name, :user_email, :user_password, :user_nivel)";
                         
        $params = [
            ':user_name' => $nome,
            ':user_email' => $email,
            ':user_password' => $senha_hash,
            ':user_nivel' => $user_nivel
        ];

        $register_user = $this->db->queryExecute($query_insert, $params);

        if ($register_user) {
            $this->check_session();
            session_regenerate_id(true);

            $user_id = $this->db->lastInsertId();

            $_SESSION['id'] = $user_id;
            $_SESSION['nome'] = $nome;
            $_SESSION['nivel_acesso'] = $user_nivel;

            header('Location: ../acess_verify.php');
            exit;
        }
    }

    public function select_user($id)
    {
        $query_select = "SELECT user_name, user_email, user_nivel FROM users WHERE user_id = :id";
        $params = [
            ':id' => $id
        ];

        $select_user = $this->db->get_select($query_select, $params);

        return $select_user;
    }

    public function alterar_dados($nome, $email, $id)
    {
        $query_update = "UPDATE users SET user_name = :nome, user_email = :email WHERE user_id = :id ";
        $params = [
            ':nome' => $nome,
            ':email' => $email,
            ':id' => $id
        ];

        $update_user = $this->db->queryExecute($query_update, $params);

        if ($update_user)
        {
            header('location: painel_usuario.php');
            exit;
        }
    }

    public function delete_count($id)
    {
        $query_delete = "DELETE FROM users WHERE user_id = :id";
        $params = [
            ':id' => $id
        ];

        $delete_user = $this->db->queryExecute($query_delete, $params);

        if ($delete_user)
        {
            header('location: form_login.php');
            exit;
        }
    }

    public function get_user()
    {
        $this->check_session();

        return $_SESSION['id'];
    }

    
    public function permissions($id_url)
    {
        $id_logged = $this->get_user();

        if ($id_logged == $id_url)
        {
            return;
        }
        else
        {
            die('Você não tem acesso a este usuário');
        }
    }

    public function check_acess_user()
    {
        $this->check_session();
        if (empty($_SESSION['id']))
        {
            header('location: ../index.php');
        }

        if ($_SESSION['nivel_acesso'] == 'admin')
        {
            header('location: dashboard.php');
            exit;
        }
    }

    private function email_exists($email)
    {
        $query_check_email = "SELECT COUNT(*) FROM users WHERE user_email = :user_email";
        $params = [':user_email' => $email];

        $result = $this->db->get_select($query_check_email, $params);

        return $result['COUNT(*)'] > 0;
    }

    private function check_session()
    {
        if ( session_status() !== PHP_SESSION_ACTIVE)
        {
            session_start();
        }
    }

}
