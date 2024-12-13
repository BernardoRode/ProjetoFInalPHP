<?php
include_once './config/config.php';
include_once './classes/Servico.php';
include_once './classes/Cliente.php';
include_once './classes/Veiculo.php';
include_once './classes/Funcionario.php';
include_once './classes/Venda.php';
include_once './classes/Estoque_pecas.php';
include_once './classes/Estoque_acessorio.php';
include_once './classes/Promocao.php';
session_start();

// CRIA UMA VARIAVEL E CHAMA A FUNÇÃO DE obterVeiculos 
$veiculo = new Veiculo($db);
$vei = $veiculo->obterVeiculos();

$clientes = new Cliente($db);
$cli = $clientes->obterCliente();

$funcionarios = new Funcionario($db);
$func = $funcionarios->obterFuncionario();

$servico = new Servicos($db);
$serv = $servico->obterServico();

$Estoque_pecas = new Estoque_pecas($db);
$pec = $Estoque_pecas->obterPecas();

$acessorios = new estoque_acessorio($db);
$ace = $acessorios->obterAcessorio();

$promocao = new Promocao($db);
$promo = $promocao->obterPromocao();

$funcionarios = new Funcionario($db);
if (!isset($_SESSION['funcionario_id'])) {
    header('Location: index.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $Vendas = new Venda($db);

    $data_venda = $_POST['data_venda'] ?? null;
    $valor_total = $_POST['valor_total'] ?? null;
    $servico_id = $_POST['servico_id'] ?? null;
    $funcionario_id = $_SESSION['funcionario_id'] ?? null; // Obtido da sessão
    $pecas_id = $_POST['pecas_id'] ?? null;
    $acessorio_id = $_POST['acessorio_id'] ?? null;
    $veiculo_id = $_POST['veiculo_id'] ?? null;
    $promocao_id = $_POST['promocao_id'] ?? null;

    if ($data_venda && $valor_total && $servico_id && $funcionario_id && $pecas_id && $acessorio_id && $veiculo_id && $promocao_id) {
        $Vendas->cadastrarVendas($data_venda, $valor_total, $servico_id, $funcionario_id, $pecas_id, $acessorio_id, $veiculo_id, $promocao_id);
        header('Location: principal.php');
        exit();
    } else {
        echo "Todos os campos são obrigatórios.";
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./css/cadastroVenda.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Serviço</title>
</head>

<body>
    <div class="container">
        <form method="POST" class="form-card">
            <h1>Cadastro de Serviço</h1>

            <div class="form-group">
                <label for="data_venda">Data da Venda</label>
                <input type="date" id="data_venda" name="data_venda" placeholder="Digite a data da venda" required>
            </div>

            <div class="form-group">
                <label for="valor_total">Valor Total</label>
                <input type="number" id="valor_total" name="valor_total" placeholder="Digite o valor total da venda"
                    required>
            </div>

            <div class="form-group">
                <label for="servico_id">Serviço</label>
                <select id="servico_id" name="servico_id" required>
                    <option value="">-- Selecione o tipo de serviço --</option>
                    <?php foreach ($serv as $servico): ?>
                        <option value="<?= $servico['id'] ?>">
                            <?= $servico['tipo_servico'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="funcionario_id">Funcionário</label>
                <select id="funcionario_id" name="funcionario_id" required>
                    <option value="">-- Selecione o nome do funcionário --</option>
                    <?php foreach ($func as $f): ?>
                        <option value="<?= $f['id'] ?>">
                            <?= $f['nome'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="pecas_id">Peças</label>
                <select id="pecas_id" name="pecas_id" required>
                    <option value="">-- Selecione as peças --</option>
                    <?php foreach ($pec as $p): ?>
                        <option value="<?= $p['id'] ?>">
                            <?= $p['nome'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="acessorio_id">Acessórios</label>
                <select id="acessorio_id" name="acessorio_id" required>
                    <option value="">-- Selecione os acessórios --</option>
                    <?php foreach ($ace as $a): ?>
                        <option value="<?= $a['id'] ?>">
                            <?= $a['nome'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="veiculo_id">Veículo</label>
                <select id="veiculo_id" name="veiculo_id" required>
                    <option value="">-- Selecione um veículo --</option>
                    <?php foreach ($vei as $v): ?>
                        <option value="<?= $v['id'] ?>">
                            <?= $v['modelo'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="promocao_id">Promoção</label>
                <select id="promocao_id" name="promocao_id" required>
                    <option value="">-- Selecione a promoção --</option>
                    <?php foreach ($promo as $pr): ?>
                        <option value="<?= $pr['id'] ?>">
                            <?= $pr['descricao'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-actions">
                <input type="submit" value="Adicionar">
                <input type="button" value="Voltar" onclick="history.back()">
            </div>
        </form>
    </div>
</body>

</html>