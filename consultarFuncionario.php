<?php
session_start();
include_once './config/config.php';
include_once './classes/Estoque_pecas.php';
include_once './classes/usuario.php';
include_once './classes/Funcionario.php';

$funcionarios = new Funcionario($db);

// Verificando se o usuário está logado
if (!isset($_SESSION['funcionario_id'])) {
    header('Location: index.php');
    exit();
}

if (isset($_POST['deletar'])) {
    try {
        $id = $_POST['deletar'];
        
        
        $funcionarios->deletarFuncionario($id); // Supondo que a classe Funcionario tenha o método deletar
        header('location:consultarFuncionario.php');
        exit();
    } catch (Exception $e) {
        echo '<p style="color: red;">Erro ao excluir funcionário: ' . $e->getMessage() . '</p>';
    }
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
        <div class="footer">
            <button class="button print-button" onclick="window.print()">Imprimir Tabela</button>
            <input class="voltar" type="button" value="VOLTAR" onclick="window.location.href='principal.php'">
        </div>
    </div>
</body>

</html>
