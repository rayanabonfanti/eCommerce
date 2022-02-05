<?php
class Usuario{
	private $id;
	private $cpf;
	private $nome;
	private $email;
	private $senha;
	private $foto_perfil;
	private $nivel;
								
	public function __construct($cpf,$nome, $senha, $email,$foto_perfil="",$nivel = 'cliente', $id=-1){
		$this->id = $id;
		$this->cpf = $cpf;
		$this->nome = $nome;
		$this->email = $email;
		$this->senha = $senha;
		$this->foto_perfil = $foto_perfil;
		$this->nivel = $nivel;
		
	}
	public function getId(){
		return $this->id;
	}
	
	public function getCpf(){
		return $this->cpf;
	}
	
	public function getNome(){
		return $this->nome;
	}
	
	public function getEmail(){
		return $this->email;
	}
	public function getSenha(){
		return $this->senha;
	}	
	
	public function setCpf($cpf){
		$this->cpf = $cpf;
	}
	public function setNome($nome){
		$this->nome = $nome;
	}
		
	public function setEmail($email){
		$this->email = $email;
	}
	public function setSenha($senha){
		$this->senha = $senha;
	}
	
	public function getNivel(){
		return $this->nivel;
	}
	
	public function getFoto_perfil(){
		return $this->foto_perfil;
	}
	
	public function setFoto_perfil($foto_perfil){
		$this->foto_perfil = $foto_perfil;
	}
	
	
	
	public function __toString(){
		return json_encode($this);
	}
	
	
}
?>
