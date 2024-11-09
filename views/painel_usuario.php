<?php require __DIR__ . '/layouts/header.php'; ?>


<?php
require __DIR__ . '/../controllers/usuarios_controller.php';
//require __DIR__ . '/../controllers/contas_controller.php';

$user = new usuario();
$user->check_acess_user();
$user_logged = $user->get_user();
$data_user = $user->select_user($user_logged);

echo 'Olá ' . $data_user['user_nivel'] . ' ' . $data_user['user_name'];

?>

<a href="contas.php">Ver contas</a>
<a href="vencimentos.php">Ver vencimentos</a>

<?php require __DIR__ . '/layouts/footer.php'; ?>