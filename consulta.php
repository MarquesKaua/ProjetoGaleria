<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta da Foto</title>
    <link rel="stylesheet" href="css/style2.css">
</head>
<body>

<?php
 ini_set('display_errors', 1);
 ini_set('display_startup_errors', 1);
 error_reporting(E_ALL);

include_once('conexao.php');


$mysql = new BancodeDados();
$mysql->conecta();


$codigo = $_GET['codigo'];


$sqlconsulta = "SELECT * FROM tabelaimg WHERE codigo = '$codigo'";


$resultado = $mysql->sqlquery($sqlconsulta, 'consulta.php');

if ($row = mysqli_fetch_assoc($resultado)) {
?>


<b>Código:</b> <input type="number" value="<?php echo $row['codigo']; ?>" readonly><br><br>
<b>Nome da Foto:</b> <input type="text" value="<?php echo $row['nomeFoto']; ?>" readonly><br><br>
<b>Descrição:</b><br>
<textarea rows="3" cols="100" readonly><?php echo $row['descricao']; ?></textarea><br><br>


<b>Imagem:</b> <br>
<img src="upload/<?php echo $row['imagem']; ?>" alt="Imagem da Foto" width="300"><br><br>

<?php
} else {
    echo "<p>Foto não encontrada!</p>";
}
?>


<input type="button" onclick="window.location='index.php';" value="Voltar">

</body>
</html>
