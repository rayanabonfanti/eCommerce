<?php
class UsuarioDAO{
	public static function inserirFotoPerfil($foto_perfil, $id){
		$sql = "update Cliente set Cliente.foto_perfil = :foto_perfil where Cliente.id_cliente = :id ";
					
		$parametros = array(":foto_perfil"=>$foto_perfil,":id"=>$id);		
							
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
		
			if($erro[0] == 0 ){
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
	
	
	public static function cadastrar($cliente){
		$sql2 = "insert into Cliente(cpf_login,nome,senha,email,foto_perfil,nivel) 
					values(:cpf_login,:nome,sha2(:senha,512),:email, :foto_perfil,:nivel)";
					
		$parametros2 = array(":cpf_login"=>$cliente->getCpf(),":nome"=>$cliente->getNome(), 
							":senha"=>$cliente->getSenha(),":email"=>$cliente->getEmail(),":foto_perfil"=>$cliente->getFoto_perfil(), ":nivel"=>$cliente->getNivel());
		
		$sql1 = "insert into Endereco(rua,numero,cidade,estado,cep,id_cliente) 
					values(:rua,:numero,:cidade,:estado,:cep, last_insert_id());";	
					
		$parametros1 = array(":rua"=>$cliente->getEndereco()->getRua(),":numero"=>$cliente->getEndereco()->getNumero(),
							":cidade"=>$cliente->getEndereco()->getCidade(),":estado"=>$cliente->getEndereco()->getEstado(),
							":cep"=>$cliente->getEndereco()->getCep());	
							
		try{
			$banco = new PDO(Banco::URL, Banco::USUARIO, Banco::SENHA);
		}catch(Exception $ex){
			echo $ex;
		}
		try{
			$banco->beginTransaction();
			$stmt2 = $banco->prepare($sql2);
			$stmt2->execute($parametros2);			
			
			$stmt1 = $banco->prepare($sql1);
			$stmt1->execute($parametros1);
			
			$erro1 = $stmt1->errorInfo();
			$erro2 = $stmt2->errorInfo();			
		
			if($erro2[0] == 0 && $erro1[0]==0){
				$banco->commit();
			}
			else{
				$banco->rollBack();
			}
		}catch(Exception $e){
			$banco->rollBack();
		}
		//print_r($erro1);
		//print_r($erro2);
		return $erro2[0] == 0 && $erro1[0] == 0;
	}
	
	
	
	
	
	
	
	public static function alterar($cliente){
		$id = $cliente->getId();   
		$sql1 = "update Endereco Set rua=:rua, numero=:numero, cidade=:cidade, estado=:estado, cep=:cep
				where Endereco.id_cliente=:id ; " ;
								
		$parametros1 = array(":rua"=>$cliente->getEndereco()->getRua(),":numero"=>$cliente->getEndereco()->getNumero(),
							":cidade"=>$cliente->getEndereco()->getCidade(),":estado"=>$cliente->getEndereco()->getEstado(),
							":cep"=>$cliente->getEndereco()->getCep(),":id"=>$id);	
			
		$sql2 = "update Cliente set cpf_login=:cpf_login, nome=:nome, email=:email, nivel = :nivel 
				where Cliente.id_cliente = :id;";
		
		$parametros2 = array(":cpf_login"=>$cliente->getCpf(),":nome"=>$cliente->getNome(),":email"=>$cliente->getEmail(), 
							":nivel"=>$cliente->getNivel(),":id"=>$id);

		try{
			$banco = new PDO(Banco::URL, Banco::USUARIO, Banco::SENHA);
		}catch(Exception $ex){
			echo $ex;
		}
		
		try{
			$banco->beginTransaction();
			$stmt1 = $banco->prepare($sql1);
			$stmt1->execute($parametros1);
			
			$stmt2 = $banco->prepare($sql2);
			$stmt2->execute($parametros2);
			
			$erro1 = $stmt1->errorInfo();
			$erro2 = $stmt2->errorInfo();			
		
			if($erro2[0] == 0 && $erro1[0]==0){
				$banco->commit();
			}
			else{
				$banco->rollBack();
			}
		}catch(Exception $e){
			$banco->rollBack();
		}
		//print_r($erro1);
		//print_r($erro2);
		return $erro2[0] == 0 && $erro1[0] == 0;
	}
	
	
	public static function excluirPorId($id){
		$sql = "delete from Cliente where cliente.id_cliente = :id";
		
		$parametros = array(":id"=>$id);	
		try{
			$banco = new PDO(Banco::URL, Banco::USUARIO, Banco::SENHA);
		}catch(Exception $ex){
			echo $ex;
		}
		$stmt = $banco->prepare($sql);
		$stmt->execute($parametros);			
		$erro = $stmt->errorInfo();	
		return $erro[0] == 0;
	}
	
	public static function excluirPorNome($nome){
		$sql = "delete from Cliente where cliente.nome = $nome";
		
		$parametros = array(":nome"=>$nome);	
		try{
			$banco = new PDO(Banco::URL, Banco::USUARIO, Banco::SENHA);
		}catch(Exception $ex){
			echo $ex;
		}
		$stmt = $banco->prepare($sql);
		$stmt->execute($parametros);			
		$erro = $stmt->errorInfo();	
		return $erro[0] == 0;
	}
	
	/*
	public static function salvar($cliente){
		if($cliente->getId() > 0){
			return ClienteDAO::alterar($cliente);
		}else{
			return ClienteDAO::cadastrar($cliente);
		}
	} */
	
	public static function autenticar($email,$senha){
		$cliente = NULL;
		$sql = "select *from Cliente join Endereco where (email=:email and senha=sha2(:senha,512)) and Cliente.id_cliente = Endereco.id_cliente";
		
		try{
			$banco = new PDO(Banco::URL, Banco::USUARIO, Banco::SENHA);
		}catch(Exception $ex){
			echo $ex;
		}		
		$parametros = array(":email"=>$email, ":senha"=>$senha);
				
		$stmt = $banco->prepare($sql);
		$stmt->execute($parametros);
		
		while($obj = $stmt->fetchObject()){
			$endereco = new Endereco($obj->rua, $obj->numero, $obj->cidade, $obj->estado, $obj->cep);			
			$cliente = new Cliente($obj->cpf_login,$obj->nome, $obj->senha,  $obj->email,$obj->foto_perfil, $obj->nivel, $endereco, $obj->id_cliente);
			
			return $cliente;
		}
		return $cliente;
		
	}
	
	public static function buscarTodos(){
		$sql = "select * from Cliente join Endereco on Cliente.id_cliente = Endereco.id_cliente;";
		
		try{
			$banco = new PDO(Banco::URL, Banco::USUARIO, Banco::SENHA);
		}catch(Exception $ex){
			echo $ex;
		}
		$stmt = $banco->prepare($sql);
		$stmt->execute();		
		$retorno = array();
		
		while($obj = $stmt->fetchObject()){
			$endereco = new Endereco($obj->rua, $obj->numero, $obj->cidade, $obj->estado, $obj->cep);			
			$c = new Cliente($obj->cpf_login,$obj->nome, $obj->senha,  $obj->email,$obj->foto_perfil, $obj->nivel, $endereco, $obj->id);
			$retorno[] = $c;
		}
		return $retorno;
	}
	
	public static function buscarPorNome($nome){
		$sql = "select *from Cliente join Endereco where cliente.nome = :nome and Cliente.id_cliente = Endereco.id_cliente";

		try{
			$banco = new PDO(Banco::URL, Banco::USUARIO, Banco::SENHA);
		}catch(Exception $ex){
			echo $ex;
		}	
		$parametros = array(":nome"=>$nome);
		$stmt = $banco->prepare($sql);
		$stmt->execute($parametros);		
		$retorno = array();
		
		while($obj = $stmt->fetchObject()){
			$endereco = new Endereco($obj->rua, $obj->numero, $obj->cidade, $obj->estado, $obj->cep);			
			$c = new Cliente($obj->cpf_login,$obj->nome, $obj->senha,  $obj->email,$obj->foto_perfil, $obj->nivel, $endereco, $obj->id);
			$retorno[] = $c;
		}
		return $retorno;
	}
	
	public static function buscarPorId($id){
		$sql = "select *from Cliente join Endereco where cliente.id_cliente = :id and Cliente.id_cliente = Endereco.id_cliente";

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
			$endereco = new Endereco($obj->rua, $obj->numero, $obj->cidade, $obj->estado, $obj->cep);			
			$c = new Cliente($obj->cpf_login,$obj->nome, $obj->senha,  $obj->email,$obj->foto_perfil, $obj->nivel, $endereco, $obj->id);
			$retorno[] = $c;
		}
		return $retorno;
	}
	
}
?>

