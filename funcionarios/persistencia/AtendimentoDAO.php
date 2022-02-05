<?php
	class AtendimentoDAO
	{
		public static function todos()
		{
			$sql = "select atendimento_id_cliente,id_pedido,numero_login_funcionario,pergunta,resposta,id from atendimento";

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
				$p = new Atendimento($obj->atendimento_id_cliente,$obj->id_pedido,$obj->numero_login_funcionario,$obj->pergunta,$obj->resposta,$obj->id);
				$retorno[] = $p;
			}		
			return $retorno;
		}

		public static function respondeAtendimento($id,$numero_login,$resposta)
		{
			$sql = "update atendimento set numero_login_funcionario = :numero_login, resposta = :resposta where id = :id";

			try
			{
				$banco = new PDO(Banco::URL,Banco::USUARIO,Banco::SENHA);
			}
			catch(PDOException $ex)
			{
				echo 'Erro de conexão: ' . $ex->getMessage();
			}

			$stmt = $banco->prepare($sql);
			$stmt->execute(array(":id"=>$id,":numero_login"=>$numero_login,":resposta"=>$resposta));
			return $count = $stmt->rowCount();
		}
	}
?>
