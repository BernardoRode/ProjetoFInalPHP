<?php
session_start();
include_once './config/config.php';
include_once './classes/Estoque_acessorio.php';

if (!isset($_SESSION['funcionario_id'])) {
    header('Location: index.php');
    exit();
}

$estoque_acessorio = new Estoque_acessorio($db);

// Verifica se o ID foi passado pela URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Obtém os dados do estoque do banco de dados
    $dadosEstoque = $estoque_acessorio->lerPorId($id);

    // Verifica se o estoque foi encontrado
    if (!$dadosEstoque) {
        echo '<p style="color: red;">Erro: Estoque não encontrado!</p>';
        exit();
    }
}

// Processa o formulário de edição
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $quantidade = $_POST['quantidade'];
    $preco = $_POST['preco'];

    try {
        // Atualiza o estoque no banco de dados
        $estoque_acessorio->atualizar($id, $nome, $quantidade, $preco);
        header('Location: consultarEstoqueAcessorio.php'); // Redireciona após sucesso
        exit();
    } catch (Exception $e) {
        echo '<p style="color: red;">Erro ao atualizar o estoque: ' . $e->getMessage() . '</p>';
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Estoque de Acessórios</title>
    <link rel="stylesheet" href="./css/editarEstAcess.css">
    <link rel="shortcut icon" href="./img/title32.png" type="image/png">
</head>

<body>
    <header>
        <div class="cabecalho">
            <img src="./img/logo-tipo-semfundo.png" alt="Logo" class="logo">
            <h1 id="h1_cabecalho">XIRUZÃO AUTO PEÇAS</h1>
        </div>
    </header>
    <div class="container">
        <div class="box">
            <form method="POST" action="">
                <h1 id="titulo">Editar Estoque de Acessórios</h1>

                <!-- Campo de Nome -->
                <label for="nome">Nome:</label><br>
                <input type="text" id="nome" name="nome" placeholder="Digite o NOME" value="<?= $dadosEstoque['nome']; ?>" required><br><br>

                <!-- Campo de Quantidade -->
                <label for="quantidade">Quantidade:</label><br>
                <input type="number" id="quantidade" name="quantidade" placeholder="Digite a quantidade" value="<?= $dadosEstoque['quantidade']; ?>" required><br><br>

                <!-- Campo de Preço -->
                <label for="preco">Preço:</label><br>
                <input type="number" id="preco" name="preco" placeholder="Digite o preço" value="<?= $dadosEstoque['preco']; ?>" required><br><br>

                <!-- Botões de Submissão -->
                <input id="botao" type="submit" value="EDITAR">
                <input id="botao" type="button" value="VOLTAR" onclick="history.back()">
            </form>
        </div>
    </div>
</body>

</html>
