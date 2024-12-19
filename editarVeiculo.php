<?php
include_once './config/config.php';
include_once './classes/Veiculo.php';
include_once './classes/Funcionario.php';
session_start();

$funcionarios = new Funcionario($db);

if (!isset($_SESSION['funcionario_id'])) {
    header('Location: index.php');
    exit();
}

$veiculo = new Veiculo($db);

// Verifica se o ID foi passado pela URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Obtém os dados do veículo do banco de dados
    $dadosVeiculo = $veiculo->lerPorId($id);

    // Verifica se o veículo foi encontrado
    if (!$dadosVeiculo) {
        echo '<p style="color: red;">Erro: Veículo não encontrado!</p>';
        exit();
    }
}

// Processa o formulário de edição
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $placa = $_POST['placa'];
    $modelo = $_POST['modelo'];
    $marca = $_POST['marca'];
    $ano = $_POST['ano'];

    try {
        // Atualiza o veículo no banco de dados
        if ($veiculo->atualizar($id, $placa, $modelo, $marca, $ano)) {
            echo "<script>
            alert('Veículo atualizado com sucesso!');
            window.location.href = 'consultarVeiculo.php'; // Redireciona após o sucesso
            </script>";
        } else {
            echo "<script>
            alert('Erro ao atualizar o veículo!');
            history.back(); // Retorna à página anterior em caso de erro
            </script>";
        }
        exit();
    } catch (Exception $e) {
        echo '<p style="color: red;">Erro ao atualizar o veículo: ' . $e->getMessage() . '</p>';
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Veículo</title>
    <link rel="stylesheet" href="./css/editarVeiculo.css">
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
            <form method="POST">
                <h1 id="titulo">EDITAR VEÍCULO</h1>

                <!-- Campo de Placa -->
                <label for="placa">Placa:</label><br>
                <input type="text" id="placa" name="placa" value="<?= $dadosVeiculo['placa']; ?>" required><br><br>

                <!-- Campo de Modelo -->
                <label for="modelo">Modelo:</label><br>
                <input type="text" id="modelo" name="modelo" value="<?= $dadosVeiculo['modelo']; ?>" required><br><br>

                <!-- Campo de Marca -->
                <label for="marca">Marca:</label><br>
                <input type="text" id="marca" name="marca" value="<?= $dadosVeiculo['marca']; ?>" required><br><br>

                <!-- Campo de Ano -->
                <label for="ano">Ano:</label><br>
                <input type="number" id="ano" name="ano" value="<?= $dadosVeiculo['ano']; ?>" required><br><br>

                <!-- Botões de Submissão -->
                <div id="footer">
                    <input id="botao" type="submit" value="ATUALIZAR">
                    <input id="botao" type="button" value="VOLTAR" onclick="history.back()">
                </div>
            </form>
        </div>
    </div>
</body>

</html>
