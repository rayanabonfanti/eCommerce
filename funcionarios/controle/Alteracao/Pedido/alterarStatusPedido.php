<?php
	session_start();
	require_once($_SERVER['DOCUMENT_ROOT']."/ecommerce/funcionarios/importacoes.php");
	limparPost();
	validarFormulario();
	
	$status_atualizacao = $_POST["status_atualizacao"];
	$id = $_POST['id'];

	if($status_atualizacao == null || $id == 0)
	{
		$_SESSION['mensagemAlteracaoStatusPedido'] = 0;
	}
	else
	{
		if(PedidoDAO::alterarStatusPedido($id,$status_atualizacao))
		{
			$_SESSION['mensagemAlteracaoStatusPedido'] = 1;
		}
		else 
		{
			$_SESSION['mensagemAlteracaoStatusPedido'] = 0;
		}
	}		

	$numero_login_s = $_POST['numero_login_s'];
	$func = FuncionarioDAO::buscaFuncionario($numero_login_s);
	
	if($func == null)
	{
		header("location: ../../../index.php");
	}
	if($func->getNivelHierarquico()=="Administrador_Basico")
	{
		header("location: ../../../index.php?p=3");
	}
	else if($func->getNivelHierarquico()=="Administrador_Supervisor")
	{
		header("location: ../../../index.php?p=3");
	}
	else if($func->getNivelHierarquico()=="Funcionario_Comum")
	{
		header("location: ../../../index.php?p=2");
	}
?>
