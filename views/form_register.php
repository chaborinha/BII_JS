<?php
require __DIR__ . '/../controllers/usuarios_controller.php';

$usuario = new usuario();
if($_SERVER['REQUEST_METHOD'] === 'POST')
{
    $usuario->register_user($_POST['nome_registro'], $_POST['email_registro'], $_POST['senha_registro']);
} 

?>
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Finanças</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="../assets/css/main.css" rel="stylesheet">
</head>
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
                                <input type="text" class="form-control" id="nome" name="nome_registro" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">E-mail</label>
                                <input type="email" class="form-control" id="email" name="email_registro" required>
                            </div>
                            <div class="mb-3">
                                <label for="senha" class="form-label">Senha</label>
                                <input type="password" class="form-control" id="senha" name="senha_registro" required>
                            </div>
                            <div class="mb-3">
                                <div class="aviso" id="aviso"></div>
                            </div>
                            <button type="submit" id="btn_register" class="btn btn-primary w-100" disabled>Cadastrar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</div>
<?php require __DIR__ . '/layouts/footer.php'; ?>


