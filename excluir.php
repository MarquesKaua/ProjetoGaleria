<?php
include_once('conexao.php');

// Cria o objeto de conexão
$mysql = new BancodeDados();
$mysql->conecta();

// Verifica se o código foi passado pela URL
if (isset($_GET['codigo'])) {
    $codigo = $_GET['codigo'];

    // Cria a consulta para buscar os dados da foto antes de excluir
    $sqlconsulta = "SELECT imagem FROM tabelaimg WHERE codigo = '$codigo'";
    $result = $mysql->sqlquery($sqlconsulta, 'excluir.php');
    
    // Verifica se a foto existe no banco
    if ($row = mysqli_fetch_assoc($result)) {
        // Caminho completo do arquivo na pasta de upload
        $imagem = $row['imagem'];
        $caminhoArquivo = './upload/' . $imagem;

        // Verifica se o arquivo existe e exclui
        if (file_exists($caminhoArquivo)) {
            unlink($caminhoArquivo); // Exclui o arquivo
        }

        // Cria a consulta para excluir o registro no banco
        $sqldelete = "DELETE FROM tabelaimg WHERE codigo = '$codigo'";

        // Executa a consulta de exclusão no banco
        $mysql->sqlstring($sqldelete, "EXCLUSÃO");

        // Redireciona de volta para a página principal (index.php)
        header('Location: index.php');
        exit();
    } else {
        echo "Foto não encontrada no banco de dados!";
    }
} else {
    echo "Código não encontrado!";
}
?>
