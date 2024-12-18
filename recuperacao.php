<?php
include_once './config/config.php';
include_once './classes/Funcionario.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $codigo = $_POST['codigo'];
    $nova_senha = $_POST['nova_senha'];
    $funcionario = new Funcionario($db);


    if ($funcionario->redefinirSenha($codigo, $nova_senha)) {
        $mensagem = 'Senha redefinida com sucesso. Você pode <a href="index.php">entrar</a> agora.';
    } else {
        $mensagem = 'Código de verificação inválido.';
    }
}
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Redefinir Senha</title>
   <link rel="stylesheet" href="/css/recuperacao.css">
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
        <h1>Redefinir Senha</h1>

        <label for="codigo">Código de Verificação:</label>
        <input type="text" name="codigo" required placeholder="insira seu codigo de verificação"><br><br>
        <label for="nova_senha">Nova Senha:</label>
        <input type="password" name="nova_senha" required><br><br>
        <input type="submit" value="Redefinir Senha">
    </form>
    </div>
    </div>
    <p><?php echo $mensagem; ?></p>
</body>

</html>