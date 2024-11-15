<?php
require __DIR__ . '/../database/database.php';

class admin
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function ckeck_admin()
    {
        if ($_SESSION['nivel_acesso'] !== 'admin')
        {
            header('location: ../acess_verify.php');
            exit;
        }
    }

    public function register_admin($nome, $email, $senha, $user_nivel)
    {
        if ($this->email_exists($email))
        {
            return 'E-mail já cadastrado';
        }

        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

        $query_insert = "INSERT INTO users (user_name, user_email, user_password, user_nivel)
                         VALUES (:user_name, :user_email, :user_password, :user_nivel)";
         
        $params = [
            ':user_name' => $nome,
            ':user_email' => $email,
            ':user_password' => $senha_hash,
            ':user_nivel' => $user_nivel
        ];
        
        $register_user = $this->db->queryExecute($query_insert, $params);

        if ($register_user)
        {
            header('location: dashboard.php');
        }
    }

    public function select_all($user_nivel)
    {
        $query_select = "SELECT * FROM users WHERE user_nivel = :user_nivel";
        $params = [
            ':user_nivel' => $user_nivel
        ];

        $users = $this->db->query_select_all($query_select, $params);
        
        return $users;
    }

    public function update_admin($nome, $email, $senha, $id)
    {
        if ($this->email_exists($email))
        {
            return 'E-mail já cadastrado';
        }

        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

        $query_update = "UPDATE users SET user_name = :user_name, user_email = :user_email, user_password = :user_password WHERE user_id = :id";
        $params = [
            ':user_name' => $nome,
            ':user_email' => $email,
            ':user_id' => $id
        ];

        $update_user = $this->db->queryExecute($query_update, $params);

        if ($update_user)
        {
            header('location: dashboard.php');
            exit;
        }
    }

    public function delete_admin($id)
    {
        $query_delete = ("DELETE FROM users WHERE user_id = :id");
        $params = [
            ':id' => $id
        ];

        $delete_user = $this->db->queryExecute($query_delete, $params);

        if ($delete_user)
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
} 