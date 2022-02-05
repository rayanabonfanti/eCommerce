<?php
	session_start();
	require_once($_SERVER['DOCUMENT_ROOT']."/ecommerce/funcionarios/importacoes.php");
	limparPost();
	validarFormulario();
	
	$id = $_POST['id'];
	$numero_login = $_POST['numero_login'];
	$resposta = $_POST['resposta'];

	if($id == 0 || $numero_login == 0 || $resposta == null)
	{
		$_SESSION['mensagemRespondeAtendimento'] = 0;
	}
	else
	{
		if(AtendimentoDAO::respondeAtendimento($id,$numero_login,$resposta))
		{
			$_SESSION['mensagemRespondeAtendimento'] = 1;
		}
		else 
		{
			$_SESSION['mensagemRespondeAtendimento'] = 0;
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
		header("location: ../../../index.php?p=4");
	}
	else if($func->getNivelHierarquico()=="Administrador_Supervisor")
	{
		header("location: ../../../index.php?p=4");
	}
	else if($func->getNivelHierarquico()=="Funcionario_Comum")
	{
		header("location: ../../../index.php?p=3");
	}


?>
