<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
include_once 'base.php'; 

class TabelaExemplo extends Base{
	
	/**
	 * Construtor
	 */
	public function __construct(){
		$this->conexao = new Database();
		$this->setNomeTabela('tabela_exemplo');
		$this->setNomeCampos(array('tab_id', 'tab_campo1','tab_campo2','tab_campo3','cat_data_cadastro', 'cat_data_atualizacao'));
		$this->setCampoID("tab_id");
		$this->setCampoAgregado("tab_id");
		$this->setValorID(0);
		$this->setCampoDataCadastro("tab_data_cadastro");
		$this->setCampoDataAtualizacao("tab_data_atualizacao");
	}	
}
?>
