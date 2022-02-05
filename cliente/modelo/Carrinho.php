<?php
class Carrinho{
	private $id;
    private $id_produto;
    private $id_cliente;
	private $quantidade;
		
		
	public function __construct($id_produto,$id_cliente,$quantidade,$id=-1){
		$this->id_produto = $id_produto;
		$this->id_cliente = $id_cliente;
		$this->quantidade = $quantidade;
		$this->id = $id;
	}
	public function getId(){
		return $this->id;
	}
	public function getIdProduto(){
		return $this->id_produto;
	}
	public function getIdCliente(){
		return $this->id_cliente;
	}
	public function getQuantidade(){
		return $this->quantidade;
	}
	public function __toString(){
		return json_encode($this);
	}
	
}
?>
