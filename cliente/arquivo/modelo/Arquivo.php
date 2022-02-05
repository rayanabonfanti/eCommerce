<?php
class Arquivo{
	private $id;
	private $nome;
	private $endereco;
		
	public function __construct($nome,$endereco,$id=-1){
		$this->nome = $nome;
		$this->endereco = $endereco;
		$this->id = $id;
	}
	public function getNome(){
		return $this->nome;
	}
	public function getEndereco(){
		return $this->endereco;
	}
	public function getId(){
		return $this->id;
	}
	public function getIcone(){
		return $this->endereco.".jpg";
	}
	
}
?>
