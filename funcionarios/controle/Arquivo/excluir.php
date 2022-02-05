<?php
    require_once($_SERVER['DOCUMENT_ROOT']."/ecommerce/funcionarios/importacoes.php");
    $id_arquivo = $_GET['id_arquivo'];
    $numero_login_funcionario_arquivo = $_GET['numero_login_funcionario_arquivo'];
    $arquivo = ArquivoDAO::buscarArquivoPorId($id_arquivo);
    ArquivoDAO::excluirArquivoFuncionario1($id_arquivo,$numero_login_funcionario_arquivo);
    ArquivoDAO::excluirArquivoFuncionario2($id_arquivo);
    unlink("../../arquivos/".$arquivo->getEndereco());
    unlink("../../arquivos/icones/".$arquivo->getIcone());
    
	$func = FuncionarioDAO::buscaFuncionario($numero_login_funcionario_arquivo);
	
	if($func == null)
	{
		header("location: ../../index.php");
	}
	if($func->getNivelHierarquico()=="Administrador_Basico")
	{
		header("location: ../../index.php?p=5");
	}
	else if($func->getNivelHierarquico()=="Administrador_RH")
	{
		header("location: ../../index.php?p=2");
	}
	else if($func->getNivelHierarquico()=="Administrador_Supervisor")
	{
		header("location: ../../index.php?p=5");
	}
	else
	{
		header("location: ../../index.php?p=4");
	}
?>
