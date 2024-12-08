<?php
include_once('conexao.php');


$mysql = new BancodeDados();
$mysql->conecta();


if (isset($_GET['codigo'])) {
    $codigo = $_GET['codigo'];

    $sqlconsulta = "SELECT imagem FROM tabelaimg WHERE codigo = '$codigo'";
    $result = $mysql->sqlquery($sqlconsulta, 'excluir.php');
    

    if ($row = mysqli_fetch_assoc($result)) {

        $imagem = $row['imagem'];
        $caminhoArquivo = './upload/' . $imagem;

        if (file_exists($caminhoArquivo)) {
            unlink($caminhoArquivo); 
        }

        $sqldelete = "DELETE FROM tabelaimg WHERE codigo = '$codigo'";

        $mysql->sqlstring($sqldelete, "EXCLUSÃO");

        header('Location: index.php');
        exit();
    } else {
        echo "Foto não encontrada no banco de dados!";
    }
} else {
    echo "Código não encontrado!";
}
?>
