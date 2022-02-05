<?php
	session_start();
	require_once($_SERVER['DOCUMENT_ROOT']."/ecommerce/funcionarios/importacoes.php");
	limparPost();
	validarFormulario();
	
	$id = $_POST['id'];
	$preco = $_POST['preco'];


	if($preco == null)
	{
		$_SESSION['mensagemAlteracaoProduto'] = 0;
	}
	else
	{
		if(ProdutoDAO::alterarPrecoProduto($id,$preco))
		{
			$_SESSION['mensagemAlteracaoProduto'] = 1;
		}
		else 
		{
			$_SESSION['mensagemAlteracaoProduto'] = 0;
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
		header("location: ../../../index.php?p=1");
	}
	else if($func->getNivelHierarquico()=="Administrador_Supervisor")
	{
		header("location: ../../../index.php?p=1");
	}
	else if($func->getNivelHierarquico()=="Funcionario_Comum")
	{
		header("location: ../../../index.php?p=0");
	}
?>
