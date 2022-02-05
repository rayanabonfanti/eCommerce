<?php
class ArquivoProdutoDAO{
	public static function salvarArquivoCadastrarProduto($arquivo,$produto){	
		$preco = $produto->getPreco();
		$descricao = $produto->getDescricao();
		$estoque = $produto->getEstoque();
		$ativo = $produto->getAtivo();
		$foto = $produto->getFoto();
				
		try{
			$conexao = new PDO(Banco::URL,Banco::USUARIO,Banco::SENHA);
		}catch(Exception $ex){
			echo $ex;
		}
		try{
			$conexao->beginTransaction();
			
			$sql0 = "insert into produto(preco,descricao,estoque,ativo,foto) values(:preco,:descricao,:estoque,:ativo,:foto)";
			$parametros0 = array(":preco"=>$preco,":descricao"=>$descricao,":estoque"=>$estoque,":ativo"=>$ativo,":foto"=>$foto);
			$last_insert0 = "select last_insert_id()";
			$parametrosL0 = array(":last_insert0"=>$last_insert0);

			$stmt0 = $conexao->prepare($sql0);
			$stmt0->execute($parametros0);	
			$stmtL0 = $conexao->prepare($last_insert0);
			$stmtL0->execute($parametrosL0);
			$array_last_insert0 = $stmtL0->fetch();
			$last_insert0 = $array_last_insert0[0];
			
			$sql1 = "insert into arquivo(nome,endereco) values(:nome,:endereco)";
			$parametros1 = array(":nome"=>$arquivo->getNome(),":endereco"=>$arquivo->getEndereco());
			$last_insert1 = "select last_insert_id()";
			$parametrosL1 = array(":last_insert1"=>$last_insert1);

			$stmt1 = $conexao->prepare($sql1);
			$stmt1->execute($parametros1);	
			$stmtL1 = $conexao->prepare($last_insert1);
			$stmtL1->execute($parametrosL1);
			$array_last_insert1 = $stmtL1->fetch();
			$last_insert1 = $array_last_insert1[0];
			

			$sql2 = "insert into arquivo_produto(id_arquivo,id_produto_arquivo) values(:last_insert1,:last_insert0)";						
			$parametros2 = array(":last_insert0"=>$last_insert0,":last_insert1"=>$last_insert1);
				
			$stmt2 = $conexao->prepare($sql2);
			$stmt2->execute($parametros2);
			
			$erro0 = $stmt0->errorInfo();
			$erro1 = $stmt1->errorInfo();
			$erro2 = $stmt2->errorInfo();			
		
			if($erro0[0] == 0 && $erro2[0] == 0 && $erro1[0]==0){
				$conexao->commit();
			}
			else{
				$conexao->rollBack();
			}
		}catch(Exception $e){
			$conexao->rollBack();
		}
		print_r($erro2);
		return $erro0[0] == 0 && $erro2[0] == 0 && $erro1[0] == 0;
	}

	public static function buscarPorProduto($id_produto)
	{
		$sql="select arquivo.id,arquivo.nome,arquivo.endereco,arquivo_produto.id_produto_arquivo 
		from arquivo inner join arquivo_produto on arquivo_produto.id_arquivo = arquivo.id and arquivo_produto.id_produto_arquivo = :id_produto";
		try{
			$conexao = new PDO(Banco::URL,Banco::USUARIO,Banco::SENHA);
		}catch(Exception $ex){
			echo $ex;
		}
		$stmt = $conexao->prepare($sql);
		$stmt->execute(array(":id_produto"=>$id_produto));
		$r = array();
		while($obj = $stmt->fetchObject()){
			$r[] = new Arquivo($obj->nome,
			$obj->endereco,$obj->id);
		}		
		return $r;
	}

	public static function salvarArquivoProduto($ar,$id){	
		$sql1 = "insert into arquivo(nome,endereco) values(:nome,:endereco)";
		$parametros1 = array(":nome"=>$ar->getNome(),":endereco"=>$ar->getEndereco());
		$sql2 = "insert into arquivo_produto(id_arquivo,id_produto_arquivo) values(last_insert_id(),:id)";						
		$parametros2 = array(":id"=>$id);
							
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

	public static function excluirArquivo($id_produto,$i_ar)
	{	
			$sql0 = "delete from arquivo_produto where id_produto_arquivo = :id_produto and id_arquivo = :i_ar";
			$parametros0 = array(":id_produto"=>$id_produto,":i_ar"=>$i_ar);

			$sql1 = "delete from arquivo where id = :i_ar";
			$parametros1 = array(":i_ar"=>$i_ar);

			try
			{
				$banco = new PDO(Banco::URL,Banco::USUARIO,Banco::SENHA);
			}
			catch(PDOException $ex)
			{
				echo 'Erro de conexão: ' . $ex->getMessage();
			}
			$stmt0 = $banco->prepare($sql0);
			$stmt0->execute($parametros0);
			$erro0 = $stmt0->errorInfo();
			$stmt1 = $banco->prepare($sql1);
			$stmt1->execute($parametros1);
			$erro1 = $stmt1->errorInfo();
			return $erro0[0] == 0 && $erro1[0] == 0;
	}
}
?>
