<?php
if (!isset($_SESSION['usuario_id'])) {
    header('Location: index.php');
    exit();
}
include_once './config/config.php';
include_once './classes/Usuario.php';

$usuario = new Usuario($db);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $sexo = $_POST['sexo'];
    $fone = $_POST['fone'];
    $email = $_POST['email'];
    $usuario->atualizar($id, $nome, $sexo, $fone, $email);
    header('Location: portal.php');
    exit();
}
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $row = $usuario->lerPorId($id);
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/editar.css">
    <title>Editar Usuário</title>
    <link rel="shortcut icon" href="./img/title32.png" type="image/png">
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


    <div class="container">
        <div class="box">
            <form method="POST">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

                <label for="nome">Nome:</label>
                <input type="text" name="nome" value="<?php echo $row['nome']; ?>" required>

                <label>Sexo:</label>
                <label for="masculino_editar">
                    <input type="radio" id="masculino_editar" name="sexo" value="M" <?php echo ($row['sexo'] === 'M') ? 'checked' : ''; ?> required> Masculino
                </label>
                <label for="feminino_editar">
                    <input type="radio" id="feminino_editar" name="sexo" value="F" <?php echo ($row['sexo'] === 'F') ? 'checked' : ''; ?> required> Feminino
                </label>

                <label for="fone">Fone:</label>
                <input type="tel" name="fone" value="<?php echo $row['fone']; ?>" required>

                <label for="email">Email:</label>
                <input type="email" name="email" value="<?php echo $row['email']; ?>" required>

                <input type="submit" value="Atualizar">
            </form>
        </div>
    </div>
</body>
</html>
