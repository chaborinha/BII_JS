<?php require __DIR__ . '/layouts/header.php'; ?>



<?php require __DIR__ . '/../controllers/usuarios_controller.php';

$data_user = new usuario();
$id_user = $data_user->get_user();

echo 'Olá ' . $id_user;


?>

<a href="form_update.php?id=<?= $id_user; ?>">Atualizar dados</a>
<a href="user_delete.php?id=<?= $id_user; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja apagar sua conta?');">Deletar conta</a>



<?php require __DIR__ . '/layouts/footer.php'; ?>
