<?php
require __DIR__ . '/usuarios_controller.php';

class vencimentos extends usuario
{
    private $id_logged;
    private $acess;

    public function __construct()
    {
        parent::__construct();
        $this->id_logged = $this->get_user();
        $this->acess = $this->check_acess_user();
    }
    
    public function get_id_logged()
    {
        return $this->id_logged;
    }

    public function check_acess()
    {
        return $this->acess;
    }

    public function inserir_vencimentos()
    {
        $db = $this->getDb();
        $query_insert = "INSERT INTO vencimentos(ven_descricao, ven_valor, ven_data, user_id)
        VALUES(:ven_descricao, :ven_valor, :ven_data, :user_id)";
    }
}