<?php require __DIR__ . '/layouts/header.php'; ?>


<?php 
require __DIR__ . '/../controllers/usuarios_controller.php';

$id_update = $_GET['id'];
$user = new usuario();

$data_user = $user->select_user($id_update);
$user->permissions($id_update);

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    $user->alterar_dados($_POST['nome_upd'], $_POST['email_upd'], $id_update);
}

?>


<div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-center">Cadastro de Usuário</h4>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="mb-3">
                                <label for="nome" class="form-label">Nome</label>
                                <input type="text" class="form-control" id="nome_upd" name="nome_upd" value="<?= $data_user['user_name']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">E-mail</label>
                                <input type="email" class="form-control" id="email_upd" name="email_upd" value="<?= $data_user['user_email'] ?>" required>
                            </div>
                            
                            <div class="mb-3">
                                <div class="aviso" id="aviso"></div>
                            </div>
                            <button type="submit" id="btn_upd_user" class="btn btn-primary w-100">Atualizar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</div>






<?php require __DIR__ . '/layouts/footer.php'; ?>
