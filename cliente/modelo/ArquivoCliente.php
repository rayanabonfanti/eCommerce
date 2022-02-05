<?php
class ArquivoCliente{
	private $id;
	private $id_cliente_arquivo;
	private $id_arquivo;
		
	public function __construct($id_cliente_arquivo,$id_arquivo,$id=-1){
		$this->id_cliente_arquivo = $id_cliente_arquivo;
		$this->id_arquivo = $id_arquivo;
		$this->id = $id;
	}
	public function getIdArquivo(){
		return $this->id_arquivo;
	}
	public function getId(){
		return $this->id;
	}
	public function getIdClienteArquivo(){
		return $this->id_cliente_arquivo;
	}
	public function getIcone(){
		return $this->endereco.".jpg";
	}	
}
?>
