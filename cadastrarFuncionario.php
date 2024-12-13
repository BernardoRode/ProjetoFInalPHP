<?php
include_once("./config/config.php");
include_once("./classes/Funcionario.php");
include_once './classes/Funcionario.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $funcionario = new Funcionario($db);
    $nome = $_POST['nome'];
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
    $input = $_POST['senha'];
    $quantidade_digitos = strlen($input);
    if ($quantidade_digitos >= 8) {
        $funcionario->cadastrar($nome, $email, $senha);
        header('location: index.php');
        exit();
    } else {
        echo "<script>alert('CREDENCIAIS INVÁLIDAS !');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/cadastroFunc.css">
    <title>Cadastro Funcionario</title>
</head>

<body>
    <header>
        <div class="cabecalho">

            <img src="./img/Logo Auto Peças (1).png" alt="Logo" class="logo">
            <h1 id="h1_cabecalho">XIRUZÃO AUTO PEÇAS</h1>

        </div>
    </header>

    <div class="container">
        <div class="box">

            <form method="POST" action="">
                <h1>CADASTRAR FUNCIONÁRIO</h1>

                <label for="nome">NOME:</label><br>
                <input type="text" id="nome" name="nome" required>
                <br><br>
                <label for="email">EMAIL:</label><br>
                <input type="email" id="email" name="email" required>
                <br><br>
                <label for="senha">SENHA:</label><br>
                <input type="password" id="senha" name="senha" required>
                <br><br>
                <input type="submit" value="ADICIONAR">
                <input type="button" value="VOLTAR" onclick="history.back()">
            </form>
        </div>
    </div>
    <div class="mensagem">
        <?php if (isset($mensagem_erro)) echo '<p>' . $mensagem_erro . '</p>'; ?>
    </div>
</body>

</html>