<?php
require __DIR__ . '/../controllers/contas_controller.php';
$conta_delete = new contas();

$id_delete = $_GET['id'];
$conta_delete->delete_account($id_delete);