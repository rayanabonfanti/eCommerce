<?php
	session_start();
	require_once($_SERVER['DOCUMENT_ROOT']."/ecommerce/funcionarios/importacoes.php");
	limparPost();
	validarFormulario();
		
	$nivel_hierarquico = "Administrador_Supervisor";
	$nome = $_POST["nome"];
	$email = $_POST["email"];
	$cpf = $_POST["cpf"];
	$senha = $cpf;
	$cargo = $_POST["cargo"];
	$numero_login = $_POST["numero_login"];
	
	$funcionario = new Funcionario($senha, $cpf, $nome, $email, $nivel_hierarquico, $cargo, $numero_login);
		
	if($nome == null || $email == null || $cpf == 0 || $senha == 0 || $cargo == null || $numero_login == 0)
	{
		$_SESSION['mensagemCadastroSupervisorFuncionario'] = 0;
		header("location: ../../../index.php");
	}
	else
	{
		if(FuncionarioDAO::salvar($funcionario))
		{
			$_SESSION['funcionario'] = serialize($funcionario);
			$_SESSION['mensagemCadastroSupervisorFuncionario'] = 1;
			header("location: ../../../index.php");
		}
		else 
		{
			$_SESSION['mensagemCadastroSupervisorFuncionario'] = 0;
			header("location: ../../../index.php");
		}
	}
		
?>
