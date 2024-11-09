<?php require __DIR__ . '/layouts/header.php'; ?>

<?php 
require __DIR__ . '/../controllers/admin_controller.php';

$user_nivel = 'usuario';

$table_users = new admin();
$users = $table_users->select_all($user_nivel);
?>

<div class="container mt-5">
  <h2 class="text-center">Lista de Usuários</h2>
  
  <?php if (empty($users)): ?>
    <div class="alert alert-warning" role="alert">
      Nenhum usuário encontrado.
    </div>
  <?php else: ?>
    <table class="table table-bordered table-striped">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Nome</th>
          <th scope="col">Email</th>
          <th scope="col">Nível</th>
          <th scope="col">Ações</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($users as $user): ?>
          <tr>
            <td><?= $user['user_id']; ?></td>
            <td><?= $user['user_name']; ?></td>
            <td><?= $user['user_email']; ?></td>
            <td><?= $user['user_nivel']; ?></td>
            <td>
              <a href="admin_update.php?id=<?= $user['user_id']; ?>" class="btn btn-warning btn-sm">Editar</a>
              <a href="admin_delete.php?id=<?= $user['user_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir este usuário?');">Excluir</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php endif; ?>
</div>

<?php require __DIR__ . '/layouts/footer.php'; ?>
