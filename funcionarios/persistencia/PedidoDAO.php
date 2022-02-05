<?php
	class PedidoDAO
	{
		public static function buscarPorId($id){
		$sql = "select * from pedido where pedido.id = :id";

		try{
			$banco = new PDO(Banco::URL, Banco::USUARIO, Banco::SENHA);
		}catch(Exception $ex){
			echo $ex;
		}	
		$parametros = array(":id"=>$id);
		$stmt = $banco->prepare($sql);
		$stmt->execute($parametros);	
		
		$retorno = null;		
		while($obj = $stmt->fetchObject()){
			return new Pedido($obj->status_atualizacao,$obj->forma_pagamento, $obj->pedido_id_cliente,$obj->id);
			
		}
		return $retorno;
	}
	
	
		public static function todos()
		{
			$sql = "select id,status_atualizacao,forma_pagamento,pedido_id_cliente from pedido";

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
				$p = new Pedido($obj->status_atualizacao,$obj->forma_pagamento,$obj->pedido_id_cliente,$obj->id);
				$retorno[] = $p;
			}		
			return $retorno;
		}
		
		public static function alterarStatusPedido($id,$status_atualizacao)
		{
			$sql = "update pedido set status_atualizacao = :status_atualizacao where id = :id";

			try
			{
				$banco = new PDO(Banco::URL,Banco::USUARIO,Banco::SENHA);
			}
			catch(PDOException $ex)
			{
				echo 'Erro de conexão: ' . $ex->getMessage();
			}

			$stmt = $banco->prepare($sql);
			$stmt->execute(array(":id"=>$id,":status_atualizacao"=>$status_atualizacao));
			return $count = $stmt->rowCount();
		}
		
		public static function buscarPorIdCliente($id){
		$sql = "select * from pedido where pedido.pedido_id_cliente = :id";

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
			$c = new Pedido($obj->status_atualizacao,$obj->forma_pagamento, $obj->pedido_id_cliente,$obj->id);
			$retorno[] = $c;
		}
		return $retorno;
	}
	
	public static function cadastrarPedido($pedido){
		
		$sql = "insert into pedido(status_atualizacao,forma_pagamento,pedido_id_cliente) 
					values(:status_atualizacao,:forma_pagamento, :pedido_id_cliente)";
					
		$parametros = array(":status_atualizacao"=>$pedido->getStatusAtualizacao(),":forma_pagamento"=>$pedido->getFormaPagamento(),
							":pedido_id_cliente"=>$pedido->getPedido_id_cliente());
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
	
	public static function maxIdPedidoCliente($id_cliente){
		$sql = "SELECT MAX(id) as max_id FROM pedido where pedido.pedido_id_cliente = :id_cliente";
		
		try{
			$banco = new PDO(Banco::URL, Banco::USUARIO, Banco::SENHA);
		}catch(Exception $ex){
			echo $ex;
		}
		$parametros = array(":id_cliente"=>$id_cliente);
		$stmt = $banco->prepare($sql);
		$stmt->execute($parametros);	
		$erro = $stmt->errorInfo();
		//print_r($erro); 
		$obj = $stmt->fetch(PDO::FETCH_ASSOC);
		//return $obj;
		$max_id = $obj['max_id'];
		
		return $max_id;		
	}
	
	public static function excluirPedido($id_pedido, $id_cliente){
		$sql = "delete from pedido where pedido.id = :id_pedido and pedido.pedido_id_cliente = :id_cliente";
		
		$parametros = array(":id_pedido"=>$id_pedido, ":id_cliente"=>$id_cliente);	
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
	
	}
?>
