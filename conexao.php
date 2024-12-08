<?php
class BancodeDados {
  
    private $host = "localhost"; 	// Nome ou IP do Servidor
    private $user = "root"; 		// Usu�rio do Servidor MySQL
    private $senha = "01122005Batata@"; 		// Senha do Usu�rio MySQL
    private $banco = "projetofinal"; 		// Nome do seu Banco de Dados
    public $con;
	
	// m�todo respons�vel para conex�o a base de dados
	function conecta(){
        $this->con = @mysqli_connect($this->host,$this->user,$this->senha, $this->banco);
	    // Conecta ao Banco de Dados
        if(!$this->con){
      		// Caso ocorra um erro, exibe uma mensagem com o erro
			die ("Problemas com a conex�o");
        }
    }
	
	// m�todo respons�vel para fechar a conex�o
	function fechar(){
		mysqli_close($this->con);
		return;
	}
	// fun��o para executar o SELECT (consultar.php, verexclusao.php, veralteracao.php)
	function sqlquery($string, $caminho) {
		// Executa a consulta SQL
		$resultado = mysqli_query($this->con, $string);
		if (!$resultado) {
			// Se der erro, exibe mensagem e volta ao caminho especificado
			echo '<input type="button" onclick="window.location=' . "'$caminho'" . ';" value="Voltar"><br><br>';
			die('<b>Query Inválida:</b> ' . mysqli_error($this->con));
		}
		return $resultado; // Retorna o result set completo
	}
	
	
	// fun��o para executar o INSERT, UPDATE e DELETE (incluir.php, alterar.php, excluir.php, upload.php)
	function sqlstring($string,$texto){
		$resultado = @mysqli_query($this->con, $string);
		if (!$resultado) {
			echo '<input type="button" onclick="window.location='."'index.php'".';" value="Voltar"><br><br>';
			die('<b>Query Invalida:</b>' . @mysqli_error($mysql->con)); 
		} else {
			echo "<b>$texto </b> - Realizada com  Sucesso";
		}
		$this->fechar();
		return;
	}
	
}


?>