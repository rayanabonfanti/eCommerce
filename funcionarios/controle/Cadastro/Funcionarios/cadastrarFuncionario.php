<?php
	session_start();
	require_once($_SERVER['DOCUMENT_ROOT']."/ecommerce/funcionarios/importacoes.php");
	limparPost();
	validarFormulario();
	
	if($_POST["nivel"] == 1)
	{
		$nivel_hierarquico = "Funcionario_Comum";	
	}
	else if($_POST["nivel"] == 2)
	{
		$nivel_hierarquico = "Administrador_Basico";	
	}
	else if($_POST["nivel"] == 3)
	{
		$nivel_hierarquico = "Administrador_RH";	
	}
	else
	{
		$nivel_hierarquico = "Administrador_Supervisor";	
	}

	$nome = $_POST["nome"];
	$email = $_POST["email"];
	$cpf = $_POST["cpf"];
	$senha = $cpf;
	$cargo = $_POST["cargo"];
	$numero_login = $_POST["numero_login"];
	
	$funcionario1 = new Funcionario($senha,$cpf, $nome, $email, $nivel_hierarquico, $cargo, $numero_login);
		
	$numero_login_s = $_POST['numero_login_s'];
	$func = FuncionarioDAO::buscaFuncionario($numero_login_s);
	
	if($nome == null || $email == null || $cpf == 0 || $senha == 0 || $cargo == null || $numero_login == 0 || $_POST["nivel"] == 0)
	{
		$_SESSION['mensagemCadastroFuncionario'] = 1;
		if($func->getNivelHierarquico()=="Administrador_Basico")
		{
			header("location: ../../../index.php?p=0");
		}
		else if($func->getNivelHierarquico()=="Administrador_RH")
		{
			header("location: ../../../index.php?p=1");
		}
		else if($func->getNivelHierarquico()=="Administrador_Supervisor")
		{
			header("location: ../../../index.php?p=0");
		}
	}
	else
	{
		if(FuncionarioDAO::salvar($funcionario1))
		{
			$_SESSION['mensagemCadastroFuncionario'] = 0;
		}
		else 
		{
			$_SESSION['mensagemCadastroFuncionario'] = 1;
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
		header("location: ../../../index.php?p=0");
	}
	else if($func->getNivelHierarquico()=="Administrador_RH")
	{
		header("location: ../../../index.php?p=1");
	}
	else if($func->getNivelHierarquico()=="Administrador_Supervisor")
	{
		header("location: ../../../index.php?p=0");
	}
?>
