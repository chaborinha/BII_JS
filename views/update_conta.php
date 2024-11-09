<?php require __DIR__ . '/layouts/header.php'; ?>

<?php
require __DIR__ . '/../controllers/contas_controller.php';

$id_update = $_GET['id'];
$conta = new contas();
$conta->check_acess();
$id_logged = $conta->get_id_logged();
$id_verify = $conta->user_conta($id_update);
// var_dump($id_verify);
// echo '<hr>';
// var_dump($id_logged);
$conta->permission($id_verify);
$data_account = $conta->data_account($id_update);

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $update_account = $conta->update_account($id_update, $_POST['con_descricao_upd'], $_POST['con_valor_upd'], $_POST['con_vencimento_upd'], $_POST['con_tipopag_upd']);
}


?>

<div class="container mt-5">
        <h2 class="text-center">ALterar Conta</h2>
        <form action="" method="POST">
            <div class="mb-3">
                <label for="con_descricao" class="form-label">Descrição</label>
                <input type="text" class="form-control" id="con_descricao_upd" name="con_descricao_upd" placeholder="Informe a descrição da conta" value="<?= $data_account['con_descricao']; ?>" required>
            </div>

            <div class="mb-3">
                <label for="con_valor" class="form-label">Valor</label>
                <input type="number" step="0.01" class="form-control" id="con_valor_upd" name="con_valor_upd" placeholder="Informe o valor" value="<?= $data_account['con_valor']; ?>" required>
            </div>

            <div class="mb-3">
                <label for="con_vencimento" class="form-label">Data de Vencimento</label>
                <input type="date" class="form-control" id="con_vencimento_upd" name="con_vencimento_upd" value="<?= $data_account['con_vencimento']; ?>" required>
            </div>

            <div class="mb-3">
                <label for="con_tipopag" class="form-label">Tipo de Pagamento</label>
                <select class="form-select" id="con_tipopag_upd" name="con_tipopag_upd" value="<?= $data_account['con_tipopag']; ?>" required>
                    <option value="" disabled selected>Escolha o tipo de pagamento</option>
                    <option value="Cartao de Crédito">Cartão de Crédito</option>
                    <option value="Cartao de Débito">Cartão Débito</option>
                    <option value="Dinheiro">Dinheiro</option>
                    <option value="Pix">Pix</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Alterar</button>
</div>



<?php require __DIR__ . '/layouts/footer.php'; ?>