<?php
session_start();

// Verifica se o usuário está logado, caso contrário, redireciona ao login
if (!isset($_SESSION['logado'])) {
    header("Location: login.php");
    exit();
}

// Define o papel do usuário (admin ou guest)
$role = $_SESSION['funcao'] ?? 'convidado';

include_once('conexao.php');

// Criando o objeto MySQL e conectando ao banco de dados
$mysql = new BancodeDados();
$mysql->conecta();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeria de Fotos</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <main>
        <h3>Galeria de Fotos</h3>
        
        <!-- Exibir opções baseadas no papel -->
        <?php if ($role === 'admin'): ?>
            <a href='inclusao.php'>Enviar Foto</a><br><br>
        <?php endif; ?>
        
        <a href="login.php">Sair</a><br><br>

        <?php
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        // Definindo a consulta SQL
        $sql = "SELECT codigo, nomeFoto FROM tabelaimg";

        // Executa a consulta e obtém o result set
        $result = $mysql->sqlquery($sql, "index.php");

        // Verifica e exibe os dados na tabela
        if (mysqli_num_rows($result) > 0) {
            echo "<table border='1'>
                    <tr>
                        <th>Código</th>
                        <th>Nome da Foto</th>
                        <th>Ações</th>
                    </tr>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td>{$row['codigo']}</td>
                        <td>{$row['nomeFoto']}</td>
                        <td>
                            <a href='consulta.php?codigo={$row['codigo']}'>
                                <img src='imagens/buscar.png' alt='Consultar' width='20' title='Consultar'>
                            </a>";
                if ($role === 'admin') {
                    echo "
                            <a href='excluir.php?codigo={$row['codigo']}'>
                                <img src='imagens/excluir.png' alt='Excluir' width='20' title='Excluir'>
                            </a>";
                }
                echo "</td>
                    </tr>";
            }
            echo "</table>";
        } else {
            echo "<p>Nenhuma foto foi enviada ainda.</p>";
        }

        $mysql->fechar();
        ?>
    </main>
</body>
</html>
