<?php
	session_start();
	require_once($_SERVER['DOCUMENT_ROOT']."/ecommerce/funcionarios/importacoes.php");
	limparPost();
	validarFormulario();
	
	$numero_login = $_POST['numero_login'];
	$salario = $_POST['salario'];

	if($numero_login == 0 || $salario == 0.0)
	{
		$_SESSION['mensagemAlteracaoFuncionario'] = 0;
	}
	else
	{
		if(FuncionarioDAO::alterarSalario($numero_login,$salario))
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
	else if($func->getNivelHierarquico()=="Administrador_RH")
	{
		header("location: ../../../index.php?p=0");
	}
	else if($func->getNivelHierarquico()=="Administrador_Supervisor")
	{
		header("location: ../../../index.php?p=2");
	}
?>
