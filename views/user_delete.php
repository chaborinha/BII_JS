<?php 
require __DIR__ . '/../controllers/usuarios_controller.php';

$id_delete = $_GET['id'];

$delete_count = new usuario();

$delete_count->delete_count($id_delete);