<?php
	session_start();
	require_once($_SERVER['DOCUMENT_ROOT']."/ecommerce/funcionarios/importacoes.php");
	limparPost();
	validarFormulario();
	
	$numero_login = $_POST['numero_login'];
	if($_POST["nivel"] == 1)
	{
		$nivel = "Funcionario_Comum";	
	}
	else if($_POST["nivel"] == 2)
	{
		$nivel = "Administrador_Basico";	
	}
	else if($_POST["nivel"] == 3)
	{
		$nivel = "Administrador_RH";	
	}
	else
	{
		$nivel = "Administrador_Supervisor";	
	}

	if($numero_login == 0 || $_POST["nivel"] == 0)
	{
		$_SESSION['mensagemAlteracaoFuncionario'] = 0;
	}
	else
	{
		if(FuncionarioDAO::alterarNivel($numero_login,$nivel))
		{
			$_SESSION['mensagemAlteracaoFuncionario'] = 1;
		}
		else 
		{
			$_SESSION['mensagemAlteracaoFuncionario'] = 0;
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
		header("location: ../../../index.php?p=2");
	}
	else if($func->getNivelHierarquico()=="Administrador_Supervisor")
	{
		header("location: ../../../index.php?p=2");
	}
?>
