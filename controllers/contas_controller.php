<?php
require __DIR__ . '/usuarios_controller.php';

class contas extends usuario
{
    private $id_logged;
    private $acess;

    public function __construct()
    {
        parent::__construct();
        $this->id_logged  = $this->get_user();
        $this->acess = $this->check_acess_user();
    }

    public function select_all_accounts($id)
    {
        $db = $this->getDb();
        $query_select = "SELECT * FROM contas WHERE user_id = :user_id";
        $params = [
            ':user_id' => $id
        ];
        $select_all = $db->query_select_all($query_select, $params);
        return $select_all;
    }

    public function insert_account($con_descricao, $con_valor, $con_vencimento, $con_tipopag, $user_id)
    {
        $db = $this->getDb();
        var_dump($db);
        $user_id = $this->get_id_logged();
        $date_formated = $this->insert_date($con_vencimento);
        $query_insert = "INSERT INTO contas(con_descricao, con_valor, con_vencimento, con_tipopag, user_id)
        VALUES(:con_descricao, :con_valor, :con_vencimento, :con_tipopag, :user_id)";
        $params = [
            ':con_descricao' => $con_descricao,
            ':con_valor' => $con_valor,
            ':con_vencimento' => $date_formated,
            ':con_tipopag' => $con_tipopag,
            ':user_id' => $user_id
        ];

        $register_account = $db->queryExecute($query_insert, $params);
        if ($register_account)
        {
            header('location: painel_usuario.php');
            exit;
        }
    }

    public function data_account($con_cod)
    {
        $db = $this->getDb();

        $query_select = "SELECT con_descricao, con_valor, con_vencimento, con_tipopag FROM contas WHERE con_cod = :con_cod";
        $params = [
            ':con_cod' => $con_cod
        ];

        $get_account = $db->get_select($query_select, $params);
        return $get_account;
    }

    public function update_account($con_cod, $con_descricao, $con_valor, $con_vencimento, $con_tipopag)
    {
        $db = $this->getDb();
        $date_formated = $this->insert_date($con_vencimento);
        $query_update = "UPDATE contas SET con_descricao = :con_descricao, con_valor = :con_valor, con_vencimento = :con_vencimento,  con_tipopag = :con_tipopag
        WHERE con_cod = :con_cod";
        $params = [
            ':con_descricao' => $con_descricao,
            ':con_valor' => $con_valor,
            ':con_vencimento' => $date_formated,
            ':con_tipopag' => $con_tipopag,
            ':con_cod' => $con_cod
        ];

        $update_account = $db->queryExecute($query_update, $params);
        if ($update_account)
        {
            header('location: contas.php');
            exit;
        }
    }

    public function delete_account($id)
    {
        $db = $this->getDb();
        $query_delete = "DELETE FROM contas WHERE con_cod = :con_cod";
        $params = [
            ':con_cod' => $id
        ];

        $delete_account = $db->queryExecute($query_delete, $params);
        if ($delete_account)
        {
            header('location: contas.php');
            exit;
        }
    }

    public function display_date($date)
    {
        $date = implode("/",array_reverse(explode("-",$date)));
        return $date;
    }

    public function get_id_logged()
    {
        return $this->id_logged;
    }

    public function check_acess()
    {
        return $this->acess;
    }

    public function permission($id)
    {
        $id_logado = $this->get_id_logged();
        if ($id_logado == $id)
        {
            return;
        }
        else
        {
            header('location: 404.php');
            exit;
        }
    }

    public function user_conta($id)
    {
        $db = $this->getDb();
        $query = "SELECT user_id FROM contas WHERE con_cod = :id";
        $params = [
            ':id' => $id
        ];

        $user = $db->get_select($query, $params);
        $user_Id = $user['user_id'];
        return $user_Id;
    }

    private function insert_date($date)
    {
        $date = implode("-",array_reverse(explode("/",$date)));
        return $date;
    }
}