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

if (isset($_GET['deletar'])) {
    $id = $_GET['deletar'];
    $funcionarios->deletar($id);
    header('Location: consultarVeiculo.php');
    exit();
}

$clientes = new Veiculo($db);

if (isset($_POST['deletarVeiculo'])) {
    try {
        $id = $_GET['deletarVeiculo'];
        $clientes->deletar($id);
        header('location:index.php');
        exit();
    } catch (Exception $e) {
        echo '<p style="color: red;">Erro ao excluir veículo: ' . $e->getMessage() . '</p>';
    }
}
$dados = $clientes->ler();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./css/consVeiculo.css">
    <title>Portal - Consultar Veículos</title>
</head>

<body>
    <header>
        <div class="cabecalho">
            <img src="./img/logo-tipo-semfundo.png" alt="Logo" class="logo">
            <h1>XIRUZÃO AUTO PEÇAS</h1>
        </div>
    </header>

    <div class="main-container">
        <table class="user-table">
            <thead>
                <tr>
                    <th>ID</th>
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
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['placa']; ?></td>
                        <td><?php echo $row['modelo']; ?></td>
                        <td><?php echo $row['marca']; ?></td>
                        <td><?php echo $row['ano']; ?></td>
                        <td>
                            <a href="editarVeiculo.php?id=<?php echo $row['id']; ?>">Editar</a>
                            <a href="consultarVeiculo.php?deletar=<?php echo $row['id']; ?>" onclick="return confirm('Tem certeza que deseja deletar este veículo?');">Deletar</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <button class="button print-button" onclick="window.print()">Imprimir Tabela</button>
</body>

</html>
