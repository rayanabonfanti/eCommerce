<?php 
	class Atendimento
	{
		private $id;
		private $cpf_cliente_login;
		private $id_pedido;
		private $numero_login_funcionario;
		private $pergunta;
		private $resposta;

		public function __construct($cpf_cliente_login,$id_pedido,$numero_login_funcionario,$pergunta,$resposta,$id=-1)
		{
			$this->cpf_cliente_login = $cpf_cliente_login;
			$this->id_pedido = $id_pedido;
			$this->numero_login_funcionario = $numero_login_funcionario;
			$this->pergunta = $pergunta;
			$this->resposta = $resposta;
			$this->id = $id;
		}

		public function getID()
		{
			return $this->id;
		}

		public function getCpf_cliente_login()
		{
			return $this->cpf_cliente_login;
		}

		public function getId_pedido()
		{
			return $this->id_pedido;
		}

		public function getNumero_login_funcionario()
		{
			return $this->numero_login_funcionario;
		}

		public function getPergunta()
		{
			return $this->pergunta;
		}

		public function getResposta()
		{
			return $this->resposta;
		}

		//OUTROS GETS E SETS, TOSTRING
	}
?>
