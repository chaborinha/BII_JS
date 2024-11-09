<?php require __DIR__ . '/layouts/header.php'; ?>

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
                            <label for="tipo_usuario" class="form-label">Tipo de Usuário</label>
                            <select class="form-control" id="tipo_usuario" name="tipo_usuario" required>
                                <option value="admin">Admin</option>
                                <option value="usuario">Usuário</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <?php echo "<p>" . $msg . "</p>"; ?>
                        </div>
                        <button type="submit" id="btn_register" class="btn btn-primary w-100" disabled>Cadastrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



<?php require __DIR__ . '/layouts/footer.php';