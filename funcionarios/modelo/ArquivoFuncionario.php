<?php
class ArquivoFuncinario{
	private $id;
	private $numero_login_funcionario_arquivo;
	private $id_arquivo;
		
	public function __construct($numero_login_funcionario_arquivo,$id_arquivo,$id=-1){
		$this->numero_login_funcionario_arquivo = $numero_login_funcionario_arquivo;
		$this->id_arquivo = $id_arquivo;
		$this->id = $id;
	}
	public function getIdArquivo(){
		return $this->id_arquivo;
	}
	public function getId(){
		return $this->id;
	}
	public function getNumeroLoginFuncionarioArquivo(){
		return $this->numero_login_funcionario_arquivo;
	}
	public function getIcone(){
		return $this->endereco.".jpg";
	}	
}
?>
