<?php
class Endereco{
	private $cep;
    private $rua;
	private $numero;
	private $cidade;
	private $estado;
	
	public function __construct( $rua, $numero, $cidade, $estado, $cep){
		$this->cep = $cep;
		$this->rua = $rua;
		$this->numero = $numero;
		$this->cidade = $cidade;
		$this->estado = $estado;
	}
			
	public function getRua(){
		return $this->rua;
	}
	
	public function getNumero(){
		return $this->numero;
	}
	
	public function getCidade(){
		return $this->cidade;
	}
	public function getEstado(){
		return $this->estado;
	}
	
	public function getCep(){
		return $this->cep;
	}
	
	public function setCep($cep){
		
			$this->cep = $cep;
		
	}
	public function setRua($rua){

			$this->rua = rua;
		
	}
	
	public function setNumero($numero){
		
			$this->numero = $numero;
		
	}
	
	public function setCidade($cidade){
		
			$this->cidade = $cidade;
		
		
	}
	public function setEstado($estado){
		
			$this->Estado = $estado;
		
	}
		
	public function __toString(){
		return json_encode($this);
	}
}
?>
