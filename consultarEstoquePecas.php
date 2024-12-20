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

$usuario = new usuario($db);
$Estoque_pecas = new Estoque_pecas($db);

$dados = $Estoque_pecas->ler();

// Verifica se o ID de exclusão foi passado via GET
if (isset($_GET['deletar'])) {
    try {
        $id = $_GET['deletar']; // Captura o ID da peça a ser excluída

        // Chama o método para deletar a peça
        $Estoque_pecas->deletarPecas($id);
        header('location:consultarEstoquePecas.php'); // Redireciona após exclusão
        exit();
    } catch (Exception $e) {
        echo '<p style="color: red;">Erro ao excluir peça: ' . $e->getMessage() . '</p>';
    }
}

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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Estoque de Peças</title>
    <link rel="stylesheet" href="./css/consEstPecas.css">
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
                    <th>Quantidade</th>
                    <th>Preço</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $dados->fetch(PDO::FETCH_ASSOC)) : ?>
                    <tr>
                        <td><?php echo $row['nome']; ?></td>
                        <td><?php echo $row['quantidade']; ?></td>
                        <td><?php echo $row['preco']; ?></td>
                        <td>
                            <a href="editarEstoqueAcessorio.php?id=<?php echo $row['id']; ?>">Editar</a>
                            <a href="consultarEstoquePecas.php?deletar=<?php echo $row['id']; ?>" onclick="return confirm('Tem certeza que deseja deletar este item?');">Deletar</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <div class="footer">
        <button class="button print-button" onclick="window.print()">Imprimir Tabela</button>
        <input class="voltar"type="button" value="VOLTAR" onclick="window.location.href='principal.php'">
    </div>
</body>

</html>
