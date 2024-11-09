<?php require __DIR__ . '/layouts/header.php'; ?>

<?php 
require __DIR__ . '/../controllers/admin_controller.php';

$user_nivel = 'usuario';

$table_users = new admin();
$users = $table_users->select_all($user_nivel);
?>

<div class="container mt-5">
  <h2>Lista de Usuários</h2>
  
  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Nome</th>
        <th scope="col">Email</th>
        <th scope="col">Nível</th>
      </tr>
    </thead>
    <tbody>
      <?php
      if ($users && count($users) > 0) {
          foreach ($users as $user) {
              echo "<tr>";
              echo "<td>" . htmlspecialchars($user['id']) . "</td>";
              echo "<td>" . htmlspecialchars($user['user_name']) . "</td>";
              echo "<td>" . htmlspecialchars($user['user_email']) . "</td>";
              echo "<td>" . htmlspecialchars($user['user_nivel']) . "</td>";
              echo "</tr>";
          }
      } else {
          echo "<tr><td colspan='4'>Nenhum usuário encontrado.</td></tr>";
      }
      ?>
    </tbody>
  </table>
</div>

<?php require __DIR__ . '/layouts/footer.php'; ?>
