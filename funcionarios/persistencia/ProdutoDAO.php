<?php
	class ProdutoDAO
	{
		public static function salvar($obj)
		{
			$preco = $obj->getPreco();
			$descricao = $obj->getDescricao();
			$estoque = $obj->getEstoque();
			$ativo = $obj->getAtivo();
			$foto = $obj->getFoto();

			$sql = "insert into produto(preco,descricao,estoque,ativo,foto) values(:preco,:descricao,:estoque,:ativo,:foto)";

			try
			{
				$banco = new PDO(Banco::URL,Banco::USUARIO,Banco::SENHA);
			}
			catch(PDOException $ex)
			{
				echo 'Erro de conexão: ' . $ex->getMessage();
			}
			
			$stmt = $banco->prepare($sql);
			$parametros = array(":preco"=>$preco,":descricao"=>$descricao,":estoque"=>$estoque,":ativo"=>$ativo,":foto"=>$foto);
			$stmt->execute($parametros);
			return true;
		}
		
		public static function excluir($id)
		{
			$sql = "delete from produto where id = :id";
			$parametros = array(":id"=>$id);

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

		public static function todos()
		{
			$sql = "select id,preco,descricao,estoque,ativo,foto from produto";

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
				$p = new Produto($obj->preco,$obj->descricao,$obj->estoque,$obj->ativo,$obj->foto,$obj->id);
				$retorno[] = $p;
			}		
			return $retorno;
		}
		
		public static function alterarPrecoProduto($id,$preco)
		{
			$sql = "update produto set preco = :preco where id = :id";			

			try
			{
				$banco = new PDO(Banco::URL,Banco::USUARIO,Banco::SENHA);
			}
			catch(PDOException $ex)
			{
				echo 'Erro de conexão: ' . $ex->getMessage();
			}

			$stmt = $banco->prepare($sql);
			$stmt->execute(array(":id"=>$id,":preco"=>$preco));
			return $count = $stmt->rowCount();
		}

		public static function alterarAtivoProduto($id,$ativo)
		{
			$sql = "update produto set ativo = :ativo where id = :id";			

			try
			{
				$banco = new PDO(Banco::URL,Banco::USUARIO,Banco::SENHA);
			}
			catch(PDOException $ex)
			{
				echo 'Erro de conexão: ' . $ex->getMessage();
			}

			$stmt = $banco->prepare($sql);
			$stmt->execute(array(":id"=>$id,":ativo"=>$ativo));
			return $count = $stmt->rowCount();
		}

		public static function alterarDescricaoProduto($id,$descricao)
		{
			$sql = "update produto set descricao = :descricao where id = :id";			

			try
			{
				$banco = new PDO(Banco::URL,Banco::USUARIO,Banco::SENHA);
			}
			catch(PDOException $ex)
			{
				echo 'Erro de conexão: ' . $ex->getMessage();
			}

			$stmt = $banco->prepare($sql);
			$stmt->execute(array(":id"=>$id,":descricao"=>$descricao));
			return $count = $stmt->rowCount();
		}
		
		public static function buscarPorNome($descricao)
		{
			$sql = "select * from produto where produto.descricao like '%$descricao%' ;";
								
			try
			{
				$banco = new PDO(Banco::URL,Banco::USUARIO,Banco::SENHA);
			}
			catch(PDOException $ex)
			{
				echo 'Erro de conexão: ' . $ex->getMessage();
			}
			$stmt = $banco->prepare($sql);
			$stmt->execute(array(":descricao"=>$descricao));
			//print_r($stmt->errorInfo());
			$retorno = array();
			while($obj = $stmt->fetchObject())
			{
				$p = new Produto($obj->preco,$obj->descricao,$obj->estoque,$obj->ativo,$obj->foto,$obj->id);
				$retorno[] = $p;
			}		
			return $retorno;
		}
		
		public static function buscarPorId($id)
		{
			$sql = "select * from produto where produto.id = :id";
								
			try
			{
				$banco = new PDO(Banco::URL,Banco::USUARIO,Banco::SENHA);
			}
			catch(PDOException $ex)
			{
				echo 'Erro de conexão: ' . $ex->getMessage();
			}
			$stmt = $banco->prepare($sql);
			$stmt->execute(array(":id"=>$id));
			//print_r($stmt->errorInfo());
			$retorno = null;
			while($obj = $stmt->fetchObject())
			{
				$retorno = new Produto($obj->preco,$obj->descricao,$obj->estoque,$obj->ativo,$obj->foto,$obj->id);
				return $retorno;
			}		
			return $retorno;
		}
		
		
		
		
	}
?>
