<?php
	class FuncionarioDAO
	{
		public static function buscaFuncionario($numero_login_s)
		{
			$sql="select numero_login,cpf, nome, email, nivel_hierarquico,cargo,salario from funcionario where numero_login = :numero_login_s";
			try{
				$conexao = new PDO(Banco::URL,Banco::USUARIO,Banco::SENHA);
			}catch(Exception $ex){
				echo $ex;
			}
			$stmt = $conexao->prepare($sql);
			$stmt->execute(array(":numero_login_s"=>$numero_login_s));
			$r = NULL;
			if($obj = $stmt->fetchObject()){
				$r = new Funcionario("",$obj->cpf,$obj->nome,$obj->email,$obj->nivel_hierarquico,$obj->cargo,$obj->numero_login,$obj->salario);			
			}		
			else{
				echo "nao entrou";
			}			
			return $r;		
		}
		
		public static function autenticar($numero_login,$senha)
		{
			$sql="select numero_login,cpf, nome, email, nivel_hierarquico,cargo,salario from funcionario where numero_login=:numero_login and senha=sha2(:senha,512)";
			
			try
			{
				$conexao = new PDO(Banco::URL,Banco::USUARIO,Banco::SENHA);
			}
			catch(Exception $ex)
			{
				echo $ex;
			}
			$stmt = $conexao->prepare($sql);
			$stmt->execute(array(":numero_login"=>$numero_login,":senha"=>$senha));
			if($res = $stmt->fetchObject())
			{
				return new Funcionario("",$res->cpf,$res->nome,$res->email,$res->nivel_hierarquico,$res->cargo,$res->numero_login,$res->salario);
			}
			return NULL;
		}

		public static function alterarNome($numero_login,$nome)
		{
			$sql = "update funcionario set nome = :nome where numero_login = :numero_login";			

			try
			{
				$banco = new PDO(Banco::URL,Banco::USUARIO,Banco::SENHA);
			}
			catch(PDOException $ex)
			{
				echo 'Erro de conexão: ' . $ex->getMessage();
			}

			$stmt = $banco->prepare($sql);
			$stmt->execute(array(":numero_login"=>$numero_login,":nome"=>$nome));
			return $count = $stmt->rowCount();
		}

		public static function alterarSalario($numero_login,$salario)
		{
			$sql = "update funcionario set salario = :salario where numero_login = :numero_login";			

			try
			{
				$banco = new PDO(Banco::URL,Banco::USUARIO,Banco::SENHA);
			}
			catch(PDOException $ex)
			{
				echo 'Erro de conexão: ' . $ex->getMessage();
			}

			$stmt = $banco->prepare($sql);
			$stmt->execute(array(":numero_login"=>$numero_login,":salario"=>$salario));
			return $count = $stmt->rowCount();
		}

		public static function alterarEmail($numero_login,$email)
		{
			$sql = "update funcionario set email = :email where numero_login = :numero_login";			

			try
			{
				$banco = new PDO(Banco::URL,Banco::USUARIO,Banco::SENHA);
			}
			catch(PDOException $ex)
			{
				echo 'Erro de conexão: ' . $ex->getMessage();
			}

			$stmt = $banco->prepare($sql);
			$stmt->execute(array(":numero_login"=>$numero_login,":email"=>$email));
			return $count = $stmt->rowCount();
		}

		public static function alterarCargo($numero_login,$cargo)
		{
			$sql = "update funcionario set cargo = :cargo where numero_login = :numero_login";			

			try
			{
				$banco = new PDO(Banco::URL,Banco::USUARIO,Banco::SENHA);
			}
			catch(PDOException $ex)
			{
				echo 'Erro de conexão: ' . $ex->getMessage();
			}

			$stmt = $banco->prepare($sql);
			$stmt->execute(array(":numero_login"=>$numero_login,":cargo"=>$cargo));
			return $count = $stmt->rowCount();
		}

		public static function alterarNivel($numero_login,$nivel)
		{
			$sql = "update funcionario set nivel_hierarquico = :nivel where numero_login = :numero_login";			

			try
			{
				$banco = new PDO(Banco::URL,Banco::USUARIO,Banco::SENHA);
			}
			catch(PDOException $ex)
			{
				echo 'Erro de conexão: ' . $ex->getMessage();
			}

			$stmt = $banco->prepare($sql);
			$stmt->execute(array(":numero_login"=>$numero_login,":nivel"=>$nivel));
			return $count = $stmt->rowCount();
		}

		public static function alterarNumeroLogin($numero_login,$numero_login_novo)
		{
			$sql = "update funcionario set numero_login = :numero_login_novo where numero_login = :numero_login";			

			try
			{
				$banco = new PDO(Banco::URL,Banco::USUARIO,Banco::SENHA);
			}
			catch(PDOException $ex)
			{
				echo 'Erro de conexão: ' . $ex->getMessage();
			}

			$stmt = $banco->prepare($sql);
			$stmt->execute(array(":numero_login"=>$numero_login,":numero_login_novo"=>$numero_login_novo));
			return $count = $stmt->rowCount();
		}

		//fazer
		public static function alterarSenha($numero_login,$senha_antiga,$senha_nova)
		{
			$sql = "update funcionario set senha = sha2(:senha_nova,512) where numero_login = :numero_login and senha = sha2(:senha_antiga,512)";			

			try
			{
				$banco = new PDO(Banco::URL,Banco::USUARIO,Banco::SENHA);
			}
			catch(PDOException $ex)
			{
				echo 'Erro de conexão: ' . $ex->getMessage();
			}

			$stmt = $banco->prepare($sql);
			$stmt->execute(array(":numero_login"=>$numero_login,":senha_antiga"=>$senha_antiga,":senha_nova"=>$senha_nova));
			return $count = $stmt->rowCount();
		}

		public static function salvar($obj)
		{
			$senha = $obj->getSenha();
			$cpf = $obj->getCpf();
			$nome = $obj->getNome();
			$email = $obj->getEmail();
			$nivel_hierarquico = $obj->getNivelHierarquico();
			$cargo = $obj->getCargo();
			$numero_login = $obj->getNumeroLogin();

			$sql = "insert into funcionario(senha, cpf, nome, email, nivel_hierarquico, cargo, numero_login) 
			values(sha2(:senha,512),:cpf,:nome,:email,:nivel_hierarquico,:cargo,:numero_login)";

			try
			{
				$banco = new PDO(Banco::URL,Banco::USUARIO,Banco::SENHA);
			}
			catch(PDOException $ex)
			{
				echo 'Erro de conexão: ' . $ex->getMessage();
			}
			
			$stmt = $banco->prepare($sql);
			$parametros = array(":senha"=>$senha,":cpf"=>$cpf,":nome"=>$nome,":email"=>$email,":nivel_hierarquico"=>$nivel_hierarquico,
			":cargo"=>$cargo,":numero_login"=>$numero_login);
			$stmt->execute($parametros);
			return true;
		}
		
		public static function excluir($numero_login)
		{
			$sql = "delete from funcionario where numero_login = :numero_login";
			$parametros = array(":numero_login"=>$numero_login);

			try
			{
				$banco = new PDO(Banco::URL,Banco::USUARIO,Banco::SENHA);
			}
			catch(PDOException $ex)
			{
				echo 'Erro de conexão: ' . $ex->getMessage();
			}
			$stmt = $banco->prepare($sql);
			$stmt->execute($parametros);
			$erro = $stmt->errorInfo();
			return $erro[0] == 0;
		}

		public static function todosExcetoEleMesmoAbaixaDeleMesmo($numero_login,$administrador_basico,$funcionario_comum)
		{
			$sql = "select numero_login,cpf, nome, email, nivel_hierarquico,cargo,salario from funcionario
			where (nivel_hierarquico = :administrador_basico or nivel_hierarquico = :funcionario_comum) and numero_login != :numero_login";

			$parametros = array(":numero_login"=>$numero_login,":administrador_basico"=>$administrador_basico,":funcionario_comum"=>$funcionario_comum);

			try
			{
				$banco = new PDO(Banco::URL,Banco::USUARIO,Banco::SENHA);
			}
			catch(PDOException $ex)
			{
				echo 'Erro de conexão: ' . $ex->getMessage();
			}

			$stmt = $banco->prepare($sql);
			$stmt->execute($parametros);
			$retorno = array();
			while($obj = $stmt->fetchObject())
			{
				$f = new Funcionario("",$obj->cpf,$obj->nome,$obj->email,$obj->nivel_hierarquico,$obj->cargo,$obj->numero_login,$obj->salario);			
				$retorno[] = $f;
			}		
			return $retorno;
		}

		public static function todosExcetoEleMesmo($numero_login)
		{
			$sql = "select numero_login,cpf, nome, email, nivel_hierarquico,cargo,salario from funcionario
					where numero_login != :numero_login";

					$parametros = array(":numero_login"=>$numero_login);

			try
			{
				$banco = new PDO(Banco::URL,Banco::USUARIO,Banco::SENHA);
			}
			catch(PDOException $ex)
			{
				echo 'Erro de conexão: ' . $ex->getMessage();
			}

			$stmt = $banco->prepare($sql);
			$stmt->execute($parametros);
			$retorno = array();
			while($obj = $stmt->fetchObject())
			{
				$f = new Funcionario("",$obj->cpf,$obj->nome,$obj->email,$obj->nivel_hierarquico,$obj->cargo,$obj->numero_login,$obj->salario);			
				$retorno[] = $f;
			}		
			return $retorno;
		}
		
		public static function todos()
		{
			$sql = "select numero_login,cpf, nome, email, nivel_hierarquico,cargo,salario from funcionario";

			try
			{
				$banco = new PDO(Banco::URL,Banco::USUARIO,Banco::SENHA);
			}
			catch(PDOException $ex)
			{
				echo 'Erro de conexão: ' . $ex->getMessage();
			}

			$stmt = $banco->prepare($sql);
			$stmt->execute();
			$retorno = array();
			while($obj = $stmt->fetchObject())
			{
				$f = new Funcionario("",$obj->cpf,$obj->nome,$obj->email,$obj->nivel_hierarquico,$obj->cargo,$obj->numero_login,$obj->salario);			
				$retorno[] = $f;
			}		
			return $retorno;
		}
		
	}
?>
