<?php
class CarrinhoDAO{
	
	public static function adicionarItem($id_produto,$id_cliente, $quantidade){
		echo "Valores: $id_produto,$id_cliente, $quantidade <br>";
		$sql = "insert into carrinho(id_produto,id_cliente, quantidade) 
					values(:id_produto,:id_cliente, :quantidade)";
					
		$parametros = array(":id_produto"=>$id_produto,":id_cliente"=>$id_cliente,":quantidade"=>$quantidade);
		try{
			$banco = new PDO(Banco::URL, Banco::USUARIO, Banco::SENHA);
		}catch(Exception $ex){
			echo 'Erro de conexão: ' . $ex->getMessage();
		}
		try{
			$banco->beginTransaction();
			$stmt = $banco->prepare($sql);
			$stmt->execute($parametros);
			$erro = $stmt->errorInfo();	
			print_r($erro);
			if($erro[0] == 0){
				$banco->commit();
			}
			else{
				$banco->rollBack();
			}
		}catch(Exception $e){
			$banco->rollBack();
		}
		print_r($erro);
		return $erro[0] == 0;
	}
	
	
	public static function alterarQuantidade($id_produto,$id_cliente){
		$sql = "update carrinho set carrinho.quantidade = carrinho.quantidade + 1 
								where carrinho.id_produto = :id_produto and carrinho.id_cliente = :id_cliente  ";
					
		$parametros = array(":id_produto"=>$id_produto,":id_cliente"=>$id_cliente);
		try{
			$banco = new PDO(Banco::URL, Banco::USUARIO, Banco::SENHA);
		}catch(Exception $ex){
			echo 'Erro de conexão: ' . $ex->getMessage();
		}
		try{
			$banco->beginTransaction();
			$stmt = $banco->prepare($sql);
			$stmt->execute($parametros);
			$erro = $stmt->errorInfo();	
			//print_r($erro);
			if($erro[0] == 0){
				$banco->commit();
			}
			else{
				$banco->rollBack();
			}
		}catch(Exception $e){
			$banco->rollBack();
		}
		//print_r($erro);
		return $erro[0] == 0;
	}
	
	public static function alterarQuantidadeDecrementar($id_produto,$id_cliente){
		$sql = "update carrinho set carrinho.quantidade = carrinho.quantidade - 1 
								where carrinho.id_produto = :id_produto and carrinho.id_cliente = :id_cliente  ";
					
		$parametros = array(":id_produto"=>$id_produto,":id_cliente"=>$id_cliente);
		try{
			$banco = new PDO(Banco::URL, Banco::USUARIO, Banco::SENHA);
		}catch(Exception $ex){
			echo 'Erro de conexão: ' . $ex->getMessage();
		}
		try{
			$banco->beginTransaction();
			$stmt = $banco->prepare($sql);
			$stmt->execute($parametros);
			$erro = $stmt->errorInfo();	
			//print_r($erro);
			if($erro[0] == 0){
				$banco->commit();
			}
			else{
				$banco->rollBack();
			}
		}catch(Exception $e){
			$banco->rollBack();
		}
		//print_r($erro);
		return $erro[0] == 0;
	}
	
	
	public static function excluirItemCarrinho($id_produto, $id_cliente){
		$sql = "delete from carrinho where carrinho.id_produto = :id_produto and carrinho.id_cliente = :id_cliente";
		
		$parametros = array(":id_produto"=>$id_produto, ":id_cliente"=>$id_cliente);	
		try{
			$banco = new PDO(Banco::URL, Banco::USUARIO, Banco::SENHA);
		}catch(Exception $ex){
			echo 'Erro de conexão: ' . $ex->getMessage();
		}
		$stmt = $banco->prepare($sql);
		$stmt->execute($parametros);			
		$erro = $stmt->errorInfo();	
		return $erro[0] == 0;
	}
	
	public static function verificarCarrinho($id_produto, $id_cliente){
		$sql = "select * from carrinho where carrinho.id_produto = :id_produto and carrinho.id_cliente = :id_cliente";

		try{
			$banco = new PDO(Banco::URL, Banco::USUARIO, Banco::SENHA);
		}catch(Exception $ex){
			echo 'Erro de conexão: ' . $ex->getMessage();
		}	
		$parametros = array(":id_produto"=>$id_produto,":id_cliente"=>$id_cliente );
		$stmt = $banco->prepare($sql);
		$stmt->execute($parametros);	
		print_r($stmt->errorInfo());
		$retorno = null;	
		if($stmt->rowCount() == 0)
		{
			return $retorno;	
		}
		else
		{
			while($obj = $stmt->fetchObject())
			{
				$retorno = new Carrinho($obj->id_produto,$obj->id_cliente, $obj->quantidade, $obj->id);
				return $retorno;
			}	
		}		
	}
	
	
	
	public static function buscarPorIdCliente($id){
		$sql = "select * from carrinho where carrinho.id_cliente = :id";

		try{
			$banco = new PDO(Banco::URL, Banco::USUARIO, Banco::SENHA);
		}catch(Exception $ex){
			echo 'Erro de conexão: ' . $ex->getMessage();
		}	
		$parametros = array(":id"=>$id);
		$stmt = $banco->prepare($sql);
		$stmt->execute($parametros);	
		
		$retorno = array();		
		while($obj = $stmt->fetchObject()){
			$c = new Carrinho($obj->id_produto,$obj->id_cliente, $obj->quantidade,$obj->id);
			$retorno[] = $c;
		}
		return $retorno;
	}
	
}
?>

