<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inclusão de Fotos</title>
    <link rel="stylesheet" href="css/style3.css">
</head>
<body>
    <main>

        <h3>Inclusão de Fotos</h3>

         <!-- Formulário de inclusão -->
         <form name="fotos" action="inclusao.php" method="post" enctype="multipart/form-data">
            <b>Código:</b> <input type="number" name="codigo" required><br><br>
            <b>Nome da Foto:</b> <input type="text" name="nomeFoto" maxlength="80" style="width:550px" required><br><br>
            <b>Descrição:</b><br>
            <textarea name="descricao" rows="3" cols="100" style="resize: none;" required></textarea><br><br>
            <label for="imagem">Arquivo:</label> <input type="file" name="imagem" id="imagem" required><br><br>
            <input type="submit" value="Ok">
            <input type="reset" value="Limpar">
            <input type='button' onclick="window.location='index.php';" value="Voltar">
        </form>

        <?php
include_once('conexao.php');

// Criando o objeto MySQL e conectando ao banco de dados
$mysql = new BancodeDados();
$mysql->conecta();

// Recuperando os dados do formulário
$codigo = $_POST['codigo'];
$nomeFoto = $_POST['nomeFoto'];
$descricao = $_POST['descricao'];
$imagem = $_FILES['imagem']['name'];

// Verificar a extensão do arquivo
$extensao = strtolower(pathinfo($imagem, PATHINFO_EXTENSION));

// Definindo os tipos permitidos
$tiposPermitidos = ['jpg', 'jpeg', 'png'];

if (in_array($extensao, $tiposPermitidos)) {
    // Criando a linha do INSERT
    $sqlinsert = "INSERT INTO tabelaimg (codigo, nomeFoto, descricao, imagem) 
                VALUES ($codigo, '$nomeFoto', '$descricao', '$imagem')";

    // Executando a instrução SQL
    $resultado = $mysql->sqlstring($sqlinsert, "Inclusão");

    // Mover o arquivo de imagem para o diretório de upload
    $dir = './upload/';
    $tmpName = $_FILES['imagem']['tmp_name'];
    $name = $_FILES['imagem']['name'];

    if (move_uploaded_file($tmpName, $dir . $name)) {
        // Sucesso na inclusão e upload
        echo "<p>Foto incluída com sucesso!</p>";
    } else {
        // Caso falhe ao mover o arquivo
        echo "<p>Erro ao mover o arquivo. Tente novamente.</p>";
    }
} else {
    // Caso o arquivo não seja PNG ou JPG
    echo "<p>Somente arquivos PNG e JPG são permitidos.</p>";
}
?>


       

    </main>
</body>
</html>


