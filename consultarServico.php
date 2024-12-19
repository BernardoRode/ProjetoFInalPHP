<?php
session_start();
include_once './config/config.php';
include_once './classes/Veiculo.php';
include_once './classes/Funcionario.php';
include_once './classes/Servico.php';
include_once './classes/Cliente.php';
include_once './classes/Venda.php';

$funcionarios = new Funcionario($db);
if (!isset($_SESSION['funcionario_id'])) {
    header('Location: index.php');
    exit();
}

$servico = new Servicos($db);  // Corrigido: 'Servicos' para 'Servico'
$dados = $servico->ler();
$veiculo = new Veiculo($db);
$cliente = new Cliente($db);

$servico = new Servicos($db);

if (isset($_POST['deletar'])) {
    try {
        $id = $_POST['deletar'];
        $servico->deletar($id);
        header('location:consultarServico.php');
        exit();
    } catch (Exception $e) {
        echo '<p style="color: red;">Erro ao excluir cliente: ' . $e->getMessage() . '</p>';
    }
}

$veiculos = $veiculo->obterVeiculos();
$clientes = $cliente->obterCliente();

$veiculoMap = [];
foreach ($veiculos as $v) {
    $veiculoMap[$v['id']] = $v['modelo'];
}

$clienteMap = [];
foreach ($clientes as $c) {
    $clienteMap[$c['id']] = $c['nome'];
}

// Verificação de exclusão
if (isset($_GET['deletar'])) {
    $id = $_GET['deletar'];

    // Chame o método para deletar o serviço
    if ($servico->deletar($id)) {
        // Caso a exclusão seja bem-sucedida, redirecione de volta para a lista de serviços
        header('Location: consultarServico.php');
        exit();
    } else {
        echo "<script>alert('Erro ao deletar o serviço.');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/consServico.css">
    <title>Gerenciar Serviços</title>
    <link rel="shortcut icon" href="./img/title32.png" type="image/png">
</head>

<body>
    <header>
        <div class="cabecalho">
            <h1>XIRUZÃO AUTO PEÇAS</h1>
        </div>
    </header>
    <div class="main-container">
        <table border="1" class="servico-table">
            <thead>
                <tr>
                    <th>Tipo de Serviço</th>
                    <th>Data</th>
                    <th>Valor</th>
                    <th>Cliente</th>
                    <th>Veículo</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $dados->fetch(PDO::FETCH_ASSOC)): ?>
                    <tr>
                        <td><?php echo $row['tipo_servico']; ?></td>
                        <td><?php echo $row['data_servico']; ?></td>
                        <td><?php echo $row['valor']; ?></td>
                        <td><?php echo isset($clienteMap[$row['cliente_id']]) ? $clienteMap[$row['cliente_id']] : 'N/A'; ?>
                        </td>
                        <td><?php echo isset($veiculoMap[$row['veiculo_id']]) ? $veiculoMap[$row['veiculo_id']] : 'N/A'; ?>
                        </td>
                        <td>
                            <!-- O formulário agora está correto -->
                            <form method="POST" style="display:inline;" onsubmit="return confirm('Tem certeza que deseja deletar este funcionário?');">
                                <input type="hidden" name="deletar" value="<?= $row['id'] ?>">
                                <button type="submit">Deletar</button>
                            </form>
                        </td>
                    </tr>

                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <div class="footer">
        <button class="button print-button" onclick="window.print()">Imprimir Tabela</button>
        <input class="voltar" type="button" value="VOLTAR" onclick="window.location.href='principal.php'">
    </div>
</body>

</html>