<?php
class CompraItens{
	private $id;
    private $id_produto;
    private $id_pedido;
	private $quantidade;
	private $data_emissao;
		
		
	public function __construct($id_produto,$id_pedido,$quantidade,$data_emissao,$id=-1){
		$this->id_produto = $id_produto;
		$this->id_pedido = $id_pedido;
		$this->quantidade = $quantidade;
		$this->data_emissao = $data_emissao;
		$this->id = $id;
	}
	public function getId(){
		return $this->id;
	}
	public function getIdProduto(){
		return $this->id_produto;
	}
	public function getIdPedido(){
		return $this->id_pedido;
	}
	public function getQuantidade(){
		return $this->quantidade;
	}
	
	public function getDataEmissao(){
		return $this->data_emissao;
	}
	
	public function __toString(){
		return json_encode($this);
	}
	
}
?>
