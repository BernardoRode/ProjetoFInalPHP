<?php
session_start();
include_once './config/config.php';
include_once './classes/Funcionario.php';

$funcionario = new Funcionario($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['login'])) {
        // Processar login
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        if ($dados_funcionario = $funcionario->login($email, $senha)) {
            $_SESSION['funcionario_id'] = $dados_funcionario['id'];
            $_SESSION['funcionario_nome'] = $dados_funcionario['nome'];
            header('Location: ./principal.php');
            exit();
        } else {
            echo "<script>alert('CREDENCIAIS INVÁLIDAS !');</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <title>tela de login</title>
    <!-- <link rel="icon" type="image/png" href="./img/title32.png"> -->
    <link rel="shortcut icon" href="./img/title32.png" type="image/png">
</head>

<body>
    <header>
        <div class="cabecalho">
            <img src="./img/Logo Auto Peças (1).png" alt="Logo" class="logo">

            <h1 id="h1_cabecalho">XIRUZÃO AUTO PEÇAS</h1>
            <h3>Faça login para acessar o sistema e
                ajudar a manter nosso estoque sempre em movimento.</h3>
        </div>
    </header>


    <div class="container">
        <div class="box">
            <h1 id="titulo">AUTENTICAÇÃO</h1>


            <form method="POST">
                <label for="email">Email:</label>
                <input type="email" name="email" required>
                <br><br>
                <label for="senha">Senha:</label>
                <input type="password" name="senha" required>
                <br><br>
                <input type="submit" name="login" value="Login">
            </form>
            <p>Não tem uma conta? <br> <a href="./cadastrarFuncionario.php">Registre-se aqui</a></p> <br>
            <p>Esqueceu a senha ?? <a href="./solicitar_recuperacao.php">Clique Aqui</a></p>
            <div class="mensagem">
                <?php if (isset($mensagem_erro)) echo '<p>' . $mensagem_erro . '</p>'; ?>
            </div>
        </div>


</body>

</html>