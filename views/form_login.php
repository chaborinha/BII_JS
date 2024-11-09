<?php
require __DIR__ . '/../controllers/login_controller.php';

$acesso = new login();
$msg = '';

$acesso->check_logged();

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    $loginSuccess = $acesso->login_process($_POST['email_login'], $_POST['senha_login']);

    if (!$loginSuccess) $msg = 'Dados incorretos';
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
                    <h4 class="text-center">Login</h4>
                </div>
                <div class="card-body">
                    <form action="" method="POST" onsubmit="return validateForm()">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email_login" name="email_login" required>
                        </div>

                        <div class="mb-3">
                            <label for="senha" class="form-label">Senha</label>
                            <input type="password" class="form-control" id="senha_login" name="senha_login" required>
                        </div>
                        
                        <div class="mb-3">
                            <?php 
                                if (!empty($msg)) {
                                    echo "<p class='text-danger'>" . htmlspecialchars($msg) . "</p>"; 
                                }
                            ?>
                        </div>

                        <button type="submit" id="btn_login" class="btn btn-primary w-100">Login</button>
                        <a href="form_register.php">cadastrar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>


</script>

<?php require __DIR__ . '/layouts/footer.php'; ?>
