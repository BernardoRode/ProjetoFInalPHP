<?php
session_start();
include_once './config/config.php';
include_once './classes/Estoque_pecas.php';
include_once './classes/usuario.php';
include_once './classes/Funcionario.php';
$funcionarios = new Funcionario($db);
if (!isset($_SESSION['funcionario_id'])) {
    header('Location: index.php');
    exit();
}
if (isset($_GET['deletar'])) {
    $id = $_GET['deletar'];
    $funcionarios->deletar($id);
    header('Location: consultarEstoquePecas.php');
    exit();
}

$dados = $funcionarios->ler();

function saudacao() {
    $hora = date('H');
    if ($hora >= 6 && $hora < 12) {
        return "Bom dia";
    } elseif ($hora >= 12 && $hora < 18) {
        return "Boa tarde";
    } else {
        return "Boa noite";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Portal</title>
    <link rel="stylesheet" href="/css/consFunc.css">
</head>
<body>
<header>
        <div class="cabecalho">

        <img src="./img/logo-tipo-semfundo.png" alt="Logo" class="logo">
            <h1 id="h1_cabecalho">XIRUZÃO AUTO PEÇAS</h1>
            <h3>Faça login para acessar o sistema e
                ajudar a manter nosso estoque sempre em movimento.</h3>
        </div>
    </header>

    <div class="buttons">
    <a href="logout.php">Logout</a>
    </div>

    <div class="main-container">
    <table class="user-table">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Ação</th>
        </tr>

        <?php while ($row = $dados->fetch(PDO::FETCH_ASSOC)) : ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['nome']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td>
                    <a href="editarEstoqueAcessorio.php?id=<?php echo $row['id']; ?>">Editar</a>
                    <a href="consultarFuncionario.php?deletar=<?php echo $row['id']; ?>">Deletar</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
    </div>
</body>
</html>
