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
    <link rel="stylesheet" href="/css/solicitarRecup.css">
    <title>Recuperar Senha</title>
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
    <h1>Recuperar Senha</h1>

        <label for="email">Email:</label>
        <input type="email" name="email" required><br><br>
        <input type="submit" value="Enviar">
    </form>
    </div>
    <p><?php echo $mensagem; ?></p>
    <div class="button-container">
    <a href="index.php">Voltar</a>
    </div>
</body>
</html>
