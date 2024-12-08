<?php
session_start();

// Verifica se os dados de login foram enviados
if (isset($_POST['username'], $_POST['senha'])) {
    // Usuário fixo para login (pode ser substituído por banco de dados)
    $username = $_POST['username'];
    $senha = $_POST['senha'];

    // Autenticação simples
    if ($username === 'admin' && $senha === 'admin') {
        $_SESSION['logado'] = true;
        $_SESSION['funcao'] = 'admin';
    } else {
        $_SESSION['logado'] = true;
        $_SESSION['funcao'] = 'convidado';
    }

    // Redireciona para a página inicial
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <h1>LOGIN</h1>
    <form method="post">
        <label for="username">Usuário:</label>
        <input type="text" name="username" id="username" required><br><br>
        <label for="senha">Senha:</label>
        <input type="password" name="senha" id="senha" required><br><br>
        <button type="submit">Entrar</button>
    </form>
</body>
</html>
