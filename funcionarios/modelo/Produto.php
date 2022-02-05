<?php 
	class Produto
	{
		private $id;
		private $preco;
		private $descricao;
		private $estoque;
		private $ativo;
		private $foto;

		public function __construct($preco,$descricao,$estoque,$ativo,$foto="",$id=-1)
		{
			$this->preco = $preco;
			$this->descricao = $descricao;
			$this->estoque = $estoque;
			$this->ativo = $ativo;
			$this->foto = $foto;
			$this->id = $id;
		}

		public function getID()
		{
			return $this->id;
		}
		
		public function getFoto()
		{
			return $this->foto;
		}

		public function getDescricao()
		{
			return $this->descricao;
		}

		public function getPreco()
		{
			return $this->preco;
		}

		public function getEstoque()
		{
			return $this->estoque;
		}

		public function getAtivo()
		{
			return $this->ativo;
		}
		
		//OUTROS SETS, TOSTRING
	}
?>
