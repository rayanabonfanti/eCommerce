<?php
require_once("Usuario.php");
class Cliente extends Usuario{
	private $endereco;
	
	
	public function __construct($cpf,$nome, $senha, $email, $foto_perfil = "", $nivel = 'cliente', $endereco, $id=-1){
		parent::__construct($cpf,$nome, $senha, $email, $foto_perfil, $nivel,$id);
		$this->endereco = $endereco;
	}
		
	public function getEndereco(){
		return $this->endereco;
	}
		
	public function setEndereco($end){
		$this->endereco = $end;
	}
		
	public function __toString(){
		return json_encode($this);
	}
}
?>
