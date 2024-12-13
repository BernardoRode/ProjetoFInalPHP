<?php
session_start();
include_once './config/config.php';
include_once './classes/Promocao.php';
include_once './classes/Funcionario.php';

$funcionarios = new Funcionario($db);
if (!isset($_SESSION['funcionario_id'])) {
    header('Location: index.php');
    exit();
}

$promo = new Promocao($db);

// Processar exclusão de notícia
if (isset($_GET['deletar'])) {
    $id = $_GET['deletar'];
    $promo->deletar($id);
    header('Location: consultarPromocao.php');
    exit();
}

// Obter dados das promoções
$dados = $promo->ler();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/consPromo.css">
    <title>Portal - Promoções</title>
</head>

<body>
    <header>
        <div class="cabecalho">
            <img src="./img/logo-tipo-semfundo.png" alt="Logo" class="logo">
            <h1>XIRUZÃO AUTO PEÇAS</h1>
        </div>
    </header>

    <div class="buttons">
        <a href="cadastrarPromocao.php">Cadastrar Promoção</a>
        <a href="logout.php">Logout</a>
    </div>

    <div class="main-container">
        <h2>Promoções Ativas</h2>

        <table class="promo-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Descrição</th>
                    <th>Total</th>
                    <th>Início</th>
                    <th>Fim</th>
                    <th>Imagem</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $dados->fetch(PDO::FETCH_ASSOC)) : ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['descricao']; ?></td>
                        <td><?php echo $row['preco']; ?></td>
                        <td><?php echo $row['data_inicio']; ?></td>
                        <td><?php echo $row['data_final']; ?></td>
                        <td>
                            <img src="<?php echo $row['imagem']; ?>" alt="Imagem Promoção" class="promo-image">
                        </td>
                        <td>
                            <a href="editarPromocao.php?id=<?php echo $row['id']; ?>" class="edit-link">Editar</a>
                            <a href="consultarPromocao.php?deletar=<?php echo $row['id']; ?>" class="delete-link" onclick="return confirm('Tem certeza que deseja excluir esta promoção?');">Deletar</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <div class="footer">
        <button class="button print-button" onclick="window.print()">Imprimir Tabela</button>
    </div>
</body>

</html>
