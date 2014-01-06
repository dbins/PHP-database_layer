<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

class Conexao{
		private $local;
		private $user;
		private $senha;
		private $msg0;
		private $msg1;
		private $nome_db;
		private $db;
		private $query;
		private $resultado;
		private $erro;
	
	public function Conexao(){
		$this->local 	=	'xxx.xxx.xxx.xxx';
		$this->user  	=	'xxxxxxxx';
		$this->senha 	=	'xxxxxxxx';
		$this->msg0  	=	'Conexão falhou, erro: '.mysql_error();
		$this->msg1  	=	'Não foi possível selecionar o banco de dados!';
		$this->nome_db 	=	'xxxxxxxx';
		}
		
	public function abrir(){
		$this->db = mysql_connect($this->local,$this->user,$this->senha) or die($this->msg0);
		mysql_select_db($this->nome_db,$this->db) or die($this->msg1);
	}
	
	public function fechar(){
		//analisar se o mysql_close precisa ser colocado numa variável
		$closed = mysql_close($this->db);
		$closed = NULL;
	}
	
	public function tabelaExiste($table)
    {
	$this->abrir();
	$tablesInDb = mysql_query('SHOW TABLES FROM '.$this->nome_db.' LIKE "'.$table.'"');
		
        if($tablesInDb)
        {
            if(mysql_num_rows($tablesInDb)==1)
            {
                $this->fechar(); 
				return true;
            }
            else
            {
				$this->fechar(); 
                return false;
            }
        }
    }
	
	// Cria a função para query no Banco de Dados
    public function executarSQL($query){
        $this->abrir();
        $this->query = $query;
		// Conecta e faz a query no MySQL
        if($this->resultado = mysql_query($this->query)){
            $this->fechar();
            return $this->resultado;
        } else{
			// Caso ocorra um erro, exibe uma mensagem com o Erro
            print "Ocorreu um erro ao executar a Query MySQL: <b>$query</b>";
			print "<br><br>";
			print "Erro no MySQL: <b>".mysql_error()."</b>";
			die();
            $this->fechar();
        }        
    }
	
	public function inserirSQL($query){
		$this->abrir();
        $this->query = $query;
		// Conecta e faz a query no MySQL
        if($this->resultado = mysql_query($this->query)){
            $valor = mysql_insert_id();
			if ($valor == NULL){
				$valor = 0;
			}
			return $valor;
        } else{
			// Caso ocorra um erro, exibe uma mensagem com o Erro
            print "Ocorreu um erro ao executar a Query MySQL: <b>$query</b>";
			print "<br><br>";
			print "Erro no MySQL: <b>".mysql_error()."</b>";
			die();
            $this->fechar();
        }      
	}
}
?>
