<?php
include_once './config/config.php';
include_once './classes/Funcionario.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $funcionario = new Funcionario($db);
    $codigo = $funcionario->gerarCodigoVerificacao($email);


    if ($codigo) {
        $mensagem = "Seu código de verificação é: $codigo. Por favor, anote o código e <a href='redefinir_senha.php'>clique aqui</a> para redefinir sua senha.";
    } else {
        $mensagem = 'E-mail não encontrado.';
    }
}
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./css/solicitarRecup.css">
    <title>Recuperar Senha</title>
    <link rel="shortcut icon" href="./img/title32.png" type="image/png">
</head>

<body>
    <header>
        <div class="cabecalho">
            <h1 id="h1_cabecalho">XIRUZÃO AUTO PEÇAS</h1>
            <h3></h3>
        </div>
    </header>


    <div class="container">
        <div class="box">
            <form method="POST">
                <h1>Recuperar Senha</h1>

                <label for="email">Email:</label>
                <input type="email" name="email" required><br><br>
                <input type="submit" value="Enviar">
                <br>
                <input type="submit" value="VOLTAR" onclick="window.location.href='principal.php'">
            </form>
        </div>
</body>

</html>