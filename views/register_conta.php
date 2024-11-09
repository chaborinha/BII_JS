<?php require __DIR__ . '/layouts/header.php';?>

<?php
require __DIR__ . '/../controllers/contas_controller.php';
$conta = new contas();
$conta->check_acess();
$id_user = $conta->get_id_logged();

 var_dump($id_user);

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{

    $register_conta = $conta->insert_account($_POST['con_descricao'], $_POST['con_valor'], $_POST['con_vencimento'], $_POST['con_tipopag'], $id_user);
    
}

?>


<div class="container mt-5">
        <h2>Cadastro de Contas</h2>
        <form action="" method="POST">
            <div class="mb-3">
                <label for="con_descricao" class="form-label">Descrição</label>
                <input type="text" class="form-control" id="con_descricao" name="con_descricao" placeholder="Informe a descrição da conta" required>
            </div>

            <div class="mb-3">
                <label for="con_valor" class="form-label">Valor</label>
                <input type="number" step="0.01" class="form-control" id="con_valor" name="con_valor" placeholder="Informe o valor" required>
            </div>

            <div class="mb-3">
                <label for="con_vencimento" class="form-label">Data de Vencimento</label>
                <input type="date" class="form-control" id="con_vencimento" name="con_vencimento" required>
            </div>

            <div class="mb-3">
                <label for="con_tipopag" class="form-label">Tipo de Pagamento</label>
                <select class="form-select" id="con_tipopag" name="con_tipopag" required>
                    <option value="" disabled selected>Escolha o tipo de pagamento</option>
                    <option value="Cartao de Crédito">Cartão de Crédito</option>
                    <option value="Cartao de Débito">Cartão Débito</option>
                    <option value="Dinheiro">Dinheiro</option>
                    <option value="Pix">Pix</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Cadastrar</button>
        </form>
    </div>


<?php require __DIR__ . '/layouts/footer.php';?>