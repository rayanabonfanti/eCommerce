<?php 
	class Funcionario
	{
		private $numero_login;
		private $senha;
		private $cpf;
		private $nome;
		private $email;
		private $nivel_hierarquico;
		private $cargo;
		private $salario;
		const FUNCIONARIOCOMUM = 'Funcionario_Comum';
		const ADMINISTRADORBASICO = 'Administrador_Basico';
		const ADMINISTRADORRH = 'Administrador_RH';
		const ADMINISTRADORSUPERVISOR = 'Administrador_Supervisor';

		public function __construct($senha,$cpf,$nome,$email,$nivel_hierarquico=Funcionario::FUNCIONARIOCOMUM,$cargo,$numero_login=-1,$salario=0)
		{
			$this->numero_login= $numero_login;
			$this->senha = $senha;
			$this->cpf = $cpf;
			$this->nome = $nome;
			$this->email = $email;
			$this->nivel_hierarquico = $nivel_hierarquico;
			$this->cargo = $cargo;
			$this->salario = $salario;
		}

		public function getNumeroLogin()
		{
			return $this->numero_login;
		}

		public function getNome()
		{
			return $this->nome;
		}

		public function getNivelHierarquico()
		{
			return $this->nivel_hierarquico;
		}

		public function getEmail()
		{
			return $this->email;
		}

		public function getCargo()
		{
			return $this->cargo;
		}

		public function getSenha()
		{
			return $this->senha;
		}

		public function getSalario()
		{
			return $this->salario;
		}

		public function getCpf()
		{
			return $this->cpf;
		}

		//OUTROS SETS, TOSTRING
	}
?>
