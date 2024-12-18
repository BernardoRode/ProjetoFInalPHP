<?php
include_once './config/config.php';
include_once './classes/Cliente.php';
include_once './classes/Veiculo.php';

session_start();


$clientes = new Cliente($db);

if (isset($_POST['deletarCliente'])) {
    try {
        $id = $_POST['deletarCliente'];
        $clientes->deletarCliente($id);
        header('location:index.php');
        exit();
    } catch (Exception $e) {
        echo '<p style="color: red;">Erro ao excluir cliente: ' . $e->getMessage() . '</p>';
    }
}

$dados = $clientes->obterClientesDetalhados();

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Gerenciar Clientes</title>
    <link rel="stylesheet" href="./css/consCliente.css">
    <link rel="shortcut icon" href="./img/title32.png" type="image/png">
</head>

<body>
    <header>
        <div class="cabecalho">
            <h1>XIRUZÃO AUTO PEÇAS</h1>
        </div>
    </header>
    <br><br>

    <div class="main-container">
        <table>
            <thead>
                <tr>
                    <th>CPF</th>
                    <th>Nome</th>
                    <th>CEP</th>
                    <th>Veículo</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($dados as $cliente): ?>
                    <tr>
                        <td><?= htmlspecialchars($cliente['cpf']) ?></td>
                        <td><?= htmlspecialchars($cliente['nome']) ?></td>
                        <td><?= htmlspecialchars($cliente['cep']) ?></td>
                        <td><?= htmlspecialchars($cliente['modelo_veiculo']) ?></td>
                        <td>
                            <a href="editarCliente.php?id=<?= $cliente['id'] ?>">Editar</a>
                            <form method="POST" style="display:inline;"
                                onsubmit="return confirm('Tem certeza que deseja deletar este cliente?');">
                                <input type="hidden" name="deletarCliente" value="<?= $cliente['id'] ?>">
                                <button type="submit">Deletar</button>

                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>    
    </div>


    <div class="footer">
        <button class="button print-button" onclick="window.print()">Imprimir Tabela</button>
        <input class="voltar" type="button" value="VOLTAR" onclick="window.location.href='principal.php'">
    </div>
</body>

</html>