<?php
include_once './config/config.php';
include_once './classes/Funcionario.php';
session_start();
$funcionarios = new Funcionario($db);
if (!isset($_SESSION['funcionario_id'])) {
    header('Location: principal.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<style>

</style>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>XIRUZÃO AUTO PEÇAS</title>
    <link rel="stylesheet" href="./css/principal.css">
    <link rel="shortcut icon" href="./img/title32.png" type="image/png">
</head>

<body>
    <header>
        <div class="cabecalho">
            <h1>XIRUZÃO AUTO PEÇAS</h1>
        </div>
    </header>

    <div class="button-container">
        <h3>Cadastrar</h3>
        <a href="./cadastrarCliente.php">Cadastrar Cliente </a><br>
        <a href="./cadastrarEstoqueAcessorio.php">Cadastrar Acessorios</a><br>
        <a href="./cadastrarEstoquePecas.php">Cadastrar Peças</a><br>
        <a href="./cadastrarServico.php">Cadastrar Servicos</a><br>
        <a href="./cadastrarVeiculo.php">Cadastrar Veiculos</a><br>
        <a href="./cadastrarFuncionario.php">Cadastrar funcionario</a><br>
        <a href="./cadastrarPromocao.php">Cadastrar Promocao</a><br>
        <a href="./cadastrarVendas.php">Cadastrar Vendas</a>
    </div>
    <div class="button-container">
        <h3>consultar</h3>
        <a href="./consultarCliente.php">ConsultarCliente</a><br>
        <a href="./consultarVeiculo.php">Consultar veiculo</a><br>
        <a href="./consultarFuncionario.php">Consultar funcionario</a><br>
        <a href="./consultarEstoqueAcessorio.php">Consultar Acessórios</a><br>
        <a href="./consultarPromocao.php">Consultar Promocao</a><br>
        <a href="./consultarEstoquePecas.php">Consultar Peças</a><br>
        <a href="./consultarServico.php">Consultar Serviços</a><br>
        <a href="./consultarVendas.php">Consultar Vendas</a>
    </div>
    <div class="button-container">
        <h3>Sair</h3>
        <a href="./logout.php">Logout</a>
    </div>

</body>

</html>