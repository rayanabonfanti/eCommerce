<?php
class CompraItensDAO{
	
	public static function adicionarItemCompra($id_produto,$id_pedido, $quantidade){
		$sql = "insert into compra_itens(id_produto,id_pedido, quantidade) 
					values(:id_produto,:id_pedido, :quantidade)";
					
		$parametros = array(":id_produto"=>$id_produto,":id_pedido"=>$id_pedido,":quantidade"=>$quantidade);
		try{
			$banco = new PDO(Banco::URL, Banco::USUARIO, Banco::SENHA);
		}catch(Exception $ex){
			echo $ex;
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
		$sql = "update compra_itens set compra_itens.quantidade = compra_itens.quantidade + 1 
								where compra_itens.id_produto = :id_produto and compra_itens.id_cliente = :id_cliente  ";
					
		$parametros = array(":id_produto"=>$id_produto,":id_cliente"=>$id_cliente);
		try{
			$banco = new PDO(Banco::URL, Banco::USUARIO, Banco::SENHA);
		}catch(Exception $ex){
			echo $ex;
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
		//print_r($erro);
		return $erro[0] == 0;
	}
	
	public static function alterarQuantidadeDecrementar($id_produto,$id_cliente){
		$sql = "update compra_itens set compra_itens.quantidade = compra_itens.quantidade - 1 
								where compra_itens.id_produto = :id_produto and compra_itens.id_cliente = :id_cliente  ";
					
		$parametros = array(":id_produto"=>$id_produto,":id_cliente"=>$id_cliente);
		try{
			$banco = new PDO(Banco::URL, Banco::USUARIO, Banco::SENHA);
		}catch(Exception $ex){
			echo $ex;
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
	
	
	public static function excluirItemCompra($id_produto, $id_cliente){
		$sql = "delete from compra_itens where compra_itens.id_produto = :id_produto and compra_itens.id_cliente = :id_cliente";
		
		$parametros = array(":id_produto"=>$id_produto, ":id_cliente"=>$id_cliente);	
		try{
			$banco = new PDO(Banco::URL, Banco::USUARIO, Banco::SENHA);
		}catch(Exception $ex){
			echo $ex;
		}
		$stmt = $banco->prepare($sql);
		$stmt->execute($parametros);			
		$erro = $stmt->errorInfo();	
		//print_r($erro);
		return $erro[0] == 0;
	}
	
	
	
	
	public static function buscarPorIdCliente($id){
		$sql = "select * from compra_itens where compra_itens.id_cliente = :id";

		try{
			$banco = new PDO(Banco::URL, Banco::USUARIO, Banco::SENHA);
		}catch(Exception $ex){
			echo $ex;
		}	
		$parametros = array(":id"=>$id);
		$stmt = $banco->prepare($sql);
		$stmt->execute($parametros);	
		
		$retorno = array();		
		while($obj = $stmt->fetchObject()){
			$c = new CompraItens($obj->id_produto,$obj->id_cliente, $obj->quantidade,$obj->id);
			$retorno[] = $c;
		}
		return $retorno;
	}
	
}
?>

