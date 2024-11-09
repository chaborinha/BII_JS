<?php
require __DIR__ . '/../controllers/admin_controller.php';
$id_excluir = $_GET['id'];
$admin_delete = new admin();
$admin_delete->delete_admin($id_excluir);

?>