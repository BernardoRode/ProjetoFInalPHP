<?php
session_start();
include_once './config/config.php';
include_once './classes/Veiculo.php';
include_once './classes/Funcionario.php';
include_once './classes/Servico.php';
include_once './classes/Cliente.php';

$funcionarios = new Funcionario($db);
if (!isset($_SESSION['funcionario_id'])) {
    header('Location: index.php');
    exit();
}

$servico = new Servicos($db);  // Corrigido: Servicos para Servico
$dados = $servico->ler();
$veiculo = new Veiculo($db);
$cliente = new Cliente($db);

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

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/consServico.css">
    <title>Gerenciamento de Serviços</title>
</head>

<body>
    <header>
        <div class="cabecalho">
            <h1>XIRUZÃO AUTO PEÇAS</h1>
        </div>
    </header>

    <nav>
        <a href="cadastrarServico.php">Cadastrar Serviço</a>
        <a href="logout.php">Logout</a>
    </nav>

    <h2>Lista de Serviços</h2>
    
    <table border="1" class="servico-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tipo de Serviço</th>
                <th>Data</th>
                <th>Valor</th>
                <th>Cliente</th>
                <th>Veículo</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $dados->fetch(PDO::FETCH_ASSOC)) : ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['tipo_servico']; ?></td>
                    <td><?php echo $row['data_servico']; ?></td>
                    <td><?php echo $row['valor']; ?></td>
                    <td><?php echo isset($clienteMap[$row['cliente_id']]) ? $clienteMap[$row['cliente_id']] : 'N/A'; ?></td>
                    <td><?php echo isset($veiculoMap[$row['veiculo_id']]) ? $veiculoMap[$row['veiculo_id']] : 'N/A'; ?></td>
                    <td>
                        <a href="editarServico.php?id=<?php echo $row['id']; ?>">Editar</a>
                        <a href="consultarServico.php?deletar=<?php echo $row['id']; ?>" onclick="return confirm('Tem certeza que deseja excluir este serviço?');">Deletar</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>

</html>
