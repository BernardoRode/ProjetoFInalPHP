<?php
include_once './config/config.php';
include_once './classes/Estoque_pecas.php';
include_once './classes/Funcionario.php';
session_start();
$funcionarios = new Funcionario($db);
if (!isset($_SESSION['funcionario_id'])) {
    header('Location: index.php');
    exit();
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $Estoque_pecas = new Estoque_pecas($db);
    $nome = $_POST['nome'];
    $quantidade = $_POST['quantidade'];
    $preco = $_POST['preco'];
    $Estoque_pecas->cadastrar($nome, $quantidade, $preco);
    header('location:principal.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Cadastro de peças</title>
    <link rel="stylesheet" href="./css/cadastroEstAcess.css">
    <link rel="shortcut icon" href="./img/title32.png" type="image/png">
</head>

<body>
<header>
        <div class="cabecalho">
            <h1 id="h1_cabecalho">XIRUZÃO AUTO PEÇAS</h1>
        </div>
    </header>

    <div class="container">
        <div class="box">
            <form method="POST" action="">
                <h1 id="titulo">Cadastro de peças</h1>

                <label for="nome">NOME:</label><br>
                <input type="text" id="nome" name="nome" placeholder="Digite o nome da peça" required>
                <br><br>
                <label for="quantidade">quantidade:</label><br>
                <input type="number" id="quantidade" name="quantidade" placeholder="Digite a quantidade" required>
                <br><br>

                <label for="preco">Preço:</label><br>
                <input type="number" id="preco" name="preco" placeholder="Digite o preco" required>
                <br><br>
                <input id="botao" type="submit" value="ADICIONAR">
                <input id="botao" type="button" value="VOLTAR" onclick="history.back()">
            </form>
        </div>
    </div>
</body>

</html>