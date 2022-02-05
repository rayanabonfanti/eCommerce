<?php 
	class Pedido
	{
		private $id;
		private $status_atualizacao;
		private $forma_pagamento;
		private $pedido_id_cliente;

		public function __construct($status_atualizacao,$forma_pagamento,$pedido_id_cliente,$id=-1)
		{
			$this->status_atualizacao = $status_atualizacao;
			$this->forma_pagamento = $forma_pagamento;
			$this->pedido_id_cliente = $pedido_id_cliente;
			$this->id = $id;
		}

		public function getID()
		{
			return $this->id;
		}

		public function getStatusAtualizacao()
		{
			return $this->status_atualizacao;
		}

		public function getFormaPagamento()
		{
			return $this->forma_pagamento;
		}

		public function getPedido_id_cliente()
		{
			return $this->pedido_id_cliente;
		}

		//OUTROS GETS E SETS, TOSTRING
	}
?>
