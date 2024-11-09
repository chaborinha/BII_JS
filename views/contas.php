<?php require __DIR__ . '/layouts/header.php'; ?>

<?php 
require __DIR__ . '/../controllers/contas_controller.php';
$conta = new contas();

$conta->check_acess();
$user_id = $conta->get_id_logged();

$contas = $conta->select_all_accounts($user_id);
?>

<div class="container mt-4">
    <a href="register_conta.php" class="btn btn-primary mb-3">Adicionar nova conta</a>

    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Código</th>
                <th>Descrição</th>
                <th>Valor</th>
                <th>Vencimento</th>
                <th>Tipo de Pagamento</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($contas) {
                foreach ($contas as $conta_item) {
                    $descricao_limitada = substr($conta_item['con_descricao'], 0, 50);
                    $data_vencimento = $conta->display_date($conta_item['con_vencimento']);
                    ?>

                    <tr>
                        <td><?php echo $conta_item['con_cod']; ?></td>
                        <td><a href="info_conta.php?id=<?php echo $conta_item['con_cod']; ?>"><?php echo htmlspecialchars($descricao_limitada) . '...'; ?></td></a>
                        <td>R$ <?php echo $conta_item['con_valor']; ?></td>
                        <td><?php echo $data_vencimento; ?></td>
                        <td><?php echo htmlspecialchars($conta_item['con_tipopag']); ?></td>
                        <td>
                            <a href="update_conta.php?id=<?php echo $conta_item['con_cod']; ?>" class="btn btn-warning btn-sm">Editar</a>
                            <a href="delete_conta.php?id=<?php echo $conta_item['con_cod']; ?>" 
                               class="btn btn-danger btn-sm" 
                               onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a>
                        </td>
                    </tr>

                    <?php
                }
            } else {
                echo "<tr><td colspan='6' class='text-center'>Nenhuma conta registrada.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php require __DIR__ . '/layouts/footer.php'; ?>
