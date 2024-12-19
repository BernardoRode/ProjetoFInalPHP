<?php
session_start();
include_once './config/config.php';
include_once './classes/Veiculo.php';
include_once './classes/Funcionario.php';

$funcionarios = new Funcionario($db);
if (!isset($_SESSION['funcionario_id'])) {
    header('Location: index.php');
    exit();
}

$veiculo = new Veiculo($db);

if (isset($_POST['deletar'])) {
    try {
        $id = $_POST['deletar'];
        $veiculo->deletar($id);
        header('location:consultarVeiculo.php');
        exit();
    } catch (Exception $e) {
        echo '<p style="color: red;">Erro ao excluir cliente: ' . $e->getMessage() . '</p>';
    }
}
$dados = $veiculo->ler();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./css/consVeiculo.css">
    <title>Gerenciar Veículos</title>
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
                    <th>Placa</th>
                    <th>Modelo</th>
                    <th>Marca</th>
                    <th>Ano</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $dados->fetch(PDO::FETCH_ASSOC)): ?>
                    <tr>
                        <td><?php echo $row['placa']; ?></td>
                        <td><?php echo $row['modelo']; ?></td>
                        <td><?php echo $row['marca']; ?></td>
                        <td><?php echo $row['ano']; ?></td>
                        <td>
                            <a href="editarVeiculo.php?id=<?php echo $row['id']; ?>">Editar</a>
                            <form method="POST" style="display:inline;"
                                onsubmit="return confirm('Tem certeza que deseja deletar este Veiculo?');">
                                <input type="hidden" name="deletar" value="<?= $row['id'] ?>">
                                <button type="submit">Deletar</button>
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