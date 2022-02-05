<?php
class ArquivoClienteDAO{
	//PEGANDO O ID PRÓXIMO MESMO APÓS APAGADO
	public static function salvarArquivoCliente($arquivo,$id_cliente_arquivo){	
		$sql1 = "insert into arquivo(nome,endereco) values(:nome,:endereco)";
		$parametros1 = array(":nome"=>$arquivo->getNome(),":endereco"=>$arquivo->getEndereco());
		$sql2 = "insert into arquivo_cliente(id_arquivo,id_cliente_arquivo) values(last_insert_id(),:id_cliente_arquivo)";						
		$parametros2 = array(":id_cliente_arquivo"=>$id_cliente_arquivo);
							
		try{
			$conexao = new PDO(Banco::URL,Banco::USUARIO,Banco::SENHA);
		}catch(Exception $ex){
			echo $ex;
		}
		try{
			$conexao->beginTransaction();
			$stmt1 = $conexao->prepare($sql1);
			$stmt1->execute($parametros1);			
			$stmt2 = $conexao->prepare($sql2);
			$stmt2->execute($parametros2);
			
			$erro1 = $stmt1->errorInfo();
			$erro2 = $stmt2->errorInfo();			
		
			if($erro2[0] == 0 && $erro1[0]==0){
				$conexao->commit();
			}
			else{
				$conexao->rollBack();
			}
		}catch(Exception $e){
			$conexao->rollBack();
		}
		return $erro2[0] == 0 && $erro1[0] == 0;
	}

	public static function buscarPorIdCliente($id_cliente){
		$sql="select arquivo.id,arquivo.nome,arquivo.endereco,arquivo_cliente.id_cliente_arquivo 
		from arquivo inner join arquivo_cliente on arquivo_cliente.id_arquivo = arquivo.id and arquivo_cliente.id_cliente_arquivo = :id";
		try{
			$conexao = new PDO(Banco::URL,Banco::USUARIO,Banco::SENHA);
		}catch(Exception $ex){
			echo $ex;
		}
		$stmt = $conexao->prepare($sql);
		$stmt->execute(array(":id"=>$id_cliente));
		$r = array();
		while($obj = $stmt->fetchObject()){
			$r[] = new Arquivo($obj->nome,$obj->endereco,$obj->id);
		}		
		return $r;
	}

	public static function buscarArquivoPorId($id_arquivo)
	{
		$sql="select arquivo.id,arquivo.nome,arquivo.endereco
		from arquivo where arquivo.id = :id_arquivo";
		try{
			$conexao = new PDO(Banco::URL,Banco::USUARIO,Banco::SENHA);
		}catch(Exception $ex){
			echo $ex;
		}
		$stmt = $conexao->prepare($sql);
		$stmt->execute(array(":id_arquivo"=>$id_arquivo));
		$r = NULL;
		if($obj = $stmt->fetchObject()){
			$r = new ArquivoCliente($obj->nome, $obj->endereco, $obj->id);
		}		
		else{
			echo "nao entrou";
		}
		
		return $r;		
	}

	public static function excluirArquivoCliente1($id_arquivo,$id_cliente_arquivo){
		$sql1="delete from arquivo_cliente where id_arquivo = :id_arquivo and id_cliente_arquivo = :id_cliente_arquivo";
		
		try{
			$conexao = new PDO(Banco::URL,Banco::USUARIO,Banco::SENHA);
		}catch(Exception $ex){
			echo $ex;
		}
		$parametros1 = (array(":id_arquivo"=>$id_arquivo,":id_cliente_arquivo"=>$id_cliente_arquivo));
		try{
			$conexao->beginTransaction();
			$stmt1 = $conexao->prepare($sql1);
			$stmt1->execute($parametros1);			
			
			$erro1 = $stmt1->errorInfo();
			print_r($stmt1->errorInfo());
			if($erro1[0]==0){
				$conexao->commit();
			}
			else{
				$conexao->rollBack();
			}
		}catch(Exception $e){
			$conexao->rollBack();
		}
		return $erro1[0] == 0;
	}

	public static function excluirArquivoCliente2($id_arquivo){
		$sql1="delete from arquivo where id = :id_arquivo";
		
		try{
			$conexao = new PDO(Banco::URL,Banco::USUARIO,Banco::SENHA);
		}catch(Exception $ex){
			echo $ex;
		}
		$parametros1 = (array(":id_arquivo"=>$id_arquivo));
		try{
			$conexao->beginTransaction();
			$stmt1 = $conexao->prepare($sql1);
			$stmt1->execute($parametros1);			
			
			$erro1 = $stmt1->errorInfo();
			
			if($erro1[0]==0){
				$conexao->commit();
			}
			else{
				$conexao->rollBack();
			}
		}catch(Exception $e){
			$conexao->rollBack();
		}
		return $erro1[0] == 0;
	}

}
?>
