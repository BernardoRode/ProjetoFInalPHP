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

function saudacao()
{
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
    <title>Gerenciar Funcionarios</title>
    <link rel="stylesheet" href="./css/consFunc.css">
    <link rel="shortcut icon" href="./img/title32.png" type="image/png">
</head>

<body>
    <header>
        <div class="cabecalho">
            <h1>XIRUZÃO AUTO PEÇAS</h1>
        </div>
    </header>



    <div class="main-container">
        <table class="user-table">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $dados->fetch(PDO::FETCH_ASSOC)): ?>
                    <tr>
                        <td><?php echo $row['nome']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td>
                            <a href="editarEstoqueAcessorio.php?id=<?php echo $row['id']; ?>">Editar</a>
                            <a href="consultarFuncionario.php?deletar=<?php echo $row['id']; ?>"
                                onclick="return confirm('Tem certeza que deseja deletar este funcionário?');">Deletar</a>
                        </td>
                    </tr>
                    
                <?php endwhile; ?>
            </tbody>
        </table>
        <div class="footer">
        <button class="button print-button" onclick="window.print()">Imprimir Tabela</button>
        <input class="voltar"type="button" value="VOLTAR" onclick="window.location.href='principal.php'">
    </div>
    </div>
</body>

</html>