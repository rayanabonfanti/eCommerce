<?php
	session_start();
	require_once($_SERVER['DOCUMENT_ROOT']."/ecommerce/funcionarios/importacoes.php");
	limparPost();
	validarFormulario();
	
	$numero_login = $_POST['numero_login'];
	$senha = $_POST['senha'];
	$funcionario = FuncionarioDAO::autenticar($numero_login,$senha);
	if($funcionario != NULL)
	{
		$_SESSION['funcionario'] = serialize($funcionario);
	}
	else
	{
		$_SESSION['mensagemLoginFuncionario'] = 0;
	}
	header("location: ../index.php");
?>
